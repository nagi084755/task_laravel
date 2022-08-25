<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
  return [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'user_id' => Str::random(64),
    'password' => Hash::make($faker->password),
    'role' => 'MEMBER',
    'created_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get())
  ];
});
