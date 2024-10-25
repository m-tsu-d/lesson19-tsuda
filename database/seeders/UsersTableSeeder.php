<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追加するとseederを利用したデータ生成が可能

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
            'name' => 'ユーザー1',
            'email' => 'user1@example.com',
            'email_verified_at' => now(),
            'password' => 'password1', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'ユーザー2',
                'email' => 'user2@example.com',
                'email_verified_at' => now(),
                'password' => 'password2', 
                'created_at' => now(),
                'updated_at' => now(),
        ]);

    }
}
