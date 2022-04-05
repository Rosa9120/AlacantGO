@extends('admin')

@section('content')

<div style="display:flex; justify-content:center; padding-top:35px">
    <div class="m-3 justify-content-center text-dark" style="display:inline-block; padding: 20px; background-color:rgba(255,255,255,0.7);">

        <h5 class="card-header">
            <span class="text-dark"> <h1> The selected brand is: </h1></span>

            <span class="text-dark"> 
            <p href="{{ url('/brands/get', ['name' => $name]) }}">
                    <h1><?php echo $name; ?><h1>
            </p>
            </span>
            
        </h5>

    </div>
</div>
@endsection