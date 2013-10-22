(function() {
  var $;

  $ = jQuery;

  (function($) {
    var autoplay, current, firstSlide, last, lastSlide, nextButton, nextImage, play, prevButton, prevImage, slideHolder, slider, slides, startShow, stopShow, win;
    win = $(window);
    slider = $(".front-slider");
    slideHolder = $(".front-slide-holder");
    autoplay = 5000;
    nextButton = $('.next-img');
    prevButton = $('.prev-img');
    slides = slideHolder.find(".front-slide");
    current = 0;
    last = slides.length - 1;
    firstSlide = slides.first();
    lastSlide = slides.last();
    slides.hide();
    firstSlide.show();
    prevImage = function() {
      slide.fadeOut(1000);
      if (current === 0) {
        lastSlide.fadeIn(1000);
        current = last;
      } else {
        current = current - 1;
        slides.eq(current).fadeIn(1000);
      }
    };
    nextImage = function() {
      slides.fadeOut(1000);
      if (current === last) {
        firstSlide.fadeIn(1000);
        current = 0;
      } else {
        current = current + 1;
        slides.eq(current).fadeIn(1000);
      }
    };
    play = "";
    startShow = function() {
      clearInterval(play);
      play = setInterval(function() {
        nextImage();
      });
      autoplay;
    };
    stopShow = function() {
      clearInterval(play);
    };
    win.load(function() {
      startShow();
    });
    prevButton.click(function() {
      prevImage();
      stopShow();
    });
    nextButton.click(function() {
      nextImage();
      stopShow();
    });
    return slides.hover(function() {
      stopShow();
    }, function() {
      startShow();
    });
  });

}).call(this);
