<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\Schema;

class CreateTableKommentar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("eintrag", function (Blueprint $table) {
            // fields
            $table->int("upvotes")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("eintrag", function (Blueprint $table) {
            // fields
            $table->dropColumn("upvotes");
        });
    }
}