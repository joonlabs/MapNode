<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\Schema;

class CreateTableCitizen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("citizen", function (Blueprint $table) {
            // fields
            $table->id("id");
            $table->string("firstname", 250);
            $table->string("lastname", 250);
            $table->string("email", 250);
            $table->string("street", 100)->nullable();
            $table->string("housenumber", 25)->nullable();
            $table->string("city", 100)->nullable();
            $table->int("zip")->nullable();
            $table->string("phone", 50)->nullable();
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
        Schema::dropIfExists("citizen");
    }
}