<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet" type="text/css">
    <meta name=”robots” content=”noindex”/>
    <title>問題</title>
</head>
<body>
    <div class="container">
    <!-- コントローラーから$questionを受け取り、問題文を表示 --> 
    <h2>{{ $question->question }}</h2>
    <div class="question-wrap">
        <form action="{{ route('quiz.answer',['questionId' => $question->id]) }}" method="get">
            <!-- ユーザーによる入力フォームなので、CSRF対策を行う -->
            <!-- CSRF保護ミドルウェアがリクエストを検証 -->
             @csrf
            <!-- 問題のidカラムの値を取得 --> 
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <!-- $question->choicesは配列型。$indexがkeyで$choiceがvalue -->
            @foreach($question->choices as $index => $choice)
                <div>
                    <label>
                        <input type="radio" name="choice" value="{{ $index }}" required>
                        {{ $choice }}
                    </label>
                </div>
            @endforeach
            <input type="submit" value="解答する" class="answer">  
        </form>
    </div>
    </div>
</body>
</html>