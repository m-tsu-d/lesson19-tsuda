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
<h2>アカウント一覧</h2>
@if (session('success'))
       <div class="success">{{ session('success') }}</div>
@endif

   
<form action="{{ route('quiz.updateKeyNumbers') }}" method="POST">
        @csrf

    <table>
        <thead>
            <tr>
                <th>選択</th>
                <th>ユーザーID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>キー番号</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td><input type="checkbox" name="user_ids[]" value="{{ $user->id }}"></td>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><input type="number" name="key_numbers[{{ $user->id }}]" class="input" value="{{ $user->key_number }}" ></td>
            </tr>
            @endforeach
        </tbody>
     </table>

     <button type="submit" class="btn">キー番号を更新</button>
    </form>
</div>

    <div class="link">
        <a href="/" class="link">トップページに戻る</a>
    </div>
</body>
</html>