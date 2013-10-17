$ = jQuery

($) ->
	win = $(window)
	slider = $(".front-slider")
	slideHolder = $(".front-slide-holder")
	autoplay = 5000
	nextButton = $('.next-img')
	prevButton = $('.prev-img')
	slides = slideHolder.find(".front-slide")
	current = 0
	last = slides.length-1	
	firstSlide = slides.first()
	lastSlide = slides.last()

	slides.hide()
	firstSlide.show()

	prevImage = ->
		slide.fadeOut(1000)

		if current == 0
			lastSlide.fadeIn(1000)
			current = last
		else
			current = current - 1
			slides.eq(current).fadeIn(1000)
		return	

	nextImage = ->	
		slides.fadeOut(1000)	

		if current == last
			firstSlide.fadeIn(1000)
			current = 0
		else
			current = current + 1
			slides.eq(current).fadeIn(1000)
		return

	play = ""	

	startShow = ->
		clearInterval(play)
		play = setInterval ->
			nextImage()
			return
		autoplay
		return	
	
	stopShow = ->
		clearInterval(play)	
		return

	win.load ->
		startShow()
		return

	prevButton.click ->
		prevImage()
		stopShow()
		return

	nextButton.click ->
		nextImage()
		stopShow()
		return

	slides.hover(
		->
			stopShow()
			return
		->
			startShow()
			return	
	)