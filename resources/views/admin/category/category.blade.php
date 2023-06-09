@extends('layouts.mainlayout')

@section('title', 'Add Category')

@section('page-css')

@endsection

@section('page-contant')

    <div class="container">
        <h1>Category</h1>
        <a href="{{ route('Category.viewAddCategory') }}"><button class="btn btn-primary mb-4">ADD</button></a>
        <style>
            .table,
            tr,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;

                text-align: center
            }
        </style>
        <div class="container">

            <div class="">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>1</td>
                                <td>{{ $category->categoryName }}</td>
                                <td><img src="{{ $category->img }}" width="100"></td>
                                <td>
                                    @if ($category->status == 0)
                                        Active
                                    @else
                                        InActive
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('Category.viewEditCategory', $category->id) }}"
                                        class="btn btn-primary">EDIT</a>
                                    <a href="{{ route('Category.viewCategory', $category->id) }}"><button
                                            class="btn btn-primary">VIEW</button></a>
                                    <a href="#" class="btn btn-danger">DELETE</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>

@endsection

@section('page-js')

@endsection
