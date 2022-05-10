@extends('admin')

@section('content')

<div style="display:flex; justify-content:center; padding-top:35px">
    <div class="m-3 justify-content-center text-dark" style="display:inline-block; padding: 20px; background-color:rgba(255,255,255,0.7);">

        <span> <h1>Introduce the name of a valid establishment and the brand to which it belongs</h1> <span>

    <form action="{{url('/brands/update')}}" method="POST">
        @csrf
        @method('put')
        <li>Establishment: 
                <select name="establishment" class="form-control editable dropdown">
                    @foreach ($establishments as $establishment)
                    <option value="{{ $establishment }}" >{{ $establishment->name }}</option>
                    @endforeach
                </select>
            </li>

        <div>
        <li>Brand: 
            <select name="brand" class="form-control editable dropdown">
                @foreach ($brands as $brand)
                <option value="{{ $brand }}" >{{ $brand->name }}</option>
                @endforeach
            </select>
        </li>

        <div>
        <button type="submit">Send</button>
    </form>
    </div>
</div>
@endsection