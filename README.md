# Vite-WordPress

#### コマンド

| Command                             | Description                                               |
| ----------------------------------- | --------------------------------------------------------- |
| **`dev`**                           | フロントエンド起動                                        |
| **`build`**                         | フロントエンドビルド                                      |
| **`lint:stylelint`**                | scss/cssのリンター実行                                    |
| **`docker:init`**                   | Docker初期化                                              |
| **`docker:start`**                  | Docker起動                                                |
| **`docker:stop`**                   | Docker停止                                                |
| **`docker:delete`**                 | Dokcerコンテナ・ネットワーク・ボリューム・イメージを削除  |
| **`task:format`**                   | prettierによるソースのフォーマット                        |
| **`task:clean`**                    | Viteのmanifest.json削除                                   |
| **`task:optimize-images:watch`**    | 画像の差分監視&圧縮                                       |
| **`task:optimize-images:no-watch`** | 画像の圧縮(ビルド時など一度しか実行したいときに使用)      |
| **`task:export-wp-db`**             | ローカルDBエクスポート（./docker/mysql/initdb.sqlに出力） |
| **`task:import-wp-db`**             | ローカルDBインポート                                      |
| **`task:setup-wp`**                 | WordPressのセットアップ                                   |
| **`task:zip-theme`**                | WordPressテーマのzip圧縮（リポジトリのルートに出力）      |

#### ローカル環境 URL

| URL                           | 説明                                          | ID/PW            |
| ----------------------------- | --------------------------------------------- | ---------------- |
| http://localhost              | /distをドキュメントルートとしたローカルサイト |                  |
| http://localhost/wp-login.php | ローカル WordPress 管理画面                   | admin / password |
| http://localhost:8888         | ローカル phpMyAdmin                           |                  |
