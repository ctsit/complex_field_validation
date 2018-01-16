$('document').ready(function() {
/*
 * Finds additional valid options outside of min-max ranges.
 *
 * Searches for field notes that have children elements of class "valid". For
 * all that are found, store the original REDCap validation (found in the
 * "onblur" event callback) and replace it with a custom one.
 *
 * If the user enters a value not found in the list of additional valid
 * options, the original REDCap validation is called.
 */

    function isValueOnRange(val) {
      var ranges = complex_field_validation_tag_values;
      for(i = 0; i < ranges.length; i++){
        if(ranges[i].length == 1){
          if(val == ranges[i][0])
            return true;
        }
        if(ranges[i].length == 2){
          if(val >= ranges[i][0] && val <= ranges[i][1])
            return true;
        }
      }

      return false;
    
    }

    $( "input" ).filter(function( index, element ) {
      return $(element).siblings(".note:has('.valid')").length > 0;
    })
    .each(function( index, element ) {
      var additionalOptions = $(element).siblings(".note").find('.valid');
      var original = element.onblur;
      element.onblur = null;
      $(element).on( "blur", function( evt ) {
        var val = this.value;
        var matches = additionalOptions.filter(function( index, element ) {
          return $(element).text() == val || isValueOnRange(val);
        });
        if ( matches.length == 0 ) {
          $(this).trigger( "original", original );
        }
        else{
          element.style.backgroundColor="white";
        }
      }).on( "original", original );
    });
});


