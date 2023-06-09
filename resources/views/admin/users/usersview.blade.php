@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('page-css')

@endsection

@section('page-contant')
    <style>
        .view_specific_users {
            margin-top: 100px;
            margin-left: 50px;
        }
    </style>
    <div class="view_specific_users">
        <h1>View User</h1>
        <div class="form-group">
            <label for="category_name">User's Name:</label>
            {{ $users->name }}
        </div>
        <div class="form-group">
            <label for="category_name">User's Email:</label>
            {{ $users->email }}
        </div>
        <div class="form-group">
            <label for="category_name">User's Phone Number:</label>
            {{ $users->phone }}
        </div>
        <h3>Status:</h3>
        <div class="form-group">
            <p>
                @if ($users->status == 0)
                    Active
                @else
                    InActive
                @endif
            </p>
        </div>
    </div>

@endsection

@section('page-js')

@endsection
