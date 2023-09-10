@extends('layout')
@section('contenido')
<div class="con1">
	<div class="wood-f">
		<h2>Alta Personas</h2>
		<form id='formulario' method='post' action='{{ url("alta-personas/") }}'>
			@csrf
			<div class="inputId">
				<input type="text" id="nif" name="nif" value="{{ old('nif') ?? $persona->nif ?? null }}" placeholder="Nif" required>
				<input type="text" id="direccion" name="direccion" value="{{ old('direccion') ?? $persona->direccion ?? null }}" placeholder="Dirección">
				</div>
				<input type="text" id="nombre" name="nombre" value="{{ old('nombre') ?? $persona->nombre ?? null }}" placeholder="Nombre">

				<input type="text" id="email" name="email" value="{{ old('email') ?? $persona->email ?? null }}" placeholder="Email">
				<input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') ?? $persona->apellidos ?? null }}" placeholder="Apellidos" required>
			
			<br><br>
			<label>
				<h4 class="tarjeta">Tarjeta</h4>
			</label>
			<input type="text" maxlength='4' id="pan1" disabled value="{{ substr($persona->tarjeta ?? null, 0, 4) }}">

			<input type="text" maxlength='4' id="pan2" disabled value="{{ substr($persona->tarjeta ?? null, 4, 4) }}">

			<input type="text" maxlength='4' id="pan3" disabled value="{{ substr($persona->tarjeta ?? null, 8, 4) }}">

			<input type="text" maxlength='4' id="pan4" disabled value="{{ substr($persona->tarjeta ?? null, 12, 4) }}">

			<br><br><br>
			<input type="submit" id="alta" value='Alta' class="button">
			<input type="reset" class="button reset">
			<input type="button" id="salir" value='Abandonar' onclick="window.location.href='/gestion'">
			<span id='mensajes'>{{ $mensajes ?? null }}</span>
		</form>
		<div class="mensajes">
			<ul>
				@if ($errors->any())
				@foreach ($errors->all() as $error)
				<li class="error">{{ $error }}</li>
				@endforeach
				@endif
			</ul>
		</div>
	</div>
</div>


@endsection