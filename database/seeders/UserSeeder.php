<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                "name" => "Emmanuel",
                "email" => "admin@munives.gob.pe",
                "password" => bcrypt("admin@munives.gob.pe")
            ]
        );
    }
}
