@extends('admin')

@section('title', 'Edit establishment')

@section('content')

    <div class="container">
            <div class="back">
                <a href="/admin/establishments" id="back">Go Back</a>
            </div>

                <div class="information">
                    <span>ID #: {{ $establishment->id }}</span>

                    <form action="{{ url('/admin/establishments/remove', ["id" => $establishment->id]) }}" method="delete">
                        <div class="modal-body">
                            @csrf
                            @method('delete')
                            <h5 class="text-center">Are you sure you want to delete {{ $establishment->name }} ?</h5>
                        </div>
                        <a class="btn btn-secondary" href="{{ url('/admin/establishments/') }}">Cancel</a>
                        <form action="{{ url('/admin/establishments/remove', ['id' => $establishment->id]) }}" method="DELETE">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Yes, Delete"/>
                        </form>
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