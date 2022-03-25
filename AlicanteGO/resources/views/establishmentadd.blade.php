@extends('layout')

@section('title', 'Create a new Establishment')

@section('content')

<div class="m-3 justify-content-center text-dark">
    <form action="{{ url('/establishment/new') }}" method="POST" class="form-group">
        @csrf
        <div class="mb-3">
            <label for="name"> Name </label>
            <input required name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="Enter name" id="name">
            <label for="phone_number"> Phone Number </label>
            <input required name="phone_number" type="text" value="{{ old('phone_number') }}" class="form-control" placeholder="Enter phone number" id="phone_number">
            <label for="address"> Address </label>
            <input requiered name="address" type="text" value="{{ old('address') }}" class="form-control" placeholder="Enter address" id="address">
            <label for="postal_code"> Postal Code </label>
            <input requiered name="postal_code" type="text" value="{{ old('postal_code') }}" class="form-control" placeholder="Enter postal code" id="postal_code">
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Create Establishment</button>
        </div>
    </form>
</div>