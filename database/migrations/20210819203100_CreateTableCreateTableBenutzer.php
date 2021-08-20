<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Database\Schema\ForeignKeyConstraint;
use Curfle\Support\Facades\Schema;

class CreateTableBenutzer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("benutzer", function (Blueprint $table) {
            // fields
            $table->id("id");
            $table->int("mandant_id")->unsigned()->nullable();
            $table->string("vorname", 250);
            $table->string("nachname", 250);
            $table->string("email", 250);
            $table->string("passwort", 100);
            $table->int("benutzerrolle"); // 1=root, 2=admin
            $table->timestamp("erstellt")->defaultCurrent();

            // foreign key
            $table->foreign("mandant_id")
                ->references("id")
                ->on("mandant")
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
        Schema::dropIfExists("benutzer");
    }
}