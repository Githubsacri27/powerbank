<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovimientoSeeder extends Seeder
{
 
    public function run()
    {
        //  to execute regardless of dependencies > php artisan db:seed --class=MovimientoSeeder
        DatabaseSeeder::truncateTables(['movimientos']);
        $cuentaId = DB::table('cuentas')
            ->whereEntidad('0001')
            ->whereOficina('0200')
            ->whereDc('10')
            ->whereCuenta('0200123456')
            ->value('id');

        if ( $cuentaId != null ) {
            $result = DB::table('movimientos')->insert([
                'fecha' => '2021-11-16',
                'operacion' => 'A',
                'concepto' => 'Compra en Comercio On-Line',
                'puntos' => '100',
                'saldomov' => '100',
                'tarjeta' => '1234567890123456',
                'localizador' => 'AA233EE',
                'comercio' => 'El Libro Feliz',
                'comentarios' => 'Pendiente de verificación',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
                'cuenta_id' => $cuentaId
            ]);
            echo $result.' insert in table movimientos';
        }
    }
}
