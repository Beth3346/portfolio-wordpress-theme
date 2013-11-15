(($) ->

	$('a.more-link').click ->
		link = $(this)

		link.html('loading...')

		post_id = link.data('post')

		data = {
			action: 'drm_rmpi_ajax'
			post_id: post_id
		}

		$.get(drm_rmpi.ajaxurl, data, (data) ->
			excerpt = $('section.post-excerpt' + post_id)
			data = '<section class="post-content' + post_id + ' ">' + data + '</section>' + '<button class="hide-link hide-content' + post_id + '">Hide Article</button>';

			excerpt.before(data).slideUp('slow')

			hideButton = $('button.hide-content' + post_id).click ->
				$('section.post-content' + post_id).slideUp('slow', ->
					$(this).remove()
					hideButton.remove()
					$('section.post-excerpt' + post_id).slideDown('slow')
					link.html('Read More')

					return
				)
				
				return

			return	
		)
		
		return false
	return	
) jQuery 		