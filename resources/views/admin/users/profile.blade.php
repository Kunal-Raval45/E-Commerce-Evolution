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
                        <img src="profile-picture.jpg" alt="Profile Picture" class="img-fluid rounded-circle mb-3"
                            width="200">
                        <h5 class="card-title">John Doe</h5>
                        <p class="card-text">Web Developer</p>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-envelope"></i> john.doe@example.com</li>
                            <li><i class="fa fa-phone"></i> 123-456-7890</li>
                            <li><i class="fa fa-map-marker"></i> New York, USA</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">About Me</h5>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla fringilla, sapien vitae lacinia
                            posuere, sem ipsum consequat mi, at gravida nunc dolor in velit. Sed sit amet dapibus mauris.
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus
                            efficitur malesuada lacus, vitae dapibus ligula vulputate in. Nulla vitae finibus felis, ut
                            rutrum
                            leo. In dapibus eu purus id eleifend.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

@endsection

@section('page-js')

@endsection
