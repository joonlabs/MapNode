<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\Schema;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user", function (Blueprint $table) {
            $table->id("id");
            $table->string("firstname", 250);
            $table->string("lastname", 250);
            $table->string("email", 250);
            $table->string("password", 100);
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
        Schema::dropIfExists("user");
    }
}