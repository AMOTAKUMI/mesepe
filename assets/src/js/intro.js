export default class {
  constructor() {
    this.init();
  }

  init() {
    setTimeout(function(){
      $('.js-hd').addClass('is-passive');
      setTimeout(function(){
        $('.js-hd').addClass('is-hide');
      },2000);
    },2000);
  }
}
