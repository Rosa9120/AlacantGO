@extends('admin')

@section('content')

<div style="display:flex;justify-content:space-around;margin-top:40px;">
    <div>
        <h3>Total items: {{ count($items) }}</h3>
    </div>
    <div>
        <a class="btn btn-success" href="{{ 1+1 }}"> Create New Product</a>
    </div>
</div>

<table class="table table-bordered" style="width:85%;margin:auto;box-sizing:border-box;margin-top:60px;margin-bottom:60px;">
    <tr>
        <th>ID #</th>
        {{-- <th>Image</th> For now we will not have an image--}}
        <th>Name</th>
        <th>Price</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($items as $item)
    <tr>
        <td>{{ $item->id }}</td>
        {{-- <td><img src=""></td> // For now we will not have any image--}}
        <td>{{ $item->name }}</td>
        <td>{{ $item->price }}€</td>
        <td>
            <form action="{{ url('/items', ['id' => $item->id]) }}" method="POST">
 
                <a class="btn btn-primary" href="#">Show</a>
                <a class="btn btn-warning" href="#">Edit</a>
 
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-danger" value="Delete"/>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{-- <div style="display:flex; justify-content:center; padding-top:35px; height: 70vh;">
    <div class="m-3 justify-content-center text-dark" style="overflow-y:scroll;display:inline-block; padding: 20px; background-color:rgba(255,255,255,0.7);">
        @foreach ($items as $item)
            <form action="{{ url('/items', ['id' => $item->id]) }}" method="post">
                @csrf
                @method('delete')
                <div style="margin-top:20px;">
                    <span>{{$item->name}}</span>
                    <input class="btn btn-danger" type="submit" value="Delete" />
                </div>
            </form>
        @endforeach
    </div>
</div> --}}

@endsection