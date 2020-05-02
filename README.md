# SocialAggregator

This is a small application that fetches developers activity on Drupal.org and Github.com and then exposes it through a RESTful API. It's just a Laravel 7 explorative project for me, I'm not expecting to maintain it.

## Features

+ An administrator can create and manage users
+ Each user can setup his Drupal.org user ID and GitHub.com username (and manage his account)
+ An Artisan command allows to fetch users activities on Drupal.org and GitHub.com
+ Each user can unpublish / publish again each of his items
+ The items are exposed as a RESTful API resource using a client credentials grant

## Use

````
composer install
cp .env.example .env
nano .env
php artisan migrate
php artisan passport:install
php artisan passport:client --client
php artisan items:fetch
````
