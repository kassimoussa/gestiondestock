<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentrees', function (Blueprint $table) {
            $table->id();
            $table->string('materiel')->nullable();
            $table->integer('quantite')->nullable();
            $table->string('fournisseur');
            $table->timestamp('date_rentree');
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
        Schema::dropIfExists('rentrees');
    }
}
