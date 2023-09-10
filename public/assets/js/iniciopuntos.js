window.onload=inicio;

function inicio() {
    consultaPuntos(); //Consulta cuenta puntos de la persona
    // activación de listeners
    document.querySelector('#altapuntos').onclick = altaPuntos ;
    document.querySelector('#modifpuntos').onclick = modificacionPuntos ;
    document.querySelector('#bajapuntos').onclick = bajaPuntos ;
    document.querySelector('#movimientos').onclick = consultaPuntos ;
    // document.querySelector('#consultaprogramas').onclick = consultaProgramas ;
}
