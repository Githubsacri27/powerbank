@extends('layout')
@section('contenido')
<div class="con1">
    <div class="wood-f">
        <form method='get' action='{{ url("personas/") }}'>
            <div class="container">
                <div class="section-header">
                    <h2>Gestión comercial</h2>
                </div>
                <div class="inputId">
                    <input type="text" id="nif" required onblur='enviar()' value='{{ $persona->nif ?? null }}' placeholder="Introduzca NIF">
                    <input type="text" id='nombre' readonly value='{{ $persona->nombre ?? null}}&nbsp;{{ $persona->apellidos ?? null}}'>
                </div>
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
</div>


@endsection
<script type="text/javascript">
    function enviar() {
        let nif = document.querySelector('#nif').value;
        window.location.href = "{{ url('personas/') }}" + "/" + nif;
    }
</script>