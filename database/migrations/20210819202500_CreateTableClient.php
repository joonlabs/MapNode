<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\Schema;

class CreateTableClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("client", function (Blueprint $table) {
            // fields
            $table->id("id");
            $table->string("name", 250);
            $table->string("identifier", 50);
            $table->float("map_latitude");
            $table->float("map_longitude");
            $table->int("map_zoom")->default(11);
            $table->timestamp("created")->defaultCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("client");
    }
}