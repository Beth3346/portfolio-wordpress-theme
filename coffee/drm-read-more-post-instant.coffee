"use strict"
$ = jQuery

$('a.more-link').click ->
    link = $ @

    link.html 'loading...'

    post_id = link.data 'post'

    data =
        action: 'drm_rmpi_ajax'
        post_id: post_id

    $.get(main.ajaxurl, data, (data) ->
        excerpt = $ "div.post-excerpt#{post_id}"
        origExcerpt = $ "div.post-excerpt#{post_id}"
        data = "<div class='post-content#{post_id}'>#{data}</div><button class='hide-link hide-content#{post_id}'>Hide Article</button>"

        excerpt.before(data).fadeOut 0, -> $(@).slideUp('slow')

        hideButton = $ "button.hide-content#{post_id}"
        hideButton.click ->
            $("div.post-content#{post_id}").slideUp 'slow', ->
                $(@).remove()
                hideButton.remove()
                origExcerpt.slideDown('slow')
                link.html('Read More')
        return  
    )       
    return false