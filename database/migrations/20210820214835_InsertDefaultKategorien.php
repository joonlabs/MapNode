<?php

use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\DB;
use Curfle\Support\Facades\Schema;

class InsertDefaultKategorien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("kategorie")->insert(["name" => "Umwelt", "farbe" => "#61988E",]);
        DB::table("kategorie")->insert(["name" => "Soziales", "farbe" => "#EE4266",]);
        DB::table("kategorie")->insert(["name" => "Wirtschaft", "farbe" => "#344966",]);
        DB::table("kategorie")->insert(["name" => "Tourismus", "farbe" => "#6BA292",]);
        DB::table("kategorie")->insert(["name" => "Verkehr/Sicherheit", "farbe" => "#66C3FF",]);
        DB::table("kategorie")->insert(["name" => "Ortsbild/Siedlung", "farbe" => "#F17300",]);
        DB::table("kategorie")->insert(["name" => "Sonstiges", "farbe" => "#000000",]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("kategorie")->delete();
    }
}