export class BarbaUtil {
  static replaceHeadTags(target) {
    const head = document.head;
    const targetHead = target.html.match(/<head[^>]*>([\s\S.]*)<\/head>/i)[0];
    const newPageHead = document.createElement('head');
    newPageHead.innerHTML = targetHead;

    const removeHeadTags = ["meta[name='description']", "meta[property^='og']", "meta[name^='twitter']", "link[rel='canonical']", "link[rel='preload']"].join(',');

    head.querySelectorAll(removeHeadTags).forEach((item) => {
      head.removeChild(item);
    });

    Array.from(newPageHead.querySelectorAll(removeHeadTags))
      .reverse()
      .forEach((e) => {
        head.querySelector('title').after(e);
      });
  }

  static pushGA() {
    gtag('event', 'page_view', {
      page_title: document.title,
      page_location: location.href,
      page_path: location.pathname
    });
  }
}
