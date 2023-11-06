import gsap from 'gsap';
import barba from '@barba/core';
import { UA } from '@/utils/UA';
import { CommonUtil } from '@/utils/CommonUtil';
import { DomUtil } from '@/utils/DomUtil';
import { BarbaUtil } from '@/utils/BarbaUtil';
import barbaPrefetch from '@barba/prefetch';

export class BarbaManager {
  static init(cb) {
    barba.use(barbaPrefetch);
    barba.init({
      debug: process.env.NODE_ENV == 'development',
      prevent: ({ elm }) => (UA.IE ? elm.getAttribute('href') : false),
      timeout: 10000,
      transitions: [
        {
          before(data) {},
          beforeEnter(data) {
            console.log(data);
            BarbaUtil.replaceHeadTags(data.next);
          },
          async beforeLeave(data) {
            gsap.to('.wrapper', {
              duration: 0.25,
              opacity: 0,
              onComplete: () => {}
            });
          },
          async leave(data) {
            await new Promise((resolve) => {
              return setTimeout(resolve, 350);
            });
          },
          enter(data) {
            gsap.to('.wrapper', {
              duration: 0.5,
              opacity: 1
            });
          },
          after(data) {
            cb();
            // BarbaUtil.pushGA();
          },
          afterEnter(data) {}
        }
      ]
    });
  }
}
