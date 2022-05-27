@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<section>


    <div class="back">
        <a href="{{ url()->previous() }}" id="back">Go Back</a>
    </div>
    <div class="container">
        <div class="header">
            <div class="img-overlay"> 
                <h1> {{ $brand->name}} </h1>
            </div>
            <img class="custom-img" src="{{ asset($brand->img_url) }}">
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" id="est-tab" data-bs-toggle="tab" data-bs-target="#est-tab-pane" type="button" role="tab" aria-controls="est-tab-pane" aria-selected="true"> Establishments </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="items-tab" data-bs-toggle="tab" data-bs-target="#items-tab-pane" type="button" role="tab" aria-controls="items-tab-pane" aria-selected="false">Items</button>
            </li>
        </ul> 
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="est-tab-pane" role="tabpanel" aria-labelledby="est-tab" tabindex="0">
                <table class="table" style="width:85%;margin:auto;">
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th width="260px">Action</th>
                    </tr>
                    @foreach ($establishments as $establishment)
                    <tr>
                        <td width="40%">{{ $establishment->name }}</td>
                        <td width="40%">{{ $establishment->address }}</td>
                        <td class="action-buttons">
                            <a class="btn btn-primary" href={{ "/establishment/" . $establishment->id }}>Show</a>
                            {{-- <form action="{{ url('/admin/establishments/delete', ["id" => $establishment->id]) }}" method="POST">
                                @csrf
                                @method('get')
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{-- <div style="display:flex; margin: 15px; justify-content:center;">
                    <a class="btn btn-success" href={{ "/ilyan/create/" . $establishment->id }}> Insert new restaurant</a>  
                </div> --}}
            </div>
            <div class="tab-pane fade" id="items-tab-pane" role="tabpanel" aria-labelledby="items-tab" tabindex="0">
                <table class="table" style="width:85%;margin:auto;">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th width="180px">Action</th>
                </tr>
                @foreach ($items as $item)
                <tr>
                    <td width="20%">{{ $item->name }}</td>
                    @if ($item->description != null)
                    <td>
                        <a class="btn btn-primary" id="collapse-button" data-toggle="collapse" href="{{ '#collapse-' . $item->id }}" role="button" aria-expanded="false" aria-controls="collapse">
                            See description
                          </a>
                          <div class="collapse" id="{{ 'collapse-' . $item->id }}" >
                            <div class="card card-body">
                                <p style="text-align: center; line-height: 1.6;"> {!! str_replace(".", "<br/>", $item->description) !!} </p>
                            </div>
                    </td>
                    @else
                    <td></td>
                    @endif
                    <td width="10%">{{ $item->price }}€</td>
                    <td class="action-buttons">
                        <a class="btn btn-warning" href="{{ url("/ilyan/edit/" . $item->id) }}">Edit</a>
                        <form action="{{ url('/ilyan/' . $item->id . '?url=' . url()->current()) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger" value="Delete"/>
                        </form>
                    </td>
                </tr>
                @endforeach
                </table>
                <div style="display:flex; margin: 15px; justify-content:center;">
                    <a class="btn btn-success" href={{ "/ilyan/create?brand=" . $brand->id }}> Insert new item</a>  
                </div>
            </div>
          </div>
          <div class="manage-buttons"> 
            <a href="{{ url("/ilyan/edit/establishment/" . $establishment->id) }}"  class="btn btn-primary"> Update information </a>
            {{-- <button form="establishment-delete" onclick="return confirm('Are you sure?')" class="btn btn-danger"> Delete brand </button>
            <form id="establishment-delete" action="{{ url('/ilyan/establishment/' . $establishment->id) }}" method="POST">
                @csrf
                @method("delete")
            </form> --}}
        </div>
    </div>

</section>

@endsection

@section("style")
    <style>

    .back{
        margin-left: 20%;
        margin-top: 60px;
    }

    .container{
        font-family: "Montserrat", sans-serif;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        width: 60%;
        height: auto;
        max-height: 100%;
        background-color:whitesmoke;
        border-radius: 25px;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        padding:0;
    }


    .header{
        border-radius: 25px 25px 0 0;
        max-height: 300px;
        margin-bottom: 15px;
        position:relative;
    }

    .custom-img{
        width:100%;
        height:100%;
        max-height:300px;
        object-fit: cover;
        border-radius: 25px 25px 0 0;
    }

    .img-overlay{
        position: absolute;
        width: 100%;
        display: flex;
        height:100%;
        flex-direction: column;
        justify-content: flex-end;
        align-items: flex-start;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.85), transparent);
    }

    .img-overlay h1{
        color: white;
        font : normal 200 3vw/1 'Josefin Sans', sans-serif;
        margin-left: 8px;
    }

    .nav{
        display:flex;
        justify-content: center;
    }


    .action-buttons{
        display:flex;
        flex-direction:row;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    
    .action-buttons .btn{
        height:40px;
    }

    .manage-buttons{
        display:flex;
        /* justify-content: center; */
        margin-top: 15px;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }
    </style>
@endsection

