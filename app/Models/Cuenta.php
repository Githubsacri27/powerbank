<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    // Set the name of the DDBB table and his id for this model class 'Persona'
    protected $table = 'cuentas';
    protected $primaryKey = 'id';

    // public $timestamps = false ;  // prevent that 'created_at' 'updated_at' doesn't have these names

    /**
     * The attributes that are mass assignable
     *
     * @var string[]
     */
    protected $fillable = [
        'entidad',
        'oficina',
        'dc',
        'cuenta',
        'programa',
        'extracto',
        'renuncia',
        'saldo',
        'fechaextracto',
        'persona_id'
    ] ;

    public static function alta($datos) {
        return Cuenta::create([
            'entidad'   => $datos['entidad'],
            'oficina'   => $datos['oficina'],
            'dc'        => $datos['dc'],
            'cuenta'    => $datos['cuenta'],
            'programa'  => $datos['programa'],
            'extracto'  => $datos['extracto'],
            'renuncia'  => $datos['renuncia'],
            'saldo'     => $datos['saldo'],
            'fechaextracto'  => $datos['fechaextracto'],
            'persona_id'  => $datos['persona_id'],
        ]);
    }

}
