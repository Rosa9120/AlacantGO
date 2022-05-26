@extends('admin')

@section('title', 'Create Manager')

@section('content')
<div class="container">

    <div class="back">
        <a href="{{ url()->previous() }}" id="back">Go Back</a>
    </div>

    <div class="manager">
        <div class="information">
            <form action="{{ url('/admin/managers') }}" method="POST" class="form-group">
                @csrf
                <ul>
                    <li> Full name 
                        <input class="editable" required name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="Enter name" id="name">
                    </li>

                    <li> DNI 
                        <input class="editable" required name="DNI" type="text" value="{{ old('DNI') }}" class="form-control" class="@error('DNI') is-invalid @enderror" placeholder="Enter DNI" id="DNI">
                    </li>
                    @error('DNI')
                    <li class="error-container">
                        <div class="alert alert-danger error-msg"> DNI must have 8 numbers and one capital letter</div>
                    </li>
                    @enderror
                    

                    <li> Phone Number 
                        <input class="editable" required name="phone" type="text" value="{{ old('phone') }}" class="form-control" class="@error('phone') is-invalid @enderror" placeholder="Enter phone number" id="phone_number">
                    </li>
                    @error('phone')
                    <li class="error-container">
                        <div class="alert alert-danger error-msg">{{ $message }}</div>
                    </li>
                    @enderror
                    

                    <li> Establishment 
                    
                    <select id="dropdown" name="dropdownEstablishment" class="form-control editable dropdown">
                        <option value = ""> </option>
                        @foreach ($establishments as $idx => $establishment)
                            <option value="{{ $establishment->id }}" {{ ($idx == -1) ? 'selected' : '' }}>{{ $establishment->name }}</option>
                        @endforeach
                    </select>
                    </li>
                    
                    <li>  Brand 
                
                    <select id="dropdown" name="dropdownBrand" class="form-control editable dropdown">
                
                        <option value = ""> </option>
                        @foreach ($brands as $idx => $brand)
                            <option value="{{ $brand->id }}" {{ ($idx == -1) ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    </li>
                </ul>

                <div class="submit">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('style')

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
        font-size: 21px;
        color: white;
    }

    .manager {
        display: flex;
        flex-direcion: row;
        flex-grow: 0;
        flex-basis: 90%;
        margin-left: 20px;
        justify-content: space-between;
    }

    .information {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border: 1px solid grey;
        border-radius: 10px;
        font-size: 22px;
        min-width: 60%
        max-width: 70%;
        max-height: 80%;
        flex-grow: 1;
        margin-top: 0;
        margin-left: 20px;
        margin-right: 10px;
        margin-bottom: 20px;
        overflow-y: auto;
        padding: 20px;
    }

    ::-webkit-input-placeholder {
        font-style: italic;
     }
     :-moz-placeholder {
        font-style: italic;  
     }
     ::-moz-placeholder {
        font-style: italic;  
     }
     :-ms-input-placeholder {  
        font-style: italic; 
     }

    li {
        display: flex;
        justify-content: space-between;
    }

    .editable {
        line-height: 14px;
        margin-bottom: 8px;
        width: 40%;
        border-radius: 5px;
        border: none;
        padding: 3px;
        padding-left: 5px;
    }

    .dropdown {
        line-height: 20px;
    }

    .submit {
        display: flex;
        justify-content: flex-end;
    }

@endsection