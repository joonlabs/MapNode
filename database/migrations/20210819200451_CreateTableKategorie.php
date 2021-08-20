<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\Schema;

class CreateTableKategorie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("kategorie", function (Blueprint $table) {
            $table->id("id");
            $table->string("name", 150);
            $table->string("farbe", 7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("kategorie");
    }
}