import '../styles/main.scss';
import barba from '@barba/core';
import { BarbaManager } from '@/ui/BarbaManager';
import { CommonUtil } from '@/utils/CommonUtil';
import { UA } from '@/utils/UA';
import Core from './core/';
import { HeaderAnim } from '@/ui/HeaderAnim';

UA.set();
let core;
let headerAnim;

// gtag('config', 'XXXXXX', {
//   send_page_view: false
// });

document.body.classList.remove('preload');
headerAnim = new HeaderAnim();
core = new Core();

BarbaManager.init(() => {
  core = new Core();
  headerAnim = new HeaderAnim();
});

barba.hooks.leave(() => {
  if (core !== null) {
    core = null;
  }

  if (headerAnim !== null) {
    headerAnim = null;
  }
});
