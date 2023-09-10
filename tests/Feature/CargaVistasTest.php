<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Persona;

class CargaVistasTest extends TestCase
{
    use RefreshDatabase; 

    public function test_carga_vista_inicial() {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_carga_vista_gestion_comercial_con_sesion() {
        session(['idPersona' => '1']);
        $response = $this->get('/gestion');
        $response->assertStatus(200);
        $response->assertSee(['titulo' => 'Gestión Comercial']);
    }
    public function test_carga_vista_gestion_comercial_sin_sesion() {
        $response = $this->get('/gestion');
        $response->assertStatus(200);
        $response->assertSee(['titulo' => 'Gestión Comercial']);
    }

    public function test_carga_vista_alta_mto_cta_puntos_sin_sesion(){
        $response = $this->get('/alta-mto-puntos');
        $response->assertStatus(302);
    }
    public function test_carga_vista_alta_mto_cta_puntos_con_sesion(){
        //first create persona in empty DDBB with id=1
        $response = $this->post('/alta-personas',[
            'nif'       => '10000001A',
            'nombre'    => 'Margaret',
            'apellidos' => 'Rose',
            'direccion' => 'Av. Pignarelli, 56',
            'email'     => 'pignarelli@mail.com',
        ]);
        session(['idPersona' => '1']);
        $response = $this->get('/alta-mto-puntos');
        $response->assertStatus(200);
        $response->assertSee(['titulo' => 'Alta y Mantenimiento Cta Puntos']);
    }
    public function test_carga_vista_alta_mto_cta_puntos_con_sesion_invalido(){
        session(['idPersona' => '999']);
        $response = $this->get('/alta-mto-puntos');
        $response->assertStatus(302);
    }

    public function test_carga_vista_alta_personas() {
        $response = $this->get('/alta-personas');
        $response->assertStatus(200);
        $response->assertSee(['titulo' => 'Alta Personas']);
    }
    public function test_carga_vista_consuta_mvtos_cta_puntos() {
        $response = $this->get('/consulta-movimientos');
        $response->assertStatus(200);
        $response->assertSee(['titulo' => 'Consulta movimientos Cta Puntos']);
    }
    public function test_carga_vista_detalle_mvto_cta_puntos() {
        $response = $this->get('/detalle-movimiento');
        $response->assertStatus(200);
        $response->assertSee(['titulo' => 'Detalle movimiento Cta Puntos']);
    }
    public function test_carga_vista_alta_mvtos_cta_puntos() {
        $response = $this->get('/alta-movimientos');
        $response->assertStatus(200);
        $response->assertSee(['titulo' => 'Alta movimientos Cta Puntos']);

    }
}
