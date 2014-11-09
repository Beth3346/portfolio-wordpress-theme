###############################################################################
# Sort Tabular Data
###############################################################################
"use strict"
# TODO: merge with drm-sort to create a single sorting library that will sort any type of elements
# major difference is the use of columnNum to find data to be sorted
$ = jQuery
class @DrmTableSorter
    constructor: (@list = $('.drm-sortable-table'), @buttonClass = 'drm-sortable-table-button', @activeClass = 'active', @ignoreWords = ['a', 'the']) ->
        self = @
        # parent list element
        tableBody = @list.find 'tbody'
        @rows = tableBody.find 'tr'

        @list.on 'click', ".#{@buttonClass}", ->
            _that = $ @
            columnNum = _that.closest('th').index()
            self.toggleActiveClass.call @, self.activeClass, 'tr'
            sortedRows = self.sortList _that.data('dir'), columnNum, self.rows
            self.renderSort sortedRows, tableBody

    toggleActiveClass: (className, parent) ->
        $(@).closest(parent).find(".#{className}").removeClass(className).end().end().addClass className

    sortList: (direction, columnNum, listItems) =>
        patterns =
            number: new RegExp "^(?:\\-?\\d+|\\d*)(?:\\.?\\d+|\\d)"
            alpha: new RegExp '^[a-z ,.\\-]*','i'
            # mm/dd/yyyy
            monthDayYear: new RegExp '^(?:[0]?[1-9]|[1][012]|[1-9])[-\/.](?:[0]?[1-9]|[12][0-9]|[3][01])(?:[-\/.][0-9]{4})'
            # 00:00pm
            time: new RegExp '^(?:[12][012]|[0]?[0-9]):[012345][0-9](?:am|pm)', 'i'
            hour: new RegExp '^(\\d+)'
            minute: new RegExp ':(\\d+)'
            ampm: new RegExp '(am|pm|AM|PM)$'
        
        sortUtilities =
            capitalize: (str) ->
                str.toLowerCase().replace /^.|\s\S/g, (a) ->
                    a.toUpperCase()

            getValues: (listItems, columnNum) ->
                # creates an array of values from list items
                values = []

                listItems.each ->
                    value = $(@).find('td').eq(columnNum).text()
                    values.push $.trim(value)

                return values
            
            parseTime: (time) ->
                _hour = parseInt(patterns.hour.exec(time)[1], 10)
                _minutes = patterns.minute.exec(time)[1]
                _ampm = patterns.ampm.exec(time)[1].toLowerCase()

                if _ampm is 'am'
                    _hour = _hour.toString()
                    
                    if _hour is '12'
                        _hour = '0'
                    else if _hour.length is 1
                        _hour = "0#{_hour}"
                        
                    return "#{_hour}:#{_minutes}"

                else if _ampm is 'pm'
                    return "#{_hour + 12}:#{_minutes}"
            
            cleanAlpha: (str, ignoreWords = []) ->
                # removes leading 'the' or 'a'
                $.each ignoreWords, ->
                    re = new RegExp "^#{@}\\s", 'i'
                    str = str.replace re, ''
                    return str

                return str

            sortValues: (a, b, direction = 'ascending') ->
                # test for alpha values and perform alpha sort
                if patterns.alpha.test(a)
                    if a < b
                        return if direction is 'ascending' then -1 else 1
                    else if a > b
                        return if direction is 'ascending' then 1 else -1
                    else if a is b
                        return 0
                # if values are not alpha perform an numeric sort
                else
                    return if direction is 'ascending' then a - b else b - a
        
            getDataTypes: (listItems, columnNum, type = null) ->
                self = @
                values = self.getValues listItems, columnNum
                types = []

                if type?
                    types.push type
                else
                    $.each values, ->
                        if dataTypeChecks.isDate.call self, @
                            types.push 'date'
                        else if dataTypeChecks.isTime.call self, @
                            types.push 'time'
                        else if dataTypeChecks.isNumber.call self, @
                            types.push 'number'
                        else if dataTypeChecks.isAlpha.call self, @
                            types.push 'alpha'
                        else
                            types.push null

                return $.unique types
            
            createArrays: (obj, list) ->
                # create keys with empty arrays for each value in an array
                $.each list, ->
                    obj[@] = []
                    return
                return obj

            concatArrays: (obj) ->
                # combine an object made up of arrays into a single array
                arr = []
                $.each obj, ->
                    arr = arr.concat @
                    return
                return arr

            sortComplexList: (types, listItems, direction, columnNum) ->            
                # sort complex list with two or more data types
                # group data types together
                self = @
                sortLists = {}
                # create sortLists arrays
                @createArrays sortLists, types
                # add listItems to sortLists arrays
                $.each listItems, ->
                    listItem = @
                    value = $.trim $(listItem).text()
                    $.each types, ->
                        if dataTypeChecks["is#{self.capitalize(@)}"].call self, value
                            sortLists["#{@}"].push listItem
                # sort sortLists arrays
                $.each sortLists, (key) ->
                    comparators["sort#{self.capitalize(key)}"] sortLists[key], direction, columnNum

                return @concatArrays sortLists

        dataTypeChecks =
            isDate: (value) -> return if patterns.monthDayYear.test(value) then true else false
            isNumber: (value) -> return if patterns.number.test(value) then true else false
            isAlpha: (value) -> return if patterns.alpha.test(value) then true else false
            isTime: (value) -> return if patterns.time.test(value) then true else false
        
        comparators = 
            sortDate: (listItems, direction, columnNum) ->
                # need support for various date and time formats
                _sort = (a, b) ->
                    a = $.trim $(a).find('td').eq(columnNum).text()
                    b = $.trim $(b).find('td').eq(columnNum).text()
                    if dataTypeChecks.isDate(a) and dataTypeChecks.isDate(b)
                        a = new Date patterns.monthDayYear.exec(a)
                        b = new Date patterns.monthDayYear.exec(b)

                    return sortUtilities.sortValues a, b, direction

                return listItems.sort _sort 

            sortTime: (listItems, direction, columnNum) ->
                # need support for various date and time formats                
                _sort = (a, b) ->
                    a = $.trim $(a).find('td').eq(columnNum).text()
                    b = $.trim $(b).find('td').eq(columnNum).text()
                    if dataTypeChecks.isTime(a) and dataTypeChecks.isTime(b)
                        a = new Date "04-22-2014 #{sortUtilities.parseTime(patterns.time.exec(a))}"
                        b = new Date "04-22-2014 #{sortUtilities.parseTime(patterns.time.exec(b))}"

                    return sortUtilities.sortValues a, b, direction

                return listItems.sort _sort

            sortAlpha: (listItems, direction, columnNum) =>
                _sort = (a, b) =>
                    a = sortUtilities.cleanAlpha($.trim($(a).find('td').eq(columnNum).text()), @ignoreWords).toLowerCase()
                    b = sortUtilities.cleanAlpha($.trim($(b).find('td').eq(columnNum).text()), @ignoreWords).toLowerCase()

                    return sortUtilities.sortValues a, b, direction

                return listItems.sort _sort

            sortNumber: (listItems, direction, columnNum) ->
                _sort = (a, b) ->
                    a = parseFloat($.trim($(a).find('td').eq(columnNum).text()))
                    b = parseFloat($.trim($(b).find('td').eq(columnNum).text()))

                    return sortUtilities.sortValues a, b, direction

                return listItems.sort _sort

        type = @list.find('th').eq(columnNum).data 'type'
        types = sortUtilities.getDataTypes listItems, columnNum, type
        return sortUtilities.sortComplexList types, listItems, direction, columnNum

    renderSort: (sortedRows, list) =>
        list.empty()
        $.each sortedRows, -> list.append @

new DrmTableSorter()