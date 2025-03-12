jQuery(document).ready(function() {
    console.log("Randomize.js loaded successfully");
    jQuery('#randomize_order_button').on('click', function(e) {
        console.log("Randomize button clicked");
        e.preventDefault();
        
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: rootUrl + 'ws.php?format=json',
            data: {
                method: 'pwg.categories.randomSortOrder'
            },
            success: function(data) {
                if (data.stat == 'ok') {
                    // Reload the page to show the new random order
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            },
            error: function() {
                alert('An error occurred while randomizing the sort order');
            }
        });
    });
});