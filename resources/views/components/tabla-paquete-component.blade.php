@php
$datos = session('paquete', []);
Session::put('contador',0);
@endphp

<table class="tabla">
    <tr>
        <th>Entregado</th>
        <th>Id Paquete</th>
        <th>Nombre del Paquete</th>
        <th>Fecha de Entrega</th>
        <th>Direccion</th>
        <th>Latitud</th>
        <th>Longitud</th>
        <th>Estado</th>
        <th>Caracteristicas</th>
        <th>Nombre del Remitente</th>
        <th>Nombre del Destinatario</th>
        <th>Id del Producto</th>
        <th>Producto</th>
        <th>Volumen(L)</th>
        <th>Peso(Kg)</th>
        <th>Fecha de creacion</th>
        <th>Ultima actualizacion</th>
        <th>Fecha de borrado</th>
    </tr>
    @if($datos)
    @foreach ($datos as $paquete)
    @php
        $contador=Session::get('contador');
    @endphp
    <tr onclick="seleccionarFila(this)">
    <td> <input id="paqueteSeleccionado{{$contador}}" type="checkbox" name="paquete_seleccionado[]" value="{{ $paquete['Id Paquete'] }}"
            @if ($paquete['Estado'] === 'entregado')    checked disabled @endif> </td>
            <td>{{ $paquete['Id Paquete'] }}</td>
            <td>{{ $paquete['Nombre del Paquete'] }}</td>
            <td>{{ $paquete['Fecha de Entrega'] }}</td>
            <td>{{ $paquete['Direccion'] }}</td>
            <td>{{ $paquete['Longitud'] }}</td>
            <td>{{ $paquete['Latitud'] }}</td>
            <td>{{ $paquete['Estado'] }}</td>
            <td>{{ $paquete['Caracteristicas'] }}</td>
            <td>{{ $paquete['Nombre del Remitente'] }}</td>
            <td>{{ $paquete['Nombre del Destinatario'] }}</td>
            <td>{{ $paquete['Id del Producto'] }}</td>
            <td>{{ $paquete['Producto'] }}</td>
            <td>{{ $paquete['Volumen(L)'] }}</td>
            <td>{{ $paquete['Peso(Kg)'] }}</td>
            <td>{{ $paquete['created_at'] }}</td>
            <td>{{ $paquete['updated_at'] }}</td>
            <td>{{ $paquete['deleted_at'] }}</td>
        </tr>
        @php
        $contador=$contador+1;
        Session::put('contador',$contador);
        @endphp
    @endforeach
    @endif
</table>

<script>
    function seleccionarFila(fila) {
        var checkbox = fila.querySelector('input[type="checkbox"]');
        if (!checkbox.disabled) {
            checkbox.checked = !checkbox.checked;
        }
    }
</script>
