<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Database\Schema\ForeignKeyConstraint;
use Curfle\Support\Facades\Schema;

class CreateTableNachricht extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("nachricht", function (Blueprint $table) {
            // fields
            $table->id("id");
            $table->int("eintrag_id")->unsigned();
            $table->int("buerger_id")->unsigned();
            $table->string("inhalt");
            $table->bool("bestaetigt")->default(false);
            $table->bool("namen_veroeffentlichen")->default(true);
            $table->bool("nachricht_bei_interaktion")->default(true);
            $table->datetime("erstellt")->defaultCurrent();

            // foreign keys
            $table->foreign("eintrag_id")
                ->references("id")
                ->on("eintrag")
                ->onDelete(ForeignKeyConstraint::CASCADE)
                ->onUpdate(ForeignKeyConstraint::CASCADE);

            $table->foreign("buerger_id")
                ->references("id")
                ->on("buerger")
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
        Schema::dropIfExists("nachricht");
    }
}