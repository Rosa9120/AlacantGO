@extends('admin')

@section('title', 'Categories List')

@section('content')

<div style="display:flex;justify-content:space-around;margin-top:40px;">
    <div>
        <h3>Total categories: {{ $count }}</h3>
    </div>
    <div>
        <a class="btn btn-success" href="{{ url('/categories/create') }}"> Create New Category</a>
    </div>
</div>

<div class="form-group has-search search">
    <form class="search-form" action="{{ url('/categories/search') }}" method="GET">
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
    </tr>
    @foreach ($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>

        <td>
            <a class="btn btn-warning" href="{{ url("/categories/" . $category->id . "/edit") }}">Edit</a>
 
            <form action="{{ url('/categories/delete', ['id' => $category->id]) }}" method="POST">
                @csrf
                @method('get')
                <input type="submit" class="btn btn-danger" value="Delete"/>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $categories->links() }}

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