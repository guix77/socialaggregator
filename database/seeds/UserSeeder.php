<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = env('INITIAL_USER_NAME');
        $user->email = env('INITIAL_USER_EMAIL');
        $user->github_user_name = env('INITIAL_USER_GITHUB_USER_NAME');
        $user->drupal_user_id = env('INITIAL_USER_DRUPAL_USER_ID');
        $user->password = Hash::make(env('INITIAL_USER_PASSWORD'));
        $user->save();
        $user->assignRole('admin');
    }
}
