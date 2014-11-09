###############################################################################
# Displays popovers on hover
###############################################################################
"use strict"

$ = jQuery
class @DrmPopover
    constructor: (@holder = $('div.popover-holder')) ->
        self = @
        _buttons = self.holder.find 'button'

        _buttons.on 'click', self.togglePopover
        $('body').click -> self.holder.find('div.drm-popover').hide() 

    togglePopover: (e) ->
        _popoverId = $(@).data 'popover'
        popover = $("div##{_popoverId}").fadeToggle()
        
        e.stopPropagation()

        _checkPosition = ->
            _that = $ @
            _positionLeft = _that.position().left
            _offsetLeft = _that.offset().left
            _positionTop = _that.position().top
            _offsetTop = _that.offset().top
            _popoverHeight = _that.height()

            if _offsetLeft < 0
                _that.css('left': (Math.abs(_offsetLeft) + 10) + _positionLeft)
            else if _offsetTop < 0
                _that.css('bottom': (Math.abs(_positionTop) - _popoverHeight) - Math.abs(_offsetTop))

        _checkPosition.call popover

new DrmPopover()