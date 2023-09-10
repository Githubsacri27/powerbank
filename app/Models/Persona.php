<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    // Set the name of the DDBB table and his id for this model class 'Persona'
    protected $table = 'personas';
    protected $primaryKey = 'id';

    // public $timestamps = false ;  // prevent that 'created_at' 'updated_at' doesn't have these names

    /**
     * The attributes that are mass assignable
     *
     * @var string[]
     */
    protected $fillable = [
        'nif',
        'nombre',
        'apellidos',
        'direccion',
        'email',
        'tarjeta'
    ] ;

    public static function alta($datos) {
        return Persona::create([
            'nif'       => $datos['nif'],
            'nombre'    => $datos['nombre'],
            'apellidos' => $datos['apellidos'],
            'direccion' => $datos['direccion'],
            'email'     => $datos['email'],
            'tarjeta'   => $datos['tarjeta'],
        ]);
    }
}
