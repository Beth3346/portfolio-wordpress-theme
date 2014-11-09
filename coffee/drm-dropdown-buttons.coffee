###############################################################################
# Allows a button to display a dropdown when clicked
###############################################################################
"use strict"

$ = jQuery
class @DrmDropdownButton
    constructor: (@container = $('div.drm-dropdown-solid-btn-holder'), @speed = 300, @button = 'button') ->
        self = @
        self.activeClass = 'clicked'

        self.container.on 'click', self.button, (e) ->
            that = $ @
            menu = that.next 'ul'
            menuStatus = if menu.is ':hidden' then 'hidden' else 'showing'

            # close any open menus
            openButtons = self.container.find('ul').not(':hidden').prev 'button'

            unless openButtons.length is 0
                self.changeMenu.call openButtons, 'showing', self.speed, self.activeClass

            self.changeMenu.call that, menuStatus, self.speed, self.activeClass
            e.preventDefault()
            e.stopPropagation()

        $('body').on 'click', (e) ->
            # close any open menus
            openButtons = $(@).find('ul').not(':hidden').prev 'button'

            unless openButtons.length is 0
                self.changeMenu.call openButtons, 'showing', self.speed, self.activeClass
            e.stopPropagation()

    changeMenu: (status, speed, activeClass) ->
        if status is 'hidden' then $(@).next('ul').addClass(activeClass).slideDown speed else $(@).next('ul').removeClass(activeClass).slideUp speed
        
new DrmDropdownButton()
new DrmDropdownButton $('div.drm-dropdown-split-btn-holder'), 300, 'button:last()'