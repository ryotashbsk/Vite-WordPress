import '../styles/main.scss';
import core from './core/';
import { setUA } from './utils/ua';

window.addEventListener('load', () => document.documentElement.classList.remove('preload'));
setUA();
core();
