@extends('admin')

@section('title', 'Create Brand')

@section('content')

    <div class="container">
        <div class="back">
            <a href="/brands" id="back">Go Back</a>
        </div>

        <div class="item">
            <div class="information">
                <form action="{{ url('/brands/create') }}" method="POST">
                    @csrf
                    @method('post')
                    <ul>

                        <li>Name: <input class="editable" value="{{ old('name') }}"  required name="name" type="text" class="form-control" placeholder="Brand Name"/>
                        </li>

                        <li>Isin: <input class="editable" value="{{ old('isin') }}" required name="isin"  class="@error('isin') is-invalid @enderror"  type="text" lang="en" placeholder="ES111111111"/>
                        </li>
                        @error('isin')
                            <div class="alert alert-danger"> ISIN must have 2 capital letters and 9 numbers </div>
                        @enderror
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
        font-size: 21px;
        color: white;
    }

    .item {
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
        max-width: 70%;
        max-height: 80%;
        margin: auto;
        margin-top: 0;
        margin-bottom: 20px;
        overflow-y: auto;
        padding: 20px;
    }

@endsection