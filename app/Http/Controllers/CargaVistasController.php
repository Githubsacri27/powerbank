<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Programa;
use App\Models\Cuenta;
use App\Models\Movimiento;
use Exception;

class CargaVistasController extends Controller
{
    // load resources/views/welcome.blade.php, etc
    public function index() {
        return view('welcome');
    }
    public function gestion() {
        $datos['titulo'] = "Gestión Comercial";
        $datos['navigation'] = [ ["/alta-mto-puntos", "Cuenta Puntos"] ,
                                 ["/alta-personas" , "Alta personas"]
                            ];

        if (session()->has('idPersona')) {
            $id = session('idPersona');
            $persona = Persona::find($id);
            $datos['persona'] = $persona;
        }

        return view('gestion')->with($datos);
    }
    public function altapersonas() {
        $datos['titulo'] = "Alta Personas";
        $datos['navigation'] = [];
        return view('alta-personas')->with($datos);
    }

    public function altamtopuntos() {
        $datos['titulo'] = "Alta y Mantenimiento Cta Puntos";
        $datos['navigation'] = [ ["/consulta-movimientos", "Consulta movimentos"]
                            ];
        try {
            if ( !(session()->has('idPersona')) ) {
                throw new Exception('Error: Session has not idPersona', 1) ;
            }
            $id = session('idPersona') ;
            if ( !($datos['persona'] = Persona::find($id)) ) {
                throw new Exception('Error: idPersona - Persona::find', 2);
            }
        } catch (Exception $e) {
            return redirect()->route('gestion');
        }
        $datos['programas']= Programa::all(['codigo','descripcion']);
        return view('alta-mto-puntos')->with($datos);;
    }
    public function consultamovimientos() {
        $datos['titulo'] = "Consulta movimientos Cta Puntos";
        $datos['navigation'] = [ ["/alta-movimientos", "Alta movimientos"] ,
                                 ["/detalle-movimiento" , "Detalle movimiento"]
                        ];
        $id = session('idPersona');
        if (!$id) {
            return redirect()->route('gestion');
        } else {
            if ( !($datos['persona'] = Persona::find($id)) ) {
                return redirect()->route('gestion');
            } else {
                $idPersona = $datos['persona']->id;
                $cuenta = Cuenta::where('persona_id', $idPersona)->first();
                if ( !$cuenta ) return redirect()->route('alta-mto-puntos');
                $datos['movimientos'] = $cuenta->hasMany(Movimiento::class, 'cuenta_id')->orderBy('id','DESC')->get() ;
                $datos['operacion'] = 'T';
            }
        }

        return view('consulta-movimientos')->with($datos);;
    }
    public function altamovimientos() {
        $datos['titulo'] = "Alta movimientos Cta Puntos";
        $datos['navigation'] = [];
        return view('alta-movimientos')->with($datos);;
    }
    public function detallemovimiento() {
        $datos['titulo'] = "Detalle movimiento Cta Puntos";
        $datos['navigation'] = [];
        return view('detalle-movimiento')->with($datos);;
    }

}
