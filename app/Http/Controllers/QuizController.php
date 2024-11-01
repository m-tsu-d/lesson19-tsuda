<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question; //Questionモデルの参照
use Illuminate\Support\Facades\Gate;    //Gateモデルの参照
use Illuminate\Support\MessageBag; //バリデーションエラーメッセージの参照
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Models\User; //Userモデルの参照
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    //indexメソッドの定義
    public function index()
    {
        //問題回答のページに移動して最初に表示される問題を指定
        //テーブルのidカラムの値が1以上に該当する最初のレコードの値を取得
        $firstQuestionId = Question::where('id', '>=' ,1)->first();

        //indexのビューを返す（firstQuestionIdをindexのビューに渡す）
        return view('quiz.index',compact('firstQuestionId'));

    }

    //createメソッドの定義
    public function create()
    {
        //adminの権限を持っていなかったら、403エラーを発生させる
        if(!Gate::allows('admin')){
            abort(403);
        }else{
            //createのビューを返す
            return view('quiz.create');
        }
    }

    //storeメソッドの定義
    public function store(Request $request)
    {
 
        //dd($request);

        //バリデーション
        //問題文の作成・選択肢の作成・解答の選択を必須に設定
        //連想配列で['postしてきた値'=>'検証ルール']
        $inputs = $request->validate([
            'question' => 'required',
            'choices.0' => 'required',
            'choices.1' => 'required',
            'choices.2' => 'required',
            'correct_choice' => 'required'
        ]);

        //作成した問題文・選択肢・解答をデータベースのテーブルに保存
        $question = new Question();
        $question->question = $inputs['question'];
        $question->choices= $inputs['choices'];
        $question->correct_choice = $inputs['correct_choice'];
        $question->save();

        // フラッシュメッセージを設定
        return redirect()->route('quiz.create')->with('success', 'クイズの登録が完了しました。続けて新しい問題を作ることができます。');
    }

    //showメソッドの定義
    public function show($questionId)
    {
        //questionIdで指定したクイズデータを取得
        //見つからなかったらエラー（404HTTPレスポンス）を返す
        $question = Question::findOrFail($questionId);
  
        //compact関数でcontrollerから変数を受け渡す
        return view('quiz.show',compact('question'));
    }

    //answerメソッドの定義
    public function answer(Request $request,$questionId)
    {
        // トータル問題数を取得
       $totalQuestions = Question::count();

       // セッションから現在の正解数を取得
       // セッションに保存されている'correct_answers'というキーが存在しない場合、初期値を0とする。
       $correctAnswers = session('correct_answers', 0);

        //ビューで受け取ったユーザーの解答とquestion_id
        $userAnswer = $request->input('choice');
        $questionId = $request->input('question_id');

        //questionIdで指定したクイズデータを取得
        $question = Question::findOrFail($questionId);

        //カラムchoiceは配列型なので、インデックス番号が0(選択肢1),1(選択肢2),2(選択肢3)
        //カラムcorrect_choiceの値は1(選択肢1),2(選択肢2),3(選択肢1)
        //カラムcorrect_choiceからマイナス1することで、一つの選択肢に対する値が同一になるように調整
        $correctChoiceIndex = $question->correct_choice - 1;
    
        //ユーザーが選択した解答とクイズデータの正解を比較
        if ($userAnswer == $correctChoiceIndex) {
            $isCorrect = true;

             // 正解数を1増やしてセッションに保存
             $correctAnswers++;
             session(['correct_answers' => $correctAnswers ]);

        } else {
            $isCorrect = false;
            //不正解であればセッション'correct_answers'を0に初期化する。
            session(['correct_answers' => 0]);
        }

        //ビューで受け取ったquestion_idより値の大きくかつ、昇順で先頭のクイズのidを取得
        $nextQuestionId = Question::where('id', '>', $questionId)->first();

        // ログイン中のユーザーのキー番号を取得
        $userKeyNumber = Auth::user()->key_number ?? null;


       // 最後の問題かどうかを確認し、全問正解かどうかを判定
    if (!$nextQuestionId) {
        // 全問正解の場合
        if ($correctAnswers == $totalQuestions) {

            //セッション'correct_answers'の初期化
            session(['correct_answers' => 0]);

            return view('quiz.answer', [
                'isCorrect' => $isCorrect,
                'question' => $question,
                'userAnswer' => $userAnswer,
                'nextQuestionId' => null, // 最後の問題なのでNULL
                'userKeyNumber' => $userKeyNumber // 全問正解であればキー番号を渡す
            ]);
        } else {

            //セッション'correct_answers'の初期化
            session(['correct_answers' => 0]);

            // 全問正解でない場合
            return view('quiz.answer', [
                'isCorrect' => $isCorrect,
                'question' => $question,
                'userAnswer' => $userAnswer,
                'nextQuestionId' => null,
                'userKeyNumber' => null // 全問正解でない場合はNULLを渡す
            ]);
        }
    } else {
        // 次の問題があれば次の問題へ進む
        return view('quiz.answer', [
            'isCorrect' => $isCorrect,
            'question' => $question,
            'userAnswer' => $userAnswer,
            'nextQuestionId' => $nextQuestionId,
            'userKeyNumber' => null // 途中の問題なのでNULLを渡す
        ]);
    }
    
    }

    //listメソッドの定義
    public function list()
    {
        //adminの権限を持っていなかったら、403エラーを発生させる
        if(!Gate::allows('admin')){
            abort(403);
        }else{

            //questionsテーブルの全レコードを取得
            $questions = Question::all();
            //listのビューを返す
            return view('quiz.list', ['questions' => $questions]);
        }
    }

    //deleteメソッドの定義
    public function destroy(Request $request)
    {

        //adminの権限を持っていなかったら、403エラーを発生させる
        if(!Gate::allows('admin')){
            abort(403);
        }else{
        //ビューで受け取ったquestion_id
        $deleteQuestionIds = $request->input('question_ids');

        if ($deleteQuestionIds) {
            // 一括削除
            Question::destroy($deleteQuestionIds);
            $successMessage = "選択したクイズの削除が完了しました。";
        } else {
            $successMessage = "削除するクイズが選択されていません。";
        }

        // // idの値で問題を検索して取得   
        // $question = Question::findOrFail($deleteQuestionId);
        // $question->delete();

        // 削除したら一覧画面にリダイレクト
        return redirect()->route('quiz.list')->with('success', $successMessage);
        }
    }

     //accountListメソッドの定義
     public function accountList()
     {
         //adminの権限を持っていなかったら、403エラーを発生させる
         if(!Gate::allows('admin')){
             abort(403);
         }else{
 
             //usersテーブルの全レコードを取得
             $users = User::all();

             //accountListのビューを返す
             return view('quiz.accountList', ['users' => $users]);
         }
     }

     //updateKeyNumbersメソッドの定義
     public function updateKeyNumbers(Request $request)
    {

       // バリデーションルール
       $request->validate([
        'user_ids' => 'required|array',
        'key_numbers' => 'required|array',
        'key_numbers.*' => 'nullable|numeric', // 各キー番号が数字であることを確認
        ]);

        // チェックボックスで選択されたユーザーIDの配列を取得
        $userIds = $request->input('user_ids');
        // 各ユーザーの新しいキー番号を取得
        $keyNumbers = $request->input('key_numbers');

        // 選択されたユーザーのキー番号を更新
        foreach ($userIds as $userId) {
            $user = User::find($userId);
            if ($user) {
                // 新しいキー番号を設定
                $user->key_number = $keyNumbers[$userId] ?? $user->key_number; // 新しい値がなければ元の値を維持
                $user->save();
            }
        }

        return redirect()->back()->with('success', 'キー番号が更新されました。');
    }
 

}
