@extends('admin')

@section('content')
<div style="display:flex; justify-content:center; padding-top:35px">
    <div class="m-3 justify-content-center text-dark" style="display:inline-block; padding: 20px; background-color:rgba(255,255,255,0.7);">
        <form action="{{ url('/manager/new') }}" method="POST" class="form-group">
            @csrf
            <div class="mb-3">
                <label for="name"> Full name </label>
                <input required name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="Enter name" id="name">
                <label for="DNI"> DNI </label>
                <input requiered name="DNI" type="text" value="{{ old('DNI') }}" class="form-control" placeholder="Enter DNI" id="DNI">
                <label for="phone_number"> Phone Number </label>
                <input required name="phone_number" type="text" value="{{ old('phone_number') }}" class="form-control" placeholder="Enter phone number" id="phone_number">
                <label for="establishment"> Establishment </label>
                <input required name="establishment" type="text" value="{{ old('establishment') }}" class="form-control" placeholder="Enter establishment name" id="establishment">
                <label for="brand"> Brand </label>
                <input required name="brand" type="text" value="{{ old('brand') }}" class="form-control" placeholder="Enter brand name" id="brand">
         
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Create Manager</button>
            </div>
        </form>
    </div>
</div>
@endsection