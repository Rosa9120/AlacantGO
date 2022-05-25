@extends('admin')

@section('title', 'Brands List')

@section('content')

<div style="display:flex;justify-content:space-around;margin-top:40px;">
    <div>
        <h3>Total brands: {{ $count }}</h3>
    </div>
    <div>
        <a class="btn btn-success" href="{{ url('/admin/brands/set') }}"> Set Brand</a>
        <a class="btn btn-success" href="{{ url('/admin/brands/create') }}"> Create New Brand</a>
    </div>
</div>

<div class="form-group has-search search">
    <form class="search-form" action="{{ url('/admin/brands/search') }}" method="get">
        @csrf
        @method('post')
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
        <th>Name</th>
        <th>Isin</th>
    </tr>
    @foreach ($brands as $brand)
    <tr>
        <td>{{ $brand->id }}</td>
        <td>{{ $brand->name }}</td>
        <td>{{ $brand->isin }}</td>

        <td>
            <a class="btn btn-warning" href="{{ url("/admin/brands/" . $brand->id . "/edit") }}">Edit</a>
 
            <form action="{{ url('/admin/brands/delete', ['id' => $brand->id]) }}" method="POST">
                @csrf
                @method('get')
                <input type="submit" class="btn btn-danger" value="Delete"/>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $brands->links() }}

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