@extends('admin')

@section('title', 'Edit Item')

@section('content')

    <div class="container">
        <div class="back">
            <a href="/items" id="back">Go Back</a>
        </div>

        <div class="item">
            <div class="img-container">
                <img src="/assets/images/placeholder.png" alt="image">
            </div>

            <div class="information">
                <span>ID #: {{ $item->id }}</span>
                <form action="{{ url('/items', ["id" => $item->id]) }}" method="POST">
                    @csrf
                    @method('patch')
                    <ul>
                        <li>Name: 
                            <input class="editable" name="name" type="text" value="{{ $item->name }}" />
                        </li>
                        <li>Price: 
                            <input class="editable" name="price" type="number" lang="en" step="0.01" value="{{ $item->price }}" /></li>
                        <li>Description: 
                            <input class="editable" name="description" type="text" value="{{ $item->description }}" />
                        </li>
                        <li>Type: 
                            <input class="editable" name="type" type="text" value="{{ $item->type }}" />
                        </li>
                        @if($item->establishment == null)
                            <li>Brand: 
                                <select name="brand" class="form-control editable dropdown">
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ ($brand->id == $item->brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </li>
                        @else
                            <li>Establishment: 
                                <select name="establishment" class="form-control editable dropdown">
                                    @foreach ($establishments as $establishment)
                                    <option value="{{ $establishment->id }}" {{ ($establishment->id == $item->establishment->id) ? 'selected' : '' }}>{{ $establishment->name }}</option>
                                    @endforeach
                                </select>
                            </li>
                        @endif
                    </ul>
                
                    <div class="submit">
                        <button type="submit" class="btn btn-primary">Confirm</button>
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