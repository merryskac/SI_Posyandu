<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>
  <title>Document</title>
</head>
<body>
  <p id="demo"></p>
  <div id="map" style="height: 180px;"></div>
  <p id='position'></p>
  <script>
    let latitude = -0.8852694
    let longitude = 119.8968176
    let x = document.getElementById('demo');
    function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition();
    latitude = position.coords.latitude
    longitude = position.coords.longitude
    x.innerHTML = "position:  "+latitude+","+longitude
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
    var map = L.map('map').setView([latitude, longitude], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
  if(!navigator.geolocation){
    y = document.getElementById('position')
    y.innerHTML = 'coordinates not found'
  }else{
    var marker = L.marker([latitude,longitude]).addTo(map);
  }
  </script>
</body>
</html>