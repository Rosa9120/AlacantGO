@extends('layouts.app')

@section('title', 'Establishment List')

@section('content')
<section>
<br>
    <div class="back">
        <a href="/" id="back">Go Back</a>
    </div>
    <div class="restaurant">
        <div class="header">
            <div class="img-overlay"> 
                <h1> {{ $establishment->name}} </h1>
                <h2> {{ $establishment->address}} </h2>
            </div>
            <img class="custom-img" src="{{ asset($establishment->img_url) }}">

        </div>

        <table class="table" style="width:85%;margin:auto;">
            <tr>
                {{-- <th>Image</th> For now we will not have an image--}}
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                @auth
                    @if (Auth::user()->rol == 'admin' || (Auth::check() && Auth::user()->rol == "manager" && ($establishment->manager()->first()?->user()->first()->id == Auth::user()->id)))
                    <th width="180px">Action</th>
                    @endif
                @endauth
            </tr>
            @foreach ( $establishment->items()->get() as $item)
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

                @auth
                    @if (Auth::user()->rol == 'admin' || (Auth::check() && Auth::user()->rol == "manager" && ($establishment->manager()->first()?->user()->first()->id == Auth::user()->id)))
                    <td class="action-buttons">
                        <a class="btn btn-warning" href="{{ url("/ilyan/edit/" . $item->id) }}">Edit</a>
                        <form action="{{ url('/items', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger" value="Delete"/>
                        </form>
                    </td>
                    @endif 
                @endauth
            </tr>
            @endforeach
        </table>
    </div>
    @auth
        {{-- TODO ESTO HABRÁ QUE CAMBIARLO POR MANAGER --}}
        @if (Auth::user()->rol == 'admin' || (Auth::check() && Auth::user()->rol == "manager" && ($establishment->manager()->first()?->user()->first()->id == Auth::user()->id)))      
            <div style="display:flex; margin-top: 30px; justify-content:center;">
                <a class="btn btn-success" href="/ilyan/create/"> Insert new item</a>
            </div>
            <div class="manage-buttons"> 
                <a href="{{ url("/ilyan/edit/establishment/" . $establishment->id . "?url=" . url()->current()) }}"  class="btn btn-primary"> Update information </a>
                <a class="btn btn-danger"> Delete restaurant </a>
            </div>
        @endif
    @endauth
</section>
   
@endsection

@section('scripts')
<script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=establishments&region=GB'></script>

@endsection

<script>
    var $table = $('#table')
    var $button = $('#button')

    $(function() {
        $button.click(function () {
        $table.bootstrapTable('expandRowByUniqueId', 1)
        })
  })

</script>
@section("style")
<style>

    html{
        overflow-x:hidden;
    }

    .manage-buttons{
        display:flex;
        /* justify-content: center; */
        margin-top: 30px;
        justify-content: center;
        gap: 15px;
    }

    section{
        min-height: calc(100vh - 70px - 123px - 48px);
        background-color: #e5e3df;
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

    .img-overlay h2{
        color: white;
        font : normal 200 1vw/1 'Josefin Sans', sans-serif;
        margin-left: 8px;
        margin-top: 2px;
    }

    .back {
        position: relative;
        left:20%;

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
        /* font-size: 21px; */
        color: white;
    }

    .restaurant{
        margin: 25px 20% 0 20%;
        background-color:whitesmoke;
        position:relative;
        /* padding: 0 2% 2% 2%; */
        border-radius:25px;
        /* margin-bottom: 15px; */
    }

    .card{
        border:none;
        margin-top: 5px;
    }

    .card-body{
        background-color:#F5F5F5
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

    @media (max-width: 1500px){
        .custom-img{
            object-fit: cover;
            border-radius: 25px 25px 0 0;
        }
    }
</style>
@endsection