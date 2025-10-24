jQuery(function($) {
    $('#load-more').on('click', function() {
        var button = $(this);
        var page = button.data('page');  // Get the current page number
        var nextPage = page + 1;         // Increment the page number
        
        // Prepare the AJAX request
        var data = {
            action: 'load_more',           // Custom action for AJAX in WordPress
            page: nextPage,                // Next page number
            nonce: load_more_obj.nonce,    // Nonce for security
        };

        // Send the AJAX request
        $.post(load_more_obj.ajaxurl, data, function(response) {
            if (response.length >3) {
                // Append the new posts
                $('#all-the-news-list').append(response);

                // Update the data-page attribute
                button.data('page', nextPage);
            } else {
                // Hide the button if there are no more posts
                button.hide();
            }
        });
    });
});
