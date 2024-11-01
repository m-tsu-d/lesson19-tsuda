<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>解答</title>
</head>

<body class="flex flex-col items-center justify-center min-h-screen ">

<div class="text-center mb-8">
        <h1>解答結果</h1>
        <br>
        <p >問題: {{ $question->question }}</p>
        <br>
        
         <!-- 問題の選択肢の番号と正解の番号にズレを調整 --> 
        <p >あなたは選択肢{{ $userAnswer + 1 }} {{ $question->choices[$userAnswer] }}を選びました。</p>
        <br>

        @if ($isCorrect)
            <p class ="text-red-500">正解です！</p>
        @else
        <p class ="text-red-500">不正解です。正解は{{ $question->choices[$question->correct_choice - 1] }}です。</p>
        @endif

        <!-- 次の問題があれば、次の問題のリンクを表示 --> 
        @if ($nextQuestionId)
           <br>
            <a href="{{ route('quiz.show', ['questionId' => $nextQuestionId]) }}" class="link">次の問題へ</a>
        @else
           <br>
            <p class="end">クイズが終了しました。</p>
            <br>
            @if (!is_null($userKeyNumber)) 
            <p class="text-green-500">ダイヤル鍵の番号は{{ $userKeyNumber }}です！</p>
            @else
            <p class="message_retry">全問正解を目指して、レッツ・ワンモア・トライ！</p>
            @endif
            <br>
            <a href="/" class="link">トップページに戻る</a>
        @endif
    </div>
</body>
</html>