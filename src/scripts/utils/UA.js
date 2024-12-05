import { UAParser } from 'ua-parser-js';

const uap = new UAParser();
const result = uap.getResult();

export const ua = {
  pc: result.device.type !== 'tablet' && result.device.type !== 'mobile',
  tablet: result.device.type === 'tablet',
  sp: result.device.type === 'mobile',
  ios: result.os.name === 'iOS',
  android: result.os.name === 'Android',
  windows: result.os.name === 'Windows',
  ie: result.browser.name === 'IE',
  edge: result.browser.name === 'Edge',
  chrome: result.browser.name === 'Chrome',
  firefox: result.browser.name === 'Firefox',
  safari: result.browser.name === 'Safari' || result.browser.name === 'Mobile Safari'
};

export function setUA() {
  [
    {
      ua: ua.pc,
      class: 'ua-pc'
    },
    {
      ua: ua.tablet,
      class: 'ua-tablet'
    },
    {
      ua: ua.sp,
      class: 'ua-sp'
    },
    {
      ua: ua.android,
      class: 'ua-android'
    },
    {
      ua: ua.ie,
      class: 'ua-ie'
    },
    {
      ua: ua.windows,
      class: 'ua-windows'
    },
    {
      ua: ua.safari,
      class: 'ua-safari'
    },
    {
      ua: ua.ios,
      class: 'ua-ios'
    }
  ].forEach((item) => {
    if (item.ua) {
      document.documentElement.classList.add(item.class);
    }
  });
}
