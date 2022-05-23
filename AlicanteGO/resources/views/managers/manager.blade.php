@extends('admin')

@section('content')

    <div class="container">
        <div class="back">
            <a href="/managers" id="back">Go Back</a>
        </div>

        <div class="manager">
            <div class="img-container">
                <img src="/assets/images/user.png" alt="image">
            </div>

            <div class="information">
                <ul>
                    <li>ID #: {{ $manager->id }}</li>
                    <li>Full name: {{ $manager->name }}</li>
                    <li>DNI: {{ $manager->DNI }}</li>
                    @if(isset($manager->brand))
                    <li>Brand: <a href="{{ url("/brands") }}"> {{ $manager->brand->name }}</a></li>    
                    @else
                    <li>  Brand: none  </li>    
                    @endif
                    @if(isset($manager->establishment))
                        <li>Establishment: <a href="{{ url("/establishments/" . $manager->establishment->id) }}"> {{ $manager->establishment->name }} </a> </li>
                    @else
                    <li> Establishment: none </li>  
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <style>

    .container {
        font-family: "Montserrat", sans-serif;
        margin-top: 100px;
        padding: 15px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        width: 70%;
        height: auto;
        max-height: 100%;
        background-color: rgba(109, 109, 109, 0.2);
        border-radius: 20px;
        border: 1px solid grey;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
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
        color: white;
    }

    .img-container {
        width: 30%;
        height: 70%;
        align-self: center;
    }

    .manager {
        display: flex;
        flex-direcion: row;
        flex-grow: 0;
        flex-basis: 90%;
        margin-left: 20px;
        justify-content: space-between;
    }

    img {
        display: block;
        max-width: 100%;
        max-height: 100%;
        border-radius: 15px;
        border: 1px solid grey;
    }
    .information{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border: 1px solid grey;
        border-radius: 10px;
        font-size: 22px;
        min-width: 60%
        max-width: 70%;
        max-height: 80%;
        flex-grow: 1;
        margin-top: 0;
        margin-left: 20px;
        margin-right: 10px;
        margin-bottom: 20px;
        overflow-y: auto;
        padding: 20px;
    }
    </style>

@endsection

