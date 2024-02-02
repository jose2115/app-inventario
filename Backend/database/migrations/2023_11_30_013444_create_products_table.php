<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('ref');
            $table->string('cod-barra-1');
            $table->string('cod-barra-2');
            $table->string('cod-barra-3');

            $table->string('description');
            $table->string('color');
            $table->string('talla');

            $table->uuid('zona_id')->nullable();
            $table->foreign('zona_id')->references('id')->on('zonas');
            
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
        Schema::dropIfExists('products');
    }
}
