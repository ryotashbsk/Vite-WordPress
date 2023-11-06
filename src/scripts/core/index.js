import barba from '@barba/core';
import gsap from 'gsap';
import routes from '@/routes';
import { DomUtil } from '@/utils/DomUtil';
import { CommonUtil } from '@/utils/CommonUtil';
import { ScrollUtil } from '@/utils/ScrollUtil';

export default class Core {
  #dataRoute = document.querySelector('.app').dataset.route;

  constructor() {
    CommonUtil.reloadAtResized();
    this.#init();
  }

  async #init() {
    this.#routeInit();
  }

  /*
   * data-route属性と
   * src/scripts/routes/xx.jsのファイルが一致したら実行
   */

  #routeInit() {
    console.log(this.#dataRoute);
    if (this.#dataRoute && routes.get(this.#dataRoute)) {
      const App = routes.get(this.#dataRoute);
      const app = new App();
    }
  }
}
