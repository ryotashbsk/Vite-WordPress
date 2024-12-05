import { defineConfig } from 'vite';
import liveReload from 'vite-plugin-live-reload';
import sassGlobImports from 'vite-plugin-sass-glob-import';
import path from 'path';
import config from './constants.json';
const isDevelopment = process.env.NODE_ENV === 'development';

export default defineConfig({
  server: {
    // 開発サーバー起動時に自動的にブラウザを開く
    open: 'http://localhost',

    // ローカルネットワーク上で他のデバイスからアクセス可能にする
    host: true
  },

  // サイトのルートパス
  // サブディレクトリで起動する際は'/sub-directly/'とする
  base: config.pathPrefix,

  build: {
    // ビルド先
    outDir: `${config.outputPath}`,

    assetsDir: `.`,

    // outDirにmanifest.jsonを作成
    manifest: true,

    rollupOptions: {
      // エントリーポイント
      input: config.entryPoint
    },

    // Top-level awaitを使うためにビルドターゲットを変更
    target: ['es2022', 'edge89', 'firefox89', 'chrome89', 'safari15'],

    // JavaScriptの圧縮方法を指定（'terser'を使用）
    minify: 'terser',

    terserOptions: {
      compress: {
        // ビルド時にconsole.logなどのコンソール出力を削除
        drop_console: true
      }
    }
  },

  css: {
    // 開発モードでCSSのソースマップを生成
    devSourcemap: true,

    preprocessorOptions: {
      scss: {
        // TODO: Dart Sass 2.0.0までの暫定対応
        silenceDeprecations: ['legacy-js-api'],

        // dockerのlocalhostからbackground-imageを読み込むために、開発中はは絶対パスを渡す
        additionalData: `$src: "${isDevelopment ? 'http://localhost:5173/src' : '/src'}";`
      }
    }
  },
	
	
  resolve: {
    alias: [{ find: '@/', replacement: '/src/scripts/' }]
  },

  // プラグイン
  plugins: [sassGlobImports(), liveReload([__dirname + '/dist/**/*.php'])]
});
