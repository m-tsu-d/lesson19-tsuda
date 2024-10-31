<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet" type="text/css">
    <meta name=”robots” content=”noindex” />
    <title>問題の作成</title>
</head>

<body>
    <div class="container">
        <h2>3択クイズを作る</h2>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('quiz.store') }}" method="post">
            @csrf
            <div>
                <label class="label">問題文 : </label>
                <input type="text" name="question" class="input" value="{{ old('question') }}">
                @error('question')
                <div class="error">問題文は必ず入力してください。</div>
                @enderror
            </div>
            <div>
                <label class="label">選択肢1 : </label>
                <input type="text" name="choices[0]" class="input" value="{{ old('choices.0') }}">
            </div>
            <div>
                <label class="label">選択肢2 : </label>
                <input type="text" name="choices[1]" class="input" value="{{ old('choices.1') }}">
            </div>
            <div>
                <label class="label">選択肢3 : </label>
                <input type="text" name="choices[2]" class="input" value="{{ old('choices.2') }}">
                @if ($errors->has('choices.0') || $errors->has('choices.1') || $errors->has('choices.2'))
                <div class="error">選択肢は必ず3つ入力してください。</div>
                 @endif

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

    <div class="link">
        <a href="/" class="link">トップページに戻る</a>
    </div>

</body>
</html>