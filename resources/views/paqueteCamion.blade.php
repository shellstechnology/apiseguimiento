<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styleAlmacenes.css">
    <link rel="icon" href="img/Logo Aplicación.png">
    <title>Paquetes Entregados</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<button class="cerrarSesion" id="cerrarSesion">
        <div class="rectangulo">
            <div class="linea">
                <div class="triangulo"></div>
            </div>
        </div>
</button>
    <div class="principalBody">
        <div class="barraDeNavegacion">
            <a href="{{route('paqueteCamion')}}" class="itemSeleccionado"> Paquetes a Entregar</a>
            <a href="{{route('rutaCamion')}}" class="item"> Ruta</a>

        </div>
        <div class="container">
            <div class="cuerpo">
                <div id="contenedorTabla">
                    <x-tabla-paquete-component />
                </div>
            </div>
            <div class="cajaDatos">

                <div class="contenedorDatos">
                    <input type="hidden" name="identificador" id="identificador">
                    <button id="aceptar" type="submit" name="aceptar">Aceptar</button>
                </div>


                <button id="cargarDatos" type="submit" name="cargar">Cargar Datos</button>

            </div>
        </div>
    </div>
    </div>
    </div>
    @php
    $contador=Session::get('contador');
    @endphp
    <script>
        $(document).ready(function () {
            var token = localStorage.getItem("accessTokenC");
            if (token == null)
                $(location).prop('href', '/login');
            var dataFormulario;
            var userId = localStorage.getItem("userId");
            $("#cargarDatos").click(function () {
                dataFormulario = {
                    "userId": userId
                }
                console.log(dataFormulario);
                $.ajax({
                    url: '{{route('paqueteCamiom.cargarDatos')}}',
                    type: 'POST',
                    async: true,
                    crossDomain: true,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Authorization": "Bearer " + localStorage.getItem("accessTokenC"),
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                    },
                    data: JSON.stringify(dataFormulario),
                    success: function (data) {
                        alert(data);
                        $(location).prop('href', '/paqueteCamion');
                    }

                });
            });
            $("#aceptar").click(function () {
                var cantidadFilas = @json($contador);
                console.log(cantidadFilas);
                var paqueteSeleccionado = [];
                var paqueteSeleccionado = [];
                for (var x = 0; x <= cantidadFilas; x++) {
                    var id = 'paqueteSeleccionado' + x;
                    var checkbox = $("#" + id);
                    if (checkbox.is(":checked")) {
                        var valor = checkbox.val();
                        paqueteSeleccionado.push(valor);
                    }
                }

                var dataFormulario = {
                    "userId": localStorage.getItem("userId"),
                    "paquete_seleccionado": paqueteSeleccionado,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Authorization": "Bearer " + localStorage.getItem("accessTokenC"),
                    "Accept": "application/json",
                    "Content-Type": "application/json",

                }
                $.ajax({
                    url: '{{route('redireccion.paqueteCamion')}}',
                    method: 'POST',
                    async: true,
                    crossDomain: true,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Authorization": "Bearer " + localStorage.getItem("accessTokenC"),
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                    },
                    data: JSON.stringify(dataFormulario),
                    success: function (data) {
                        alert(data)
                        dataFormulario = {
                            "userId": userId
                        }
                        console.log(dataFormulario);
                        $.ajax({
                            url: '{{route('paqueteCamiom.cargarDatos')}}',
                            type: 'POST',
                            async: true,
                            crossDomain: true,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                "Authorization": "Bearer " + localStorage.getItem("accessTokenC"),
                                "Accept": "application/json",
                                "Content-Type": "application/json",
                            },
                            data: JSON.stringify(dataFormulario),
                            success: function (data) {
                                $(location).prop('href', '/paqueteCamion');
                            }

                        });
                    }
                });
            });
            $("#cerrarSesion").click(function(){
                jQuery.ajax({  
                    url: 'http://localhost:8002/api/v1/logout',  
                    type: 'GET',
                    headers: {
                        "Authorization" : "Bearer " + localStorage.getItem("accessTokenC"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    success: function(data) {  
                        localStorage.removeItem("accessTokenC");
                        localStorage.removeItem("userId");
                        $(location).prop('href', '/login');
                    }
                    
                });  
            });

        });

    </script>

</body>

</html>