import barba from '@barba/core';
import { DomUtil } from '@/utils/DomUtil';
import { UA } from '@/utils/UA';

export class CommonUtil {
  static isDebug = this.getParam('debug');
  static isTouch = 'ontouchstart' in window;

  static debug() {
    if (this.isDebug) {
      DomUtil.findAll('a').forEach((elm) => {
        const href = elm.getAttribute('href');
        elm.setAttribute('href', `${href}?debug=1`);
      });
    }
  }

  static wait(waitTime) {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve();
      }, waitTime);
    });
  }

  static getParam(str) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(str);
  }

  static hasParam(str) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.has(str);
  }

  static splitText() {
    const elms = document.querySelectorAll('[data-split-text]');
    elms.forEach((elm) => {
      const text = elm.textContent;
      elm.innerHTML = '';
      text.split('').forEach((t) => {
        const _t = t == ' ' ? '&nbsp;' : t;
        elm.innerHTML += '<span>' + _t + '</span>';
      });
    });
  }

  static mediaQuery(device, cb) {
    const mq = window.matchMedia('(min-width: 751px)');
    const handle = (q) => {
      if (device == 'pc' && q.matches) {
        cb();
      } else if (device == 'sp' && !q.matches) {
        cb();
      }
    };
    handle(mq);
  }

  static reloadAtResized() {
    const mq = window.matchMedia('(min-width: 751px)');
    const handle = (q) => {
      if (q.matches) {
        window.location.reload();
      } else {
        window.location.reload();
      }
    };
    mq.addEventListener('change', handle);

    barba.hooks.leave(() => {
      mq.removeEventListener('change', handle);
    });
  }

  static onlyResized(cb) {
    let vw = window.innerWidth;

    const resize = () => {
      if (vw === window.innerWidth) {
        // 画面の横幅にサイズ変動がないので処理を終える
        return;
      }

      // 画面の横幅のサイズ変動があった時のみ高さを再計算する
      vw = window.innerWidth;
      cb();
    };

    window.addEventListener('resize', resize);

    barba.hooks.leave(() => {
      window.removeEventListener('resize', resize);
    });
  }
}
