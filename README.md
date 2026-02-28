# アプリケーション名
フリマアプリ

## アプリ概要
ユーザーが商品を出品・購入できるフリマアプリです。
会員登録機能、ログイン機能、商品出品機能、購入機能、コメント機能、お気に入り機能を実装しています。
---

## 主な機能一覧

### ■ 商品関連
- 商品一覧表示
- 商品詳細表示
- 商品出品
- 商品購入
- カテゴリー複数選択
- 商品状態選択

### ■ ユーザー関連
- 会員登録
- ログイン / ログアウト
- プロフィール表示
- プロフィール編集
- 出品商品一覧表示
- 購入商品一覧表示

### ■ その他機能
- お気に入り機能
- コメント投稿機能
- 送付先住所変更機能

---
## 環境構築
Dockerビルド
1. `git clone git@github.com:mitoyuu/flea-market-app.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`（初回起動時のみ実行）

> *MacのM1・M2チップのPCの場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができないことがあります。
エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加で記載してください*
``` bash
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```
**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```

6. マイグレーションの実行
``` bash
php artisan migrate
```

7. シーディングの実行
``` bash
php artisan db:seed
```

## 使用技術
・PHP 8.2.11
・Laravel ８.83.8
・MySQL 8.0.26・
・nginx 1.21.1

## ER図
![ER図](public/img/erd.png)

## URL
開発環境
- 商品一覧画面（トップ画面）：http://localhost/
- 商品一覧画面（トップ画面）_マイリスト：http://localhost/?tab=mylist/
- 会員登録画面：http://localhost/register/
- ログイン画面：http://localhost/login/
- ログアウト：(管理画面から操作/URLなし)
- 商品詳細画面：http://localhost/item/{item_id}
- 商品購入画面：http://localhost/purchase/{item_id}/
- 送付先住所変更画面：http://localhost/purchase/address/{item_id}/
- 商品出品画面：http://localhost/sell/
- プロフィール画面：http://localhost/mypage/
- プロフィール編集画面（設定画面）：http://localhost/mypage/profile/
- プロフィール画面_購入した商品一覧：http://localhost/mypage?page=buy/
- プロフィール画面_出品した商品一覧：http://localhost/mypage?page=sell/
- 検索：http://localhost/search?input=/
- phpMyAdmin：http://localhost:8080/

## 今後の改善点
- 決済機能（Stripe）の本実装
- バリデーションの最適化
- 画像保存形式の統一
- UI/UXの改善
- 商品購入時の排他制御の強化
- データベース設計の最適化