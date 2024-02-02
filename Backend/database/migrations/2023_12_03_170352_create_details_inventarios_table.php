<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_inventarios', function (Blueprint $table) {
            
            $table->uuid('id')->primary();

            $table->uuid('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');

            $table->uuid('zona_id')->nullable();
            $table->foreign('zona_id')->references('id')->on('zonas');

            $table->uuid('inventario_id')->nullable();
            $table->foreign('inventario_id')->references('id')->on('inventarios');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details_inventarios');
    }
}
