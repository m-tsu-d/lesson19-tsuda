<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question; //Questionモデルの参照
use Illuminate\Support\Facades\Gate;    //Gateモデルの参照
use Illuminate\Support\MessageBag; //バリデーションエラーメッセージの参照
use Illuminate\View\Middleware\ShareErrorsFromSession;

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
        } else {
            $isCorrect = false;
        }

        //ビューで受け取ったquestion_idより値の大きくかつ、昇順で先頭のクイズのidを取得
        $nextQuestionId = Question::where('id', '>', $questionId)->first();

        $firstQuestionId = $questionId;

        // return view('quiz.index',compact('firstQuestionId'));

        return view('quiz.answer',[
            'isCorrect' =>  $isCorrect,
            'question' => $question,
            'userAnswer' => $userAnswer,
            'nextQuestionId' => $nextQuestionId
        ]);

        //サンプル。91行目をcompact関数で記載すると下記になる。
        //return view('quiz.answer', compact('isCorrect', 'question', 'userAnswer', 'nextQuestionId')); 
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
    public function destroy(Request $request,$questionId)
    {
        //adminの権限を持っていなかったら、403エラーを発生させる
        if(!Gate::allows('admin')){
            abort(403);
        }else{
        //ビューで受け取ったquestion_id
        $deleteQuestionId = $request->input('question_id');

        // idの値で問題を検索して取得   
        $question = Question::findOrFail($deleteQuestionId);
        $question->delete();

        // 削除したら一覧画面にリダイレクト
        return redirect()->route('quiz.list')->with('success', "クイズID:{$deleteQuestionId}の削除が完了しました。");
        }
    }

}
