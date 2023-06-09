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
    public function category(){
        $categories = DB::table('category')->get();
        return view('admin.category.category', compact('categories'));
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