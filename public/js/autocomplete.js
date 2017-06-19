// var input_selector = 'input[type=text].autocomplete, input[type=password].autocomplete, input[type=email].autocomplete, input[type=url].autocomplete, input[type=tel].autocomplete, input[type=number].autocomplete, input[type=search].autocomplete, textarea';
var input_selector = 'input[type=text].autocomplete, input[type=email].autocomplete, input[type=url].autocomplete, input[type=tel].autocomplete, input[type=number].autocomplete, input[type=search].autocomplete';

/**************************
 * Auto complete plugin  *
 *************************/

$(document).ready(function() {
    $(input_selector).attr( "autocomplete", "off" );
    $(input_selector).focus(function(e) {
        var $input = $(e.target);
        var $array = $input.data('array');
        var $inputDiv = $input.closest('.input-field');

        if ($array !== '') {
            // Create html element for auto complete panel
            var $select = $('#' + $input.attr("id") + '-autocomplete-content').get(0);

            if ($select == undefined) {
                var $html = '<ul class="autocomplete-content hide" id="' + $input.attr("id") + '-autocomplete-content" data-target="' + $input.attr("id") + '">';
                for (var i = 0; i < $array.length; i++) {
                    // If path and class aren't empty add image to auto complete else create normal element
                    if ($array[i]['path'] !== '' && $array[i]['path'] !== undefined && $array[i]['path'] !== null && $array[i]['class'] !== undefined && $array[i]['class'] !== '') {
                        $html += '<li class="autocomplete-option"><img src="' + $array[i]['path'] + '" class="' + $array[i]['class'] + '"><span>' + $array[i]['value'] + '</span></li>';
                    } else {
                        $html += '<li class="autocomplete-option"><span>' + $array[i]['value'] + '</span></li>';
                    }
                }
                $html += '</ul>';
                $inputDiv.append($html); // Set ul in body
                // End create html element
            }
        }
    });

    // Perform search
    $(document).on('keyup', '.autocomplete', function(e) {
        var $input = $(e.target);
        var $val = $input.val().trim().toLowerCase();
        var $select = $('#' + $input.attr("id") + '-autocomplete-content');
        $select.css('width',$input.width());
        $select.removeClass('hide');
        if ($val != '') {
            $select.children('li').each(function() {
                var matchStart = $(this).text().toLowerCase().indexOf($val);

                if (matchStart >= 0) {
                    var matchEnd = matchStart + $val.length - 1;
                    var beforeMatch = $(this).text().slice(0, matchStart);
                    var matchText = $(this).text().slice(matchStart, matchEnd + 1);
                    var afterMatch = $(this).text().slice(matchEnd + 1);
                    $(this).html("<span>" + beforeMatch + "<span class='highlight'>" + matchText + "</span>" + afterMatch + "</span>");
                    $(this).removeClass('hide');
                } else {
                    //$(this).addClass('hide');
                }
            });
        } else {
            $select.children('li').addClass('hide');
        }
    });

    $(document).on('click', '.autocomplete-option', function(e) {
        var $ul = $(e.target).closest('ul.autocomplete-content');
        var $target = $('#' + $ul.data('target'));
        $target.val($(this).text().trim());
        //$ul.addClass('hide');
        $target.focusin();
    });

    $(input_selector).keydown(function(e) {
        var key = e.keyCode;
        var $input = $(e.target);
        var $items = $('#' + $input.attr("id") + '-autocomplete-content').children('li');
        var $selected = $items.filter('.selected');
        var $current;

        var $ul = $('#' + $input.attr("id") + '-autocomplete-content:visible');
        if ($ul.is(':visible')) {
            $items.removeClass('selected');

            if (key != 40 && key != 38 && key != 37 && key != 39 && key != 13) return;

            if (key == 40) {
                if (!$selected.length || $selected.is(':last-child')) {
                    $current = $items.eq(0);
                } else {
                    $current = $selected.next();
                    while ($current.is(':hidden')) {
                        if ($current.is(':last-child')) {
                            $current = $items.eq(0);
                        } else {
                            $current = $current.next();
                        }
                    }
                }
            }
            else if (key == 38) {
                if (!$selected.length || $selected.is(':first-child')) {
                    $current = $items.last();
                } else {
                    $current = $selected.prev();
                    while ($current.is(':hidden')) {
                        if ($current.is(':first-child')) {
                            $current = $items.last();
                        } else {
                            $current = $current.prev();
                        }
                    }
                }
            }
            else if (key == 37 || key == 39 || key == 13) {
                $current = $selected;
                $ul = $current.closest('ul.autocomplete-content');
                var $target = $('#' + $ul.data('target'));
                $target.val($current.text().trim());
                //$ul.addClass('hide');
                $target.focusin();
            }
            $current.addClass('selected');
            return false;
        }
    });

    $('*').not('.autocomlete, .autocomplete-option').click(function (e) {
        $('.autocomplete-content').addClass('hide');
    });
});
