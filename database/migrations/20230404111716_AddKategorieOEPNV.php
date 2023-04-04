<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\DB;
use Curfle\Support\Facades\Schema;

class AddKategorieOEPNV extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("kategorie")->where("name", "Sonstiges")->update(["id" => 9]);
        DB::table("kategorie")->insert(["id" => 8, "name" => "ÖPNV", "farbe" => "#87187E",]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("kategorie")->where("id", 8)->delete();
        DB::table("kategorie")->where("id", 9)->update(["id" => 8]);
    }
}