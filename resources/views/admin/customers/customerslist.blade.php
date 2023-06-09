@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('page-css')

@endsection

@section('page-contant')

    <div>
        <h1>Custmor's List</h1>
        <a href="{{ route('customer_registration_form') }}" class="btn btn-outline-primary">ADD</a>
        <div>
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Profile Image</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Address 1</th>
                    <th>Address 2</th>
                    <th>Zipcode</th>
                </tr>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td><img src="{{ $customer->profile_image }}" width="150"></td>
                        <td>{{ $customer->fullname }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->country }}</td>
                        <td>{{ $customer->state }}</td>
                        <td>{{ $customer->city }}</td>
                        <td>{{ $customer->address_1 }}</td>
                        <td>{{ $customer->address_2 }}</td>
                        <td>{{ $customer->zipcode }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection

@section('page-js')

@endsection
