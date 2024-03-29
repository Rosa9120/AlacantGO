@extends('layouts.app')

@section('title', 'Edit Brand')

@section('content')

    <div class="container">
        <div class="back">
            <a href="{{ url()->previous() }}" id="back">Go Back</a>
        </div>

        <div class="title">
            <h1> Edit Brand </h1>
        </div>

            <div class="information">
                <span>ID #: {{ $brand->id }}</span>
                <form action="{{ url('/brand', ["brand" => $brand->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <ul>
                        <li>Name: 
                            <input class="editable" required name="name" type="text" value="{{ $brand->name }}" />
                        </li>
                        <li>Isin: 
                            <input class="editable" required name="isin" type="text" lang="en" class="@error('isin') is-invalid @enderror" value="{{ $brand->isin }}" /></li>
                            @error('isin')
                            <li class="error-container">
                                <div class="alert alert-danger error-msg"> ISIN must have 2 capital letters and 9 numbers </div>
                            </li>
                            @enderror
                            <li>Photo:
                                <input name="image" class="form-control-sm" id="formFileSm" type="file" accept="image/*" />
                            </li>
                    </ul>
                
                    <div class="submit">
                        <button type="submit" class="btn btn-success">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
        background-color: rgba(109, 109, 109, 0.2);
        border-radius: 20px;
        border: 1px solid grey;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }

    .manager {
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