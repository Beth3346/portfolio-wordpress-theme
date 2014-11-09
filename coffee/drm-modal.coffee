###############################################################################
# Displays a modal window
###############################################################################
"use strict"

$ = jQuery
class @DrmModal
    constructor: (@buttons = $('button.drm-modal-open'), @lightbox = $('div.drm-modal-lightbox'), @speed = 300) ->
        self = @
        _modals = self.lightbox.find 'div.drm-modal'
        _close = _modals.find 'button.drm-modal-close'

        self.buttons.on 'click', -> self.showModal.call @, self.speed
        
        _close.on 'click', $.proxy self.hideModal, self
        
        self.lightbox.on 'click', $.proxy self.hideModal, self
        
        _modals.on 'click', (e) ->
            e.stopPropagation()

    showModal: (speed) ->
        _modalId = $(@).data 'modal'
        $("##{_modalId}").fadeIn speed

    hideModal: (e) ->
        @lightbox.fadeOut @speed
        e.preventDefault()
        
new DrmModal()