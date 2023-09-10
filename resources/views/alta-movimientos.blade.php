@extends('layout')
@section('contenido')
<div class="con1">
	<div class="wood-f">
		<h2>Alta movimientos</h2>
			<form id='formulario_mov'>
				<label>CONTRATO PUNTOS:</label>
				<input type="text" id="entidad" disabled>
				<input type="text" id="oficina" disabled>
				<input type="text" id="digito" disabled>
				<input type="text" id="cuenta" disabled>
				<input type="hidden" id="nif" value=''>
				<br><br>
				<label>FECHA MOVIMIENTO:</label>
				<input type="date" id="fecha">
				<br><br>
				<label>OPERACIÓN:</label>
				<input type="radio" name="operacion" value='A' checked>&nbsp&nbsp<span>Asignación</span><br>
				<label></label>
				<input type="radio" name="operacion" value='D'>&nbsp&nbsp<span>Disposición</span>
				<br><br>
				<label>CONCEPTO</label>
				<input type="text" id="concepto">
				<br><br><hr><br>
				<label>SALDO:</label>
				<input type="number" id="saldo" disabled>
				<br><br>
				<label>PUNTOS:</label>
				<input type="number" id="puntos">
				<br><br><br>
				<input type="button" id="alta" value='Alta'>
                <input type="button" id="salir" value='Abandonar' onclick="window.location.href=&#39{{ url('/consulta-movimientos')}}&#39">
				<span id='mensajes'>Zona de mensajes</span>
			</form>
	</div>
</div>
@endsection
