<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous"></script>


    <style>
        @charset "utf-8";
        html, body {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
        }

        html {
            font-size: 10px;
        }

        body {
            overflow: hidden;
        }

        #app {
            width: 100%;
            height: 100%;
        }
    </style>

</head>
<body>

<div class="row" style="height: 100%">
    <div class="col-6">
        <form method="post" id="frm" >

            <input type="text" id="id_lat">
            <input type="text" id="id_long">

        </form>

        <button onclick="$('#frm').submit()" type="button">Save</button>
    </div>

    <div class="col-6">
        <div id="app"></div>
    </div>
</div>


<script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
<script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>


<script>

    $(document).ready(function () {
        var app = new Mapp({
            element: '#app',
            presets: {
        latlng: {
        lat: '35.73249',
        lng: '51.42268'
    },
        zoom: 7
    },
        apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkxODM2YTc4YjQ1MWY1ODk5NmE1NTM2MmNiYmFjZmFiZGRmYTY5MzQzN2YxNDUzOTNmN2Q2MWE1MjI3ZmViNTRmYmI2OTM4ZmM5YWMyYTkyIn0.eyJhdWQiOiIyMjk0MSIsImp0aSI6IjkxODM2YTc4YjQ1MWY1ODk5NmE1NTM2MmNiYmFjZmFiZGRmYTY5MzQzN2YxNDUzOTNmN2Q2MWE1MjI3ZmViNTRmYmI2OTM4ZmM5YWMyYTkyIiwiaWF0IjoxNjg4MTQ1NzA4LCJuYmYiOjE2ODgxNDU3MDgsImV4cCI6MTY5MDczNzcwOCwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.lA2hR9BeYbGBvk0APHQR2goL78g40sNGIuRICJumxLY2J33UQzamiHQaAk_DJNYaHLZjfDqG8toL3sg7ayWaeOlmkB-WnqS2iAaepdAwG_JX98-ciY6kn8amIwpUGHD8q7DYMfZvTZojjIGXOKTjjQhJDVwl53G86vJEpelC4_Zy-Lobydel2IDvW39MPifL3tkNIMnA-cwAlXz83HyGTMDYN987cqI7FXtaFsgo6Qf6KjDNERKE3br67sTifkZTPagM30CUQZebLTWDK1aDWuBa2L3HvnC_ux4V1SPVlrWaM-hx7peKcieHXgOJEfSA2Bvf3XlAXYE-tM8LeJLW0A'
    });
        app.addLayers();

        // Implement location picker
        app.map.on('click', function (e) {
            // آدرس یابی و نمایش نتیجه در یک باکس مشخص
            ShowMarker(app, e.latlng.lat, e.latlng.lng);

            $('#id_lat').val(e.latlng.lat);
            $('#id_long').val(e.latlng.lng);
            // برای سفارشی سازی نمایش نتیجه به جای متد بالا از متد زیر میتوان استفاده کرد

            // app.findReverseGeocode({
            //   state: {
            //     latlng: {
            //       lat: e.latlng.lat,
            //       lng: e.latlng.lng
            //     },
            //     zoom: 16
            //   },
            //   after: function(data) {
            //     app.addMarker({
            //       name: 'advanced-marker',
            //       latlng: {
            //         lat: e.latlng.lat,
            //         lng: e.latlng.lng
            //       },
            //       icon: app.icons.red,
            //       popup: {
            //         title: {
            //           i18n: 'آدرس '
            //         },
            //         description: {
            //           i18n: data.address
            //         },
            //         class: 'marker-class',
            //         open: true
            //       }
            //     });
            //   }
            // });
        });
    });

    function ShowMarker(app, lat, long) {
        app.showReverseGeocode({
            state: {
                latlng: {
                    lat: lat,
                    lng: long,
                },
                zoom: 16
            }
        });

        app.addMarker({
            name: 'advanced-marker',
            latlng: {
                lat: lat,
                lng: long,
            },
            icon: app.icons.red,
            popup: false
        });
    }

</script>
</body>
</html>
