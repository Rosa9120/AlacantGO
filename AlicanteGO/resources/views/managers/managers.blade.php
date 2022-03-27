@extends('admin')

@section('content')

<div style="display:flex;justify-content:space-around;margin-top:40px;">
    <div>
        <h3>Total items: {{ $count }}</h3>
    </div>  
    <div>  
        <a href="{{url('/addmanagers')}}"> 
            <button type="button" class="btn btn-success">Create Manager</button>
        </a>

        {{-- <a class="btn btn-success" href="/addmanagers" > Create Manager </a> --}}
    </div>
</div>

<div class="form-group has-search search">
    <form class="search-form" action="{{ url('/managers/search') }}" method="POST">
        @csrf
        @method('post')
        @if(empty($search))
            {{$search = null}}
        @endif
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
        @if($manager->brand != null)
            <td>{{ $manager->brand->name }}</td>    
        @else
        <td style="font-style:italic;" > none </td>    
        @endif

        @if($manager->establishment != null )
            <td>{{ $manager->establishment->name }}</td>
        @else
            <td style="font-style:italic;"> none </td>
        @endif
        <td>
            <a class="btn btn-primary" href="{{ url("/managers/" . $manager->id) }}">Show</a>
            <a class="btn btn-warning" href="{{ url("/managers/edit/" . $manager->id) }}">Edit</a>
 
            <form action="{{ url('/managers', ['id' => $manager->id]) }}" method="POST">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-danger" value="Delete"/>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{-- {{ $managers->links() }} --}}
<style>
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
</style>
@endsection
