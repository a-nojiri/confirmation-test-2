# もぎたて(商品管理システム)

## 環境構築
1. git clone git@github.com:a-nojiri/confirmation-test-2.git
2. DOckerDesktopアプリを立ち上げる
3. docker-compose up -d --build
   ＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集して下さい。
4.「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
5. .envに以下の環境変数を追加
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel_db
   DB_USERNAME=laravel_user
   DB_PASSWORD=laravel_pass
6. php artisan key:generate
7. php artisan migrate
8. php artisan db:seed
   
## 使用技術(実行環境)
・　
