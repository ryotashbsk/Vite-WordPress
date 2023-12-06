import { readFile } from 'fs/promises';
import { rimraf } from 'rimraf';
const config = JSON.parse(await readFile(new URL('../config.json', import.meta.url)));
const manifest = `${config.outputPath}.vite/manifest.json`;

rimraf(manifest).then(() => {
  const yellow = '\u001b[33m';
  var reset = '\u001b[0m';
  console.log(`${yellow}rimraf ${manifest} ${reset}`);
});
