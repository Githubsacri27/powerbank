<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Models\Cuenta;
use App\Models\Programa;
use \Exception;

class CuentasController extends Controller
{
    public function consulta($idPersona) {  //NO  RMB : Route Model Binding
        // $id = session('idPersona');
        try {
            // $cuenta = $persona->hasOne(Cuenta::class, 'persona_id')->first();
            $cuenta = Cuenta::where('persona_id', $idPersona)->first();
            if (!$cuenta) {
                throw new Exception('Persona sin cuenta puntos', 10);
            }
            $programa= Programa::where('codigo', $cuenta->programa)->first('descripcion');
            if (!$programa) {
                throw new Exception("Código programa $cuenta->programa no válido", 30);
            }
            $cuenta->descripcion = $programa->descripcion;
            $respuesta = array('codigo' => '00', 'respuesta' => $cuenta);

        } catch (\Exception $e) {
            $respuesta = array('codigo' => $e->getCode(), 'respuesta' => $e->getMessage());
        }

        return response()->json($respuesta);
    }

    public function alta() {
        $datos = request()->all();
        $respuesta = [];
        $rules = array('persona_id' => "required|numeric|gt:0|unique:cuentas,persona_id" ,
                       'programa' =>  'required'
                      );
        $messages = array('persona_id.required' => 'Se debe seleccionar una persona previamente',
                          'persona_id.numeric'  => 'Id de persona no numérico',
                          'persona_id.gt'       => 'Id de persona menor que 0',
                          'persona_id.unique'   => 'Sólo se permite una cuentas puntos por persona',
                          'programa.required'   => 'Se debe seleccionar un programa'
                      );
        $validator = Validator::make($datos, $rules, $messages);

        if ( $validator->stopOnFirstFailure()->fails() ) {
            $datos['errors'] = $validator->messages()->all();
            $respuesta = array('codigo' => '10', 'respuesta' => $datos['errors']);
        } else {
            if ($validator->fails()) {
                $datos['errors'] = $validator->messages()->all();
                $respuesta = array('codigo' => '15', 'respuesta' => $datos['errors']);
            } else {
                // validar correccion de datos a dar de alta
                $programas = Programa::all('codigo')->toArray();
                $codigos = [] ;
                foreach ($programas as $programa) { array_push($codigos, $programa['codigo']); }
                if ( !in_array($datos['programa'], $codigos) ) {
                    $respuesta = array('codigo' => '20', 'respuesta' => ["Código de programa '$datos[programa]' no existe"]);
                } else {
                    // continuar con la alta : rellenar los campos que no tienen valor por defecto
                    $datos['entidad'] =  rand(0,9999);
                    $datos['oficina'] =  rand(0,9999);
                    $datos['dc']      =  rand(0,99);
                    $datos['cuenta']  =  rand(1000000000,9999999999);
                    $datos['saldo']   =  0;
                    $datos['fechaextracto'] =  date(today());

                    try {
                        $cuenta = Cuenta::alta($datos);
                        $respuesta = array('codigo' => '00', 'respuesta' => $cuenta);
                    } catch (QueryException $e) {
                        $datos['errors'] = ['SQLSTATE='.$e->errorInfo[0],
                                            'codeSGBD='.$e->errorInfo[1],
                                            'errobbdd='.$e->errorInfo[2]
                                        ];
                        $respuesta = array('codigo' => '33', 'respuesta' => $datos['errors']);
                    }
                }
            }
        }
        return response()->json($respuesta);  //in all cases

    }

    // MUY IMPORTANTE
    // Route::put('/cuentas/{cuenta}',  EL NOMBRE  del parámetro $cuenta del controlador DEBE COINCIDIR con el del parámetro de la ruta {cuenta},
    //  sino Laravel NO lo informa mediante RMB(Route Model Binding) donde recoje en la ruta un id de Cuenta y lo transforma en su correspondiente objeto/registro de la BBDD según el modelo
    public function modificacion(Cuenta $cuenta) {
        $datos = request()->all();
        $respuesta = [];
        $rules = array( 'programa'   => 'required' );
        $messages = array( 'programa.required'   => 'Se debe seleccionar un programa' );
        $validator = Validator::make($datos, $rules, $messages);
        if ($validator->fails()) {
            $datos['errors'] = $validator->messages()->all();
            $respuesta = array('codigo' => '15', 'respuesta' => $datos['errors']);
        } else {
            // validar correccion de datos a dar de alta
            $programas = Programa::all('codigo')->toArray();
            $codigos = [] ;
            foreach ($programas as $programa) { array_push($codigos, $programa['codigo']); }
            if ( !in_array($datos['programa'], $codigos) ) {
                $respuesta = array('codigo' => '20', 'respuesta' => ["Código de programa '$datos[programa]' no existe"]);
            } else {
                // continuar con la modificacion : rellenar los campos a modificar
                $cuenta->programa =  $datos['programa'] ;
                $cuenta->extracto =  $datos['extracto'] ;
                $cuenta->renuncia =  $datos['renuncia'] ;
                try {
                    $result = $cuenta->update($datos);
                    if ($result)
                         $respuesta = array('codigo' => '200', 'respuesta' => $datos);
                    else $respuesta = array('codigo' => '500', 'respuesta' => 'Modificación NO efectuada');
                } catch (QueryException $e) {
                    $datos['errors'] = ['SQLSTATE='.$e->errorInfo[0],
                                        'codeSGBD='.$e->errorInfo[1],
                                        'errobbdd='.$e->errorInfo[2]
                                    ];
                    $respuesta = array('codigo' => '33', 'respuesta' => $datos['errors']);
                }
            }

        }
        return response()->json($respuesta);  //in all cases
    }

    // MUY IMPORTANTE
    // Route::delete('/cuentas/{cuenta}',  EL NOMBRE  del parámetro $cuenta del controlador DEBE COINCIDIR con el del parámetro de la ruta {cuenta},
    //  sino Laravel NO lo informa mediante RMB(Route Model Binding) donde recoje en la ruta un id de Cuenta y lo transforma en su correspondiente objeto/registro de la BBDD según el modelo
    public function baja(Cuenta $cuenta) {
        $respuesta = [];
        try {
            $result = $cuenta->delete();
            if ($result)
                 $respuesta = array('codigo' => '200', 'respuesta' => 'Baja efectuada');
            else $respuesta = array('codigo' => '500', 'respuesta' => 'Baja NO efectuada');
        } catch (QueryException $e) {
            $datos['errors'] = ['SQLSTATE='.$e->errorInfo[0],
                                'codeSGBD='.$e->errorInfo[1],
                                'errobbdd='.$e->errorInfo[2]
                            ];
            $respuesta = array('codigo' => '33', 'respuesta' => $datos['errors']);
        }

        return response()->json($respuesta);  //in all cases
    }

}
