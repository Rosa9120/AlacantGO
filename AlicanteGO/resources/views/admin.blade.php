<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    </head>

    <body>
        <div class="head">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav" style="margin-left:50%;transform:translateX(-50%);">
                        <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="/managers">Managers</a>
                        <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="/establishments">Establishments</a>
                        <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="/brands">Brands</a>
                        <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="/categories">Categories</a>
                        <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="/items">Items</a>
                    </div>
                </div>
            </nav>             
        </div>

        <div class="content">
            @yield('content')
        </div>
    </body>

    <script>
        @yield('script')
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        html, body {
            background-color: #z;
            height: 100%;
        }

        .content {
            height: 100%;
        }

        .head{
            height: 70px;
            display:flex;
            border-bottom: 1px solid black;
            font-family: "Montserrat", sans-serif;
            background-color: #5c5c5c;
        }

        nav {
            width:100%;
            box-sizing: border-box;
            margin-left: 20px;
        }
    
        .input-group{
            padding-top: 14px;
            padding-left: 28%;
        }
        .form-control{
            width: 500px;
        }

        .login{
            margin: 5px 5px 0 0;
            background-color: grey;
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        @yield('style')
        
    </style>

</html>
