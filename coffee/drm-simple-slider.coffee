###############################################################################
# A simple jQuery slider
###############################################################################
"use strict"

$ = jQuery
class @DrmSimpleSlider
    constructor: (@slider = $('div.drm-simple-slider'), @play = 10000, @speed = 300, @animate = no) ->
        self = @
        @slideHolder = self.slider.find('div').first()
        @slides = self.slideHolder.find 'div.drm-simple-slide'
        @slideList = self.createSlideList()
        _sliderControls = self.slider.find('div.drm-simple-slider-nav').find 'button'
        current = 0

        advanceImage = ->
            _last = self.slides.length - 1
            current = self.getCurrent()
            _dir = $(@).data 'dir'

            _nextImage = (current) ->
                if current is _last then 0 else current + 1
            _prevImage = (current) ->
                if current is 0 then _last else current - 1
                
            next = if _dir is 'prev' then _prevImage(current) else _nextImage(current)

            self.replaceImage current, next

        ## Initialize
        
        if self.slides.length > 1
            _sliderControls.show()
            self.slideList.appendTo self.slideHolder
            self.slideList.find('button').first().addClass 'active'
            self.slides.hide()
            self.slides.first().show()
        else
            _sliderControls.hide()
            self.slideList.hide()
            self.slides.first().show()

        unless self.animate is no
            begin = self.startShow()
            pause = -> self.pauseShow begin
            $(window).on 'load', $.proxy begin
            self.slideHolder.on 'mouseenter', pause

        _sliderControls.on 'click', advanceImage
        self.slideList.on 'click', 'button', ->
            current = self.getCurrent()
            next = $(@).data 'item-num'
            self.replaceImage(current, next)

    createSlideList: =>
        li = ''
        $.each @slides, (index) ->
            li += "<li><button data-item-num='#{index}'></button></li>"
        $ '<ul></ul>',
            class: 'drm-simple-slider-list'
            html: li

    getCurrent: ->
        currentSlide = @slides.not ':hidden'
        @slides.index currentSlide

    replaceImage: (current, next) ->
        links = @slideList.find 'button'
        speed = @speed
        slides = $ @slides

        slides.eq(current).fadeOut speed, ->
            slides.eq(next).fadeIn speed
            links.removeClass 'active'
            links.eq(next).addClass 'active'

    startShow: ->
        nextControl = $('.drm-simple-slider-nav').find "button[data-dir='next']"

        unless @slides.length is 0            
            start = setInterval ->
                nextControl.trigger 'click'
            , @play
        start

    pauseShow: (start) ->
        clearInterval start
        
new DrmSimpleSlider()