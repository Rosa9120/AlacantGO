@extends('layouts.app')

@section('content')

<section id="section01" class="demo">
    <div class="about-section">
        <h1 class="title">We are AlacantGo</h1>
    </div>
    <div class="about-section2">
    <h2>You are lucky to have found us</h2>
    </div>
    <a href="#section02"><span></span>Scroll</a>
</section>

<section id="section02">

    <h3>Our Team</h3>

    <div class="cards">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title puesto"> Vicente José Moreno Rebollo </h5>
            <p class="card-name"> Junior Programmer </p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>vjmr1@gcloud.ua.es</p>
            <a href="mailto:vjmr1@gcloud.ua.es" class="btn btn-secondary btn-sm"> Contact </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title puesto"> Ilya Slyusarchuk Dimitriouchkina </h5>
            <p class="card-name"> Senior Programmer </p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>isd11@gcloud.ua.es</p>
            <a href="mailto:isd11@gcloud.ua.es" class="btn btn-secondary btn-sm"> Contact </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title puesto"> Natallia Tsuranava </h5>
            <p class="card-name"> Restaurant Data Research </p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>nt33@gcloud.ua.es</p>
            <a href="mailto:nt33@gcloud.ua.es" class="btn btn-secondary btn-sm"> Contact </a>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title puesto"> Rosa María Rodríguez Lledó </h5>
            <p class="card-name"> Marketing leader </p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>rmrl3@gcloud.ua.es</p>
            <a href="mailto:rmrl3@gcloud.ua.es" class="btn btn-secondary btn-sm"> Contact </a>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title puesto"> Alberto Rius Poveda </h5>
            <p class="card-name"> Data and Information Analist </p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>arp99@gcloud.ua.es</p>
            <a href="mailto:arp99@gcloud.ua.es" class="btn btn-secondary btn-sm"> Contact </a>

        </div>
    </div>

    </div>

    <div class="bottom-container">
        <div class="card-mission">
            <div class="card-body">
                <h5 class="card-title puesto"> Our mission </h5>
                <p> The goal of this project is to develop an application dedicated to show the location of several restaurants around the city and more detailed description of them, such as its menus, photos of the location, opinions, etc. And all of that using a simple user interface. It will consist of an API of Google Maps and extra data we’ll gather ourselves, its main objective is to be as simple as possible, therefore being handy. </p>
                <p> The name of this app is Alacant Go, as it is now restricted to the city of Alacant. 
                    In our experience, browsing the web to find menus of specific restaurants can be daunting. Most restaurants do not share their menus in their websites - others do not even have websites. 
                </p>
                Our goal is to unify the information that is provided from restaurants to potential customers in order to ease the process of choosing where to eat.
                We will develop a web application with a database that stores all the restaurants and the information regarding their menus, prices, etc. Additionally, we plan for google reviews to be displayed alongside the restaurant’s information.
                </p>
            </div>
        </div>
    </div>


</section>

@endsection

@section("style")
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
        @import url(https://fonts.googleapis.com/css?family=Josefin+Sans:300,400);


    section {
        position: relative;
        width: 100%;
        height: 100%;
        overflow-x:hidden;
    }
            
    section::after {
        position: absolute;
        bottom: 0;
        left: 0;
        content: '';
        width: 100%;
        height: 80%;
        background: -webkit-linear-gradient(top,rgba(0,0,0,0) 0,rgba(0,0,0,.8) 80%,rgba(0,0,0,.8) 100%);
        background: linear-gradient(to bottom,rgba(0,0,0,0) 0,rgba(0,0,0,.8) 80%,rgba(0,0,0,.8) 100%);
   }

    section h1 {
        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 2;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        color: #fff;
        font : normal 300 64px/1 'Josefin Sans', sans-serif;
        text-align: center;
        white-space: nowrap;
    }

    section h2{
        position: absolute;
        top: 60%;
        left: 50%;
        z-index: 2;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        color: #fff;
        font : normal 300 32px/1 'Josefin Sans', sans-serif;
        text-align: center;
        white-space: nowrap;
    }

    section h3{
        position: absolute;
        top: 2%;
        left: 50%;
        z-index: 2;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        color: #fff;
        font : normal 300 32px/1 'Josefin Sans', sans-serif;
        text-align: center;
        white-space: nowrap;
    }


    #section01 { 
        background: linear-gradient(70deg, black, white);
        animation: gradient 30s ease infinite;
        /* height:calc(100vh - 57px); */
        height:100vh;
    }

    #section02 { 
        background: linear-gradient(70deg, black, white);
        animation: gradient 30s ease infinite;
        /* height:calc(100vh - 57px); */
        height:auto;
        min-height: 100vh;
        overflow-x:hidden;
    }

    #section01 a {
        padding-top: 60px;
    }

    #section01 a span {
        position: absolute;
        top: 0;
        left: 50%;
        width: 24px;
        height: 24px;
        margin-left: -12px;
        border-left: 1px solid #fff;
        border-bottom: 1px solid #fff;
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        /* box-sizing: border-box; */
    }

    .demo a {
        position: absolute;
        bottom: 40px;
        left: 50%;
        z-index: 2;
        display: inline-block;
        -webkit-transform: translate(0, -50%);
        transform: translate(0, -50%);
        color: #fff;
        font : normal 400 20px/1 'Josefin Sans', sans-serif;
        letter-spacing: .1em;
        text-decoration: none;
        transition: opacity .3s;
    }

    .card-name{
        font-size: 20px;
        font-family: 'Josefin Sans', sans-serif;
    }

    .mission{
        color: #fff;
        font : normal 300 32px/1 'Josefin Sans', sans-serif;
    }
    .demo a:hover {
        opacity: .5;
    }
   
    .input-group{
        padding-top: 14px;
        padding-left: 28%;
    }

    .form-control{
        width: 500px;
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

    .cards{
        display:flex;
        padding-top: 5%;
        flex-direction: row;
        align-content: center;
        gap: 25px;
        flex-wrap: wrap;
        justify-content: center ;
        max-height: 1000px; 
    }

    .bottom-container{
        display:flex;
        padding-top: 5%;
        flex-direction: row;
        align-content: center;
        flex-wrap: nowrap;
        justify-content: center ;
    }

    .card {
        width: 400px;
        position: relative;
        border-radius:25px;
        background-color:whitesmoke;
        z-index: 999;
        opacity:0.9;
    }

    .card-body
    {
        text-align: center;
    }

    .card-mission {
        width: 700px;
        position: relative;
        border-radius:25px;
        background-color:whitesmoke;
        z-index: 999;
        opacity:0.9;
    }

    .card-name{

    }

    </style>
@endsection

<script>
    $(function() {
    $('a[href*=#section02]').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: $($(this).attr('#section02')).offset().top}, 500, 'linear');
    });
    });
</script>