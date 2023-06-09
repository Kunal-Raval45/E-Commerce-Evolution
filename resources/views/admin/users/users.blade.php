@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('page-css')

@endsection

@section('page-contant')

    <div>
        <h1>USERS</h1>
        <a class="btn btn-info" href="{{ route('addusers') }}">Add Users</a>
        <div>

            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>STATUS</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>1</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>

                                <td>
                                    @if ($user->status == 0)
                                        Active
                                    @else
                                        InActive
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('Users.edit', $user->id) }}" class="btn btn-primary">EDIT</a>
                                    <a href="{{ route('viewspecificuser', $user->id) }}"><button
                                            class="btn btn-dark">VIEW</button></a>
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
