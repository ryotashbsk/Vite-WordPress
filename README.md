# Vite-WordPress

#### コマンド

| Command                  | Description                                               |
| ------------------------ | --------------------------------------------------------- |
| **`dev`**                | フロントエンド起動                                        |
| **`build`**              | フロントエンドビルド                                      |
| **`optimize-images`**    | 画像の差分監視&圧縮                                       |
| **`lint:stylelint`**     | scss/cssのリンター実行                                    |
| **`docker:init`**        | Docker初期化                                              |
| **`docker:start`**       | Docker起動                                                |
| **`docker:stop`**        | Docker停止                                                |
| **`docker:delete`**      | Dokcerコンテナ・ネットワーク・ボリューム・イメージを削除  |
| **`shell:export-wp-db`** | ローカルDBエクスポート（./docker/mysql/initdb.sqlに出力） |
| **`shell:import-wp-db`** | ローカルDBインポート                                      |
| **`shell:setup-wp`**     | WordPressのセットアップ                                   |
| **`zip-theme`**          | WordPressテーマのzip圧縮（リポジトリのルートに出力）      |

#### ローカル環境 URL

| URL                           | 説明                                          | ID/PW            |
| ----------------------------- | --------------------------------------------- | ---------------- |
| http://localhost              | /distをドキュメントルートとしたローカルサイト |                  |
| http://localhost/wp-login.php | ローカル WordPress 管理画面                   | admin / password |
| http://localhost:8888         | ローカル phpMyAdmin                           |                  |
