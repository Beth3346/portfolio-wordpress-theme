$ = jQuery
win = $(window)
slider = $('.front-slider')
slideHolder = $('.front-slide-holder')
autoplay = 5000
nextButton = $('.next-img')
prevButton = $('.prev-img')
slides = slideHolder.find('.front-slide')
current = 0
firstSlide = slides.first()
lastSlide = slides.last()
play = 5000
speed = 2000
length = slides.length
last = length-1	

## Initialize

slides.hide()
firstSlide.show()
if length > 1
	nextButton.show()
	prevButton.show()

console.log length	

prevImage = ->
	slides.fadeOut(speed)

	if current == 0
		lastSlide.fadeIn(speed)
		current = last
	else
		current = current - 1
		slides.eq(current).fadeIn(speed)
	return	

nextImage = ->	
	slides.fadeOut(speed)	

	if current == last
		firstSlide.fadeIn(speed)
		current = 0
	else
		current = current + 1
		slides.eq(current).fadeIn(speed)
	return

startShow = ->
	clearInterval(play)
	play = setInterval ->
		nextImage()
		return
	, autoplay		
	return

stopShow = ->
	clearInterval(play)	
	return

win.load ->
	if length > 1 
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
		if length > 1
			startShow()
			return	
)