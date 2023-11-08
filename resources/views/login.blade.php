<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/Logo Aplicación.png">
    <link rel="stylesheet" href="css/styleLogin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <title>Log-in</title>
</head>

<body>
    <div class="principalBody">
        <div>
            <div class="formulario">
                <div class="imagenLogo">
                    <div style="margin-top: 50px;">
                        <img src="\img\Logo Aplicación.png" alt="FastTrackerLogo" width="150" height="150">
                    </div>
                </div>
                    <input class="campoTexto" type="text" name="username" id="username" placeholder="Ingrese su usuario: "> <br>
                    <input class="campoTexto" type="password" name="password" id="password" placeholder="Ingrese su contraseña: "> <br>
                    <button id="botonSubmit" class="botonSubmit"> Iniciar Sesión</button>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
      $(document).ready(function () {
    var token = localStorage.getItem("accessToken");
    if (token !== null) {
      //  $(location).prop('href', '/');
    }

    $("#botonSubmit").click(function () {


        var formData = {
            "name": $("#username").val(),
            "password": $("#password").val(),
        }

        $.ajax({
            url: 'http://localhost:8002/api/v1/login',
            method: 'POST',
            async: true,
            crossDomain: true,
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json",
            },
            data: JSON.stringify(formData),

            success: function(data) {  
                        localStorage.setItem("accessToken", data.token);
                        console.log(data);
                       // $(location).prop('href', '/');
                     //  window.location.href = '/';
                    },

            error: function (data) {
                alert("Credenciales invalidas");
            }
        });
    });
});
    </script>


</body>

</html>
