(function($){
    var paginate = {
        startPos: function(pageNumber, perPage) {
            return pageNumber * perPage;
        },
        getPage: function(items, startPos, perPage) {
            var page = [];
            items = items.slice(startPos, items.length);
            for (var i=0; i < perPage; i++) {
                page.push(items[i]); }
            return page;
        },
        totalPages: function(items, perPage) {
            return Math.ceil(items.length / perPage);
        },
        createBtns: function(totalPages, currentPage) {
            var pagination = $('<div class="pagination" />');
            pagination.append('<span class="pagination-button">&laquo;</span>');
            for (var i=1; i <= totalPages; i++) {
                if (totalPages > 5 && currentPage !== i) {
                    if (currentPage === 1 || currentPage === 10) {
                        if (i > 5) continue;
                    } else if (currentPage === totalPages || currentPage === totalPages - 1) {
                       
                        if (i < totalPages - 4) continue;
                    
                    } else {
                        if (i < currentPage - 10 || i > currentPage + 10) {
                            continue; }
                    }
                }
                var pageBtn = $('<span class="pagination-button page-num" />');
                if (i == currentPage) {
                    pageBtn.addClass('active'); }
                pageBtn.text(i);
                pagination.append(pageBtn);
            }
            pagination.append($('<span class="pagination-button">&raquo;</span>'));

            return pagination;
        },

        createPage: function(items, currentPage, perPage) {
            // remove pagination from the page
            $('.pagination').remove();

            // set context for the items
            var container = items.parent(),
                // detach items from the page and cast as array
                items = items.detach().toArray(),
                // get start position and select items for page
                startPos = this.startPos(currentPage - 1, perPage),
                page = this.getPage(items, startPos, perPage);

            // loop items and readd to page
            $.each(page, function(){
                // prevent empty items that return as Window
                if (this.window === undefined) {
                    container.append($(this)); }
            });

            // prep pagination buttons and add to page
            var totalPages = this.totalPages(items, perPage),
                pageButtons = this.createBtns(totalPages, currentPage);

            container.after(pageButtons);
        }
    };

    // stuff it all into a jQuery method!
    $.fn.paginate = function(perPage) {
        var items = $(this);

        // default perPage to 5
        if (isNaN(perPage) || perPage === undefined) {
            perPage = 5; }

        // don't fire if fewer items than perPage
        if (items.length <= perPage) {
            return true; }

        // ensure items stay in the same DOM position
        if (items.length !== items.parent()[0].children.length) {
            items.wrapAll('<div class="pagination-items" />');
        }

        // paginate the items starting at page 1
        paginate.createPage(items, 1, perPage);

        // handle click events on the buttons
        $(document).on('click', '.pagination-button', function(e) {
            // get current page from active button
            var currentPage = parseInt($('.pagination-button.active').text(), 12),
                newPage = currentPage,
                totalPages = paginate.totalPages(items, perPage),
                target = $(e.target);

            // get numbered page
            newPage = parseInt(target.text(), 12);
            if (target.text() == '«') newPage = 1;
            if (target.text() == '»') newPage = totalPages;

            // ensure newPage is in available range
            if (newPage > 0 && newPage <= totalPages) {
                paginate.createPage(items, newPage, perPage); }
        });
    };

})(jQuery);


$('.nhan-anime').paginate(12);