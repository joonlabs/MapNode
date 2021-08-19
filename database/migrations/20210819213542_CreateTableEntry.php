<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Database\Schema\ForeignKeyConstraint;
use Curfle\Support\Facades\Schema;

class CreateTableEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("entry", function (Blueprint $table) {
            // fields
            $table->id("id");
            $table->string("name", 250);
            $table->int("status"); // 0=offen, 1=problem, 2=geschlossen
            $table->string("content")->nullable();
            $table->float("latitude");
            $table->float("longitude");
            $table->int("category_id")->unsigned();
            $table->int("citizen_id")->unsigned();
            $table->tinyInt("commited")->default(false);
            $table->tinyInt("chat_available")->default(true);
            $table->timestamp("created")->defaultCurrent();

            // foreign keys
            $table->foreign("category_id")
                ->on("category")
                ->references("id")
                ->onUpdate(ForeignKeyConstraint::CASCADE)
                ->onDelete(ForeignKeyConstraint::CASCADE);

            $table->foreign("citizen_id")
                ->on("citizen")
                ->references("id")
                ->onUpdate(ForeignKeyConstraint::CASCADE)
                ->onDelete(ForeignKeyConstraint::CASCADE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("entry");
    }
}