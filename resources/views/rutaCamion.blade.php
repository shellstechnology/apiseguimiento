<!DOCTYPE html> <html lang="en"> <head>
<meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge"> <link rel="stylesheet" href="css/styleAlmacenes.css"> <script
    src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js">
</script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" /> <link rel="stylesheet"
    href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" /> <link rel="stylesheet"
    href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script> <script
    src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> <script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Ruta del Camion</title>
</head>

<body>
    <div class="principalBody">
        <div class="barraDeNavegacion">
            <a href="{{route('paqueteCamion')}}" class="item"> Paquetes a Entregar</a>
            <a href="{{route('rutaCamion')}}" class="itemSeleccionado"> Ruta</a>

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
                    <button id="aceptar" type="submit" name="aceptar">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
        $(document).ready(function () {
            var token = localStorage.getItem("accessToken");
            if (token == null)
                $(location).prop('href', '/login');
            $("#aceptar").click(function () {
                var dataFormulario = {
                    "userId":localStorage.getItem("userId"),
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Authorization": "Bearer " + localStorage.getItem("accessToken"),
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                }
                console.log(dataFormulario);
                $.ajax({
                    url: '{{route('redireccion.rutaCamion')}}',
                    method: 'POST',
                    async: true,
                    crossDomain: true,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Authorization": "Bearer " + localStorage.getItem("accessToken"),
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                    },
                    data: JSON.stringify(dataFormulario),
                    success: function (data) {
                        alert(data);
                        $(location).prop('href', '/rutaCamion');
                    }
                });
            });

        });

    </script>

</body>

</html>