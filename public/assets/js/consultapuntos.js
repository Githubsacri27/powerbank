// Consulta Cuenta Puntos

function consultaPuntos() {
    //recuperar token
    let token = document.querySelector("input[name=_token]").value;

    //recuperar datos del formulario
    let idPersona = document.querySelector('#id').value ;

    //Obligatoriedad de todos los campos
    if (idPersona == '') {
        window.alert("Consulta sin datos");
        return;
    }

    //confeccionar los parámetros de la petición ajax
    let parametros = {
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        method: 'GET', //método de envio de los datos al servidor
    }

    //informar el servicio a utilizar
    let servicio = '/cuentas'+'/'+idPersona;

    //realizar la petición ajax al servidor
    fetch(servicio, parametros)
    //recoger la respuesta del servidor
    .then(function(respuesta) {
        if (respuesta.ok) {
            //tipo de mensaje a recoger por el siguiente then
            return respuesta.json();
        } else {
            throw("fetch.respuesta : fallo en consultapuntos.js");
        }
    })
    //realizar el tratamiento del mensaje de respuesta (mostrar el mensaje)
    .then(function(mensaje) {
        // Verificar el código de respuesta e incorporar datos al formulario de la vista
        if (mensaje.codigo === '00') {
            let cuenta = mensaje.respuesta;
            elemHidden = document.querySelector('#idCuenta') ;
            elemHidden.value = cuenta.id;
            document.querySelector('input#entidad').value = cuenta.entidad;
            document.querySelector('input#oficina').value = cuenta.oficina;
            document.querySelector('input#digito').value = cuenta.dc;
            document.querySelector('input#cuenta').value = cuenta.cuenta;
            document.querySelector('#programa').value = cuenta.programa;
            document.querySelector('#programa').onchange();
            let checkExtracto = document.querySelector('input[name="extracto"]');
            (cuenta.extracto == 1) ? checkExtracto.checked = true  : checkExtracto.checked = false;
            let checkRenuncia = document.querySelector('input[name="renuncia"]');
            (cuenta.renuncia == 1) ? checkRenuncia.checked = true : checkRenuncia.checked = false;
            ScreenWithCuenta(true, cuenta);
        } else {
            // Mostrar una alerta con el mensaje de error
            document.querySelector('#mensajes').innerHTML = mensaje.respuesta ;
            ScreenWithCuenta(false, null);
        }
    })
    //tratamiento de errores
    .catch(function(error) {
        window.alert(error);
    })

}

function ScreenWithCuenta(withCuenta, cuenta){
    if (withCuenta == true) {
        document.querySelector('input#entidad').value = cuenta.entidad;
        document.querySelector('input#oficina').value = cuenta.oficina;
        document.querySelector('input#digito').value = cuenta.dc;
        document.querySelector('input#cuenta').value = cuenta.cuenta;
        document.querySelector('#programa').value = cuenta.programa;
        document.querySelector('#programa').onchange();
        let checkExtracto = document.querySelector('input[name="extracto"]');
        (cuenta.extracto == 1) ? checkExtracto.checked = true  : checkExtracto.checked = false;
        let checkRenuncia = document.querySelector('input[name="renuncia"]');
        (cuenta.renuncia == 1) ? checkRenuncia.checked = true : checkRenuncia.checked = false;

        document.querySelector('#altapuntos').disabled = true;
        document.querySelector('#modifpuntos').disabled = false;
        document.querySelector('#bajapuntos').disabled = false;
        document.querySelector('#movimientos').disabled = false;
    } else {
        document.querySelector('input#entidad').value = '';
        document.querySelector('input#oficina').value = '';
        document.querySelector('input#digito').value = '';
        document.querySelector('input#cuenta').value = '';
        document.querySelector('#programa').value = 'Seleccione código';
        document.querySelector('#descripcion').value = '';
        let checkExtracto = document.querySelector('input[name="extracto"]');
        checkExtracto.checked = false;
        let checkRenuncia = document.querySelector('input[name="renuncia"]');
        checkRenuncia.checked = false;

        document.querySelector('#altapuntos').disabled = false;
        document.querySelector('#modifpuntos').disabled = true;
        document.querySelector('#bajapuntos').disabled = true;
        document.querySelector('#movimientos').disabled = true;
    }
}
