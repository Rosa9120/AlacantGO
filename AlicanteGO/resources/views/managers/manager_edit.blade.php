@extends('admin')

@section('title', 'Edit Manager')

@section('content')

    <div class="container">
        <div class="back">
            <a href="/admin/managers" id="back">Go Back</a>
        </div>

        <div class="title">
            <h1> Edit Manager </h1>
        </div>

        <div class="manager">
            <div class="img-container">
                <img src="/assets/images/user.png" alt="image">
            </div>

            <div class="information">
                <form action="{{ url('/admin/managers', ["id" => $manager->id]) }}" method="POST">
                    @csrf
                    @method('patch')
                <ul>
                    <li>ID #: <input class="custom" name="id" disabled="disabled" value = "{{ old('id', $manager->id)  }}" ></li>
                    <li>Full name: <input class="custom" name="name" required value="{{ old('name', $manager->name) }}"> </li>
                    <li>DNI: <input class="custom" name="DNI" required value = "{{ old('DNI',$manager->DNI) }}"class="@error('DNI') is-invalid @enderror"  > </li>
                    @error('DNI')
                    <li class="error-container">
                        <div class="alert alert-danger error-msg"> DNI must have 8 numbers and one capital letter</div>
                    </li>
                    @enderror

                    <li>Phone number: <input class="custom" name="phone" required class="@error('phone') is-invalid @enderror" value="{{ old('phone', $manager->phone) }}"> </li>
                    @error('phone')
                    <li class="error-container">
                        <div class="alert alert-danger error-msg">{{ $message }}</div>
                    </li>
                    @enderror
                    <li>Brand:                
                        <select id="dropdown" name="dropdownBrand" class="custom dropdown">
                        @if(isset($manager->brand))
                            <option value = ""> </option>
                            @foreach ($brands as $idx => $brand)
                            <option value="{{ old('dropdownBrand', $brand->id ) }}"{{ ($brand->id  == $manager->brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                        @else
                        <option value = ""> </option>
                            @foreach ($brands as $idx => $brand)
                                <option value="{{ old('dropdownBrand', $brand->id ) }}" {{ ($idx == -1) ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        @endif

                    </select>
                    </li> 

                    <li>Establishment:                
                        <select id="dropdown" name="dropdownEstablishment" class="custom dropdown">
                            @if(isset($manager->establishment))
                                <option value = "" > </option>
                                @foreach ($establishments as $idx => $establishment)
                                    <option value="{{ old('dropdownEstablishment', $establishment->id ) }}"  {{ ($establishment->id == $manager->establishment->id) ? 'selected' : '' }}>{{ $establishment->name }}</option>
                                @endforeach
                            @else
                            <option value = ""> </option>
                                @foreach ($establishments as $idx => $establishment)
                                    <option value="{{ old('dropdownEstablishment', $establishment->id ) }}"  {{ ($idx == -1) ? 'selected' : '' }}>{{ $establishment->name }}</option>
                                @endforeach
                            @endif
                    </select>
                    </li> 
                </ul>
                <div class="submit">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
            </div>

        </div>

    </div>

    <style>

    .error-container {
            display: flex;
            justify-content: flex-end;
        }

        li > .error-msg {
            min-width: 40%;
            padding: 0;
            padding-left: 6px;
            padding-right: 6px;
            color: #842029;
        }

    .container {
        font-family: "Montserrat", sans-serif;
        margin-top: 100px;
        padding: 15px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        width: 70%;
        height: auto;
        max-height: 100%;
        background-color: rgba(109, 109, 109, 0.2);
        border-radius: 20px;
        border: 1px solid grey;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }

    .back {
        position: relative;
    }

    #back {
        display: inline-block;
        padding: 5px;
        text-decoration: none;
        font-size: 20px;
        color: #4E4E4E;
        transition: 0.3s;
    }

    #back:hover {
        color: white;
        transform: scale(1.1);
    }

    .img-container {
        width: 30%;
        height: 70%;
        align-self: center;
    }

    .manager {
        display: flex;
        flex-direcion: row;
        flex-grow: 0;
        flex-basis: 90%;
        margin-left: 20px;
        justify-content: space-between;
    }

    img {
        display: block;
        max-width: 100%;
        max-height: 100%;
        border-radius: 15px;
        border: 1px solid grey;
    }

    .information {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        border: 1px solid grey;
        border-radius: 10px;
        font-size: 22px;
        min-width: 60%
        max-width: 70%;
        max-height: 80%;
        flex-grow: 1;
        margin: 0 10 20 20;
        overflow-y: auto;
        padding: 20px;
    }

    li {
        display: flex;
        justify-content: space-between;
    }

    .custom{
        line-height: 14px;
        margin-bottom: 8px;
        width: 40%;
        border-radius: 5px;
        border: none;
        padding: 3px;
        padding-left: 5px;
    }

    .submit {
        display: flex;
        justify-content: flex-end;
    }
    </style>

@endsection

