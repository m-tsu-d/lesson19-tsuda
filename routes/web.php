<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//QuizController に関連するルートを定義
Route::controller(QuizController::class)->group(function(){
    //トップページ(indexメソッドを呼んで、view配下のquiz/indexを返す)
    Route::get('/','index')->name('quiz.index');

    //クイズを作成(createメソッドを呼んで、view配下のquiz/createを返す)
    Route::get('/create','create')->name('quiz.create');

    //クイズの登録(storeメソッドを呼んで、DBにクイズを登録する)
    Route::post('/quiz/store','store')->name('quiz.store'); 

    //クイズを表示(questionIdを引数にshowメソッドを呼んで、view配下のquiz/showを返す)
    Route::get('/quiz/{questionId}','show')->name('quiz.show');

    //クイズの正解/不正解を表示(answerメソッドを呼んで、view配下のquiz/answerを返す)
    Route::get('/quiz/answer/{questionId}','answer')->name('quiz.answer');
    //Route::post('/quiz/answer', [QuizController::class, 'answer'])->name('quiz.answer');

    //クイズの一覧を表示(listメソッドを呼んで、view配下のquiz/listを返す)
    Route::get('/list','list')->name('quiz.list');

    //クイズを削除(destroyメソッドを呼んで、指定したquestionIdのクイズをDBから削除する)
    Route::delete('/quiz/destroy/{questionId}', 'destroy')->name('quiz.destroy');

});