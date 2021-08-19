<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Database\Schema\ForeignKeyConstraint;
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
            // fields
            $table->id("id");
            $table->int("client_id")->unsigned()->nullable();
            $table->string("firstname", 250);
            $table->string("lastname", 250);
            $table->string("email", 250);
            $table->string("password", 100);
            $table->int("role"); // 1=root, 2=admin
            $table->timestamp("created")->defaultCurrent();

            // foreign key
            $table->foreign("client_id")
                ->references("id")
                ->on("client")
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
        Schema::dropIfExists("user");
    }
}