<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    //indexメソッドの定義
    public function index()
    {
        //indexのビューを返す
        return view('quiz.index');
    }
}
