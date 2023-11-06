import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollToPlugin } from 'gsap/all';
gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(ScrollToPlugin);
import { CommonUtil } from '@/utils/CommonUtil';

export class ScrollUtil {
  static observeScroll() {
    const elms = document.querySelectorAll('[data-scroll-show]');
    const elmsArray = Array.prototype.slice.call(elms, 0);

    const options = {
      root: null,
      rootMargin: '0px 0px -50px',
      threshold: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1]
    };
    const observer = new IntersectionObserver(doWhenIntersect, options);
    elmsArray.forEach(function (elm) {
      observer.observe(elm);
    });

    /**
     * 交差したときに呼び出す関数
     * @param entries
     */
    const doWhenIntersect = (entries) => {
      const entriesArray = Array.prototype.slice.call(entries, 0);
      entriesArray.forEach(function (entry) {
        if (entry.isIntersecting) {
          // entry.target.classList.add('js-show');
        }
      });
    };
  }

  static observeScrollGsap() {
    const elms = document.querySelectorAll('[data-scroll-show]');
    elms.forEach((elm) => {
      if (elm.getAttribute('data-scroll-show') == 'fadeUp') {
        gsap.to(elm, {
          duration: 0.75,
          ease: 'power2.out',
          y: 0,
          opacity: 1,
          delay: 0.25,
          scrollTrigger: {
            trigger: elm,
            start: 'top 75%'
          }
        });
      }

      if (elm.getAttribute('data-scroll-show') == 'bounce-text') {
        gsap.to(elm.querySelectorAll('span'), {
          duration: 0.8,
          ease: 'elastic.out(1, 0.4)',
          stagger: 0.05,
          scale: 1,
          scrollTrigger: {
            trigger: elm,
            start: 'top 75%'
          }
        });
      }

      if (elm.getAttribute('data-scroll-show') == 'draw-line') {
        gsap.to(elm, {
          duration: 0.75,
          ease: 'power2.out',
          scaleX: 1,
          scrollTrigger: {
            trigger: elm,
            start: 'top 75%'
          }
        });
      }
    });
  }

  static scrollAnchor() {
    const scroll = (targetLink) => {
      console.log(targetLink);
      const target = document.getElementById(targetLink);

      const rect = target.getBoundingClientRect();
      const scrollTop = window.pageYOffset || window.pageYOffset;
      const position = rect.top + scrollTop;

      gsap.to(window, {
        duration: 1,
        ease: 'power2.inOut',
        scrollTo: position
      });
    };

    // 通常のアンカーリンク
    const anchors = document.querySelectorAll('[data-anchor]');
    if (anchors.length > 0) {
      anchors.forEach((elm) => {
        elm.addEventListener('click', (e) => {
          e.preventDefault();
          const href = e.currentTarget.getAttribute('data-anchor');
          scroll(href);
        });
      });
    }

    // urlハッシュ
    const anchor = CommonUtil.getParam('anchor');
    if (anchor) {
      CommonUtil.wait(500).then(() => {
        scroll(anchor);
      });
    }
  }
}
