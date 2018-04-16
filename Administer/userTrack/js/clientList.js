jQuery(function ($) {

    /**
     * Helper class to manage the date range filter
     * @param  {jQuery} el jQuery wrap object
     * @return {[type]}    [description]
     */
    var rangeFilter = function (el) {

        el = el || $('body');

        var fromInput = $('input[name=from]', el);
        var toInput = $('input[name=to]', el);

        /**
         * Converts a Date to "YYYY-MM-DD"
         * @param  {Date} date
         * @return {String} converted date
         */
        function shortISO (date) {
            return date.toISOString().substring(0,10);
        }

        /**
         * Updates the form and to date inputs 
         * to display the specified range
         * @param {Date} start 
         * @param {Date} end  
         */
        this.setRange =  function (start, end) {
            fromInput.val(shortISO(start));
            toInput.val(shortISO(end));
        }
    };

    var range= new rangeFilter($('#rangeFilter'));
    
    // Default value is 6 months of data
    var end = new Date();
    var start = new Date(end);
    start.setMonth(start.getMonth() - 6);

    range.setRange(start, end);

    // Update the list on filter change
    $('.filter *').on('change', function (){
        userTrackAjax.populateClientsList(0);
    });


    jQuery('#deleteRecords').dblclick(function () {

        // Delete all data for selected clients
        if (jQuery('#recordList tr.selected').length !== 0) {
            jQuery('#recordList tr.selected').each(function () {
                userTrackAjax.deleteClient(jQuery(this).attr('data-id'), this);
            });
            return;
        } else {
            alert("No records selected!");
        }
    });

    jQuery('#cleanDatabase').dblclick(function () {
        userTrackAjax.cleanDataForDomain(options.domain);
    });

    jQuery('#deleteZeroRecords').dblclick(function () {
        userTrackAjax.deleteZeroRecords(options.domain);
    });
});