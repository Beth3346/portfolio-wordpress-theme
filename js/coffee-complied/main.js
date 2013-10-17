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

(function() {
  var $;

  $ = jQuery;

  (function($) {
    var animate, buttonBack, buttonCurrentBack, buttonHoverBack, current, imgButtons, imgList, imgWidth, imgs, imgsLen, moveSlide, slideHolder, sliderNav, start, startShow, totalImgsWidth, transition;
    slideHolder = $('div.slide-holder').css('overflow', 'hidden').children('div.slides');
    imgs = slideHolder.find('.slide-content');
    imgWidth = imgs.first().width();
    imgsLen = imgs.length;
    current = 1;
    totalImgsWidth = imgsLen * imgWidth;
    sliderNav = $('.slider-nav');
    imgList = $('ul.img-list');
    imgButtons = imgList.find('button');
    buttonBack = imgButtons.css('background-color');
    buttonHoverBack = '#333';
    buttonCurrentBack = '#00c0c9';
    animate = 'yes';
    (function() {
      if (imgsLen > 1) {
        sliderNav.show();
        imgList.show();
        imgButtons.first().css('background-color', buttonCurrentBack);
      }
    });
    moveSlide = function() {
      var currentButton, direction, loc;
      direction = $(this).data('dir');
      loc = imgWidth;
      currentButton = $('button#button' + current);
      if (direction === 'next') {
        ++current;
        imgButtons.css('background-color', buttonBack);
        currentButton = $('button#button' + current);
        currentButton.css('background-color', buttonCurrentBack);
        clearInterval(start);
      } else {
        --current;
        imgButtons.css('background-color', buttonBack);
        currentButton = $('button#button' + current);
        currentButton.css('background-color', buttonCurrentBack);
        clearInterval(start);
      }
      if (current === 0) {
        current = imgsLen;
        loc = totalImgsWidth - imgWidth;
        direction = 'next';
        currentButton = $('button#button' + current);
        currentButton.css('background-color', buttonCurrentBack);
        clearInterval(start);
      } else if ((current - 1) === imgsLen) {
        current = 1;
        loc = 0;
        currentButton = $('button#button' + current);
        currentButton.css('background-color', buttonCurrentBack);
        clearInterval(start);
      }
      transition(slideHolder, loc, direction);
    };
    sliderNav.find('button').on('click', moveSlide);
    startShow = function() {
      var currentButton, direction, loc;
      direction = 'next';
      loc = imgWidth;
      currentButton = $('button#button' + current);
      if (current !== imgsLen) {
        ++current;
        imgButtons.css('background-color', buttonBack);
        currentButton = $('button#button' + current);
        currentButton.css('background-color', buttonCurrentBack);
      } else if (current === imgsLen) {
        current = 1;
        loc = 0;
        imgButtons.css('background-color', buttonBack);
        currentButton = $('button#button' + current);
        currentButton.css('background-color', buttonCurrentBack);
      }
      transition(slideHolder, loc, direction);
      return current;
    };
    if (animate === 'yes') {
      start = setInterval(startShow, 5000);
    }
    imgButtons.on('click', loc(function() {
      var direction, imgNum, loc, that;
      that = $(this);
      direction = 'next';
      imgNum = that.data('num');
      if (imgNum !== current) {
        loc = Math.abs(imgNum - current) * imgWidth;
        direction = imgNum < current ? 'prev' : 'next';
        transition(slideHolder, loc, direction);
        current = imgNum;
        imgButtons.css('background-color', buttonBack);
        that.css('background-color', buttonCurrentBack);
        clearInterval(start);
      }
      return current;
    }));
    imgButtons.on('mouseenter', function() {
      var currentButton, that;
      that = $(this);
      currentButton = $('button#button' + current);
      imgButtons.css('background-color', buttonBack);
      currentButton.css('background-color', buttonCurrentBack);
      that.css('background-color', buttonHoverBack);
    });
    imgButtons.on('mouseleave', function() {
      var currentButton;
      currentButton = $('button#button' + current);
      imgButtons.css('background-color', buttonBack);
      currentButton.css('background-color', buttonCurrentBack);
    });
    transition = function(container, loc, direction) {
      unit;
      var unit;
      if (direction && loc !== 0) {
        unit = direction === 'next' ? '-=' : '+=';
      }
      container.animate({
        'margin-left': unit ? unit + loc : loc
      });
    };
  });

}).call(this);

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
