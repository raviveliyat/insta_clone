<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'title' => $faker->text(24),
        'description' => $faker->text(100),
        'website' => $faker->url(),
        'profile_pic_url' => 'http://www.cybecys.com/wp-content/uploads/2017/07/no-profile.png',
    ];
});
