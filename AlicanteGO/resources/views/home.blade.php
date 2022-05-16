@extends('layouts.app')

@section('content')
<div class="map-container" id="map-container" style="height: 540px;">
    
</div>

<div class="container-down">
    <div class="filters"> 
        <div class="filter-element" style="display:flex; flex-direction:row;">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle btn-lg" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown"  aria-expanded="false">
                  Category
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>

        <div class="filter-element">
            <div class="dropdown2">
                <button class="btn btn-secondary dropdown-toggle btn-lg" type="button" id="dropdownMenuButton2" data-toggle="dropdown2" aria-haspopup="true" data-bs-toggle="dropdown2"  aria-expanded="false">
                  Order
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
        <div class="filter-element"> 
            <input class="form-check-input" type="checkbox" style="padding: 9px;" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Search restaurants that are open now </label>
        </div> 

        <input type="submit" value="Apply filters" class="btn btn-primary" />

    </div>
    <div class="container-right"> 
        <div class="searcher"> 
            <input type="text" name="search" value="" class="form-control" style="width: 50%; font-size: 1.2rem;" placeholder="Search by name...">
            <input type="submit" value="Go" style="font-size: 1.2rem;" class="btn btn-primary" />
        </div>
        <div class="cards">
            @foreach ($establishments as $est)
                <div class="card">
                    <img class="card-img-top" style="border-radius: 25px 25px 0 0;" src="storage/default.jpg">
                    <div class="overlay">
                        <a href="#" class="btn btn-primary" class="fade"> More information </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"> {{ $est->name }}</h5>
                        <p class="card-text"> {{ $est->address }} </p>
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
			center: new google.maps.LatLng({{ $latitude }}, {{ $longitude }}),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: true,
			panControl:false,
			mapTypeControl:false,
			scaleControl:false,
			overviewMapControl:false,
			rotateControl:false
	  	}
		var map = new google.maps.Map(document.getElementById('map-container'), mapOptions);
        var image = new google.maps.MarkerImage("assets/images/pin.png", null, null, null, new google.maps.Size(28,36));
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
                            <img src="storage/default.jpg" height="170px" width="170px">
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
        flex-grow: 1;
        margin: 15px;
        width: 400px;
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
    }

    .filter-element{
        /* margin-top: 15px; */
        display:flex;
        flex-direction:row;
        justify-content: space-around;
    }

    .container-right{
        flex-grow: 3;
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


    .overlay {
        position: absolute;
        margin: 0;
        height: 80%;
        width: 100%;
        opacity: 0;
        z-index:50;
        border-radius: 25px 25px 0 0;
        transition: .5s ease;
        background-color: whitesmoke;
        display:flex;
        justify-content: center;
        align-content: center;
    }


    .card:hover .overlay {
        opacity: 0.7;
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

    .dropdown-toggle {
        white-space: nowrap;
        width: 250px;
    }

    .dropdown-item{
        width:250px;
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