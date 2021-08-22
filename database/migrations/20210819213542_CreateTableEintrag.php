<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Database\Schema\ForeignKeyConstraint;
use Curfle\Support\Facades\Schema;

class CreateTableEintrag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("eintrag", function (Blueprint $table) {
            // fields
            $table->id("id");
            $table->string("name", 250);
            $table->int("status")->default(0); // 0=offen, 1=problem, 2=geschlossen
            $table->string("inhalt")->nullable();
            $table->float("latitude");
            $table->float("longitude");
            $table->int("mandant_id")->unsigned();
            $table->int("kategorie_id")->unsigned();
            $table->int("buerger_id")->unsigned();
            $table->bool("bestaetigt")->default(false);
            $table->bool("chat_verfuegbar")->default(true);
            $table->timestamp("erstellt")->defaultCurrent();

            // foreign keys
            $table->foreign("mandant_id")
                ->on("mandant")
                ->references("id")
                ->onUpdate(ForeignKeyConstraint::CASCADE)
                ->onDelete(ForeignKeyConstraint::CASCADE);

            $table->foreign("kategorie_id")
                ->on("kategorie")
                ->references("id")
                ->onUpdate(ForeignKeyConstraint::CASCADE)
                ->onDelete(ForeignKeyConstraint::CASCADE);

            $table->foreign("buerger_id")
                ->on("buerger")
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
        Schema::dropIfExists("eintrag");
    }
}