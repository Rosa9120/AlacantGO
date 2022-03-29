@extends('admin')

@section('content')
<div style="display:flex; justify-content:center; padding-top:35px">
    <div class="m-3 justify-content-center text-dark" style="display:inline-block; padding: 20px; background-color:rgba(255,255,255,0.7);">
        <form action="{{ url('/addmanagers/create') }}" method="POST" class="form-group">
            @csrf
            <div class="mb-3">
                <label for="name"> Full name </label>
                <input required name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="Enter name" id="name">
                <label for="DNI"> DNI </label>
                <input required name="DNI" type="text" value="{{ old('DNI') }}" class="form-control" placeholder="Enter DNI" id="DNI">
                <label for="phone"> Phone Number </label>
                <input required name="phone" type="text" value="{{ old('phone') }}" class="form-control" placeholder="Enter phone number" id="phone_number">
                <label for="establishment"> Establishment </label>
         
                <select id="dropdown" name="dropdownEstablishment" class="form-control editable dropdown">
                    <option value = ""> </option>
                    @foreach ($establishments as $idx => $establishment)
                        <option value="{{ $establishment->id }}" {{ ($idx == -1) ? 'selected' : '' }}>{{ $establishment->name }}</option>
                    @endforeach
                </select>
                <label for="brand"> Brand </label>
              
                <select id="dropdown" name="dropdownBrand" class="form-control editable dropdown">
            
                    <option value = ""> </option>
                    @foreach ($brands as $idx => $brand)
                        <option value="{{ $brand->id }}" {{ ($idx == -1) ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>

            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Create Manager</button>
            </div>
        </form>
    </div>
</div>
@endsection