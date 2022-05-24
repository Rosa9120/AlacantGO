@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="map-container" id="map-container" style="height: 540px;">
    
</div>

<div class="container-down">
    <div class="filters" >
        <form action="{{ url('/establishments/filter') }}" id="filter" method="GET" style="height: 100%; display: flex; flex-direction: column; justify-content: space-around;">
            @csrf
            @method('get')
            <div class="filter-element">
                <select name="category" class="form-control dropdown" style="width: 100%; cursor:pointer; height: 3em; font-size: 0.75em; text-align: center; background-color: #686868; color: white;">
                    <option value="-1">
                        Category
                    </option>
                    @foreach ($categories as $category_opt)
                        <option value="{{ $category_opt->id }}" @if (!empty($category) and $category == $category_opt->id)
                            selected
                        @endif>
                            {{ $category_opt->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-element">
                <select name="brand" class="form-control dropdown" style="width: 100%; cursor:pointer; height: 3em; font-size: 0.75em; text-align: center; background-color: #686868; color: white;">
                    <option value="-1">
                        Brand
                    </option>
                    @foreach ($brands as $brand_opt)
                        <option value="{{ $brand_opt->id }}" @if (!empty($brand) and $brand == $brand_opt->id)
                            selected
                        @endif>
                            {{ $brand_opt->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="filter-element">
                <select name="orderBy" class="form-control dropdown" style="width: 100%; height: 3em; cursor:pointer; font-size: 0.75em; text-align: center; background-color: #686868; color: white;">
                    <option value="-1" @if (!empty($orderBy) and $orderBy == -1)
                        selected
                    @endif>
                        Order by
                    </option>
                    <option value="1" @if (!empty($orderBy) and $orderBy == 1)
                        selected
                    @endif>
                        Price: High to Low
                    </option>
                    <option value="2" @if (!empty($orderBy) and $orderBy == 2)
                        selected
                    @endif>
                        Price: Low to High
                    </option>
                </select>
            </div>

            <div class="filter-element"> 
                <input name="open" class="form-check-input" type="checkbox" style="padding: 9px; cursor:pointer; margin-right: 5px;" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Search restaurants that are open now 
                </label>
            </div> 

            <input type="submit" value="Apply filters" class="btn btn-primary" />
            <a href="/" class="btn btn-danger">Clear filters</a>
        </form> 

    </div>
    <div class="container-right"> 
        <div class="searcher"> 
            <input type="text" form="filter" name="search" class="form-control" style="width: 50%; font-size: 1.2rem;" placeholder="Search by name or address..." value={{ $search }}>
            <input type="submit" form="filter" value="Go" style="font-size: 1.2rem;" class="btn btn-primary" />
        </div>
        <div class="cards">
            @foreach ($establishments as $est)
                <div class="card">
                    <img class="card-img-top" style="border-radius: 25px 25px 0 0;" src= "{{ asset($est['img_url']) }}">
                    <div class="overlay-container">
                        <div class="overlay">

                        </div>
                    </div>
                    <a href="{{ url("/establishment/" . $est['id']) }}" class="btn btn-primary more-info-btn" class="fade"> More information </a>
                    <div class="card-body">
                        <h5 class="card-title"> {{ $est['name'] }}</h5>
                        <p class="card-text"> {{ $est['address'] }} </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=establishments&region=GB'></script>
<script defer>
	function initialize() {
		var mapOptions = {
			zoom: 14,
			minZoom: 12,
			maxZoom: 24,
			zoomControl:true,
			zoomControlOptions: {
  				style:google.maps.ZoomControlStyle.DEFAULT
			},
			center: new google.maps.LatLng({{ 38.34517 }}, {{ -0.48149 }}),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: true,
			panControl:false,
			mapTypeControl:false,
			scaleControl:false,
			overviewMapControl:false,
			rotateControl:false
	  	}
		var map = new google.maps.Map(document.getElementById('map-container'), mapOptions);
        var image = new google.maps.MarkerImage("/assets/images/pin.png", null, null, null, new google.maps.Size(28,36));
        console.log(image);
        var establishments = @json($establishments);

        for(establishment in establishments)
        {
            establishment = establishments[establishment];
            if(establishment.latitude && establishment.longitude)
            {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(establishment.latitude, establishment.longitude),
                    icon:image,
                    map: map,
                    title: establishment.name
                });
                var infowindow = new google.maps.InfoWindow();
                google.maps.event.addListener(marker, 'click', (function (marker, establishment) {
                    return function () {
                        infowindow.setContent(generateContent(establishment))
                        infowindow.open(map, marker);
                    }
                })(marker, establishment));
            }
        }
	}
	google.maps.event.addDomListener(window, 'load', initialize);

    function generateContent(establishment)
    {   

        var content = `
            <div class="gd-bubble" style="">
                <div class="gd-bubble-inside">
                    <div class="geodir-bubble_desc">
                    <div class="geodir-bubble_image">
                        <div class="geodir-post-slider">
                            <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                <div id="geodir_images_5de53f2a45254_189" class="geodir-image-wrapper" data-controlnav="1">
                                    <ul class="geodir-post-image geodir-images clearfix">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="geodir-bubble-meta-side" >
                    <div class="geodir-output-location">
                    <div class="geodir-output-location geodir-output-location-mapbubble" style="max-width:170px;">
                        <div class="geodir_post_meta  geodir-field-post_title"><span class="geodir_post_meta_icon geodir-i-text">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title"> </span>
                            <img src=`+establishment.img_url+` height="170px" width="170px"> 
                        </div> 
                        <br>
                        <div style="font-weight:bold; font-size: 1rem; font-family: sans-serif, Monospace, Helvetica;"  class="geodir_post_meta  geodir-field-post_title"><span class="geodir_post_meta_icon geodir-i-text">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title"> </span></span>`+establishment.name+`</div>
                        <div style="font-size: 1rem; font-family: sans-serif, Monospace, Helvetica;" class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title"> </span></span><span itemprop="streetAddress">`+establishment.address+`</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>`;

    return content;

    }
</script>
@endsection

@section("style")
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

    /* .head{
        height: 70px;
        background-color: #b7d8f3;
        display:flex;
    } */

    .head{
        height: 70px;
        display:flex;
        justify-content: flex-end;
        border-bottom: 1px solid black;
        font-family: "Montserrat", sans-serif;
        background-color: #5c5c5c;
    }

    .auth-nav {
        width:100%;
        display: flex;
        box-sizing: border-box;
        margin-right: 20px;
    }

    .input-group{
        padding-top: 14px;
        padding-left: 28%;
    }

    .form-control{
        width: 500px;
    }

    .map-container {
        position:relative;
    }

    .container-down{
        display:flex;
        flex-direction: row;
        height: auto;
        font-size: 1.5rem;
        background-color:#e5e3df;
        height: calc(100% - 540px - 70px);
        flex-wrap: nowrap;
    }

    .filters{
        /* flex-grow: 1; */
        margin: 15px;
        display:flex;
        height:auto;
        flex-flow: column nowrap;
        justify-content: space-around;
        align-items:center;
        padding: 40px 80px 40px 80px;
        height: 500px;
        position:sticky;
        top:15px;
        border-collapse: separate; 
        opacity: 0.7;
        background-color:whitesmoke;
        border-radius: 25px;
        min-width: 400px !important;
    }

    .filter-element{
        /* margin-top: 15px; */
        display:flex;
        flex-direction:row;
        justify-content: space-around;
    }

    .container-right{
        /* flex-grow: 3; */
        justify-content: center;
    }

    .searcher{
        display:flex;
        padding-bottom: 15px; 
        margin: 15px;
        justify-content: center;
    }

    .cards{
        display:flex;
        flex-direction: row;
        align-content: center;
        /* max-width: 1200px; */
        gap: 25px;
        flex-wrap: wrap;
        justify-content: flex-start ;
        margin-left: 10%;
    }

    .card{
        width: 400px;
        position: relative;
        border-radius:25px;
    }

    .card-img-top{
        height: 380px;
        object-fit: cover;
    }

    .overlay-container {
        position: absolute;
        margin: 0;
        height: 380px;
        width: 100%;
        z-index:999;
        border-radius: 25px 25px 0 0;
        transition: .5s ease;
    }

    .overlay {
        opacity: 0;
        height: 100%;
        width: 100%;
        border-radius: 25px 25px 0 0;
        transition: .5s ease;
        background-color: whitesmoke;
    }

    .more-info-btn {
        display: none;
        opacity: 0;
        transition: .5s ease;
        position: absolute;
        top: 40%;
    }

    .card:hover .overlay {
        opacity: 0.7;
    }

    .card:hover .more-info-btn {
        opacity: 1;
        display: inline-block;
    }

    .fade{
        position: absolute;
        -webkit-transform: translate(-50%, -50%); 
        -ms-transform: translate(-50%, -50%); 
        transform: translate(-50%, -50%);
        opacity: 1;
    }

    .btn{
        align-self: center;
        z-index: 999;
        opacity: 1;
    }

    .card-title{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 30px;
        font-weight: 550;
    }

    @media(max-width:1150px){
        .container-down{
        flex-wrap: wrap;
        }

        .filters{
            position:relative;
            width:100%;
        }
    }
    </style>
@endsection