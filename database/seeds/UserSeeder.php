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
            'github_user_name' => env('INITIAL_USER_GITHUB_USER_NAME'),
            'drupal_user_id' => env('INITIAL_USER_DRUPAL_USER_ID'),
            'twitter_user_id' => env('INITIAL_USER_TWITTER_USER_ID'),
            'linkedin_user_id' => env('INITIAL_USER_LINKEDIN_USER_ID'),
            'password' => bcrypt(env('INITIAL_USER_PASSWORD')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
