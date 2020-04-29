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
            $table->string('github_user_name')->unique()->nullable()->after('email');
            $table->bigInteger('drupal_user_id')->unique()->nullable()->after('github_user_name');
            $table->bigInteger('twitter_user_id')->unique()->nullable()->after('drupal_user_id');
            $table->bigInteger('linkedin_user_id')->unique()->nullable()->after('twitter_user_id');
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
            $table->dropColumn('github_user_name');
            $table->dropColumn('drupal_user_id');
            $table->dropColumn('twitter_user_id');
            $table->dropColumn('linkedin_user_id');
        });
    }
}
