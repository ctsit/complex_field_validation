$(document).ready(function() {
    // Checking if field annotation is present on this page.
    if ($('#div_field_annotation').length === 0) {
        return false;
    }

    $('body').on('dialogopen', function(event, ui) {
        var $popup = $(event.target);
        if ($popup.prop('id') !== 'action_tag_explain_popup') {
            // That's not the popup we are looking for...
            return false;
        }

        // Aux function that checks if text matches the "@DEFAULT" string.
        var isDefaultLabelColumn = function() {
            return $(this).text() === '@DEFAULT';
        }

        // Getting @DEFAULT row from action tags help table.
        var $default_action_tag = $popup.find('td').filter(isDefaultLabelColumn).parent();
        if ($default_action_tag.length !== 1) {
            return false;
        }

        var tag_name = '@EXTRA-VALID-RANGES';
        var descr = 'Adds valid options outside of the min-max range for a form field with number validation. For example, by adding the action tag @EXTRA-VALID-RANGES = "88,95-97,13,15-17,24", the user will be allowed to enter any of the following numbers (in addition to the range already defined): 88, 24, any number between 15 and 17, and any number between 95 and 97.';

        // Creating a new action tag row.
        var $new_action_tag = $default_action_tag.clone();
        var $cols = $new_action_tag.children('td');
        var $button = $cols.find('button');

        // Column 1: updating button behavior.
        $button.attr('onclick', $button.attr('onclick').replace('@DEFAULT', tag_name));

        // Columns 2: updating action tag label.
        $cols.filter(isDefaultLabelColumn).text(tag_name);

        // Column 3: updating action tag description.
        $cols.last().text(descr);

        // Placing new action tag.
        $new_action_tag.insertAfter($default_action_tag);
    });
});
