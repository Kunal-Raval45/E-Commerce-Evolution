@extends('layouts.mainlayout')

@section('title', 'Edit Category')

@section('page-css')

@endsection

@section('page-contant')


    <style>
        .editCategory {
            margin-top: 100px;

        }
    </style>
    @if ($category->status == 0)
        <style>
            .active-border {
                border: 2px solid #0cbd15;
                color: #0cbd15 border-radius: 4px;
                padding: 8px;
            }
        </style>
    @else
        <style>
            .inactive-border {
                border: 2px solid #bd0c0c;
                color: #bd0c0c border-radius: 4px;
                padding: 8px;
            }
        </style>
    @endif
    <div class="container">
        <div class="editCategory">
            <h1>Edit Category</h1>
            <form id="myForm" method="POST" action="{{ route('editcategories', $category->id) }}" id="storecategory"
                enctype="multipart/form-data">

                @csrf
                <div class="form-group">
                    <label for="category_name">Category Name:</label>
                    <input type="text" class="form-control" value="{{ $category->categoryName }}" id="category_name"
                        name="category_name">
                </div>

                <div class="form-group">
                    <label for="category_name">Current Image:</label>
                    <img src="../{{ $category->img }} " width="250">
                </div>


                <div class="form-group">
                    <label for="category_name">Upload an Image:</label>
                    <input type="file" class="form-control" id="cat_img" name="cat_img">
                </div>
                <h3>Status:</h3>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="active" name="status" id="activeRadio"
                        value="0" checked>
                    <label class="form-check-label active-border" for="activeRadio">
                        Active
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inactive" name="status" id="inactiveRadio"
                        value="1">
                    <label class="form-check-label inactive-border" for="inactiveRadio">
                        <b id="inactive">Inactive</b>
                    </label>
                </div>
        </div>
        <div class="form-group">
            <button id="add" type="submit" name="submit" class="btn btn-primary">UPDATE</button>
        </div>

        </form>
    </div>
    </div>
@endsection

@section('page-js')

@endsection
