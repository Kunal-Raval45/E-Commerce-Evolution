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
    public function category(Request $request){

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

      // Custom search filter
    //   $searchCity = $request->get('searchCity');
    //   $searchGender = $request->get('searchGender');
      $searchName = $request->get('searchName');

      // Total records
      $records = Category::select('count(*) as allcount');

                // if(!empty($searchCity)){
                //     $records->where('city',$searchCity);
                // }
                // if(!empty($searchGender)){
                //     $records->where('gender',$searchGender);
                // }
                if(!empty($searchName)){
                    $records->where('categoryName','like','%'.$searchName.'%');
                }
                $totalRecords = $records->count();
                // Total records with filter
                $records = Category::select('count(*) as allcount')->where('categoryName', 'like', '%' .$searchValue . '%');

                ## Add custom filter conditions
                // if(!empty($searchCity)){
                //     $records->where('city',$searchCity);
                // }
                // if(!empty($searchGender)){
                //     $records->where('gender',$searchGender);
                // }
                if(!empty($searchName)){
                    $records->where('categoryName','like','%'.$searchName.'%');
                }
                $totalRecordswithFilter = $records->count();

                // Fetch records
                $records = Category::orderBy($columnName,$columnSortOrder)
                            ->select('users_4.*')
                            ->where('users_4.name', 'like', '%' .$searchValue . '%');
                ## Add custom filter conditions
                if(!empty($searchCity)){
                    $records->where('city',$searchCity);
                }
                if(!empty($searchGender)){
                    $records->where('gender',$searchGender);
                }
                if(!empty($searchName)){
                    $records->where('categoryName','like','%'.$searchName.'%');
                }
                $employees = $records->skip($start)
                            ->take($rowperpage)
                            ->get();

                $data_arr = array();
                foreach($employees as $employee){

                    $username = $employee->username;
                    $name = $employee->name;
                    $email = $employee->email;
                    $gender = $employee->gender;
                    $city = $employee->city;

                    $data_arr[] = array(
                        "username" => $username,
                        "name" => $name,
                        "email" => $email,
                        "gender" => $gender,
                        "city" => $city,
                    );
                }

                $response = array(
                    "draw" => intval($draw),
                    "iTotalRecords" => $totalRecords,
                    "iTotalDisplayRecords" => $totalRecordswithFilter,
                    "aaData" => $data_arr
                );

                return response()->json($response);
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


        // dd($category);
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