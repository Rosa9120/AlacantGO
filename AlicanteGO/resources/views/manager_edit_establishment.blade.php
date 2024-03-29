@extends('layouts.app')

@section('title', 'Create Establishment')

@section('content')
<section>
    <div class="container">
        <div class="back">
            <a href="{{ url()->previous() }}" id="back">Go Back</a>
        </div>
        <div class="title">
                <h1> Edit Establishment </h1>
        </div>
        <div class="establishment">
            <div class="information">
                <span>ID #: {{ $establishment->id }}</span>
                <form action="{{ url('/establishment/' . $establishment->id . "?url=" . back()->getTargetUrl()) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PATCH')
                    <ul>
                        <li>Name: 
                            <input class="editable" name="name" type="text" value="{{ $establishment->name }}" />
                        </li>
                        <li>Phone Number: 
                            <input class="editable" name="phone_number" type="number" lang="en" step="0.01" value="{{ $establishment->phone_number }}" />
                        </li>
                        <li>Address: 
                            <input class="editable" name="address" type="text" value="{{ $establishment->address }}" />
                        </li>
                        <li>Postal Code: 
                            <input class="editable" name="postal_code" type="text" value="{{ $establishment->postal_code }}" />
                        </li>
                        <li>Latitude: 
                            <input class="editable" name="latitude" type="text" value="{{ $establishment->latitude }}" />
                        <li>Longitude: 
                            <input class="editable" name="longitude" type="text" value="{{ $establishment->longitude }}" />
                        <li>Brand: 
                            <select name="brand" class="form-control editable dropdown">
                                <option> </option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ ($brand->id == $establishment->brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>Category: 
                            <select name="category" class="form-control editable dropdown">
                                <option> </option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ ($category->id == $establishment->category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>Photo:
                            <input class="form-control-sm" id="image" type="file" name="image" accept="image/*"/>
                        </li>
                        @error('image')
                        <li class="error-container">
                            <div class="alert alert-danger error-msg">{{ $message }}</div>
                        </li>
                        @enderror 
                    </ul>  
                    <div class="submit">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('style')
<style>
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

    section{
        height: calc(100vh - 57px - 180px - 104px);
        background-color: #e5e3df;
    }

    .main{
        padding:0;
        margin:0;
    }

    .title{
        align-self: center;
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

    ::-webkit-input-placeholder {
        font-style: italic;
     }
     :-moz-placeholder {
        font-style: italic;  
     }
     ::-moz-placeholder {
        font-style: italic;  
     }
     :-ms-input-placeholder {  
        font-style: italic; 
     }

    li {
        display: flex;
        justify-content: space-between;
    }

    .editable {
        line-height: 14px;
        margin-bottom: 8px;
        width: 40%;
        border-radius: 5px;
        border: none;
        padding: 3px;
        padding-left: 5px;
    }

    .dropdown {
        line-height: 20px;
    }

    .submit {
        display: flex;
        justify-content: flex-end;
    }
</style>
@endsection