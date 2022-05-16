@extends('admin')

@section('title', 'Create Establishment')

@section('content')

<div class="container">
    <div class="back">
        <a href="/establishments" id="back">Go Back</a>
    </div>

    <div class="establishment">
        <div class="information">
            <form action="{{ url('/addestablishments/create') }}" method="POST">
                @csrf
                @method('post')
                <ul>
                    <li>Name: 
                        <input class="editable" required name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="Enter name" id="name">
                    </li>
                    <li>Phone Number: 
                        <input class="editable" name="phone_number" type="text" value="{{ old('phone_number') }}" class="form-control" placeholder="Enter phone number" id="phone_number">
                    </li>
                    <li>Address: 
                        <input class="editable"requiered name="address" type="text" value="{{ old('address') }}" class="form-control" placeholder="Enter address" id="address">
                    </li>
                    <li>Postal Code: 
                        <input class="editable" requiered name="postal_code" type="text" value="{{ old('postal_code') }}" class="form-control" placeholder="Enter postal code" id="postal_code">
                    </li>
                    <li>Latitude: 
                        <input class="editable" requiered name="latitude" type="text" value="{{ old('latitude') }}" class="form-control" placeholder="Enter latitude" id="latitude">
                    </li>
                    <li>Longitude: 
                        <input class="editable" requiered name="longitude" type="text" value="{{ old('longitude') }}" class="form-control" placeholder="Enter longitude" id="longitude">
                    </li>
                    <li>Brand: 
                        <select name="brand" class="form-control editable dropdown">
                            <option> </option>
                            @foreach ($brands as $idxB => $brand)
                            <option value="{{ $brand->id }}" {{ ($idxB == 0) ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>Category: 
                        <select name="category" class="form-control editable dropdown">
                            <option> </option>
                            @foreach ($categories as $idxC => $category)
                            <option value="{{ $category->id }}" {{ ($idxC == 0) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>           
                <div class="submit">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
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
        font-size: 21px;
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

@endsection