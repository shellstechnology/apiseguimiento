@php
$datos = session('coordenadas', []);
@endphp


<script>
    var coordenadas = [];
    var puntos = [];
    var nombres = [];
    var ruta = [];
    var planRuta = [];
    var point;
    var lastpoint;
    var r = null;
    var ubicacion = null;
    var map;
    var circulo = null;
    var marcador = null;
    var controlBoton = 1;
    var markers = [];
    document.addEventListener("DOMContentLoaded", function () {
        var elementoMapa = document.getElementById("map");
        if (elementoMapa && !map) {
            var x = [-34.89945, -56.13177];
            map = L.map("map").setView(x, 13);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "&copy; OpenStreetMap contributors"
            }).addTo(map);
        }
        coordenadas = @json($datos);
        console.log(coordenadas);
        map.locate({ setView: true, maxZoom: 16 });
        map.on('locationfound', onLocationFound);
        map.on('locationerror', onLocationError);
    });

    function onLocationFound(e) {
        ubicacion = e.latlng;
        if(Array.isArray(coordenadas) && coordenadas.length > 0){
        calcularRuta();
        }
    }
    function onLocationError(e) {
            alert(e.message);
        }

    var ico1 = L.icon({
        iconUrl: "http://localhost:8006/img/Marker1.png",
        iconSize: [60, 60],
        iconAnchor: [30, 60],
        popupAnchor: [-3, -76]
    })

    var ico2 = L.icon({
        iconUrl: "http://localhost:8006/img/Marker2.png",
        iconSize: [60, 60],
        iconAnchor: [30, 60],
        popupAnchor: [-3, -76]
    })

    function calcularRuta() {
        if(!coordenadas){
            alert('no se detectan coordenadas validas')
            return
        }
        console.log(coordenadas)
        if (coordenadas.length > 1) {
            var longitud = null;
            var puntoInicio = ubicacion;
            var datoPunto;
            var distancia;
            var listaPuntos = [];
            var x = 0;
            var cqvm = 0;
            while (x == 0) {
                cqvm = cqvm + 1;
                if (cqvm > 100) {
                    x = 1;
                }
                if (coordenadas.length !== 0) {
                    longitud = null;
                    coordenadas.forEach(function (puntoDestino) {
                        distancia = puntoInicio.distanceTo([puntoDestino['Longitud'],puntoDestino['Latitud']]);
                        if (!longitud) {
                            longitud = distancia;
                            datoPunto = puntoDestino;
                        } else {
                            if (longitud > distancia) {
                                longitud = distancia;
                                datoPunto = puntoDestino;
                            }
                        }
                    });

                    planRuta.push(datoPunto);
                    coordenadas = coordenadas.filter(function (elemento) {
                        return elemento !== datoPunto;
                    });
                } else {
                    x = 1;
                }
            }
        } else {
            planRuta = [coordenadas[0]]
        }
        crearRuta();
    }

    function crearRuta() {
    var rutaFinal = [ubicacion];
    console.log(planRuta);

    planRuta.forEach(function (x) {
        rutaFinal.push(L.latLng(x['Longitud'], x['Latitud']));
        var marcador = L.marker(L.latLng(x['Longitud'], x['Latitud'])).addTo(map);
        marcador.setIcon(ico2);
        marcador.dragging.disable();
    });

    var routeControl = L.Routing.control({
        waypoints: rutaFinal,
        createMarker: function (i, wp, nWps) {
            if (i === 0 || i === nWps - 1) {
                return L.marker(wp.latLng, {
                    icon: ico1
                });
            }
        },
        routeWhileDragging: false
    }).addTo(map);
    routeControl.hide();
    routeControl.getPlan().options.draggableWaypoints = false;
    ruta.push(routeControl);
    r = r + 1;
    controlBoton = 1;
    console.log(ruta);
}

</script>

