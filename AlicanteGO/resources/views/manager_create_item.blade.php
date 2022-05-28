@extends('layouts.app')

@section('title', 'Create Item')

@section('content')
<section>
    <div class="container">
        <div class="back">
            <a href="{{ url()->previous() }}" id="back">Go Back</a>
        </div>

        <div class="title">
            <h1> Create Item </h1>
        </div>

        <div class="item">
            <div class="information">
                <form action="{{ url('/ilyan?' . ($establishment != null ? 'establishment=' . $establishment?->id : '') . ($brand != null ? '&brand=' . $brand?->id : '') . '&url=' . url()->previous()) }}" method="POST">
                    @csrf
                    @method('post')
                    <ul>
                        <li>Name: 
                            <input class="editable @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', null) }}" placeholder="Tarta de Oreo..."/>
                        </li>
                        @error('name')
                            <li class="error-container">
                                <div class="alert alert-danger error-msg">{{ ucfirst($errors->first("name")) }}</div>
                            </li>
                        @enderror
                        <li>Price: 
                            <input class="editable @error('price') is-invalid @enderror" name="price" type="number" value="{{ old("price", null) }}" step="0.01" lang="en" placeholder="3,99..."/>
                        </li>
                        @error('price')
                            <li class="error-container">
                                <div class="alert alert-danger error-msg">{{ ucfirst($errors->first("price")) }}</div>
                            </li>
                        @enderror
                        <li>Description: 
                            <textarea class="editable" name="description" type="text" wrap="off" type="text" rows="3"></textarea> 
                        </li>
                    </ul>
                
                    <div class="submit">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

@endsection

@section('style')
<style>

    section{
        height: calc(100vh - 57px - 180px - 104px);
        background-color: #e5e3df;
    }

    .title{
        align-self: center;
    }

    textarea{
        max-height: 140px;
        white-space: pre;
    }

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

    .error-container {
        display: flex;
        justify-content: flex-end;
    }

    li > .error-msg {
        min-width: 40%;
        padding: 0;
        padding-left: 6px;
        padding-right: 6px;
        color: #842029;
    }

    .belongs {
        display: flex;
        align-items: center;
        margin-top: 7px;
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
        height: calc(20px * 2);
    }

    .submit {
        display: flex;
        justify-content: flex-end;
    }
</style>
@endsection