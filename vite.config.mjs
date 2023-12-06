import { defineConfig } from 'vite';
import liveReload from 'vite-plugin-live-reload';
import sassGlobImports from 'vite-plugin-sass-glob-import';
import config from './config.json';

export default defineConfig({
  server: {
    host: '0.0.0.0',
    port: 3000,
    open: 'http://localhost'
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

    minify: 'terser',

    terserOptions: {
      compress: {
        // ビルド時console.logを削除
        drop_console: true
      }
    }
  },

  css: {
    devSourcemap: true
  },

  resolve: {
    alias: [{ find: '@/', replacement: '/src/scripts/' }]
  },

  // プラグイン
  plugins: [sassGlobImports(), liveReload([__dirname + '/dist/**/*.php'])]
});
