<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */

    public function addusers(){
        return view('admin.users.usersadd');
    }

    public function addusersform(Request $request){
        $storeData = $request->validate([
            'name' => 'required|max:255',
            'profile_image' => 'mime:jpeg,png,jpg,gif',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);

        $imageName = date('d-m-y').'.'.$storeData['name'].'.'.($storeData['profile_image']->getClientOriginalName());
        $priorPath = ("images/users/uploads");
        if(!$priorPath){
            File::makeDirectory("images/users/uploads");
        }
       $path =  $storeData['profile_image']->move($priorPath,$imageName);

        $users = User::create($storeData);

        if($users){
            return redirect('/users');
        }

    }
    public function viewusers(){
        return view('admin.users.users');
    }
    public function getUser(Request $request)
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
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy('users.id', "desc")
            ->where('users.name', 'like', '%' . $searchValue . '%')
            ->select('users.*')
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
                $img = substr(StrtoUpper($record['name']),0,1);
             }
             else{
                 $img = '<img src ="' . $record['profile_image'] . '">';
             }

            $row[] = $img;

            $row[] = $record['name'];

            $row[] = $record['email'];

            $row[] = $record['phone'];


            $row[] = $status;

            $Action = '';


            $Action .= '<a href="' . route('Users.edit', $record['id']) . '" class="btn btn-secondary">edit</a>&nbsp;|';


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
    public function viewspecificuser($id){
        $users = User::where('id',$id)->first();
        return view('admin.users.usersview', compact('users'));
    }
    public function edit($id)
    {
        $users = User::findorfail($id);
        return view('admin.users.usersedit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateForm(Request $request, string $id)
    {
        $updateData = $request->validate([
            'name' => 'required|max:255',
            'profile_image' => 'mimes:jpeg,png,jpg,gif',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'status' => 'required',
        ]);


        $imageName = date('d-m-y').'.'.$updateData['name'].'.'.($updateData['profile_image']->getClientOriginalName());
        $priorPath = ("images/users/uploads");
        if(!$priorPath){
            File::makeDirectory("images/users/uploads");
        }


       $path =  $updateData['profile_image']->move($priorPath,$imageName);

       $updateData['profile_image'] = $path;

        User::whereId($id)->update($updateData);
        return redirect('users')->with('completed', 'user has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect('/users')->with('completed', 'User has been deleted');
    }
}