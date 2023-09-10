// Modificación Cuenta Puntos

function modificacionPuntos() {

    //recuperar token
    let token = document.querySelector("input[name=_token]").value;

    let idCuenta = document.querySelector('#idCuenta').value ;
    //Obligatoriedad de los campos
    if (idCuenta == '') {
        window.alert("Consulta sin datos");
        return;
    }
    //recuperar datos del formulario
    let programa = document.querySelector('#programa').value ;
    let checkExtracto = document.querySelector('input[name="extracto"]');
    checkExtracto.checked ? extracto = 1 : extracto = 0 ;
    let checkRenuncia = document.querySelector('input[name="renuncia"]');
    checkRenuncia.checked ? renuncia = 1 : renuncia = 0 ;

    // //confeccionar los parámetros de la petición ajax
    let datos = {
        'id'         : idCuenta,
        'programa'   : programa,
        'extracto'   : extracto,
        'renuncia'   : renuncia,
    }
    let parametros = {
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        method: 'put', //método de envio de los datos al servidor
        body: JSON.stringify(datos)
    }

    //informar el servicio a utilizar
    let url = '/cuentas/' + idCuenta;

    //realizar la petición ajax al servidor
    fetch(url, parametros)
    //recoger la respuesta del servidor
    .then(function(respuesta) {
        if (respuesta.ok) {
            //tipo de mensaje a recoger por el siguiente then
            return respuesta.json();
        } else {
            throw("fetch.respuesta : fallo en modificacionpuntos.js");
        }
    })
    //realizar el tratamiento del mensaje de respuesta (mostrar el mensaje)
    .then(function(mensaje) {
        // Verificar el código de respuesta e incorporar datos al formulario de la vista
        if (mensaje.codigo === '200') {
            document.querySelector('#mensajes').innerHTML = 'Modificación efectuada';;
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
