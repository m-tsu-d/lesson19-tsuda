<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>問題一覧</title>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="container">
        <h2 class="text-xl font-bold mb-4 text-center">削除するクイズを選択する</h2>
        
        @if (session('success'))
            <div class="success mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <form action="{{ route('quiz.destroy') }}" method="post">
            @csrf
            @method('DELETE')

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 p-2">選択</th>
                            <th class="border border-gray-300 p-2">クイズID</th>
                            <th class="border border-gray-300 p-2">問題文</th>
                            <th class="border border-gray-300 p-2">選択肢１</th>
                            <th class="border border-gray-300 p-2">選択肢２</th>
                            <th class="border border-gray-300 p-2">選択肢３</th>
                            <th class="border border-gray-300 p-2">正解</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td class="border border-gray-300 p-2"><input type="checkbox" name="question_ids[]" value="{{ $question->id }}"></td>
                                <td class="border border-gray-300 p-2">{{ $question->id }}</td>
                                <td class="border border-gray-300 p-2">{{ $question->question }}</td>
                                <td class="border border-gray-300 p-2">{{ $question->choices[0] }}</td>
                                <td class="border border-gray-300 p-2">{{ $question->choices[1] }}</td>
                                <td class="border border-gray-300 p-2">{{ $question->choices[2] }}</td>
                                <td class="border border-gray-300 p-2">{{ $question->correct_choice }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <button type="submit" class="btn btn-primary btn-block normal-case" onClick="return confirm('選択したクイズを本当に削除しますか?');">削除</button>
        </form>

        <div class="mt-4 text-center">
            <a href="/" class="text-blue-500">トップページに戻る</a>
        </div>
    </div>
</body>
</html>
