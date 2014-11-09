###############################################################################
# Creates a Pinterest like sortable, image grid
###############################################################################
#TODO: add check so that one column doesn't get too long. Skip it and move to the next column
"use strict"

$ = jQuery
# adds case insensitive contains to jQuery

$.extend $.expr[":"], {
    "containsNC": (elem, i, match) ->
        (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0
}

class @DrmFlexibleGrid
    constructor: (@gridClass = 'drm-flexible-grid', @imagesPerRow = 4, @flex = true) ->
        self = @
        self.grid = $ ".#{self.gridClass}"

        if self.grid.length isnt 0
            self.gridNav = $ '.drm-grid-nav'
            self.items = self.grid.find('.drm-grid-item').hide()
            hash = window.location.hash

            $(window).load ->
                self.tags = self.getTags()
                filter = if hash then hash.replace /^#/, '' else null
                self.addFilterButtons self.tags
                self.filterListItems filter

                if filter
                    activeButton = $("button.drm-grid-filter[data-filter=#{filter}]")
                    activeButton.siblings('button').removeClass 'active'
                    activeButton.addClass 'active'

            if self.flex
                $(window).resize ->
                    items = self.grid.find '.drm-grid-item'
                    self.positionListItems items
                    self.resizeCurtain()

            $(window).load self.resizeCurtain

            self.grid.on 'mouseenter', '.drm-grid-item', ->
                $(@).find('.curtain').stop().fadeIn 'fast'

            self.grid.on 'mouseleave', '.drm-grid-item', ->
                $(@).find('.curtain').stop().fadeOut 'fast'

            self.gridNav.on 'click', 'button.drm-grid-filter', ->
                _that = $ @
                filter = _that.data('filter').toLowerCase()
                self.filterListItems filter
                _that.siblings('button').removeClass 'active'
                _that.addClass 'active'

    getTags: =>
        self = @
        tags = []
        _tagListItems = self.grid.find 'ul.caption-tags li'

        $.each _tagListItems, (key, value) ->
            _tag = $(value).text()
            tags.push _tag
            $.unique tags

        tags

    addFilterButtons: (tags) =>
        self = @

        _capitalize = (str) ->
            str.toLowerCase().replace /^.|\s\S/g, (a) ->
                a.toUpperCase()

        $.each tags, (key, value) ->
            _tagButton = $ '<button></button>',
                class: 'drm-grid-filter'
                text: _capitalize value
                'data-filter': value
            _tagButton.appendTo self.gridNav

        self.gridNav.find('.drm-grid-filter').first().addClass 'active'

    resizeCurtain: =>
        _curtain = @grid.find '.curtain'

        $.each _curtain, (key, value) ->
            _that = $ value
            _holder = _that.parent '.drm-grid-item'
            _imageHeight = _holder.find('img').height()

            _that.height(_imageHeight).hide()

    addListItems: (items) =>
        self = @
        @grid.empty()
        items.appendTo(@grid).hide 0, ->
            self.positionListItems items

    positionListItems: (items) =>
        self = @

        # add height to grid holder to accomodate images
        _resizeHolder = (items) ->
            _tallestColumn = 0
            _columnHeights = []

            _i = 0
            until _i is self.imagesPerRow 
                _columnHeights.push 0
                _i = _i + 1
            
            $.each items, (key, value) ->
                _that = $ value
                _columnNum = _that.data 'column'
                _height = _that.outerHeight true

                _columnHeights[_columnNum] += _height

            $.each _columnHeights, (key, value) ->
                if value > _tallestColumn
                    _tallestColumn = value
                    _tallestColumn

            self.grid.css 'height': _tallestColumn + 40

        # need to keep track of column length so _that any one column doesn't get too long

        $.each items, (key, value) ->
            _that = $ value
            _index = key + 1
            _columnNum = if _index % self.imagesPerRow is 0 then self.imagesPerRow - 1 else (_index % self.imagesPerRow) - 1
            _that.attr 'data-column', _columnNum
            _that.attr 'data-num', _index
            _prevImage = if _index > self.imagesPerRow then self.grid.find('.drm-grid-item').eq(_index - (self.imagesPerRow + 1)) else null
            
            if _prevImage?
                _margin = _prevImage.outerWidth(true) - _prevImage.outerWidth(false)
                _top = if _index < ((self.imagesPerRow * 2) + 1) then _prevImage.outerHeight(false) + _margin else _prevImage.outerHeight(false) + _margin + _prevImage.position().top
                _left = (_prevImage.outerWidth(false) * _columnNum) + (_margin * _columnNum)

                _that.css
                    'top': _top
                    'left': _left
                    'position': 'absolute'
            else
                _that.css
                    'top': 0
                    'left': 0
                    'position': 'relative'

            _that.show()

        _resizeHolder items

    filterListItems: (filter) =>
        # filter images by tag
        filter = if window.location.hash then filter else 'all'
        window.location.hash = filter

        if filter in @tags or filter is 'all'
            filteredItems = if filter is 'all' then @items else @items.has "ul.caption-tags li:containsNC(#{filter})"
            @addListItems filteredItems
        else
            $('<p></p>',
                text: 'no items match').appendTo @grid
        

new DrmFlexibleGrid()