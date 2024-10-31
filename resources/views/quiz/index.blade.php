<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet" type="text/css">
    <title>3択クイズ</title>
</head>
<body>
    <div class="container">
        <h2>3択クイズ</h2>
        <div class="login">       
        @auth
                <!-- コントローラーから$firstQuestionIdを受け取る -->
                <!-- クイズが1問も作成されていない時は表示されない -->
                  @if($firstQuestionId)
                  <a href="{{ route('quiz.show',['questionId' => $firstQuestionId]) }}" class="quiz">クイズに挑戦</a>
                  @endif 
                
                  @can('admin')
                  <a href="{{ route('quiz.create') }}" class="quiz">（管理人用）クイズを作る</a>
                  <a href="{{ route('quiz.list') }}" class="quizList">（管理人用）クイズを削除する</a>
                  @endcan

                  <!-- ログアウトフォーム -->
                 <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                 @csrf
                <button type="submit" class="btn btn-logout">ログアウト</button>
                </form>

        @else
               <!-- ユーザーが認証されていない場合 -->
               <p class="notice">ログインしてクイズに挑戦！</p>
               <div>
                  <a href="{{ route('login') }}">ログイン</a>
                  <a href="{{ route('register') }}">アカウント登録</a>
               </div>
        @endif 
        </div>
    </div>
</body>
</html>