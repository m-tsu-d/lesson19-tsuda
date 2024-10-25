<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet" type="text/css">
    <meta name=”robots” content=”noindex”/>
    <title>問題の作成</title>
</head>
<body>
    <div class="container">
        <h2>3択クイズを作る</h2>
        <form action="{{ route('quiz.store') }}" method="post">
            @csrf
            <div>
                <label class="label">問題文 : </label>
                <input type="text" name="question" class="input">
            </div>
            <div>
                <label class="label">選択肢1 : </label>
                <input type="text" name="choices[]" class="input">
            </div>
            <div>
                <label class="label">選択肢2 : </label>
                <input type="text" name="choices[]" class="input">
            </div>
            <div>
                <label class="label">選択肢3 : </label>
                <input type="text" name="choices[]" class="input">
            </div>
            <div>
                <label class="label">正解の選択肢</label>
                <select name="correct_choice">
                    <option value="1">選択肢1</option>
                    <option value="2">選択肢2</option>
                    <option value="3">選択肢3</option>
                </select>
            </div>
            <input type="submit" value="登録する" class="store">
        </form>
    </div>
</body>
</html>