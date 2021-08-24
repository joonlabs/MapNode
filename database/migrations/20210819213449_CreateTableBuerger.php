<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\Schema;

class CreateTableBuerger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("buerger", function (Blueprint $table) {
            // fields
            $table->id("id");
            $table->string("vorname", 250);
            $table->string("nachname", 250);
            $table->string("email", 250);
            $table->string("strasse", 100)->nullable();
            $table->string("hausnummer", 25)->nullable();
            $table->string("stadt", 100)->nullable();
            $table->int("plz")->nullable();
            $table->string("telefon", 50)->nullable();
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
        Schema::dropIfExists("buerger");
    }
}