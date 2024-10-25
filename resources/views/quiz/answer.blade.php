<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet" type="text/css">
    <title>解答</title>
</head>
<body>
    <div class="container">
        <h2>解答結果</h2>
        <p class="question">問題: {{ $question->question }}</p>
        
         <!--　問題の選択肢の番号と正解の番号にズレを調整　--> 
        <p class="select">あなたは選択肢{{ $userAnswer + 1 }}を選びました</p>

        @if ($isCorrect)
            <p>正解です！</p>
        @else
            <p>不正解です。正解は{{ $question->choices[$question->correct_choice - 1] }}です。</p>
        @endif

        <!--　次の問題があれば、次の問題のリンクを表示　--> 
        @if ($nextQuestionId)
            <a href="{{ route('quiz.show', ['questionId' => $nextQuestionId]) }}" class="link">次の問題へ</a>
        @else
            <p class="end">クイズが終了しました</p>
            <a href="/" class="link">トップページに戻る</a>
        @endif
    </div>
</body>
</html>