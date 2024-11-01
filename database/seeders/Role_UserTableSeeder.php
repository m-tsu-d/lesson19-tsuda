<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追加するとseederを利用したデータ生成が可能

class Role_UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
            'user_id' => '1', 
            'role_id' => '1', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('role_user')->insert([
            'user_id' => '2', 
            'role_id' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
