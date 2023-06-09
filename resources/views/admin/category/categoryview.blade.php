@extends('layouts.mainlayout')

@section('title', 'Add Category')

@section('page-css')

@endsection

@section('page-contant')
    <style>

    </style>
    <div class="container">
        <div class="editCategory">
            <h1>Edit Category</h1>

            <div class="form-group">
                <label for="category_name">Category Name:</label>
                <h1>{{ $category->categoryName }} </h1>
            </div>

            <div class="form-group">
                <label for="category_name">Current Image:</label>
                <img src="../{{ $category->img }} " width="250">
            </div>

            <h3>Status:</h3>
            <div class="form-group">

                <p>
                    @if ($category->status == 0)
                        Active
                    @else
                        InActive
                    @endif
                </p>
            </div>
        </div>
    </div>

@endsection

@section('page-js')

@endsection
