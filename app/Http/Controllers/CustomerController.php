<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRegistration;
use App\Models\Customers;
use App\Http\Controllers\DropdownController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function customer_registration_form(){

        $result = (new DropdownController)->index();
        return view('admin.customers.customeradd', $result);
    }

    public function add_customers(CustomerRegistration $request){

        $imageName = date('d-m-y').'.'.($request->phone).'.'.($request->profile_image->getClientOriginalName());
        $priorPath = ("images/customers/uploads");
        if(!$priorPath){
            File::makeDirectory("images/customers/uploads");
        }


       $path =  $request->profile_image->move($priorPath,$imageName);

       // dd($request->country."      ".$request->state."        ".$request->city);
            $addCustomer = Customers::create([

                'profile_image' => $path,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' =>$request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'zipcode' => $request->zipcode,
                'password' => $request->password,
            ]);
                if($addCustomer){
                    return redirect('/addcustomer');
                }

    }

    public function view_customerslist(){
        return view('admin.customers.customerslist');
    }

    public function getCustomers(Request $request)
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
        $totalRecords = Customers::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Customers::select('count(*) as allcount')->where('fullname', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Customers::orderBy('customers.id', "desc")
            ->where('customers.fullname', 'like', '%' . $searchValue . '%')
            ->select('customers.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data = array();
        $counter = 0;
        foreach ($records as $record) {

            if($record['status'] == '0')
            {
                $status = '<span class="">Active</span>';
            }
            else
            {
                $status = '<span class="">Inactive</span>';
            }

            $row = array();
            $row[] = ++$counter;

            if($record['profile_image'] == ''){
                $img = substr(StrtoUpper($record['fullname']),0,1);
            }
            else{
                 $img = '<img src ="' . $record['profile_image'] . '">';
            }

            $row[] = $img;

            $row[] = $record['fullname'];

            $row[] = $record['email'];

            $row[] = $record['phone'];

            $row[] = $record['country'];

            $row[] = $record['state'];

            $row[] = $record['city'];

            $row[] = $record['address_1'];

            $row[] = $record['address_2'];

            $row[] = $record['zipcode'];


            $row[] = $status;

            $Action = '';


            $Action .= '<a href="javascript" class="btn btn-secondary">edit</a>&nbsp;|';


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
    public function view_specific_customer($id){
        $customer = Customers::where('id', $id);
        return view('admin.customers.viewspecificcustomer', compact('customer'));
    }


}