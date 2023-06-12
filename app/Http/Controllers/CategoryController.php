<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryAdd;
use App\Http\Requests\CategoryEdit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    public function category()
    {
        return view('admin.category.category');
    }

    public function getCategory(Request $request)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');

        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Category::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Category::select('count(*) as allcount')->where('categoryName', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Category::orderBy('category.id', "desc")
            ->where('category.categoryName', 'like', '%' . $searchValue . '%')
            ->select('category.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $counter = 0;
        foreach ($records as $record) {

            if($record['status'] == '1')
            {
                $status = '<span class="">Active</span>';
            }
            else
            {
                $status = '<span class="">Inactive</span>';
            }

            $row = array();
            $row[] = ++$counter;

            $row[] = '<img src ="'. $record['img'] . '">';

            $row[] = $record['categoryName'];

            $row[] = $status;

            $Action = '';


            $Action .= '<a href="' . route('Category.viewEditCategory', $record['id']) . '" class="btn btn-secondary">edit</a>&nbsp;|';


            $Action .= '<a href="javascript:;" class="btn">view</a>&nbsp;|';


            $Action .= '<a data-id="" href="javascript:;" class="btn">delete</a>';



            $row[] = $Action;
            $data[] = $row;
        }

        $output = array(
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecordswithFilter,
            "data" => $data,
        );

        echo json_encode($output);
        exit;
    }


    public function viewCategory($id){
        $category = DB::table('category')->where('id',$id)->first();
            return view('admin.category.categoryview', compact('category'));
    }
    public function viewAddCategory(){
        return view('admin.category.categoryadd');
    }
    public function viewEditCategory($id){
        $category = DB::table('category')->where('id',$id)->first();
        return view('admin.category.categoryedit', compact('category'));
    }


    public function storecategory(CategoryAdd $request){



        $imageName = date('d-m-y').'.'.($request->cat_img->getClientOriginalName());
        $priorPath = ("images/categories/uploads");
        if(!$priorPath){
            Storage::makeDirectory("images/categories/uploads");
        }


       $path =  $request->cat_img->move($priorPath,$imageName);

        // dd($path);
        $category = DB::table('category')->insert([
            'categoryName' => $request->category_name,
            'img'=> $path,
        ]);

        if($category){
            return redirect('/addCategory');
        }
    }
    public function editcategories(CategoryEdit $request, $id){

        $previousImage = DB::table('category')->where('id', $id)->first();
        $newimage = date('d-m-y').'.'.($request->cat_img->getClientOriginalName());
        $priorPath = ("images/categories/uploads");
        if(!$priorPath){
            Storage::makeDirectory("images/categories/uploads");
        }


       $path =  $request->cat_img->move($priorPath,$newimage);
    //    dd($previousImage->img."   New Path    ".$path);
        if($previousImage != $path){
            File::delete([$previousImage->img]);
        }

        $category = DB::table('category')->update([
            'categoryName' => $request->category_name,
            'img'=> $path,
            'status' =>$request->status,
        ]);

        if($category){
            return redirect('/Category');
        }

    }
}