<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;
    // Set the name of the DDBB table and his id for this model class 'Persona'
    protected $table = 'movimientos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha',
        'operacion',
        'concepto',
        'puntos',
        'saldomov',
        'tarjeta',
        // 'localizador',
        // 'comercio',
        // 'comentarios',
        'cuenta_id'
    ] ;

    public static function alta($datos) {
        return Cuenta::create([
            'fecha'     => $datos['fecha'],
            'operacion' => $datos['operacion'],
            'concepto'  => $datos['concepto'],
            'puntos'    => $datos['puntos'],
            'saldomov'  => $datos['saldomov'],
            'tarjeta'   => $datos['tarjeta'],
            // 'localizador'  => $datos['localizador'],
            // 'comercio'     => $datos['comercio'],
            // 'comentarios'  => $datos['comentarios'],
            'cuenta_id'  => $datos['cuenta_id'],
        ]);
    }
}
