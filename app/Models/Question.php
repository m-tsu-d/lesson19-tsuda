<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    
    //変数$fillableを用いて、カラムの値をDBに登録をする処理をシンプル化
    protected $fillable = [
        'question',
        'choices',
        'correct_choice'
    ];

    //カラム「choices」のデータ型指定（配列）
    //json（配列）のままだとStringとして登録されてしまう
    protected $casts = [
        'choices' => 'array'
    ];
}
