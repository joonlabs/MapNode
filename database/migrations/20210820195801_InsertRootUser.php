<?php


use Curfle\Database\Migrations\Migration;
use Curfle\Database\Schema\Blueprint;
use Curfle\Support\Facades\DB;
use Curfle\Support\Facades\Hash;
use Curfle\Support\Facades\Schema;

class InsertRootUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws \Curfle\Support\Exceptions\Logic\LogicException
     */
    public function up()
    {
        DB::table("user")
            ->insert([
                "firstname" => "MapNode",
                "lastname" => "Admin",
                "email" => "root@mapnode",
                "password" => Hash::hash("root"),
                "role" => 1
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("user")
            ->where("email", "root@mapnode")
            ->delete();
    }
}