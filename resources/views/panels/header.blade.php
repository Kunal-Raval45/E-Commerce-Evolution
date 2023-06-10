<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    #more_settings {
        position: absolute;
        left: -210px;
        /* Adjust the value to position it properly */
        top: 0;
        background-color: #ffffff;
        border: 1px solid #f1ecec;
        border-radius: 5px;
        box-shadow: 2px black;
        padding: 10px;
    }
</style>
<div class="header">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg"
                    alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <div class="search-field d-none d-md-block">
                <form class="d-flex align-items-center h-100" action="#">
                    <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                            <i class="input-group-text border-0 mdi mdi-magnify"></i>
                        </div>
                        <input type="text" class="form-control bg-transparent border-0"
                            placeholder="Search projects">
                    </div>
                </form>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="assets/images/faces/face1.jpg" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black">{{ session('username') }}</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <div class="dropdown-divider"></div>
                        @if (session('username'))
                            <div id="settings">
                                <div class="dropdown-item">
                                    <i id="profile" class="mdi mdi-settings me-2 text-primary"></i>Settings
                                </div>
                            </div>
                            <div id="more_settings" style="display: none">
                                <div id="view_profile">
                                    <a class="dropdown-item" href="{{ route('userprofileupdate', session('id')) }}">
                                        <i id="profile" class="mdi mdi-account me-2 text-primary"></i> View Profile
                                    </a>
                                </div>
                                <div id="change_password">
                                    <a class="dropdown-item" href="">
                                        <i id="profile" class="mdi mdi-account-edit me-2 text-primary"></i> Change
                                        Password
                                    </a>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                        @endif()
                    </div>
                </li>
                <li class="nav-item nav-settings d-none d-lg-block">
                    <a class="nav-link" href="#">
                        <i class="mdi mdi-format-line-spacing"></i>
                    </a>
                </li>
            </ul>

        </div>
    </nav>
</div>
<script>
    $(document).ready(function() {
        $("#settings").hover(function() {
            $("#more_settings").show();
        });
    });
</script>
