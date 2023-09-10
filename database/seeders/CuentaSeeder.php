<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuentaSeeder extends Seeder
{

    public function run()
    {
        
        DatabaseSeeder::truncateTables(['cuentas']);

        $personaId = DB::table('personas')->whereNif('10000001A')->value('id');

        if ( $personaId != null ) {
            $result = DB::table('cuentas')->insert([
                'entidad' => '0001',
                'oficina' => '0200',
                'dc' => '10',
                'cuenta' => '0200123456',
                'programa' => 'PPP',
                'extracto' => '0',
                'renuncia' => '0',
                'saldo' => '0',
                'fechaextracto' => '2021-11-16',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
                // 'persona_id' => $personas[0]->id
                'persona_id' => $personaId
            ]);
            echo $result.' insert in table cuentas';
        }
    }
}
