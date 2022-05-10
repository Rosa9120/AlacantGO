@extends('admin')

@section('content')

<div style="display:flex;justify-content:space-around;margin-top:40px;">
    <div>
        <h3>Total managers: {{ $count }}</h3>
    </div>  
    <div>  
        <a href="{{ url('/addmanagers') }}" method="GET"> 
            <button type="button" class="btn btn-success">Create Manager</button>
        </a>
    </div>
</div>

<div class="form-group has-search search">
    <form class="search-form" action="{{ url('/managers/search') }}" method="GET">
        @csrf
        @method('get')
        @if(empty($search))
            {{$search = null}}
        @endif
        <div class="dropdown-container">
            <select name="orderBy" class="form-control dropdown">
                <option value="-1" @if (!empty($orderBy) and $orderBy == -1)
                    selected
                @endif>
                    Order by
                </option>
                <option value="1" @if (!empty($orderBy) and $orderBy == 1)
                    selected
                @endif>
                    Alphabetical order: A to Z
                </option>
                <option value="2" @if (!empty($orderBy) and $orderBy == 2)
                    selected
                @endif>
                Alphabetical order: Z to A
                </option>
            </select>
        </div>
        <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search by name...">
        <input type="submit" class="btn btn-primary" value="Search"/>
    </form>
</div>

<table class="table table-bordered" style="width:85%;margin:auto;box-sizing:border-box;margin-top:30px;margin-bottom:60px;">
    <tr>
        <th>ID #</th>
        <th>Name</th>
        <th>DNI</th>
        <th>phone</th>
        <th>Brand</th>
        <th>Establishment</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($managers as $manager)
    <tr>
        <td>{{ $manager->id }}</td>
        <td>{{ $manager->name }}</td>
        <td>{{ $manager->DNI }}</td>
        <td>{{ $manager->phone }}</td>
        @if(isset($manager->brand))
            <td>{{ $manager->brand->name }}</td>    
        @else
        <td style="font-style:italic;" > none </td>    
        @endif

        @if(isset($manager->establishment))
            <td>{{ $manager->establishment->name }}</td>
        @else
            <td style="font-style:italic;"> none </td>
        @endif
        <td>
            <a class="btn btn-primary" href="{{ url("/managers/show/" .$manager->id) }}">Show</a>
            <a class="btn btn-warning" href="{{ url("/managers/edit/" . $manager->id) }}">Edit</a>
 
            <form action="{{ url('/managers/delete', ['id' => $manager->id]) }}" method="POST">
                @csrf
                @method('get')
                <input type="submit" class="btn btn-danger" value="Delete"/>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{$managers->links() }}
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

    form {
        display: inline-block;
    }

    .dropdown-container {
        margin-right: 0.6em;
        border-right: 1px solid #a6a6a6;
        padding-right: 0.6em;        
    }

    .dropdown {
        line-height: 20px;
        width: auto;
        padding: 0.6em;
    }

    
@endsection
