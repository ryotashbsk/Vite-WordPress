import { readFile } from 'fs/promises';
import path from 'path';
import { rimraf } from 'rimraf';

const constants = JSON.parse(await readFile(path.resolve('constants.json')));
const manifest = `${constants.outputPath}.vite/manifest.json`;

rimraf(manifest).then(() => {
  const yellow = '\u001b[33m';
  var reset = '\u001b[0m';
  console.log(`${yellow}rimraf ${manifest} ${reset}`);
});
