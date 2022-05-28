@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<section>

<div class="container">
    <h1 style="color: #4E4E4E; align-self:center; margin:10px; font : normal 200 3vw/1 'Josefin Sans', sans-serif;"> Profile</h1>
    <h2> Personal data </h2>
    <p>
        <span style="font-weight: bold; font-size: 1vw"> Name:  </span> 
        <span style="font-size: 1vw"> {{ $manager->name }}  </span>
    </p>
    <p>
        <span style="font-weight: bold; font-size: 1vw"> DNI:  </span> 
        <span style="font-size: 1vw"> {{ $manager->DNI }}  </span>
    </p>
    <p>
        <span style="font-weight: bold; font-size: 1vw"> Phone number:  </span> 
        <span style="font-size: 1vw"> {{ $manager->phone }}  </span>
    </p>


    <div class="container-cards">
       <div class="container1"> 
        <p style="font-weight: bold; font-size: 1vw"> Establishments you own: </p>

        @if(isset($manager->establishment))
            <div class="card">
                <img class="card-img-top" style="border-radius: 25px 25px 0 0;" src= "{{ asset($manager->establishment['img_url']) }}">
                <div class="overlay-container">
                    <div class="overlay">
    
                    </div>
                </div>
                <a href="{{ url("/establishment/" . $manager->establishment_id) }}" class="btn btn-primary more-info-btn" class="fade"> Manage </a>
                <div class="card-body">
                    <h5 class="card-title"> {{ $manager->establishment['name'] }}</h5>
                    <p class="card-text"> {{ $manager->establishment['address'] }} </p>
                </div>
            </div>
        @else
        <div style="display:flex; margin-top: 30px; justify-content:center;">
            <a class="btn btn-success" href="/establishment/create" > Create an establishment </a>
        </div>
        @endif
        </div> 

        <div class="container2"> 
        
            <p style="font-weight: bold; font-size: 1vw"> Brands you own: </p>
        
            @if(isset($manager->brand))
                <div class="card">
                    <img class="card-img-top" style="border-radius: 25px 25px 0 0;" src= "{{ asset($manager->brand['img_url']) }}">
                    <div class="overlay-container">
                        <div class="overlay">
        
                        </div>
                    </div>
                    <a href="{{ url("/brand/" . $manager->brand_id) }}" class="btn btn-primary more-info-btn" class="fade"> Manage </a>
                    <div class="card-body">
                        <h5 class="card-title"> {{ $manager->brand['name'] }}</h5>
                    </div>
                </div>
            @else
            <div style="display:flex; margin: 30px 0 30px 0; justify-content:center;">
                <a class="btn btn-success" href="/ilyan/create/brand"> Create a brand </a>
            </div>
            @endif
        </div>
    </div>
    
</div>

</section>

@endsection

@section("style")
    <style>

    html{
        width:100%;
        overflow-x:hidden;
    }

    section{
        display:flex;
        justify-content: center;
    }
    .container{
        margin: 25px 20% 0 20%;
        background-color:whitesmoke;
        position:relative;
        border-radius:25px;
        display: flex;
        flex-flow: column wrap;
    }

    .card{
        width: 400px;
        position: relative;
        border-radius:25px;
        align-self: center;
        margin: 20px 0 20px 0;
    }

    .card-img-top{
        height: 380px;
        object-fit: cover;
    }

    .overlay-container {
        position: absolute;
        margin: 0;
        height: 380px;
        width: 100%;
        z-index:999;
        border-radius: 25px 25px 0 0;
        transition: .5s ease;
    }

    .overlay {
        opacity: 0;
        height: 100%;
        width: 100%;
        border-radius: 25px 25px 0 0;
        transition: .5s ease;
        background-color: whitesmoke;
    }

    .more-info-btn {
        display: none;
        opacity: 0;
        transition: .5s ease;
        position: absolute;
        top: 40%;
    }

    .card:hover .overlay {
        opacity: 0.7;
    }

    .card:hover .more-info-btn {
        opacity: 1;
        display: inline-block;
    }

    .fade{
        position: absolute;
        -webkit-transform: translate(-50%, -50%); 
        -ms-transform: translate(-50%, -50%); 
        transform: translate(-50%, -50%);
        opacity: 1;
    }

    .card-title{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 30px;
        font-weight: 550;
    }

    .container-cards{
        display:flex;
        width:100%;
        flex-flow: row wrap;
        justify-content: space-around;
    }

    .btn{
        align-self: center;
        z-index: 999;
        opacity: 1;
    }

    </style>
@endsection

