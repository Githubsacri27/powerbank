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
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->char('entidad',4);
            $table->char('oficina',4);
            $table->char('dc',2);
            $table->char('cuenta',10);
            $table->char('programa',3);
            $table->tinyInteger('extracto');
            $table->tinyInteger('renuncia');
            $table->decimal('saldo', 5, 0)->default(0);
            $table->date('fechaextracto')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('cuentas', function (Blueprint $table) {
            $table->unsignedBigInteger('persona_id');

            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('restrict')->onUpdate('restrict');

            $table->unique(['entidad', 'oficina', 'dc', 'cuenta']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuentas', function (Blueprint $table) {
            $table->dropForeign('persona_id');
            $table->dropUnique(['entidad', 'oficina', 'dc', 'cuenta']);
        });

        Schema::dropIfExists('cuentas');

    }
};
