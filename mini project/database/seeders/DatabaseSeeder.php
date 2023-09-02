<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            "username" => "admin",
            "email" => "admin@gmail.com",
            "level" => "admin",
            "number_phone" => "089556785678",
            "password" =>bcrypt("12345678"),
            "tanggal_lahir" => "2003-05-03",
            "gambar" => "profile.jpg"
        ]);
    }
}
