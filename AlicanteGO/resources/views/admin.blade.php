<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    </head>

    <body>
        <div class="head">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <a class="navbar-brand" href="/admin">Administrator</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                  <div class="navbar-nav">
                    <a class="nav-item nav-link" href="managers">Managers </a>
                    <a class="nav-item nav-link" href="establishments">Establishments</a>
                    <a class="nav-item nav-link" href="#">Brands</a>
                    <a class="nav-item nav-link" href="#">Categories</a>
                    <a class="nav-item nav-link" href="/items">Items</a>
                </div>
                </div>
              </nav>
    

       
            
        
             
        </div>

        <div class="content">
            @yield('content')
        </div>
    </body>

    <style>
        body {
            background-color: #f5f1f1;
        }

        .head{
            height: 70px;
            display:flex;
            border-bottom: 1px solid black;
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
        
    </style>

</html>
