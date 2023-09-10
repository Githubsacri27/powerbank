<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Models\Persona;
use App\Rules\nifExists;

class PersonasController extends Controller
{
    public function consulta($nif=null) {
        $data['nif'] = $nif;
        $datos['errors'] = $datos['persona'] = [];
        $datos['titulo'] = "Gestión Comercial";
        $datos['navigation'] = [ ["/alta-mto-puntos", "Cuenta Puntos"] ,
                                 ["/alta-personas" , "Alta personas"]
                            ];

        $rules = array('nif' => ["required", new nifExists($nif)]);
        $messages = array('nif.required' => 'El campo nif es obligatorio');
        $validator = Validator::make($data, $rules, $messages);
        if ( $validator->fails() ) {
            // $datos['errors'] = $validator->messages();
            session()->forget('idPersona');
            return redirect()->route('gestion')
                ->withErrors($validator)
                ->withInput() ;
        } else {
            $persona = Persona::where('nif',$data['nif'])->first();
            if ( $persona != null) {
                $datos['persona'] = $persona;
                session( ['idPersona' => $datos['persona']->id] );
                // dd(session()->all()) ;
            } else {
                session()->forget('idPersona');
                $datos['errors'] = "Unknown Error in Persona::where, persona is null";
            }

        }

        return view('gestion')->with($datos);

    }

    public function alta() {
        $datos = request()->all();
        $datos['titulo'] = "Alta Personas";
        $datos['navigation'] = [];

        $rules = array('nif' => "required|unique:personas,nif" ,
                       'nombre' =>  'required',
                       'apellidos' => 'required',
                       'direccion' => 'required',
                       'email' => 'required|email'
                      );
        $messages = array('nif.required' => 'El campo nif es obligatorio',
                          'nif.unique' => 'El nif ya existe',
                          'nombre.required' => 'El campo nombre es obligatorio',
                          'apellidos.required' => 'El campo apellidos es obligatorio',
                          'direccion.required' => 'El campo dirección es obligatorio',
                          'email.required' => 'El campo email es obligatorio',
                          'email.email' => 'El formato del mail no es correcto'
                      );
        $validator = Validator::make($datos, $rules, $messages);

        if ( $validator->fails() ) {
            $datos['errors'] = $validator->messages();
            session()->forget('idPersona');
            return back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $datos['tarjeta'] = rand(1000,9000).rand(1000,9000).rand(1000,9000).rand(1000,9000);
            try {
                $persona = $datos['persona'] = Persona::alta($datos);
            } catch (QueryException $e) {
                $datos['errors'] = ['SQLSTATE='.$e->errorInfo[0],
                                    'codeSGBD='.$e->errorInfo[1],
                                    'errobbdd='.$e->errorInfo[2]
                                ];
               return back()->withErrors($datos['errors'])->withInput();
            }

            if ( isset($persona) ) {
                session( ['idPersona' => $persona->id] );
                $datos['mensajes'] = 'Alta efectuada';
            } else {
                session()->forget('idPersona');
            }
        }
        return view('alta-personas')->with($datos);
    }

}
