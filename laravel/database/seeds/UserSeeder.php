<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "email" => "admin@bla.com",
            "password" => Hash::make("admin"),
            "level_id" => 1,
            "name" => "Administrator",
            "api_token" => Str::random(32)
        ]);
        DB::table('users')->insert([
            "email" => "userbiasa@bla.com",
            "password" => Hash::make("userbiasa"),
            "level_id" => 2,
            "name" => "User Biasa",
            "api_token" => Str::random(32)
        ]);
    }
}
