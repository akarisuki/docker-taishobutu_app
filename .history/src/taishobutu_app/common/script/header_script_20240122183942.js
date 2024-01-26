$(function(){
  $('#switch').on('change', function(){
    var st = $(window).scrollTop();
    if($(this).prop("checked") == true) {
      $('html').addClass('scroll-prevent');
      $('html').css('top', -(st) + 'px');
      $('#switch').on('change', function(){
        if($(this).prop("checked") !== true) {
          $('html').removeClass('scroll-prevent');
          $(window).scrollTop(st);
        }
      });
    }
  });
  $('.header_menu a[href]').on('click', function(event) {
    $('#switch').prop('checked', false);
  });
  $('.header_menu a').on('click', function(){
    var st = $(window).scrollTop();
      $('html').removeClass('scroll-prevent');
      $('html').css('top', -(st) + 'px');
      $('.header_menu a').on('change', function(){
      });
    
  });
});

