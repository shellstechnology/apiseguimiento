<!DOCTYPE html> 
<html lang="en">
    <head> 
        <meta charset="UTF-8"> 
       <meta name="viewport" content="width=device-width,
        initial-scale=1.0"> <meta http-equiv="X-UA-Compatible" 
        content="ie=edge">
        <link rel="stylesheet" href="css/styleAlmacenes.css">
        <link rel="icon" href="img/Logo Aplicación.png"> <title>Paquetes Entregados</title> 
    </head>
    <body>
    <div class="principalBody">
        <div class="barraDeNavegacion">
        <a href="{{route('paqueteCamion')}}" class="itemSeleccionado"> Paquetes a Entregar</a> 
        <a href="{{route('rutaCamion')}}" class="item"> Ruta</a> 
        <form action="{{route('redireccion.paqueteCamion')}}" method="POST">
        @csrf
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
         <button type="submit" name="aceptar">Aceptar</button>
      </div>
     </form>
     <form action="{{route('paqueteCamiom.cargarDatos')}}" method="GET">
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