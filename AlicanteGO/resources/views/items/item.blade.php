@extends('admin')

@section('title', 'Item Info')

@section('content')

    <div class="container">
        <div class="back">
            <a href="/admin/items" id="back">Go Back</a>
        </div>

        <div class="title">
            <h1> Item Info </h1>
        </div>

        <div class="item">
            <div class="img-container">
                <img src="/assets/images/placeholder.png" alt="image">
            </div>

            <div class="information">
                <ul>
                    <li>ID #: {{ $item->id }}</li>
                    <li>Name: {{ $item->name }}</li>
                    <li>Price: {{ $item->price }}€</li>
                    <li>Description: {{$item->description}}</li>
                    <li>Type: {{ $item->type }}</li>
                    @if($item->establishment == null)
                        <li>Brand: <a href="{{ url("/admin/brand/get") }}">{{ $item->brand->name }}</a></li>
                    @else
                        <li>Establishment: <a href="{{ url("/admin/establishments/" . $item->establishment->id) }}">{{ $item->establishment->name }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('style')

    .container {
        font-family: "Montserrat", sans-serif;
        margin-top: 100px;
        padding: 15px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        width: 50%;
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
        transform: scale(1.1);
        color: white;
    }

    .img-container {
        width: 30%;
        height: 70%;
        align-self: center;
    }

    .item {
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

    .information {
        border: 1px solid grey;
        border-radius: 10px;
        font-size: 22px;
        max-width: 50%;
        max-height: 80%;
        margin: auto;
        margin-top: 0;
        margin-bottom: 20px;
        overflow-y: auto;
        padding: 20px;
    }

@endsection