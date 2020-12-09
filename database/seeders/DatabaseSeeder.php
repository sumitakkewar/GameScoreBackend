<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'The UnderTaker',
            'username' => 'undertaker',
            'email' => 'undertaker@wwe.com',
            'password' => bcrypt('silence'),
        ]);
    }
}
