<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function viewProducts(){

        return view('admin.products.viewProducts');

    }

    public function getProducts(Request $request){
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
        $totalRecords = products::select('count(*) as allcount')->count();
        $totalRecordswithFilter = products::select('count(*) as allcount')->where('product_name', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = products::orderBy('products.id', "desc")
            ->where('products.product_name', 'like', '%' . $searchValue . '%')
            ->select('products.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $counter = 0;
        foreach ($records as $record) {

            if($record['product_status'] == '1')
            {
                $status = '<span class="">Active</span>';
            }
            else
            {
                $status = '<span class="">Inactive</span>';
            }

            $row = array();
            $row[] = ++$counter;

            if($record['product_thumbnail'] == ''){
                // $img = substr(StrtoUpper($record['name']),0,1);
                $img = 'No image.';

             }
             else{
                 $img = '<img src ="' . $record['product_thumbnail'] . '">';
             }

            $row[] = $record['category_id'];

            $row[] = $img;

            $row[] = $record['product_name'];

            $row[] = $record['product_brand'];

            $row[] = $record['product_code'];


            $row[] = $status;

            $Action = '';


            $Action .= '<a href="javascript:; " class="btn btn-secondary">edit</a>&nbsp;|';


            $Action .= '<a href="'. route('viewSpecificProduct', $record['category_id']) . '" class="btn">view</a>&nbsp;|';


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

    public function addProducts(){

        $categoryNames = Category::all();
        return view('admin.products.addProducts', compact('categoryNames'));

    }

    public function addProductsForm(Request $request){

        $validator = Validator::make($request->all(), [

            'categoryName' => 'required',
            'product_name'  => 'required',
            'product_brand' => 'required',
            'product_code' => 'required',
            'product_thumbnail' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'product_stock_quantity' => 'required',
           'product_status' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        $thumbnail = $request->product_thumbnail;

        $imageName = date('d-m-y').'.'.$request->product_name.'.'.($request->product_thumbnail->getClientOriginalName());
        $priorPath = ("images/products/thumbnails");

        $path = $request->product_thumbnail->move($priorPath,$imageName);

        $addProducts = [
            'category_id' => $request->categoryName,
            'product_name' => $request->product_name,
            'product_brand' => $request->product_brand,
            'product_code' => $request->product_code,
            'product_thumbnail' => $path,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'product_stock_quantity' => $request->product_stock_quantity,
            'product_status' => $request->product_status,
        ];



        products::create($addProducts);

        return redirect('/addproducts');

    }

    public function viewSpecificProduct(String $id){

        $Products = products::leftjoin('category','products.category_id','=','category.id')->select('products.*','category.categoryName')->first();
        $status = '';


        if($Products->product_status == 1){
            $status = 'Active';
        }
        $status = 'InActive';
        return view('admin.products.viewSpecificProduct', compact('Products'))->with($status);

    }
}