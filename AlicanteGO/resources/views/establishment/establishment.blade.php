@extends('admin')

@section('content')

<div style="display:flex; justify-content:center; padding-top:35px">
    <div class="m-3 justify-content-center text-dark" style="display:inline-block; padding: 20px; background-color:rgba(255,255,255,0.7);">
        <h5 class="card-header">
            <span class="text-dark">{{ $establishment->name }}</span>
        </h5>
    </div>
</div>
@endsection