<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>クイズ出題</title>
</head>

<body class="flex flex-col items-center justify-center min-h-screen">

    <div class="text-center mb-8">
     <!-- コントローラーから$questionを受け取り、問題文を表示 --> 
    <h1>{{ $question->question }}</h1>

    <br>
         <div class="question-wrap">
        <form action="{{ route('quiz.answer',['questionId' => $question->id]) }}" method="get">
            <!-- ユーザーによる入力フォームなので、CSRF対策を行う -->
            <!-- CSRF保護ミドルウェアがリクエストを検証 -->
             @csrf
            <!-- 問題のidカラムの値を取得 --> 
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <!-- $question->choicesは配列型。$indexがkeyで$choiceがvalue -->
            @foreach($question->choices as $index => $choice)
              <div class="flex items-center mb-2">
                   <label class="flex items-center">
                        <input type="radio" name="choice" value="{{ $index }}" required class="mr-2">
                        <span class="text-left">{{ $choice }}</span> 
                   </label>
                </div>
            @endforeach
            <br>
            <input type="submit" value="解答する" class="btn btn-primary btn-block normal-case">  
        </form>
    </div>

    </div>
    
</body>
</html>
