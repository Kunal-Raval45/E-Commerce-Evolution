@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('page-css')

@endsection

@section('page-contant')

    <div>
        <h1>Edit Users</h1>
        <div class="container mt-5 ml-5">
            <form id="myForm" method="POST" action="{{ route('Users.updateForm', $users->id) }}"
                enctype="multipart/form-data">

                @csrf
                <div class="form-group">
                    <label for="user_name">User's Name:</label>
                    <input type="text" class="form-control" value="{{ $users->name }}" id="user_name" name="name">
                </div>
                <div class="form-group">
                    <label for="user_name">User's Image:</label>
                    @if ($users->profile_image)
                        <img src="../{{ $users->profile_image }}" width="250">
                    @else
                        <p>No Image Found</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="user_email">Change User's Image:</label>
                    <input type="file" class="form-control" name="profile_image">
                </div>
                <div class="form-group">
                    <label for="user_email">User's Email:</label>
                    <input type="email" class="form-control" value="{{ $users->email }}" id="user_email" name="email">
                </div>
                <div class="form-group">
                    <label for="user_email">User's Phone Number:</label>
                    <input type="text" class="form-control" value="{{ $users->phone }}" id="user_phone" name="phone">
                </div>
                <h3>Status:</h3>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="active" name="status" id="activeRadio"
                        value="0" checked>
                    <label class="form-check-label active-border" for="activeRadio">
                        <b id="inactive">Active</b>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inactive" name="status" id="inactiveRadio"
                        value="1">
                    <label class="form-check-label inactive-border" for="inactiveRadio">
                        <b id="inactive">Inactive</b>
                    </label>
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
