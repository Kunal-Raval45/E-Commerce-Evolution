<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function viewProducts(){

        return view('admin.products.viewProducts');

    }

    public function addProducts(){

        $categoryNames = Category::all();
        return view('admin.products.addProducts', compact('categoryNames'));

    }

    public function addProductsForm(Request $request){

        $addProducts = $request->validate([
            'categoryName' => 'required|max:255',
            'profile_image' => 'mime:jpeg,png,jpg,gif',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);

    }
}