<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('admins')->insert([
      'name' => 'admin',
      'user_id' => Str::random(64),
      'email' => 'admin@test.com',
      'password' => Hash::make('pass123'),
      'role' => 'ADMIN'
    ]);
  }
}
