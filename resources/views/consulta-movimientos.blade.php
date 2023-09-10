@extends('layout')
@section('contenido')
<div class="con1">
	<div class="wood-f">
		<h2>CONTRATO PUNTOS</h2>
		<form id='formulario'>
				<label>CONTRATO PUNTOS:</label>
				<input type="text" id="entidad" disabled>
				<input type="text" id="oficina" disabled>
				<input type="text" id="digito" disabled>
				<input type="text" id="cuenta" disabled>
				
				<input type="text" id="nif" hidden value='{{ $persona->nif ?? null }}'>
				<br><br>
				<label>FECHA DESDE:</label>
				<input type="date" id="fechadesde">
				<span>&nbsp&nbsp&nbsp</span>
				<label>FECHA HASTA:</label>
				<input type="date" id="fechahasta">
				<br><br>
				<label>OPERACIÓN:</label>
				<input type="radio" name="operacion" value='A'>&nbsp&nbsp<span>Asignación</span><br>
				<label></label>
				<input type="radio" name="operacion" value='D'>&nbsp&nbsp<span>Disposición</span><br>
				<label></label>
				<input type="radio" name="operacion" value='T' checked>&nbsp&nbsp<span>Todos</span>
				<br><br>
				<label>CONCEPTO</label>
				<input type="text" id="concepto">
				<br><br>
				<label>Últimos</label>
				<input type="checkbox" name="ultimos">
				<br><hr><br>
				<label>ULTIMO EXTRACTO:</label>
				<input type="date" id="ultimoex" disabled>
				<span>&nbsp&nbsp&nbsp</span>
				<label>SALDO PUNTOS:</label>
				<input type="number" id="saldototal" disabled>
				<br><br><hr><br>

                <table id='movimientos'>
                    <tr><th></th><th>FECHA</th><th>A/D</th><th>CONCEPTO</th><th>PUNTOS</th><th>SALDO</th></tr>
                @foreach ($movimientos as $clave => $movimiento)
                    <tr>
                        @if ($clave == 0)
                            <td>
                                <input type="radio" name="movimiento" checked value='{{ $movimiento->id }}'>
                            </td>
                        @else
                            <td>
                                <input type="radio" name="movimiento"  value='{{ $movimiento->id }}'>
                            </td>
                        @endif
                        <td>{{ $movimiento->fecha }}</td>
                        <td>{{ $movimiento->operacion }}</td>
                        <td>{{ $movimiento->concepto }}</td>
                        <td>{{ $movimiento->puntos }}</td>
                        <td>{{ $movimiento->saldomov }}</td>
                    </tr>
                @endforeach
				</table>

				<br><br><br>
				<input type="button" id="aceptar" value='Aceptar'>
				<input type="button" id="detalle" value='Detalle'   onclick="window.location.href = '/detalle-movimiento'">
				<input type="button" id="imprimir" value='Imprimir'>
                <input type="button" id="salir" value='Abandonar' onclick="window.location.href='/alta-mto-puntos'">
				<input type="button" id="altamov" value='Alta movimiento' onclick="window.location.href = '/alta-movimientos'">
				<div class='mensajes'></div>
			</form>
		</form>
	</div>
</div>
			
@endsection
