@extends('admin')

@section('title', 'Items List')

@section('content')

<div style="display:flex;justify-content:space-around;margin-top:40px;">
    <div>
        <h3>Total items: {{ $count }}</h3>
    </div>
    <div>
        <a class="btn btn-success" href="{{ url('/items/create') }}"> Create New Product</a>
    </div>
</div>

<div class="form-group has-search search">
    <form class="search-form" action="{{ url('/items/search') }}" method="GET">
        @csrf
        @method('get')
        @if(empty($search))
            {{ $search = null }}
        @endif
        <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search by name...">
        <input type="submit" class="btn btn-primary" value="Search"/>
    </form>
</div>

<table class="table table-bordered" style="width:85%;margin:auto;box-sizing:border-box;margin-top:30px;margin-bottom:60px;">
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
            <a class="btn btn-primary" href="{{ url("/items/" . $item->id) }}">Show</a>
            <a class="btn btn-warning" href="{{ url("/items/" . $item->id . "/edit") }}">Edit</a>
 
            <form action="{{ url('/items', ['id' => $item->id]) }}" method="POST">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-danger" value="Delete"/>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $items->links() }}

@endsection

@section('style')

    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

    .pagination {
        justify-content: center;    
    }

    .search-form {
        display: flex;
    }

    .search {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    form {
        display: inline-block;
    }
@endsection