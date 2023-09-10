<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramaSeeder extends Seeder
{

    public function run()
    {
        $result = DB::table('programas')->insert(
            [
                [
                    'codigo' => 'PPP',
                    'descripcion' => 'Programa Puntos de Prueba',
                    'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                    'updated_at' => DB::raw('CURRENT_TIMESTAMP')
                ],
                [
                    'codigo' => 'PBS',
                    'descripcion' => 'Programa Puntos Básico',
                    'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                    'updated_at' => DB::raw('CURRENT_TIMESTAMP')
                ],
                [
                    'codigo' => 'PAV',
                    'descripcion' => 'Programa Puntos Avanzado',
                    'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                    'updated_at' => DB::raw('CURRENT_TIMESTAMP')
                ],
                [
                    'codigo' => 'PPR',
                    'descripcion' => 'Programa Puntos Premiun',
                    'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                    'updated_at' => DB::raw('CURRENT_TIMESTAMP')
                ],
            ]
        );
        echo $result.' insert in table programas';
    }
}
