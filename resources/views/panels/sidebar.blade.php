<style>

</style>
<div class="sidebar">
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="nav-profile-image">
                            <img src="assets/images/faces/face1.jpg" alt="profile">
                            <span class="login-status online"></span>
                            <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex flex-column">
                            <span class="font-weight-bold mb-2">@auth
                                    {{ auth()->user()->name }}</span>
                            @endauth
                            <span class="text-secondary text-small">...</span>
                        </div>
                        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ '/' }}">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-home menu-icon"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <ul class="nav flex-column sub-menu">

                        {{-- @auth
                            {{ dd(auth()->user()->name) }}
                        @endauth --}}
                        {{-- @auth @if (auth()->user()->name == '') --}}
                        <li class="nav-item"> <a class="nav-link" href="{{ route('Users.login') }}"> Login </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('Users.register') }}"> Register</a>
                        </li>
                        {{-- @endif() @endauth --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('Category.category') }}">Category</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('viewusers') }}">Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('view_customerslist') }}">Customers</a>
                        </li>

                    </ul>
                </li>


            </ul>
        </nav>
        <!-- partial -->

        <!-- main-panel ends -->
    </div>
</div>
