@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('page-css')
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
@endsection

@section('page-contant')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PROFILE</h5>
                        <img src="{{ auth()->user()->profile_image }}" width="150"><br>
                        <button class="btn btn-primary" id="editProfileBtn">Edit Profile</button>
                        <button class="btn btn-primary" id="changePasswordBtn">Change Password</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" id="formContainer">
                        <!-- Form will be dynamically added here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Form -->
    <div id="editProfileForm" style="display: none;">
        <h5>Edit Profile</h5>
        <!-- Add your form fields here -->
        <form id='editProfileform' method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}">
            </div>
            <div class="form-group">
                <label for="image">Update Image:</label>
                <input type="file" class="form-control" name="profile_image" id="file">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email"
                    value="{{ auth()->user()->email }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" name="phone" id="phone"
                    value="{{ auth()->user()->phone }}">
            </div>
            <button class="btn btn-primary update_profile">UPDATE</button>
        </form>
    </div>

    <!-- Change Password Form -->
    <div id="changePasswordForm" style="display: none;">
        <h5>Change Password</h5>
        <!-- Add your form fields here -->
        <form method="POST" id="changePasswordForm">
            @csrf
            <div class="form-group">

                <label for="currentPassword">Current Password:</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                    placeholder="Enter your current password" required>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword"
                    placeholder="Enter your new password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                    placeholder="Confirm your new password" required>
            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <button class="btn btn-primary change_password">UPDATE</button>
        </form>
        </form>
    </div>

@endsection

@section('page-js')
    <script>
        $(document).ready(function() {
            // Edit Profile Button Click Event
            $("#editProfileBtn").click(function() {
                $("#formContainer").html($("#editProfileForm").html());
            });

            // Change Password Button Click Event
            $("#changePasswordBtn").click(function() {
                $("#formContainer").html($("#changePasswordForm").html());
            });
        });
    </script>

    <script type="text/javascript">
        $('#editProfileForm').ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".update_profile").click(function(e) {

                e.preventDefault();

                var name = $("#name").val();
                var profile_image = $("#profile_image").val();
                var email = $("#email").val();
                var phone = $("#phone").val();

                $.ajax({

                    type: 'POST',
                    url: "{{ route('updateProfile') }}",
                    data: {
                        name: name,
                        profile_image: profile_image,
                        email: email,
                        phone: phone
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            alert(data.success);

                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });

            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        });

        $('#change_password').ready(function() {
            $(".change_password").click(function(e) {

                e.preventDefault();

                var currentPassword = $("#currentPassword").val();
                var newPassword = $("#newPassword").val();
                var confirmPassword = $("#confirmPassword").val();


                $.ajax({
                    type: 'POST',
                    url: "{{ route('updatePassword') }}",
                    data: {
                        currentPassword: currentPassword,
                        newPassword: newPassword,
                        confirmPassword: confirmPassword
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            alert(data.success);

                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });

            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        });
    </script>
@endsection
