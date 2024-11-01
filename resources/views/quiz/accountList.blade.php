<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>アカウント一覧</title>
</head>

<body class="flex items-center justify-center min-h-screen ">
    <div class="container">
        <h2 class="text-xl font-bold mb-4 text-center">アカウント一覧</h2>
        
        @if (session('success'))
            <div class="success mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <form action="{{ route('quiz.updateKeyNumbers') }}" method="POST">
            @csrf
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 p-2">選択</th>
                            <th class="border border-gray-300 p-2">ユーザーID</th>
                            <th class="border border-gray-300 p-2">名前</th>
                            <th class="border border-gray-300 p-2">メールアドレス</th>
                            <th class="border border-gray-300 p-2">キー番号</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="border border-gray-300 p-2"><input type="checkbox" name="user_ids[]" value="{{ $user->id }}"></td>
                                <td class="border border-gray-300 p-2">{{ $user->id }}</td>
                                <td class="border border-gray-300 p-2">{{ $user->name }}</td>
                                <td class="border border-gray-300 p-2">{{ $user->email }}</td>
                                <td class="border border-gray-300 p-2"><input type="number" name="key_numbers[{{ $user->id }}]" class="input border rounded" value="{{ $user->key_number }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <button type="submit" class="btn btn-primary btn-block normal-case">キー番号を更新</button>
        </form>

        <div class="mt-4 text-center">
            <a href="/" class="text-blue-500">トップページに戻る</a>
        </div>
    </div>
</body>
</html>