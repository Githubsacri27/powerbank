@extends('layout')
@section('contenido')
<div class="con1">
	<div class="wood-f">
		<h2>Cuenta Puntos</h2>
		<form id='formulario'>
			@csrf <!-- Cross Site Reques Forgery  token -->
			<div class="inputCuentaPuntos">
				<input type="text" id="id" hidden value='{{ $persona->id ?? null }}'>
				<input type="text" id="idCuenta" hidden value=''>
			</div>

			<label>CONTRATO PUNTOS:</label>
			<div class="inputContrato">
				<input type="text" id="entidad" disabled>
				<input type="text" id="oficina" disabled>
				<input type="text" id="digito" disabled>
				<input type="text" id="cuenta" disabled>
			</div>

			<label>TITULAR:</label>
			<input type="text" id="nif" disabled value='{{ $persona->nif ?? null }}'>
			<input type="text" id="titular" disabled value='{{ $persona->nombre ?? null}}&nbsp;{{ $persona->apellidos ?? null}}'>

			<label class="codigo">CÓDIGO PROGRAMA:</label>
			<select id='programa' onchange="selectDescription()">
				<option disabled selected>Seleccione código</option>
				@foreach ($programas as $programa)
				<option>{{$programa->codigo}}</option>
				@endforeach
			</select>
			<br><br>
			<label>DESCRIPCIÓN PROGRAMA:</label>
			<input type="text" id='descripcion' disabled value=''>
			<br><br>
			<label>RENUNCIA EXTRACTO:</label>
			<input type="checkbox" name="extracto" id="extracto" value='si'>
			<br><br>
			<label>RENUNCIA OBTENCIÓN PUNTOS:</label>
			<input type="checkbox" name="renuncia"  id="renuncia" value='si'>
			<br><br><br>
			<input type="button" id="altapuntos" value='Alta'>
			<input type="button" id="modifpuntos" value='Modificar' disabled>
			<input type="button" id="bajapuntos" value='Baja' disabled>
			<input type="button" id="movimientos" value='Consulta mvtos' onclick="window.location.href = '/consulta-movimientos'" disabled>
			<input type="button" id="salir" value='Abandonar' onclick="window.location.href =  '/' ">
			<br><br>
			@empty($errors)
                @else
                @if ($errors->has('nif'))
                <div class="mensajes">{{ $errors->first('nif') }}</div>
                @endif
                @endempty
		</form>
	</div>
</div>


@endsection

<script type="text/javascript">
	function selectDescription() { //función para mostrar la descripción del programa seleccionado
		var arrayProgramas = JSON.parse('@json($programas)');

		let codigo = document.getElementById('programa').value;
		//buscar en la array la descripción correspondiente al código
		for (let i = 0; i < arrayProgramas.length; i++) {
			if (arrayProgramas[i].codigo == codigo)
				document.getElementById('descripcion').value = arrayProgramas[i].descripcion;
		}
	}
</script>
<!-- <script type="text/javascript" src="{{ asset('assets/js/consultaprogramas.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('assets/js/consultapuntos.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/altapuntos.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/modificacionpuntos.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bajapuntos.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/iniciopuntos.js') }}"></script>