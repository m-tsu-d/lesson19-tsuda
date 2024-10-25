<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追加するとseederを利用したデータ生成が可能

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //json_encode() を使って配列を JSON 形式の文字列に変換
        DB::table('questions')->insert([
            'id' => '1',
            'question' => 'この中で神奈川県綾瀬市に「ない」ものは？',
            'choices' => json_encode(['スタバ', 'ドトール', 'タリーズ']), 
            'correct_choice' => '1',
            'created_at' => now(),
        ]);

        DB::table('questions')->insert([
            'id' => '2',
            'question' => 'この中で神奈川県綾瀬市出身で「ない」芸能人は？',
            'choices' => json_encode(['さかなクン', '藤井貴彦（アナウンサー）', 'オダギリ ジョー']),
            'correct_choice' => '3',
            'created_at' => now(),
        ]);

        DB::table('questions')->insert([
            'id' => '3',
            'question' => 'この中で神奈川県綾瀬市出身について「正しくない」記述は？',
            'choices' => json_encode(['豚も鶏も牛も飼育されている', '消防署や警察署だけでなく海上自衛隊の基地もある', '新幹線が市内を通っている']),
            'correct_choice' => '3',
            'created_at' => now(),
        ]);
    }
}
