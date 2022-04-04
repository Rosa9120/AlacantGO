@extends('admin')

@section('title', 'Create Item')

@section('content')

    <div class="container">
        <div class="back">
            <a href="/items" id="back">Go Back</a>
        </div>

        <div class="item">
            <div class="img-container">
                <img src="/assets/images/placeholder.png" alt="image">
            </div>

            <div class="information">
                <form action="{{ url('/items') }}" method="POST">
                    @csrf
                    @method('post')
                    <ul>
                        <li>Name: 
                            <input class="editable" required name="name" type="text" placeholder="Tarta de Oreo..."/>
                        </li>
                        <li>Price: 
                            <input class="editable" required name="price" type="number" lang="en" step="0.01" placeholder="3,99..."/>
                        </li>
                        <li>Description: 
                            <input class="editable" name="description" type="text" placeholder="La mejor tarta de Oreo..."/>
                        </li>
                        <li>Type: 
                            <input class="editable" name="type" type="text" placeholder="postre..."/>
                        </li>
                        <li class="belongs">
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" value="brand" type="radio" name="radioItem" onclick="changeDropdown()" id="radioBrand" checked>
                                    <label class="form-check-label" for="radioBrand">
                                        Brand Item
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="establishment" type="radio" onclick="changeDropdown()" name="radioItem" id="radioEstablishment">
                                    <label class="form-check-label" for="radioEstablishment">
                                        Establishment Item
                                    </label>
                                </div>
                            </div>

                            <select id="dropdownItem" name="dropdownItem" class="form-control editable dropdown">
                                @foreach ($brands as $idx => $brand)
                                    <option value="{{ $brand->id }}" {{ ($idx == 0) ? 'selected' : '' }}>{{ $brand->name }}</option>
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

@section('script')

    function changeDropdown() {

        var dropdown = document.getElementById('dropdownItem');
        var options = document.querySelectorAll('#dropdownItem option');
        options.forEach(option => option.remove());

        if (document.getElementById('radioEstablishment').checked) {
            var establishments = {!! json_encode($establishments->toArray(), JSON_HEX_TAG) !!};
            var idx = 0;
            
            for (const establishment of establishments) {
                var option = document.createElement('option');
                option.value = establishment.id;
                option.text = establishment.name;
                idx == 0 ? option.selected = 'selected' : option.selected = '';
                dropdown.appendChild(option);

                idx ++;
            }
        } else {
            var brands = {!! json_encode($brands->toArray(), JSON_HEX_TAG) !!};
            var idx = 0;
            
            for (const brand of brands) {
                var option = document.createElement('option');
                option.value = brand.id;
                option.text = brand.name;
                idx == 0 ? option.selected = 'selected' : option.selected = '';
                dropdown.appendChild(option);

                idx ++;
            }
        }
    }

@endsection

@section('style')

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

    .img-container {
        width: 30%;
        height: 70%;
        align-self: center;
    }

    .item {
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

    .belongs {
        display: flex;
        align-items: center;
        margin-top: 7px;
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
        height: calc(20px * 2);
    }

    .submit {
        display: flex;
        justify-content: flex-end;
    }

@endsection