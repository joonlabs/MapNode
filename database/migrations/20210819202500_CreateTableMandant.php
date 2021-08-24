<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\Schema;

class CreateTableMandant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("mandant", function (Blueprint $table) {
            // fields
            $table->id("id");
            $table->string("name", 250);
            $table->string("kennung", 50);
            $table->float("karte_latitude");
            $table->float("karte_longitude");
            $table->int("karte_zoom")->default(11);
            $table->datetime("erstellt")->defaultCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("mandant");
    }
}