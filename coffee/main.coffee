$ = jQuery

($) ->

	$('.back-top a').click( ->
		$('body').animate(
			scrollTop: 1000, 800)
		return false	
	)