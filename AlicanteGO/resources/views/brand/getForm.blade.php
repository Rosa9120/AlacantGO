@extends('admin')

@section('title', 'Get Brand')

@section('content')

<div style="display:flex; justify-content:center; padding-top:35px">
    <div class="m-3 justify-content-center text-dark" style="display:inline-block; padding: 20px; background-color:rgba(255,255,255,0.7);">

        <h5 class="card-header">
            <span class="text-dark"> <h1> Hello, select a ID to know which brand is related to it </h1></span>

            <span class="text-dark"> 
            <form action="{{url('/brands/get')}}" method="POST">
                @csrf
                Brand id: <input type="number" name="brand_id">

                <button type="submit">Send</button>
            </form>
            </span>
            
        </h5>

    </div>
</div>
@endsection