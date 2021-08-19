<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Database\Schema\ForeignKeyConstraint;
use Curfle\Support\Facades\Schema;

class CreateTableToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("token", function (Blueprint $table) {
            // fields
            $table->id("id");
            $table->int("user_id")->unsigned();
            $table->string("value", 500);

            // foreign key
            $table->foreign("user_id")
                ->references("id")
                ->on("user")
                ->onDelete(ForeignKeyConstraint::CASCADE)
                ->onUpdate(ForeignKeyConstraint::CASCADE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("token");
    }
}