import barba from '@barba/core';
import gsap from 'gsap';
import routes from '@/routes';
import { DomUtil } from '@/utils/DomUtil';
import { CommonUtil } from '@/utils/CommonUtil';
import { ScrollUtil } from '@/utils/ScrollUtil';

export default class Core {
  constructor() {
    this._dataRoute = document.querySelector('.app').dataset.route;
    CommonUtil.reloadAtResized();
    this._init();
  }

  async _init() {
    this._routeInit();
  }

  /*
   * data-route属性と
   * src/scripts/routes/xx.jsのファイルが一致したら実行
   */

  _routeInit() {
    console.log(this._dataRoute);
    if (this._dataRoute && routes.get(this._dataRoute)) {
      const App = routes.get(this._dataRoute);
      const app = new App();
    }
  }
}
