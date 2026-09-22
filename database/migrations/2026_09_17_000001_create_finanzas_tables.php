<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cat_egresos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
        });

        Schema::create('egresos', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto', 10, 2);
            $table->string('concepto');
            $table->dateTime('fecha');
            $table->unsignedBigInteger('id_cat');
            $table->index('id_cat');
            $table->foreign('id_cat')->references('id')->on('cat_egresos');
        });

        Schema::create('limite', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto', 10, 2);
            $table->date('mes');
            $table->unsignedBigInteger('id_cat');
            $table->index('id_cat');
            $table->foreign('id_cat')->references('id')->on('cat_egresos');
        });

        Schema::create('cat_ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
        });

        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto', 10, 2);
            $table->string('concepto');
            $table->dateTime('fecha');
            $table->unsignedBigInteger('id_cat');
            $table->index('id_cat');
            $table->foreign('id_cat')->references('id')->on('cat_ingresos');
        });

        Schema::create('meta_ahorro', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('monto_meta', 10, 2);
            $table->decimal('saldo', 10, 2);
        });

        Schema::create('movimiento', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto', 10, 2);
            $table->enum('tipo', ['INGRESO', 'EGRESO']);
            $table->dateTime('fecha');
            $table->unsignedBigInteger('id_meta');
            $table->index('id_meta');
            $table->foreign('id_meta')->references('id')->on('meta_ahorro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento');
        Schema::dropIfExists('meta_ahorro');
        Schema::dropIfExists('ingresos');
        Schema::dropIfExists('cat_ingresos');
        Schema::dropIfExists('limite');
        Schema::dropIfExists('egresos');
        Schema::dropIfExists('cat_egresos');
    }
};
