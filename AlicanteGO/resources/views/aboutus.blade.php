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
                <button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

                    <div class="return">
                        <a class="nav-item nav-link" style="color:rgb(221, 221, 221);" href="/home">Return</a>
                    </div>

                </div>
            </nav>
        </div>

            <div class="about-section">
                <h1 class="title">We are AlacantGo</h1>
                <p>You are lucky to have found us, let us help you find a nice place!</p>
            </div>

            <h2 class="team" style="text-align:center">Our Team</h2>

        <div class="our-team">
            <div class="column">
                <div class="card">
                    <div class="container">
                        <p class="puesto">Senior Programmer</p>
                        <h2>Vicente José Moreno Rebollo</h2>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>vjmr1@gcloud.ua.es</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                </div>
            </div>
            
            <div class="column">
            <div class="card">
                    <div class="container">
                        <p class="puesto">Senior Programmer</p>
                        <h2>Ilya Slyusarchuk Dimitriouchkina</h2>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>isd11@gcloud.ua.es</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                </div>
            </div>

            <div class="column">
            <div class="card">
                    <div class="container">
                        <p class="puesto">Restaurant Data Research</p>
                        <h2>Natasha Tsuranava</h2>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>nt33@gcloud.ua.es</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                </div>
            </div>

            <div class="column2">
            <div class="card">
                    <div class="container">
                        <p class="puesto">Marketing leader</p>
                        <h2>Rosa María Rodríguez Lledó</h2>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>rmrl3@gcloud.ua.es</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                </div>
            </div>

            <div class="column2">
            <div class="card">
                    <div class="container">
                        <p class="puesto">Data and Information Analist </p>
                        <h2>Alberto Rius Poveda</h2>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>arp99@gcloud.ua.es</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="description">
                <p> 
                    The goal of this project is to develop an application dedicated to show the location of several restaurants around the city and more detailed description of them, such as its menus, photos of the location, opinions, etc. And all of that using a simple user interface. It will consist of an API of Google Maps and extra data we’ll gather ourselves, its main objective is to be as simple as possible, therefore being handy. 
            </p>  
            <p>  
                The name of this app is Alacant Go, as it is now restricted to the city of Alacant. 
                In our experience, browsing the web to find menus of specific restaurants can be daunting. Most restaurants do not share their menus in their websites - others do not even have websites. 
            </p>
                Our goal is to unify the information that is provided from restaurants to potential customers in order to ease the process of choosing where to eat.
                We will develop a web application with a database that stores all the restaurants and the information regarding their menus, prices, etc. Additionally, we plan for google reviews to be displayed alongside the restaurant’s information.

                </p>
        </div>

        <div class="social-networks">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <a href="https://es-es.facebook.com/" class="fa fa-facebook"></a>
                <a href="https://twitter.com/?lang=en" class="fa fa-twitter"></a>
                <a href="https://www.instagram.com/" class="fa fa-instagram"></a>
        </div>

        </div>
    </body>

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        .head{
            height: 70px;
            display:flex;
            justify-content: flex-end;
            border-bottom: 1px solid black;
            font-family: "Montserrat", sans-serif;
            background-color: #5c5c5c;
        }

        .social-networks{
            height: 70px;
            display:flex;
            justify-content: center;
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

        .return
        {
            position: relative;
            left: -1750px;
        }

        .description
        {
            background: white;
            overflow: auto;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 16px;
            font-size: 150%;
            padding-left: 10px;
        }

        .title
        {
            font-size: 500%;
            color: #fff;
            mix-blend-mode: difference;
        }

        .puesto
        {
            font-size: 250%;
        }


        .about-section
        {
            text-align: center;
            font-size: 150%;
            padding: 310px;
            color: #fff;
            mix-blend-mode: difference;
        }

        .team{
            color: #fff;
            mix-blend-mode: difference;
        }


        html, body {
        width: 100%;
        height:100%;
        }

        body {
            background: linear-gradient(70deg, black, white);
            background-size: 400% 400%;
            animation: gradient 30s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .column 
        {
            float: left;
            width: 33.3%;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        .column2 {
            width: 33.3%;
            display: inline-block;
            margin-left: 200px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 8px;
        }

        .container
        {
            text-align: center
        }

        .fa {
            padding: 20px;
            font-size: 30px;
            width: 75px;
            text-align: center;
            text-decoration: none;
        }

        .fa:hover {
        opacity: 0.7;
        }

        .fa-facebook {
            background: #3B5998;
            color: white;
            /* margin-left: 750px; */
        }

        .fa-twitter {
            background: #55ACEE;
            color: white;
        }

        .fa-instagram {
            background: #ea4c89;
            color: white;
        }

    </style>

</html>
