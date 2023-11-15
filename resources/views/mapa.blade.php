<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ruta leaffleat</title>
  <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    <script src="{{asset('js/funciones.js')}}"> </script>
</head>

<body>
  <div>
  <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" />
    <label for="puntos">Puntos (latitud, longitud):</label>
    <input type="text" id="puntos" />
    <button onclick="agregarPunto()">Agregar Punto</button>
    <button onclick="button()">Trazar Ruta</button>
    <div id="checkboxes"></div>
  </div>
  <div id="map"></div>

  <script>
        $(document).ready(function(){
            var token = localStorage.getItem("accessTokenC");
            if(token == null)
            $(location).prop('href', '/login');
            
            
        });
        
    </script>
</body>

</html>