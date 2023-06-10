<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        return view('admin.auth.register');
    }
    public function login()
    {
        return view('admin.auth.login');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function registrationForm(Request $request)
    {

        $storeData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);



        $users = DB::table('users')->insert([
            'name' => $storeData['name'],
            'email' => $storeData['email'],
            'phone' => $storeData['phone'],
            'password' => md5($storeData['password']),
        ]);

        if($users){
            return redirect('/login');
        }

    }
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
       $users =  User::where('id','!=',session('id'))->get();

        return view('admin.users.users', compact('users'));
    }

    public function viewspecificuser($id){
        $users = User::where('id',$id)->first();
        return view('admin.users.usersview', compact('users'));
    }

    public function userprofileupdate($id){

        $users = User::where('id',$id)->first();
        return view('admin.users.profile', compact('users'));

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



    public function loginForm(Request $request)
    {
        $check = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);



        $users = DB::table('users')->whereEmailAndPassword($check['email'], Hash::make(($check['password'])))->first();


        if($users){

            Session::put('username', $users->name);
            Session::put('id', $users->id);

            return redirect('/');
        }

    }
    public function logout(){

        session()->flush();
        return redirect('/');
    }
}