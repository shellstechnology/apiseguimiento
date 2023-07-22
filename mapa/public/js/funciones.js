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

var ico1 = L.icon({
  iconUrl: "http://localhost:8000/img/Marker1.png",
  iconSize: [60, 60],
  iconAnchor: [30, 60],
  popupAnchor: [-3, -76]
})

var ico2 = L.icon({
  iconUrl:"http://localhost:8000/img/Marker2.png",
  iconSize: [60, 60],
  iconAnchor: [30, 60],
  popupAnchor: [-3, -76]
})

function button() {
  if (puntos.length > 0) {
    if (controlBoton != 0) {
      controlBoton = 0;
      verificarMapa();
    }
  } else {
    alert("debe ingresar puntos antes de trazar la ruta")
  }

}
function agregarPunto() {
  var nombreInput = document.getElementById("nombre");
  var puntosInput = document.getElementById("puntos");
  var coordenadas = puntosInput.value.split(",").map(function (coordenada) {
    return parseFloat(coordenada.trim());
  });

  if (coordenadas.length === 2 && !isNaN(coordenadas[0]) && !isNaN(coordenadas[1])) {
    var nombre = nombreInput.value.trim();
    if (nombre !== "") {
      puntos.push(coordenadas);
      nombres.push(nombre);
      puntosInput.value = "";
      nombreInput.value = "";
      if (!map) {
        crearMapa();
      }
      console.log(coordenadas)
      var mark = L.marker([coordenadas[0], coordenadas[1]], { icon: ico2 }).addTo(map).bindPopup("AHHHHHHHHHHH");
      markers.push(mark);
      crearCheckbox(nombre);
      alert("Punto agregado correctamente.");
    } else {
      alert("Por favor, ingresa un nombre para el punto.");
    }
  } else {
    alert("Por favor, ingresa las coordenadas correctamente (latitud, longitud).");
  }
}

function crearCheckbox(nombre) {
  var checkboxesDiv = document.getElementById("checkboxes");
  var checkbox = document.createElement("input");
  checkbox.type = "checkbox";
  checkbox.name = nombre; // Usamos el nombre como el valor del atributo name
  checkbox.value = "cbx";
  var label = document.createElement("label");
  label.appendChild(checkbox);
  label.appendChild(document.createTextNode(nombre));
  checkboxesDiv.appendChild(label);
}
function obtenerCheckboxesActivas() {
  var checkboxes = document.querySelectorAll("input[type='checkbox']:checked");
  var nombresCheckboxesActivas = [];

  for (var i = 0; i < checkboxes.length; i++) {
    nombresCheckboxesActivas.push(checkboxes[i].name);
  }

  console.log(nombresCheckboxesActivas);
  calcularRuta(nombresCheckboxesActivas);
}
function crearMapa() {
  if (map == undefined) {
    var x = "-34.89945,-56.13177";
    map = L.map("map").setView(puntos[0], 13);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: "&copy; OpenStreetMap contributors"
    }).addTo(map);
  }
}

function verificarMapa() {
  map.locate({ setView: true, maxZoom: 16 });
  map.on('locationfound', onLocationFound);
  map.on('locationerror', onLocationError);
}

function onLocationFound(e) {
  if (ubicacion != e) {
    if (circulo != null) {
      eliminarPuntos();
    }
    crearPuntos(e);
  }
}

function eliminarPuntos() {
  map.removeLayer(marcador);
  map.removeLayer(circulo);
}

function crearPuntos(e) {
  var radius = e.accuracy / 2;
  marcador = L.marker(e.latlng).addTo(map)
    .bindPopup("¡Estás aquí!").openPopup();
  circulo = L.circle(e.latlng, radius).addTo(map);
  ubicacion = e.latlng;
  limpiarRuta();
}

function limpiarRuta() {
  // Eliminar rutas existentes
  ruta.forEach(function (route) {
    map.removeControl(route);
  });
  // Limpiar el arreglo de rutas
  ruta = [];
  planRuta = [];
  r = 0;
  obtenerCheckboxesActivas();
}

function calcularRuta(nombresCheckboxesActivas) {
  if (nombresCheckboxesActivas.length > 1) {
    var longitud = null;
    var puntoInicio = ubicacion;
    var datoPunto;
    var distancia;
    var listaPuntos = [];

    nombresCheckboxesActivas.forEach(function (nombre) {
      var index = nombres.indexOf(nombre);
      if (index !== -1) {
        listaPuntos.push(puntos[index]);
      }
    })

    var x = 0;
    var cqvm = 0;

    listaPuntos.forEach(function (puntoDestino) {
      distancia = puntoInicio.distanceTo(puntoDestino);
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
    listaPuntos = listaPuntos.filter(function (elemento) {
      return elemento !== datoPunto;
    });

    while (x == 0) {
      cqvm = cqvm + 1;
      if (cqvm > 100) {
        x = 1;
      }
      if (listaPuntos.length !== 0) {
        longitud = null;
        listaPuntos.forEach(function (puntoDestino) {
          distancia = puntoInicio.distanceTo(puntoDestino);
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
        listaPuntos = listaPuntos.filter(function (elemento) {
          return elemento !== datoPunto;
        });
      } else {
        x = 1;
      }
    }
  } else {
    planRuta = nombresCheckboxesActivas.map(function (nombre) {
      var index = nombres.indexOf(nombre);
      if (index !== -1) {
        return puntos[index];
      }
    });
  }

  crearRuta();
}

function crearRuta() {
  var rutaFinal=[ubicacion];
  console.log('pl' + planRuta)
  planRuta.forEach(function (x) {
    rutaFinal.push(L.latLng(x[0],x[1]))
  })
  console.log(rutaFinal);
  var routeControl = L.Routing.control({
    waypoints: 
     rutaFinal,
    createMarker: function (i, wp, nWps) {
      if (i === 0 || i === nWps - 1) {
        // here change the starting and ending icons
        return L.marker(wp.latLng, {
          icon: ico1 // here pass the custom marker icon instance
        });
      }
    }
  }).addTo(map);

  routeControl.hide();
  ruta.push(routeControl);
  r = r + 1;

  controlBoton = 1;
  console.log(ruta);
}


function onLocationError(e) {
    alert(e.message);
    controlBoton = 1;
  }