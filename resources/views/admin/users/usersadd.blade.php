@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('page-css')

@endsection

@section('page-contant')

    <div>
        <h1>Add Users</h1>

        <form action="{{ route('addusersform') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">User's Name</label>
                <input type="text" class="form-control" name="name" id="name" />
            </div>
            <div class="form-group">
                <label for="email">User's Email</label>
                <input type="email" class="form-control" name="email" id="email" />
            </div>
            <div class="form-group">
                <label for="phone">User's Phone Number</label>
                <input type="tel" class="form-control" name="phone" id="phone" />
            </div>
            <div class="form-group">
                <label for="password">User's Password</label>
                <input type="password" class="form-control" name="password" id="password" />
            </div>
            <div class="form-group">
                <label for="password">User's Confirm Password</label>
                <input type="password" class="form-control" name="cpassword" id="cpassword" />
            </div>
            <button type="submit" class="btn btn-block btn-danger">ADD</button>
        </form>

        </form>
    </div>

@endsection

@section('page-js')

@endsection
