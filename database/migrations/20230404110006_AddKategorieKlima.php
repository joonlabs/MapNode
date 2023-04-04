<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\DB;
use Curfle\Support\Facades\Schema;

class AddKategorieKlima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add one to all kategorie ids
        for($i = 7; $i >= 2; $i--){
            DB::table("kategorie")->where("id", $i)->update(["id" => $i+1]);
        }

        // add kategorie "Klima"
        DB::table("kategorie")->insert(["id" => 2, "name" => "Klima", "farbe" => "#81E752",]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // delete kategorie "Klima"
        DB::table("kategorie")->where("id", 2)->delete();

        // subtract one from all kategorie ids
        for($i = 3; $i <= 8; $i++){
            DB::table("kategorie")->where("id", $i)->update(["id" => $i-1]);
        }
    }
}