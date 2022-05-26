@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
<section>
    <div class="container">
        <div class="back">
            <a onclick="{{ url()->previous() }}" id="back">Go Back</a>      
        </div>

        <div class="title">
            <h1> Edit Item </h1>
        </div>

        <div class="item">
            <div class="information">
                <span>ID #: {{ $item->id }}</span>
                <form action="{{ url('/ilyan', ["id" => $item->id]) }}" method="POST">
                    @csrf
                    @method('patch')
                    <input name="url" type="text" hidden value="{{ $url }}"/>
                    <ul>
                        <li>Name: 
                            <input class="editable @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name', $item->name) }}" />
                        </li>
                        @error('name')
                            <li class="error-container">
                                <div class="alert alert-danger error-msg">{{ ucfirst($errors->first("name")) }}</div>
                            </li>
                        @enderror
                        <li>Price: 
                            <input class="editable @error('price') is-invalid @enderror" name="price" type="number" lang="en" step="0.01" value="{{ old('price', $item->price) }}"/>
                        </li>
                        @error('price')
                            <li class="error-container">
                                <div class="alert alert-danger error-msg">{{ ucfirst($errors->first("price")) }}</div>
                            </li>
                        @enderror
                        <li>Description: 
                            <textarea class="editable" name="description" wrap="off" type="text" rows="3"> {{ old("description", $item->description) }} 
                            </textarea>
                        </li>
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

    textarea{
        max-height: 140px;
        white-space: pre;
    }

    section{
        height: calc(100vh - 57px - 180px - 104px);
        background-color: #e5e3df;
    }

    .title{
        align-self: center;
    }
    
    .main{
        padding:0;
        margin:0;
    }

    .item {
        display: flex;
        flex-direcion: row;
        flex-grow: 0;
        flex-basis: 90%;
        margin-left: 20px;
        justify-content: space-between;
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

    .submit {
        display: flex;
        justify-content: flex-end;
    }
</style>
@endsection