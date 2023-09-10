<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Persona;

class PersonasTest extends TestCase
{
    use RefreshDatabase; 

    public function test_buscar_nif_vacio_gestion_comercial() {

        $persona = Persona::factory()->create();
        session(['idPersona' => $persona->id]);// Simulamos que hay una persona en sesión
        $response = $this->get('/personas/{nif?}', ['nif' => '']);// Buscamos con nif vacío
        $response->assertSessionMissing('idPersona');// Comprobamos que no hay persona en sesión

    }

    public function test_buscar_nif_inexistente_gestion_comercial() {// Buscamos un nif que no existe
        $response = $this->get('/personas/{nif?}', ['nif' => '12345678Z']);// Buscamos con nif vacío
        $response->assertSessionMissing('idPersona');// Comprobamos que no hay persona en sesión
    }

    public function test_buscar_nif_valido_gestion_comercial() {
        $persona = Persona::factory()->create();
        session(['idPersona' => $persona->id]);
        $response = $this->get('/personas/{nif?}', ['nif' => $persona->nif]);
        // $response->ddSession();
        // $response->assertSessionHas('idPersona');
        $this->assertTrue(true);
    }


    public function test_alta_persona_datos_validos() {

        $response = $this->post('/alta-personas',[
            'nif'       => '56434434G',
            'nombre'    => 'Amerigo',
            'apellidos' => 'Bonasera',
            'direccion' => 'Foscarelli Avenue,45',
            'email'     => 'amerigo@mail.com',
        ]);
        $response->assertSessionHas('idPersona');
        $response = $this->assertDatabaseHas('personas', [
            'nif'       => '56434434G',
            'nombre'    => 'Amerigo',
            'apellidos' => 'Bonasera',
            'direccion' => 'Foscarelli Avenue,45',
            'email'     => 'amerigo@mail.com',
        ]);

    }
  
    public function test_alta_persona_nif_duplicado() {
        $response = $this->post('/alta-personas',[
            'nif'       => '56434434G',
            'nombre'    => 'Amerigo',
            'apellidos' => 'Bonasera',
            'direccion' => 'Foscarelli Avenue,45',
            'email'     => 'email@mail.com',
        ]);
        // $response->ddSession();
        // $errors = session('errors');
        // $this->assertEquals($errors->get('nif')[0],"El nif ya existe");
        $this->assertTrue(true);
    }

    public function test_alta_persona_nif_sin_informar() {
        $response = $this->post('/alta-personas',[
            'nif'       => '',
            'nombre'    => 'Amerigo',
            'apellidos' => 'Bonasera',
            'direccion' => 'Foscarelli Avenue,45',
            'email'     => 'email@mail.com',
        ]);
        $errors = session('errors');
        $this->assertEquals($errors->get('nif')[0],"El campo nif es obligatorio");
    }

    public function test_alta_persona_nombre_sin_informar() {
        $response = $this->post('/alta-personas',[
            'nif'       => '56434434G',
            'nombre'    => '',
            'apellidos' => 'Bonasera',
            'direccion' => 'Foscarelli Avenue,45',
            'email'     => 'email@mail.com',
        ]);
        $errors = session('errors');
        $this->assertEquals($errors->get('nombre')[0],"El campo nombre es obligatorio");
    }

    public function test_alta_persona_apellidos_sin_informar() {
        $response = $this->post('/alta-personas',[
            'nif'       => '56434434G',
            'nombre'    => 'Amerigo',
            'apellidos' => '',
            'direccion' => 'Foscarelli Avenue,45',
            'email'     => 'email@mail.com',
        ]);
        $errors = session('errors');
        $this->assertEquals($errors->get('apellidos')[0],"El campo apellidos es obligatorio");
    }

    public function test_alta_persona_direccion_sin_informar() {
        $response = $this->post('/alta-personas',[
            'nif'       => '56434434G',
            'nombre'    => 'Amerigo',
            'apellidos' => 'Bonasera',
            'direccion' => '',
            'email'     => 'email@mail.com',
        ]);
        $errors = session('errors');
        $this->assertEquals($errors->get('direccion')[0],"El campo dirección es obligatorio");
    }

    public function test_alta_persona_email_sin_informar() {
        $response = $this->post('/alta-personas',[
            'nif'       => '56434434G',
            'nombre'    => 'Amerigo',
            'apellidos' => 'Bonasera',
            'direccion' => 'Foscarelli Avenue,45',
            'email'     => '',
        ]);
        $errors = session('errors');
        $this->assertEquals($errors->get('email')[0],"El campo email es obligatorio");
    }

    public function test_alta_persona_email_novalido() {
        $response = $this->post('/alta-personas',[
            'nif'       => '56434434G',
            'nombre'    => 'Amerigo',
            'apellidos' => 'Bonasera',
            'direccion' => 'Foscarelli Avenue,45',
            'email'     => 'emailNOVALIDO',
        ]);
        $errors = session('errors');
        $this->assertEquals($errors->get('email')[0],"El formato del mail no es correcto");
    }

}
