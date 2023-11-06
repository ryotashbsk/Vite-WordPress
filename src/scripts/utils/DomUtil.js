export class DomUtil {
  static id(id, elm = document) {
    return elm.getElementById(id);
  }

  static find(className, elm = document) {
    return elm.querySelector(className);
  }

  static findAll(className, elm = document) {
    return elm.querySelectorAll(className);
  }

  static data(attr, elm = document) {
    return elm.querySelector(`[data-${attr}]`);
  }

  static dataAll(attr, elm = document) {
    return elm.querySelectorAll(`[data-${attr}]`);
  }
}
