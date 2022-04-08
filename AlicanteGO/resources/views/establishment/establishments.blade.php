@extends('admin')

@section('title', 'Establishments List')

@section('content')

<div style="display:flex;justify-content:space-around;margin-top:40px;">
    <div>
        <h3>Total establishments: {{ $count }}</h3>
    </div>
    <div onclick="createEstablishment()">
        <a class="btn btn-success"> Create New Establishment</a>
    </div>
</div>

<div class="form-group has-search search">
    <form class="search-form" action="{{ url('/establishments/search') }}" method="GET">
        @csrf
        @method('get')
        @if(empty($search))
            {{ $search = null }}
        @endif
        <div class="dropdown-container">
            <select name="orderBy" id="orderBy" class="form-control dropdown">
                <option value="-1" @if (!empty($orderBy) or $orderBy == -1) selected @endif>Order by</option>
                <option value="1" @if (!empty($orderBy) and $orderBy == 1) selected @endif>Order by Name</option>
                <option value="2" @if (!empty($orderBy) and $orderBy == 2) selected @endif>Order by Brand</option>
                <option value="3" @if (!empty($orderBy) and $orderBy == 3) selected @endif>Order by Category</option>
            </select>
        </div>
        
        <input class="form-control" name="search" type="text" id="search" placeholder="Search by name..."></input>
        <button type="submit" class="btn btn-primary" value="Search">Search</button>
    </form>
</div>

<table class="table table-bordered" style="width:85%;margin:auto;box-sizing:border-box;margin-top:30px;margin-bottom:30px;">
    <tr>
        <th>ID #</th>
        <th>Name</th>
        <th>Phone number</th>
        <th>Address</th>
        <th>Brand</th>
        <th>Category</th>
        <th width="260px">Action</th>
    </tr>
    @foreach ($establishments as $establishment)
    <tr>
        <td>{{ $establishment->id }}</td>
        <td>{{ $establishment->name }}</td>
        <td>{{ $establishment->phone_number }}</td>
        <td>{{ $establishment->address }}</td>
        <td>{{ $establishment->brand->name }}</td>
        <td>{{ $establishment->category->name}}</td>

        <td>
            <a class="btn btn-primary" onclick="showEstablishment({{ $establishment->id }})">Show</a>
            <a class="btn btn-warning" onclick="editEstablishment({{ $establishment->id }})">Edit</a>

            <form action="{{ url('/establishment', ['id' => $establishment->id]) }}" method="POST">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-danger" value="Delete"/>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $establishments->links() }}

<script>
    function showEstablishment(id) {
        window.location.href = `{{url('/establishment/')}}/${id}`;
    }

    function createEstablishment() {
        window.location.href = '/establishment/new';
    }

    function editEstablishment(id) {
        window.location.href = `{{url('/establishment/edit/')}}/${id}`;
    }
</script>

@endsection

@section('style')

    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

    .pagination {
        justify-content: center;    
    }

    .search-form {
        display: flex;
        flex-wrap: wrap;
    }

    .search {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .dropdown-container {
        margin-right: 0.6em;
        border-right: 1px solid #a6a6a6;
        padding-right: 0.6em;        
    }

    .dropdown {
        line-height: 20px;
        width: 10em;
        padding: 0.6em;
    }

    form {
        display: inline-block;
    }
@endsection