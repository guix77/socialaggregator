<?php

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
        DB::table('users')->insert([
            'name' => env('INITIAL_USER_NAME'),
            'email' => env('INITIAL_USER_EMAIL'),
            'password' => bcrypt(env('INITIAL_USER_PASSWORD')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
