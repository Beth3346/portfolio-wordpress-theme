###############################################################################
# Filter Tabular Data
###############################################################################
"use strict"

$ = jQuery
# adds case insensitive contains to jQuery

$.extend $.expr[":"], {
    "containsNC": (elem, i, match) ->
        (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0
}

class @DrmTableFilter
    constructor: (@tableClass = 'drm-searchable-table') ->
        self = @
        self.table = $ ".#{@tableClass}"
        self.searchInput = 'drm-search-table'
        # cache full table
        self.fullRows = @table.find 'tbody tr'

        self.table.on 'keyup', "input.#{@searchInput}", self.renderTable

    filterRows: =>
        self = @
        # check other inputs
        _inputs = self.table.find('th').find ".#{self.searchInput}"
        filterValues = []

        # get all input values and add them to filterValues array
        $.each _inputs, (key, value) ->
            _that = $ value

            if $.trim(_that.val()).length isnt 0 then filterValues.push value
        
        # get filtered rows
        if filterValues.length is 0
            rows = self.fullRows
        else
            $.each filterValues, (key, value) ->
                _that = $ value
                _input = $.trim(_that.val()).toLowerCase()
                _columnNum = _that.closest('th').index()

                if filterValues.length is 1
                    rows = self.fullRows.has "td:eq(#{_columnNum}):containsNC(#{_input})"
                else if key is 0
                    rows = self.fullRows.has "td:eq(#{_columnNum}):containsNC(#{_input})"
                else
                    rows = rows.has "td:eq(#{_columnNum}):containsNC(#{_input})"
                rows
        rows

    renderTable: =>
        _filteredRows = @filterRows()
        tableBody = @table.find('tbody').empty()

        $.each _filteredRows, (key, value) ->
            tableBody.append value

new DrmTableFilter()