<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="head">

            {{-- <div class="input-group">
                <div class="form-outline">
                    <input type="text" class="form-control" establishmentholder="Search" aria-label="Search" aria-describedby="addon-wrapping">
                </div>
                <button type="button" class="btn btn-primary" style="height:38px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                      </svg>
                </button>
   
            </div>
            <a href="/admin" style="display:inline-block;width:100px;">Admin view</a>
            <button type="button" class="login">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
            </button> --}}
            
            <nav class="navbar navbar-expand-lg navbar-light ">

            <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="/">Home</a>

                <button class="navbar-toggler mr-2" style="color: #e5e3df;" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    
                    <div class="auth" style="display: flex;">
                        @auth
                            @if (Auth::user()->rol == 'admin')
                                <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="/admin" > Admin Panel </a>
                            @endif
                        @endauth
                        @guest
                            <div class="auth" style="display: flex;">
                                <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="/signin">Sign up</a>
                                <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="/login">Login</a>
                            </div>
                        @else
                            {{-- <div>
                                <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="#">{{ Auth::user()->name }}</a>
                            </div> --}}
                            <div class="dropdown" style="padding: 0; display: inline-block;">
                                <button class="btn dropdown-toggle" style="background-color: transparent; color:rgb(221, 221, 221);" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="/profile" style="padding: 0;"><button class="btn">Profile</button></a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" style="padding: 0;"><button type="submit" class="btn" form="logout-form">Logout</button></a>
                                </div>
                            </div>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                @csrf
                                @method('post')
                            </form>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>

        <main class="py-0 content-section">
            @yield('content')
            <div class="separator"></div>
        </main>
        <div class="footer-basic">
            <footer>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="/">Home</a></li>
                    <li class="list-inline-item"><a href="/aboutus">About Us</a></li>
                    <li class="list-inline-item"><a href="/register">Register</a></li>
                    <li class="list-inline-item"><a href="/profile">Your profile</a></li>
                </ul>
                <p class="copyright">AlicanteGO © 2022</p>
            </footer>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
<style>

    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

    * {
        box-sizing: border-box;
    }

    html,body {
        height:auto;
    }
    
    /* .content-section {
        background-color: #e5e3df;
    } */

    .footer-basic {
        width: 100%;
        padding: 30px 0;
        background-color: #5c5c5c;
        color: rgb(205, 205, 205);
        margin-bottom: 0;
    }

    .footer-basic ul {
        padding: 0;
        /* position:absolute; */
        list-style: none;
        text-align: center;
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .footer-basic li {
        padding: 0 10px;
    }

    .footer-basic ul a {
        color: inherit;
        text-decoration: none;
        opacity: 0.8;
    }

    .separator {
        height: 3em;
        background-color: #e5e3df;
    }

    .footer-basic ul a:hover {
        opacity: 1;
    }

    .footer-basic .copyright {
        margin-top: 15px;
        text-align: center;
        font-size: 13px;
        color: #aaa;
        margin-bottom: 0;
    }

    .head{
        height: 70px;
        display:flex;
        justify-content: flex-end;
        border-bottom: 1px solid black;
        font-family: "Montserrat", sans-serif;
        background-color: #5c5c5c;
    }

    .auth-nav {
        width:100%;
        display: flex;
        box-sizing: border-box;
        margin-right: 20px;
    }

    .input-group{
        padding-top: 14px;
        padding-left: 28%;
    }
    .form-control{
        width: 500px;
    }

    #map-container {
        position:relative;
        height: 600px;
    }

    #app {
        display: flex;
        flex-direction: column;
    }

    footer {
        justify-self: flex-end;
        width: 100%;
    }

    .main-footer-content {
        width: 100%;
        background-color: red;
    }
    
    #app > main{
        background-color:#e5e3df;
        min-height: calc(100vh - 180px);
        overflow-x:hidden;
    }

    .content {
        min-height: calc(100vh - 180px);
        overflow-x:hidden;
    }

    .back {
        position: relative;
    }

    #back {
        display: inline-block;
        padding: 5px;
        text-decoration: none;
        font-size: 20px;
        color: #4E4E4E;
        transition: 0.3s;
    }

    #back:hover {
        transform: scale(1.1);
        color: white;
    }

    .error-container {
        display: flex;
        justify-content: flex-end;
    }

    li > .error-msg {
        min-width: 40%;
        padding: 0;
        padding-left: 6px;
        padding-right: 6px;
        color: #842029;
    }

    .title{
        align-self:center;
    }

</style>
@yield('style')
@yield('scripts')
</html>
