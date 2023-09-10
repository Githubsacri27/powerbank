<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\PersonaFactory;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{

    public function run()
    {
        //  to execute regardless of dependencies > php artisan db:seed --class=PersonaSeeder
        DatabaseSeeder::truncateTables(['personas']);

        $result = DB::table('personas')->insert([
            'nif' => '10000001A',
            'nombre' => 'Margaret',
            'apellidos' => 'Rose',
            'direccion' => 'Av. Pignarelli, 56',
            'email' => 'margaret@mail.com',
            'tarjeta' => '1234567890123456',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        echo $result.' insert in table personas';

        $result = DB::table('personas')->insert([
            'nif' => '12345678Z',
            'nombre' => 'Andres',
            'apellidos' => 'Sincuenta YPico',
            'direccion' => 'Av. SinBanco, 666',
            'email' => 'sincuenta@ypico.com',
            'tarjeta' => '0987654321654321',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        echo $result.' insert in table personas';

    }
}
