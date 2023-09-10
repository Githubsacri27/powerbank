<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    // Set the name of the DDBB table and his id for this model class 'Persona'
    protected $table = 'programas';
    protected $primaryKey = 'id';

    // public $timestamps = false ;  // prevent that 'created_at' 'updated_at' doesn't have these names

    /**
     * The attributes that are mass assignable
     *
     * @var string[]
     */
    protected $fillable = [
        'codigo',
        'descipcion',
    ] ;

    public static function alta($datos) {
        return Persona::create([
            'codigo'       => $datos['codigo'],
            'descripcion'  => $datos['descripcion'],
        ]);
    }
}
