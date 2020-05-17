<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            "nama" => "Administrator",
            "can_see_book" => true,
            "can_add_book" => true,
            "can_edit_book" => true,
            "can_delete_book" => true,
            "can_see_user" => true,
            "can_add_user" => true,
            "can_edit_user" => true,
            "can_delete_user" => true,
        ]);
        DB::table('levels')->insert([
            "nama" => "User Biasa",
            "can_see_book" => true,
            "can_add_book" => false,
            "can_edit_book" => false,
            "can_delete_book" => false,
            "can_see_user" => false,
            "can_add_user" => false,
            "can_edit_user" => false,
            "can_delete_user" => false,
        ]);
    }
}
