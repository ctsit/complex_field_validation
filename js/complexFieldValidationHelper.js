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
          return $(element).text() == val;
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
