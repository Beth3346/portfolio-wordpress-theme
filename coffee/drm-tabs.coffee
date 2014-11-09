###############################################################################
# Enables dynamic tabbed content
###############################################################################
"use strict"

$ = jQuery
class @DrmTabs
    constructor: (@holder = $('div.drm-tabs'), @activeClass = 'active', @speed = 300) ->
        self = @
        self.nav = self.holder.find 'nav'
        self.tabs = self.holder.find 'section'
        _hash = window.location.hash

        self.tabs.hide()

        if _hash
            self.holder.find("section#{_hash}").show()
            self.nav.find("a[href='#{_hash}']").addClass self.activeClass
        else
            self.nav.find('a[href^="#"]').first().addClass self.activeClass
            self.tabs.first().show()

        self.nav.on 'click', 'a[href^="#"]', (e) ->                
            target = self.getTarget.call @
            self.changeTab target
            e.preventDefault()

    getTarget: ->
        $(@).attr 'href'

    changeTab: (target) =>
        tab = @holder.find "section#{target}"
        _currentTab = @holder.find('section').not ':hidden'
        _currentId = _currentTab.attr 'id'

        _currentTab.fadeOut @speed, ->
            tab.fadeIn @speed
        @nav.find("a[href^='##{_currentId}']").removeClass @activeClass
        window.location.hash = target
        @nav.find("a[href='#{target}']").addClass @activeClass

new DrmTabs()