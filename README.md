# もぎたて(商品管理システム)

## 環境構築

1. git clone git@github.com:a-nojiri/confirmation-test-2.git
2. DOckerDesktopアプリを立ち上げる
3. docker-compose up -d --build
   
   ＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集して下さい。
4. docker-compose exec php bash(コンテナ内に入る)
5. composer install
6. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
7. `.env`に以下の環境変数を追加
    ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel_db
   DB_USERNAME=laravel_user
   DB_PASSWORD=laravel_pass
    
8. php artisan key:generate
9. php artisan migrate
10. php artisan db:seed
   
## 使用技術(実行環境)

 ･ PHP 8.0  
 
 ･ Laravel 8.x  
 
 ･ MySQL 8.0  
 
 ･ Docker  
 
 ･ Nginx  

 ## ER図
　


 ## URL
 
・ 開発環境：http://localhost/  

・ phpMyAdmin:：http://localhost:8080/
 
