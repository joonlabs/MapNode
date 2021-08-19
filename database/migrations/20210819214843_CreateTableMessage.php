<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Database\Schema\ForeignKeyConstraint;
use Curfle\Support\Facades\Schema;

class CreateTableMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("message", function (Blueprint $table) {
            // fields
            $table->id("id");
            $table->int("entry_id")->unsigned();
            $table->int("citizen_id")->unsigned();
            $table->string("content");
            $table->tinyInt("commited")->default(false);
            $table->timestamp("created")->defaultCurrent();

            // foreign keys
            $table->foreign("entry_id")
                ->references("id")
                ->on("entry")
                ->onDelete(ForeignKeyConstraint::CASCADE)
                ->onUpdate(ForeignKeyConstraint::CASCADE);

            $table->foreign("citizen_id")
                ->references("id")
                ->on("citizen")
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
        Schema::dropIfExists("message");
    }
}