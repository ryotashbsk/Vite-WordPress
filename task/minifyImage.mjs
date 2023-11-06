import { readFile } from 'fs/promises';
import imagemin from 'imagemin-keep-folder';
import imageminMozjpeg from 'imagemin-mozjpeg';
import imageminPngquant from 'imagemin-pngquant';
import imageminGifsicle from 'imagemin-gifsicle';
import imageminSvgo from 'imagemin-svgo';
const config = JSON.parse(await readFile(new URL('../config.json', import.meta.url)));

(async () => {
  await imagemin([`${config.outputPath}/../**/*.{jpg,png,gif,svg,ico,webp}`], {
    destination: `${config.outputPath}/../images`,
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
  }).then((images) => {
    const yellow = '\u001b[33m';
    const grey = '\x1b[2m';
    const reset = '\u001b[0m';

    console.log(`\n${yellow}✓${reset} ${images.length} images optimization completed.`);

    images.forEach((img) => {
      console.log(`${grey}${img.path}${reset}`);
    });
  });
})();
