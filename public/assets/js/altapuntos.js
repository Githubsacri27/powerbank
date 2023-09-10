// Alta Cuenta Puntos

function altaPuntos() {
    //recuperar token
    let token = document.querySelector("input[name=_token]").value;

    //recuperar datos del formulario
    let programa = document.querySelector('#programa').value ;
    let checkExtracto = document.querySelector('input[name="extracto"]');
    checkExtracto.checked ? extracto = 1 : extracto = 0 ;
    let checkRenuncia = document.querySelector('input[name="renuncia"]');
    checkRenuncia.checked ? renuncia = 1 : renuncia = 0 ;

    let persona_id = document.querySelector('#id').value ;

    //Obligatoriedad de los campos
    if (persona_id == '') {
        window.alert("Consulta sin datos");
        return;
    }

    // //confeccionar los parámetros de la petición ajax
    let datos = {
        'persona_id' : persona_id,
        'programa'   : programa,
        'extracto'   : extracto,
        'renuncia'   : renuncia
    }
    let parametros = {
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        method: 'post', //método de envio de los datos al servidor
        body: JSON.stringify(datos)
    }

    //informar el servicio a utilizar
    let url = '/cuentas';

    //realizar la petición ajax al servidor
    fetch(url, parametros)
    //recoger la respuesta del servidor
    .then(function(respuesta) {
        if (respuesta.ok) {
            //tipo de mensaje a recoger por el siguiente then
            return respuesta.json();
        } else {
            throw("fetch.respuesta : fallo en altapuntos.js");
        }
    })
    //realizar el tratamiento del mensaje de respuesta (mostrar el mensaje)
    .then(function(mensaje) {
        // Verificar el código de respuesta e incorporar datos al formulario de la vista
        if (mensaje.codigo === '00') {
            document.querySelector('#altapuntos').disabled = true  ;
            document.querySelector('#modifpuntos').disabled = false  ;
            document.querySelector('#bajapuntos').disabled = false  ;
            document.querySelector('#movimientos').disabled = false  ;
            // Incorporar los datos de la cuenta al formulario
            let cuenta = mensaje.respuesta;
            
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
            document.querySelector('#idCuenta').value = cuenta.id;
            document.querySelector('#mensajes').innerHTML = 'Alta efectuada';
        } else {
            // Mostrar una alerta con el mensaje de error
            document.querySelector('#mensajes').innerHTML = '';
            mensaje.respuesta.forEach((elem,clave) => {
                document.querySelector('#mensajes').innerHTML += elem += '<br>' ;
            }) ;
        }
    })
    //tratamiento de errores
    .catch(function(error) {
        window.alert(error);
    })

}

