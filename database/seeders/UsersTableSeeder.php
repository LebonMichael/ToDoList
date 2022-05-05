<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           'role_id' => 1,
            'name' => 'Michael',
            'email' => 'lebontje45@hotmail.com',
            'password' => bcrypt(12345678),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'remember_token' => Str::random(10),
        ]);
        DB::table('users')->insert([
            'role_id' => 2,
            'name' => 'Tom',
            'email' => 'tom@hotmail.com',
            'password' => bcrypt(12345678),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'remember_token' => Str::random(10),
        ]);
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Dylan',
            'email' => 'dylan@hotmail.com',
            'password' => bcrypt(12345678),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'remember_token' => Str::random(10),
        ]);
    }
}
