@extends('layout')
@section('contenido')
<div class="con1">
	<div class="wood-f">
		<h2>Detalle Movimientos</h2>
		<form id='formulario'>
			@csrf
			<label>CONTRATO PUNTOS:</label>
			<input type="text" id="entidad" disabled>
			<input type="text" id="oficina" disabled>
			<input type="text" id="digito" disabled>
			<input type="text" id="cuenta" disabled>
			<input type="hidden" id="nif" value=''>
			<br><br>
			<label>FECHA MOVIMIENTO:</label>
			<input type="date" id="fecha" disabled>
			<br><br>
			<label>CONCEPTO</label>
			<input type="text" id="concepto" disabled>
			<br>
			<hr><br>
			<label>TARJETA</label>
			<input type="text" maxlength='4' id="pan1" disabled>
			<input type="text" maxlength='4' id="pan2" disabled>
			<input type="text" maxlength='4' id="pan3" disabled>
			<input type="text" maxlength='4' id="pan4" disabled>
			<br><br>
			<label>LOCALIZADOR</label>
			<input type="text" id="localizador" disabled>
			<br><br>
			<label>COMERCIO</label>
			<input type="text" id="comercio" disabled>
			<br><br>
			<label>COMENTARIOS</label>
			<textarea id="comentarios" disabled></textarea>
			<br><br><br>

			<input type="button" id="salir" value='Abandonar' onclick="window.location.href='/consulta-movimientos'">
			<span id='mensajes'>Zona de mensajes</span>
		</form>
	</div>
</div>
@endsection