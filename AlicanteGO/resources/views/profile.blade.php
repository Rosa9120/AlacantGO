@extends('layouts.app')

@section('content')


<div class="container">
    Profile
    Establishments you own: 
    <div class="searcher"> 
        <input type="text" form="filter" name="search" class="form-control" style="width: 50%; font-size: 1.2rem;" placeholder="Search by name or address..." value={{ $search }}>
        <input type="submit" form="filter" value="Go" style="font-size: 1.2rem;" class="btn btn-primary" />
    </div>
    <div class="cards">
        @foreach ($establishments as $est)
            <div class="card">
                <img class="card-img-top" style="border-radius: 25px 25px 0 0;" src= "{{ asset($est['img_url']) }}">
                <div class="overlay-container">
                    <div class="overlay">

                    </div>
                </div>
                <a href="{{ url("/establishment/" . $est['id']) }}" class="btn btn-primary more-info-btn" class="fade"> More information </a>
                <div class="card-body">
                    <h5 class="card-title"> {{ $est['name'] }}</h5>
                    <p class="card-text"> {{ $est['address'] }} </p>
                </div>
            </div>
        @endforeach
    </div>
    Brands you own:

</div>

</section>

@endsection

@section("style")
    <style>

    .container{
        margin: 25px 20% 0 20%;
        background-color:whitesmoke;
        position:relative;
        border-radius:25px;
    }
    .form-control{
        width: 500px;
    }
    .searcher{
        display:flex;
        padding-bottom: 15px; 
        margin: 15px;
        justify-content: center;
    }

    .cards{
        display:flex;
        flex-direction: row;
        align-content: center;
        /* max-width: 1200px; */
        gap: 25px;
        flex-wrap: wrap;
        justify-content: flex-start ;
        margin-left: 10%;
    }

    .card{
        width: 400px;
        position: relative;
        border-radius:25px;
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

    </style>
@endsection

