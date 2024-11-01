<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>3択クイズ</title>
</head>
<body class="flex flex-col items-center justify-center min-h-screen">

    <div class="text-center mb-8">
    <h1 class="text-8xl font-bold text-black" style="font-size: 30px;">3択クイズ</h1>
    <br>
        @auth
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-primary btn-block normal-case">
                    ログアウト
                </button>
            </form>
        @endauth
    </div>

    
    <div class="login space-y-4">
        @auth
            @if($firstQuestionId)
            <br>
            <div class="flex justify-center space-x-4">
            
                @if($firstQuestionId)
               
                <a href="{{ route('quiz.show',['questionId' => $firstQuestionId]) }}" class="btn btn-primary btn-block normal-case">
                    クイズに挑戦！全問正解するとダイヤル鍵の番号が明かされます。
                </a>
                @endif 
                
            </div>
            <br>
            @endif

            @can('admin')
                <div class="flex flex-col items-center space-y-4">
                
                    <a href="{{ route('quiz.create') }}" class="btn btn-primary btn-block normal-case">
                        （管理人用）クイズを作る
                    </a>
                    <br>
                    <a href="{{ route('quiz.list') }}" class="btn btn-primary btn-block normal-case">
                        （管理人用）クイズを削除する
                    </a>
                    <br>
                    <a href="{{ route('quiz.accountList') }}" class="btn btn-primary btn-block normal-case">
                        （管理人用）アカウント管理
                    </a>
                </div>
            
            @endcan
        @else
            <p class="text-lg font-semibold" >ログインしてクイズに挑戦！</p>
            <div class="flex flex-col items-center space-y-4">
                <a href="{{ route('login') }}" class="btn btn-primary btn-block normal-case">
                    ログイン
                </a>
                <br>
                <a href="{{ route('register') }}" class="btn btn-primary btn-block normal-case">
                    アカウント登録
                </a>
            </div>
        @endif 
    </div>
    
</body>
</html>
