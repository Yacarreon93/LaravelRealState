;(function () {
    document.onreadystatechange = function () {
        if (document.readyState === 'complete') {
            $('ul.pagination li.active')
                .prev().addClass('show-mobile')
                .prev().addClass('show-mobile')
            $('ul.pagination li.active')
                .next().addClass('show-mobile')
                .next().addClass('show-mobile')
            $('ul.pagination')
                .find('li:first-child, li:last-child, li.active')
                .addClass('show-mobile')
        }
    }
})()
