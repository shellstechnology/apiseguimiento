<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/Logo Aplicación.png">
    <link rel="stylesheet" href="css/styleChoferes.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <title>Choferes</title>
</head>

<body>
<button class="cerrarSesion" id="cerrarSesion">
        <div class="rectangulo">
            <div class="linea">
                <div class="triangulo"></div>
            </div>
        </div>
</button>
    <div class="divPrincipalBody">
        <div class="paginasDisponibles">
            <div class="paginasDisponiblesHijos">
                <button id="Paquetes">
                    <a>Paquetes</a>
                </button>
            </div>
            <div class="paginasDisponiblesHijos">
                <button id="Rutas">
                    <a>Ruta</a>
                </button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var token = localStorage.getItem("accessTokenC");
            if(token == null)
            $(location).prop('href', '/login');
            
            $("#Paquetes").click(function(){
                jQuery.ajax({  
                    url: '/paqueteCamion',  
                    type: 'GET',
                    headers: {
                        "Authorization" : "Bearer " + localStorage.getItem("accessTokenC"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    success: function(data) {  
                        $(location).prop('href', '/paqueteCamion');
                    }
                    
                });  
            });

            $("#Rutas").click(function(){
                jQuery.ajax({  
                    url: '/rutaCamion',  
                    type: 'GET',
                    headers: {
                        "Authorization" : "Bearer " + localStorage.getItem("accessTokenC"),
                        "Accept" : "application/json",
                        "Content-Type" : "application/json",
                    },
                    success: function(data) {  
                        $(location).prop('href', '/rutaCamion');
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