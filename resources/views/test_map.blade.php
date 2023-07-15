<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link
        rel="stylesheet"
        href="https://www.parsimap.com/docs/leaflet/v1.5.1/leaflet.css"
    />
    <script src="https://www.parsimap.com/docs/leaflet/v1.5.1/leaflet.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700');
        * {
            margin:0;
        }
        * + * {
            margin-top:10px;
        }
        body {
            background-color:#eee;
            margin:0;
        }
        body,button,input {
            font-family:'IBM Plex Sans',sans-serif;
            font-size:1.2rem;
            line-height:1.5;
        }
        button,input {
            background-color:#eee;
            border:1px #999 solid;
            border-radius:4px;
            cursor:pointer;
            padding:5px 15px;
            transition:all 250ms;
        }
        form {
            padding:40px;
        }
        label {
            display:block;
        }
        #map {
        * + * {
            margin:0;
        }
        }

        body {
            margin: 0;
        }

        html,
        body,
        #map {
            height: 100%;
        }
    </style>
</head>
<body>
<div id="map"></div>

<form>
    <div><label for="lat">Latitude</label><input type="text" name="lat" id="lat"></div>
    <div><label for="lng">Longitude</label><input type="text" name="lng" id="lng"></div>
</form>

<script>
    var map;
    var pin;
    var tilesURL='https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
    var mapAttrib='&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, Tiles courtesy of <a href="http://hot.openstreetmap.org/" target="_blank">Humanitarian OpenStreetMap Team</a>';
    var marker;

    // add map container
    // $('body').prepend('<div id="map" style="height:70vh;width:100%;"></div>');
    MapCreate();

    function MapCreate() {
        // create map instance
        if (!(typeof map == "object")) {
            map = L.map('map', {
                center: [40,0],
                zoom: 3
            }).setView([29.6760859,52.4950737], 13);
        }
        else {
            map.setZoom(3).panTo([40,0]);
        }
        // create the tile layer with correct attribution
        L.tileLayer(tilesURL, {
            attribution: mapAttrib,
            maxZoom: 19
        }).addTo(map);

        marker = L.marker([29.623116,52.497856], { riseOnHover:true,draggable:true }).addTo(map);
    }

    map.on('click', function(ev) {
        $('#lat').val(ev.latlng.lat);
        $('#lng').val(ev.latlng.lng);

        marker.remove();

        if (typeof pin == "object") {
            pin.setLatLng(ev.latlng);
        }
        else {
            pin = L.marker(ev.latlng,{ riseOnHover:true,draggable:true });
            pin.addTo(map);
            pin.on('drag',function(ev) {
                $('#lat').val(ev.latlng.lat);
                $('#lng').val(ev.latlng.lng);
            });
        }
    });
</script>
</body>
</html>
