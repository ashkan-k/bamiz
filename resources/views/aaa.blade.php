<!DOCTYPE html>
<html>
<head>
    <title>انتخاب برنامه ناوبری</title>
</head>
<body>
<h3>لطفاً برنامه ناوبری مورد نظر را انتخاب کنید:</h3>
<button onclick="openMap('snapp')">Snapp</button>
<button onclick="openMap('waze')">Waze</button>
<button onclick="openMap('neshan')">Neshan</button>
<button onclick="openMap('balad')">Balad</button>

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
                    uri = "neshan://navigate?lat=" + latitude + "&lng=" + longitude;
                } else if (app === 'balad') {
                    uri = "balad://?q=" + latitude + "," + longitude;
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
