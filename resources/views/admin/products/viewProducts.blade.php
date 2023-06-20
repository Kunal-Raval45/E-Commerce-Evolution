@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('page-css')

@endsection

@section('page-contant')

    <div>
        <h1>Products</h1>
        <a class="btn btn-primary" href="{{ route('addProducts') }}">Add Products</a>
    </div>

@endsection

@section('page-js')

@endsection
