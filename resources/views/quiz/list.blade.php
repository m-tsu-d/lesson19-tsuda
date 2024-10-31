<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
<h2>削除するクイズを選択する</h2>
    @if (session('success'))
       <div class="success">{{ session('success') }}</div>
    @endif

     <form action="{{ route('quiz.destroy') }}" method="post">
     @csrf
     @method('DELETE')

    <table>
        <thead>
            <tr>
                <th>選択</th>
                <th>クイズID</th>
                <th>問題文</th>
                <th>選択肢１</th>
                <th>選択肢２</th>
                <th>選択肢３</th>
                <th>正解</th>
                <th>アクション</th>
            </tr>
        </thead>

        <tbody>
            @foreach($questions as $question)
            <tr>
                <td><input type="checkbox" name="question_ids[]" value="{{ $question->id }}"></td>
                <td>{{$question->id}}</td>
                <td>{{$question->question}}</td>
                <td>{{$question->choices[0]}}</td>
                <td>{{$question->choices[1]}}</td>
                <td>{{$question->choices[2]}}</td>
                <td>{{$question->correct_choice}}</td>
            </tr>
            @endforeach
        </tbody>
     </table>

     <button type="submit" class="btn btn-error btn-sm normal-case" onClick="return confirm('選択したクイズを本当に削除しますか?');">削除</button>
     </form>
</div>

    <div class="link">
        <a href="/" class="link">トップページに戻る</a>
    </div>
</body>
</html>