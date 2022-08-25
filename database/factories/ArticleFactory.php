<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Article;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
  return [
    'user_id' => User::inRandomOrder()->first()->user_id,
    'title' => $faker->sentence(),
    'content' => $faker->text(),
    'created_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get())
  ];
});
