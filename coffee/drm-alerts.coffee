###############################################################################
# Displays removable alerts for web apps
###############################################################################
"use strict"

$ = jQuery
class @DrmDismissibleAlert
    constructor: (@alertClass = "drm-dismissible-alert", @speed = 300) ->
        self = @

        $('body').on 'click', "div.#{@alertClass} button.close", (e) ->
            e.preventDefault()
            self.clearAlert.call @, self.speed

    showAlert: (type, message, holder) ->
        _className = "drm-#{type}-alert #{@alertClass}"
        _newAlert = $ '<div></div>',
            text: message,
            class: _className

        _close = $ '<button></button>',
            text: 'x'
            class: 'close'

        _newAlert.prependTo holder
        _close.prependTo _newAlert

    clearAlert: (speed) -> 
        $(@).parent().fadeOut speed, ->
            $(@).remove()

new DrmDismissibleAlert()