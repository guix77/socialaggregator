<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedUserProfileFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('github_user_id')->after('email');
            $table->bigInteger('drupal_user_id')->after('github_user_id');
            $table->bigInteger('twitter_user_id')->after('drupal_user_id');
            $table->bigInteger('linkedin_user_id')->after('twitter_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('github_user_id');
            $table->dropColumn('drupal_user_id');
            $table->dropColumn('twitter_user_id');
            $table->dropColumn('linkedin_user_id');
        });
    }
}
