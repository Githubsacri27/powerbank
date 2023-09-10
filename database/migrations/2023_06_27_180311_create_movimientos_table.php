<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->char('operacion',1);
            $table->string('concepto',200);
            $table->decimal('puntos', 5, 0);
            $table->decimal('saldomov', 5, 0);
            $table->char('tarjeta',16);
            $table->char('localizador',8)->nullable()->default(null);;
            $table->char('comercio',80)->nullable()->default(null);;
            $table->string('comentarios',300)->nullable()->default(null);;
            $table->timestamps();;
        });

        Schema::table('movimientos', function (Blueprint $table) {
            $table->unsignedBigInteger('cuenta_id');

            $table->foreign('cuenta_id')->references('id')->on('cuentas'); //->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropForeign('cuenta_id');
        });
        Schema::dropIfExists('movimientos');
    }
};
