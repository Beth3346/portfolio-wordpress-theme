###############################################################################
# Easy list sorting
###############################################################################
"use strict"

$ = jQuery
class @DrmSort
    constructor: (@lists = $('.drm-sortable'), @autoSort = yes, @buttonClass = 'drm-sort-list', @activeClass = 'active', @ignoreWords = ['a', 'the']) ->
        self = @        

        if self.autoSort
            $.each @lists, ->
                list = $ @
                listItems = list.find 'li'
                sortedList = self.sortList 'ascending', listItems
                self.renderSort sortedList, list
                $("button.drm-sort-list[data-sort='ascending']").addClass self.activeClass

        $('body').on 'click', ".#{@buttonClass}", ->
            _that = $ @
            _listId = _that.data 'list'
            list = $ "ul##{_listId}"
            direction = _that.data 'sort'
            listItems = list.find 'li'
            sortedList = self.sortList direction, listItems
            self.renderSort sortedList, list
            self.toggleActiveClass.call @, 'active', '.button-group'

    toggleActiveClass: (className, parent) ->
        $(@).closest(parent).find(".#{className}").removeClass(className).end().end().addClass className

    sortList: (direction, listItems) =>
        # TODO: add support for sorting datetime values
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

            getValues: (listItems) ->
                # creates an array of values from list items
                values = []

                listItems.each ->
                    _that = $ @
                    values.push $.trim(_that.text())

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
        
            getDataTypes: (listItems, type = null) =>
                self = @
                values = sortUtilities.getValues listItems
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

            sortComplexList: (types, listItems, direction) ->            
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
                    comparators["sort#{self.capitalize(key)}"] sortLists[key], direction

                return @concatArrays sortLists

        dataTypeChecks =
            isDate: (value) -> return if patterns.monthDayYear.test(value) then true else false
            isNumber: (value) -> return if patterns.number.test(value) then true else false
            isAlpha: (value) -> return if patterns.alpha.test(value) then true else false
            isTime: (value) -> return if patterns.time.test(value) then true else false
        
        comparators = 
            sortDate: (listItems, direction) ->
                # need support for various date and time formats
                _sort = (a, b) ->
                    if dataTypeChecks.isDate($.trim($(a).text())) and dataTypeChecks.isDate($.trim($(b).text()))
                        a = new Date patterns.monthDayYear.exec($.trim($(a).text()))
                        b = new Date patterns.monthDayYear.exec($.trim($(b).text()))

                    return sortUtilities.sortValues a, b, direction

                return listItems.sort _sort 

            sortTime: (listItems, direction) ->
                # need support for various date and time formats                
                _sort = (a, b) ->
                    if dataTypeChecks.isTime($.trim($(a).text())) and dataTypeChecks.isTime($.trim($(b).text()))
                        a = new Date "04-22-2014 #{sortUtilities.parseTime(patterns.time.exec($.trim($(a).text())))}"
                        b = new Date "04-22-2014 #{sortUtilities.parseTime(patterns.time.exec($.trim($(b).text())))}"

                    return sortUtilities.sortValues a, b, direction

                return listItems.sort _sort

            sortAlpha: (listItems, direction) =>
                _sort = (a, b) =>
                    a = sortUtilities.cleanAlpha($.trim($(a).text()), @ignoreWords).toLowerCase()
                    b = sortUtilities.cleanAlpha($.trim($(b).text()), @ignoreWords).toLowerCase()

                    return sortUtilities.sortValues a, b, direction

                return listItems.sort _sort

            sortNumber: (listItems, direction) ->
                _sort = (a, b) ->
                    a = parseFloat($.trim($(a).text()))
                    b = parseFloat($.trim($(b).text()))

                    return sortUtilities.sortValues a, b, direction

                return listItems.sort _sort

        type = listItems.parent().data 'type'
        types = sortUtilities.getDataTypes listItems, type

        return sortUtilities.sortComplexList types, listItems, direction

    renderSort: (sortedList, list) ->
        # clear unsorted items from list
        list.empty()
        # replace with sortedList
        $.each sortedList, -> list.append @

new DrmSort()