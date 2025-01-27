# アプリケーション名
　もぎたて
## 環境構築
　Dockerビルド
　　1. git clone git@github.com:hshino0561/mogitate.git
　　2. docker-compose up -d --build

　※各種コンテナが起動しない場合は、PCの環境に合わせてdocker-compose.ymlファイルを編集してください。

　Laravel環境構築
　　1. docker-compose exec php bash
　　2. composer install
　　3. .env.exampleファイルから.envを作成し、環境変数を変更
　　4. php artisan key:generate
　　5. php artisan migrate
　　6. php artisan db:seed
　　7. php artisan storage:link

## 使用技術(実行環境)
　　・PHP 8.1.1
　　・Laravel 8.83.29
　　・MySQL 8.0.26
　　・Nginx 1.21.1
　　・Bootstrap

## ER図
　　・ER.drawio.svg

## URL
　　・開発環境：http://localhost/
　　・phpMyAdmin：http://localhost:8080

## 未実装内容
　　・並び替え機能
　　・一部のバリデーションチェック：値段：値段が数値で入力されていない場合：数値で入力してください
　　　調整不足でもありますが、数値のみ入力許可に伴い未実装です。

## 調整不足内容
　　・レイアウト調整
　　・検索結果の表示内容
　　・画像回りのバリデーションチェック

