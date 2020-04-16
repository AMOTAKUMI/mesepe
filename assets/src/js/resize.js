export default class {
  constructor() {
    this.init();
  }

  init() {
    $(window).resize(function(){
      let x = $(window).width();
      let y = 768;
      if (x <= y) {
        $('body').addClass('is-sp').removeClass('is-pc');
      }else{
        $('body').addClass('is-pc').removeClass('is-sp');
      }
    });
  }
}
