<!DOCTYPE html>
<html>
<head>
    <title>انتخاب برنامه ناوبری</title>

    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
        }

        .button img {
            vertical-align: middle;
            margin-right: 5px;
        }
    </style>

</head>
<body>
<h3>لطفاً برنامه ناوبری مورد نظر را انتخاب کنید:</h3>
<a class="button" onclick="openMap('snapp')">
    <img src="snapp_logo.png" alt="Snapp Logo" width="24" height="24">Snapp
</a>
<a class="button" onclick="openMap('waze')">
    <img src="waze_logo.png" alt="Waze Logo" width="24" height="24">Waze
</a>
<a class="button" onclick="openMap('neshan')">
    <img src="neshan_logo.png" alt="Neshan Logo" width="24" height="24">Neshan
</a>
<a class="button" onclick="openMap('balad')">
    <img src="balad_logo.png" alt="Balad Logo" width="24" height="24">Balad
</a>
<a class="button" onclick="openMap('google_map')">
    <img src="google_maps_logo.png" alt="Google Maps Logo" width="24" height="24">Google Maps
</a>

<script>
    function openMap(app) {
        var latitude = 36.306269; // عرض جغرافیایی
        var longitude = 50.030766; // طول جغرافیایی

                var uri;
                if (app === 'snapp') {
                    uri = "snapp://map?lat=" + latitude + "&lng=" + longitude;
                } else if (app === 'waze') {
                    uri = "waze://?ll=" + latitude + "," + longitude + "&navigate=yes";
                } else if (app === 'neshan') {
                    uri = "neshan://navigate?lat=" + latitude + "&lon=" + longitude;
                } else if (app === 'balad') {
                    uri = "balad://?q=" + latitude + "," + longitude;
                } else if (app === 'google_map') {
                    uri = "google.navigation:q=" + latitude + "," + longitude;
                }

                if (uri) {
                    window.location.href = uri;
                } else {
                    alert("برنامه ناوبری معتبری انتخاب نشده است.");
                }
                }
</script>
</body>
</html>
