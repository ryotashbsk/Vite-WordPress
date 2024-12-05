import chokidar from 'chokidar';
import { promises as fs } from 'fs';
import path from 'path';
import imagemin from 'imagemin';
import imageminMozjpeg from 'imagemin-mozjpeg';
import imageminPngquant from 'imagemin-pngquant';
import imageminGifsicle from 'imagemin-gifsicle';
import imageminSvgo from 'imagemin-svgo';
const constants = JSON.parse(await fs.readFile(path.resolve('constants.json')));

const inputDir = `src/images`; // 入力フォルダ
const outputDir = `${constants.outputPath}../images`; // 出力フォルダ

// 文字色
const green = '\u001b[32m';
const yellow = '\u001b[33m';
const red = '\u001b[31m';
const reset = '\u001b[0m';

// 監視用のchokidar watcher
const watcher = chokidar.watch(inputDir, {
  ignored: /(^|[\/\\])\../, // ドットで始まるファイルを除外（隠しファイル）
  persistent: true
});

// 画像圧縮処理
const compressImage = async (filePath) => {
  try {
    const relativePath = path.relative(inputDir, filePath); // 入力パスから相対パスを取得
    const outputFilePath = path.join(outputDir, relativePath); // 出力先ファイルのパス
    const outputDirPath = path.dirname(outputFilePath); // 出力先ディレクトリ
    console.log('🚀 ~ compressImage ~ outputDirPath:', outputDirPath);

    // 出力先ディレクトリがない場合は作成
    try {
      await fs.mkdir(outputDirPath, { recursive: true });
    } catch (error) {
      console.log(`${red} Error compressing ${outputDirPath}:${reset}`, error);
    }

    // 画像圧縮を実行
    const files = await imagemin([filePath], {
      destination: outputDirPath,
      plugins: [
        imageminMozjpeg({ quality: 80 }),
        imageminPngquant({ quality: [0.7, 0.85] }),
        imageminGifsicle(),
        imageminSvgo({
          plugins: [
            {
              name: 'removeViewBox',
              active: false
            }
          ]
        })
      ]
    });
    console.log(`${green}Compressed:${reset} ${filePath}`);
  } catch (error) {
    console.log(`${red} Error compressing ${filePath}:${reset}`, error);
  }
};

// watcherでのファイル変更監視
watcher
  .on('ready', () => console.log('Watching for image changes...'))
  .on('add', compressImage) // 新しいファイルが追加された場合
  .on('change', compressImage) // ファイルが変更された場合
  .on('unlink', async (filePath) => {
    // ファイルが削除された場合
    const relativePath = path.relative(inputDir, filePath);
    const outputFilePath = path.join(outputDir, relativePath);
    try {
      await fs.unlink(outputFilePath);
      console.log(`${yellow}Deleted:${reset} ${outputFilePath}`);
    } catch (error) {
      console.log(`${red} Failed to delete ${outputFilePath}:${reset}`, error);
    }
  });
