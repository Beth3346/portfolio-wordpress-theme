(($) ->

	$('a.more-link').click ->
		link = $(this)

		link.html('loading...')

		post_id = link.data('post')

		data = {
			action: 'elr_rmpi_ajax'
			post_id: post_id
		}

		$.get(elr_rmpi.ajaxurl, data, (data) ->
			excerpt = $('div.post-excerpt' + post_id)
			data = '<div class="post-content' + post_id + ' ">' + data + '</div>' + '<button class="hide-link hide-content' + post_id + '">Hide Article</button>';

			excerpt.before(data).slideUp('slow')

			hideButton = $('button.hide-content' + post_id).click ->
				$('div.post-content' + post_id).slideUp('slow', ->
					$(this).remove()
					hideButton.remove()
					$('div.post-excerpt' + post_id).slideDown('slow')
					link.html('Read More')

					return
				)
				
				return

			return	
		)
		
		return false
	return	
) jQuery 		