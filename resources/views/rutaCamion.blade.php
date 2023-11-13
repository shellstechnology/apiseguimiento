<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styleAlmacenes.css">
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <title>Ruta del Camion</title>
</head>
@include("header")
<body>
    <div class="principalBody">
        <div class="barraDeNavegacion">
            <a href="{{route('paqueteCamion')}}" class="item"> Paquetes a Entregar</a>
            <a href="{{route('rutaCamion')}}" class="itemSeleccionado"> Ruta</a>
            <form action="{{route('redireccion.rutaCamion')}}" method="POST">
                @csrf
        </div>
        <div class="container">
            <x-mapa-component />
            <div class="cuerpo">
                <div id="map">
                </div>
            </div>
            <div class="cajaDatos">
                <div class="contenedorDatos">
                    <div class="contenedorDatos">
                        <x-select-camiones-component />
                    </div>
                    <input type="hidden" name="identificador" id="identificador">
                    <button type="submit" name="aceptar">Aceptar</button>
                </div>
                </form>
                <form action="{{route('rutaCamion.cargarDatos')}}" method="GET">
                    @csrf
                    <button type="submit" name="cargar">Cargar Datos</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>
</html>
