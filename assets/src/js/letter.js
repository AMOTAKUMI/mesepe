export default class {
  constructor() {
    this.init();
  }

  init() {
    let txt      = '';
    let w_txt    = [];
    let l        = ['is-l01','is-l02','is-l03','is-l04','is-l05','is-l06','is-l07','is-l08','is-l09','is-l10'];
    let lead_num = '';
    let lead     = [];

    $(window).keydown(function(e){
      if(event.shiftKey){
        if(e.keyCode === 13){
          txt = $('.js-textarea').val();
          w_txt = txt.split(/\r\n|\r|\n/);

        	for(let i=0;i<w_txt.length;i++) {
            let _w_txt = '';
            w_txt[i].split('').forEach(function(c) {
              if(c != undefined) _w_txt += '<i class="'+l[Math.floor(Math.random()*l.length)]+'">'+c+'</i>';
            });
            w_txt[i] = _w_txt;
        	}

          $('.js-textarea').addClass('is-passive');
          setTimeout(function(){
            $('.js-textarea').addClass('is-hide');
          },300);

          for(let i=0;i<w_txt.length;i++) {
            $('.js-lead').append(w_txt[i]);
            $('.js-lead').append('<br />');
        	}

          setTimeout(function(){
            $('.js-lead i').each(function(){
              $(this).addClass('is-active');
            });
          }, 100);

          setTimeout(function(){
            $('.js-lead').addClass('is-passive');
          }, 5000);

          setTimeout(function(){
            $('.js-reply').addClass('is-passive');
          }, 10000);

          $('.wr').addClass('is-recive');
          return false;

        }
      }
    });
  }
}
