(function() {
  var $;

  $ = jQuery;

  (function($) {
    return $('.back-top a').click(function() {
      $('body').animate({
        scrollTop: 1000
      }, 800);
      return false;
    });
  });

}).call(this);