# Vite-WordPress

#### コマンド

| Command              | Description                                               |
| -------------------- | --------------------------------------------------------- |
| **`dev`**            | フロントエンド起動                                        |
| **`build`**          | フロントエンドビルド                                      |
| **`lint:stylelint`** | scss/cssのリンター実行                                    |
| **`docker:init`**    | Docker初期化                                              |
| **`docker:start`**   | Docker起動                                                |
| **`docker:stop`**    | Docker停止                                                |
| **`wpdb-export`**    | ローカルDBエクスポート（./docker/mysql/initdb.sqlに出力） |
| **`wpdb-import`**    | ローカルDBインポート                                      |

#### ローカル環境 URL

| URL                           | 説明                                          | ID/PW            |
| ----------------------------- | --------------------------------------------- | ---------------- |
| http://localhost              | /distをドキュメントルートとしたローカルサイト |                  |
| http://localhost/wp-login.php | ローカル WordPress 管理画面                   | admin / password |
| http://localhost:8888         | ローカル phpMyAdmin                           |                  |
