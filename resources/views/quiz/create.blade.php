<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>問題作成</title>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="container">
        <h2 class="text-xl font-bold mb-4 text-center">3択クイズを作る</h2>

        @if (session('success'))
            <div class="success mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <form action="{{ route('quiz.store') }}" method="post">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-medium">問題文 :</label>
                <input type="text" name="question" class="border border-black p-2 w-full" value="{{ old('question') }}">
                @error('question')
                <div class="text-red-600">問題文は必ず入力してください。</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">選択肢1 :</label>
                <input type="text" name="choices[0]" class="border border-black p-2 w-full" value="{{ old('choices.0') }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">選択肢2 :</label>
                <input type="text" name="choices[1]" class="border border-black p-2 w-full" value="{{ old('choices.1') }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">選択肢3 :</label>
                <input type="text" name="choices[2]" class="border border-black p-2 w-full" value="{{ old('choices.2') }}">
                @if ($errors->has('choices.0') || $errors->has('choices.1') || $errors->has('choices.2'))
                <div class="text-red-600">選択肢は必ず3つ入力してください。</div>
                @endif
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">正解の選択肢 :</label>
                <select name="correct_choice" class="border border-black p-2 w-full">
                    <option value="1">選択肢1</option>
                    <option value="2">選択肢2</option>
                    <option value="3">選択肢3</option>
                </select>
            </div>
            <input type="submit" value="登録する" class="btn btn-primary btn-block normal-case">
        </form>
        
        <br>
        <a href="/" class="mt-4 text-center">トップページに戻る</a>

    </div>

</body>
</html>
