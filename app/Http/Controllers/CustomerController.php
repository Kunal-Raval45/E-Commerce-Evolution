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
        $customers = Customers::all();
        return view('admin.customers.customerslist', compact('customers'))->with('i');
    }

    public function view_specific_customer($id){
        $customer = Customers::where('id', $id);
        return view('admin.customers.viewspecificcustomer', compact('customer'));
    }


}