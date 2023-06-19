@extends('layouts.mainlayout')

@section('title', 'profile')

@section('page-css')

@endsection

@section('page-contant')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile {
            margin-top: 200px
        }
    </style>
    <div class="profile container mt-6">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        {{-- <img src="profile-picture.jpg" alt="Profile Picture" class="img-fluid rounded-circle mb-3"
                            width="200"> --}}
                        <h1>{{ $users->name }}</h1>
                        <div>

                            <div>
                                <div class="dropdown-item">
                                    <button class="btn btn-light" id="edit_profile"><i id="edit-profile"
                                            class="mdi mdi-account-edit me-2 text-primary"></i>EDIT
                                        PROFILE</button>
                                </div>
                            </div>

                            <div>
                                <div class="dropdown-item">
                                    <button class="btn btn-light" id="changePassword"> <i id="password"
                                            class="mdi mdi-account-edit me-2 text-primary"></i>CHANGE PASSWORD</button>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div id="editprofileform" style="display: none;">
                            <h1>Edit Profile</h1>
                            {{-- @yield('edit-content') --}}

                            <!-- Add your edit profile form elements here -->
                        </div>
                        <div id="changepasswordform" style="display: none;">
                            <h1>Change Password</h1>
                            <!-- Add your change password form elements here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

@endsection

@section('page-js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#changePassword").click(function() {
                $("#changepasswordform").show();
                $("#editprofileform").hide();
            });
            $("#edit_profile").click(function() {
                $("#changepasswordform").hide();
                $("#editprofileform").show();
            });
        });
    </script>
@endsection
