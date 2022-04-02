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
    <form class="search-form" action="{{ url('/establishment/search') }}" method="POST">
        @csrf
        @method('post')
        @if(empty($search))
            {{ $search = null }}
        @endif
        <input class="form-control" name="search" type="text" id="search" placeholder="Search by name..." autofocus></input>
        <button style="margin-left:5px;" type="submit" class="btn btn-primary" value="Search">Search</button>
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
 
            <form action="{{ url('/establishments', ['id' => $establishment->id]) }}" method="POST">
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
        window.location.href = '/establishmentadd';
    }

    function editEstablishment(id) {
        window.location.href = `{{url('/establishmentedit/')}}/${id}`;
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