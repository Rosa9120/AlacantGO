@extends('admin')

@section('title', 'Establishment Info')

@section('content')

<div class="container">
    <div class="back">
        <a href="/admin/establishments"  id="back">Go Back</a>
    </div>

    <div class="title">
            <h1> Establishment Info</h1>
    </div>

    <div class="establishment">
        <div class="information">
            <ul>
                <li>ID #: {{ $establishment->id }}</li>
                <li>Name: {{ $establishment->name }}</li>
                <li>Phone Number: {{ $establishment->phone_number }}</li>
                <li>Address: {{$establishment->address }}</li>
                <li>Postal Code: {{ $establishment->postal_code }}</li>
                <li>Brand: {{ $establishment->brand->name }}</li>
                <li>Category: {{ $establishment->category->name }}</li>
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

    .establishment {
        display: flex;
        flex-direcion: row;
        flex-grow: 0;
        flex-basis: 90%;
        margin-left: 20px;
        justify-content: space-between;
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