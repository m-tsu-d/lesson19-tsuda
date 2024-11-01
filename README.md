# 贈り物にワクワク体験を添える３択クイズアプリ
【こんなシーンでご利用いただけます。】
友人への贈り物にダイヤル鍵をかける。
このアプリのurlとログイン情報を記したカードを添える。
それだけで、離れてい暮らす友人とワクワクする体験を共有できます！

## ログイン／ユーザー登録
プレゼントの送り先のアカウントは作成済みです。
送られてきたカードの情報をもとに、画面中央にある「ログイン」ボタンからログインできます。
<img width="1438" alt="スクリーンショット 2024-11-01 17 29 58" src="https://github.com/user-attachments/assets/00d9b9cc-3d57-4bcd-b305-b2de2790a0a6">
※自分でアカウント登録して、単純にクイズを楽しむこともできます。

## ３択クイズに挑戦
「クイズに挑戦！」ボタンを押すと、３択クイズが始まります。
<img width="1409" alt="スクリーンショット 2024-11-01 17 34 56" src="https://github.com/user-attachments/assets/7cdc92ff-7c60-4fe1-84f0-c112040eae47">
<img width="1430" alt="スクリーンショット 2024-11-01 17 37 09" src="https://github.com/user-attachments/assets/1819e2c8-ad78-4fcf-ad9a-ce4cd61fadd9">
クイズに全問正解すると、ダイヤル鍵の番号が表示されます。
この番号で、贈り物にかけられたダイヤル鍵を解錠できます。
<img width="1416" alt="スクリーンショット 2024-11-01 17 38 12" src="https://github.com/user-attachments/assets/a4d91e93-8100-4604-b42d-71c262737f53">
※１つでも間違えると、ダイヤル鍵の番号が表示されません。
　同じ問題に繰り返し挑戦することができます。
※自分でアカウント登録した方には、ダイヤル鍵の番号は表示されません。

## ３つの管理者用メニュー
管理者権限のあるアカウントでログインすると、「クイズに挑戦！」以外に３つの管理者用メニューが表示されます。
<img width="1418" alt="スクリーンショット 2024-11-01 17 45 38" src="https://github.com/user-attachments/assets/cc085999-9b5e-4f32-ab7e-f950fc628730">

## クイズを作る
フォーマットに沿って、新しい３択クイズを作ることができます。
<img width="1426" alt="スクリーンショット 2024-11-01 17 47 01" src="https://github.com/user-attachments/assets/48b63ee8-ac2c-4c17-9f6a-035102254a3b">

## クイズを削除する
登録済みの３択クイズを一覧で確認することができます。
出題したくない３択クイズは、選択して削除することができます。
<img width="1440" alt="スクリーンショット 2024-11-01 17 50 16" src="https://github.com/user-attachments/assets/3e512f8d-38a9-4c11-b6f3-a829036114eb">

## アカウントを管理する
登録済みの一覧を確認することができます。
指定のアカウントに送るダイヤル錠の番号を「キー番号」に登録します。
「キー番号」は変更ができます。
「キー番号」が空欄のアカウントは、３択クイズを純粋に楽しむことができます。
<img width="1415" alt="スクリーンショット 2024-11-01 17 53 48" src="https://github.com/user-attachments/assets/f4115f80-460c-4986-931c-0d0011440890">

## ローカル環境での起動手順
### ①マイグレーション実行後、３つのシーダーを実行。
*`php artisan db:seed --class=QuestionsTableSeeder`
*`php artisan db:seed --class=Role_UserTableSeeder`
*`php artisan db:seed --class=RolesTableSeeder`
### ②「アカウント登録」からアカウント作成。
*最初に作成されたアカウントに管理者権限が付与されます。
*２つ目以降のアカウントには、ユーザー権限が付与されます。
### ③管理者権限のアカウントでログインし、ユーザー権限のアカウントの「キー番号」を設定。
