<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Video::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'filename' => 'dotcom_nxt392_tomnight_512x288.mp4',
        'location' => '/videos/dotcom_nxt392_tomnight_512x288.mp4',
        'thumbnail' => '/videos/dotcom_nxt392_tomnight_thumb.jpg',
        'format' => 'mp4',
        'duration' => '00:00:25',
        'filesize' => '1.82 M',
        'bitrate' => '597.21 K',
    ];
});
