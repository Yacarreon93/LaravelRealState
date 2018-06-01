;(function () {

  window.onload = function () {

    const url = '/estates/search'
    const inputs = {
      ref: $('input[name="search_ref"]'),
      label: $('input[name="search_label"]'),
      address: $('input[name="search_address"]')
    }

    setOnChangeHandle(inputs)

    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } })

    function setOnChangeHandle(inputs) {
      Object.keys(inputs).forEach(function(key) {
        inputs[key] && inputs[key].keyup(function() { search(inputs) })
      })
    }

    function getData(inputs) {
      const data = {}
      Object.keys(inputs).forEach(function(key) {
        data[key] = inputs[key].val();
      })
      return data
    }

    function regenPagination(response) {
        const {
          from,
          total,
          per_page,
          last_page,
          current_page,
          prev_page_url,
          next_page_url
        } = response
        const pages = total ? Math.ceil(total / per_page) : 0
        const pagesLinksLimit = 9;
        const pagination = $('.pagination')
        pagination.empty()
        let rowStr = ''
        rowStr += '<li class="show-mobile ' + (!prev_page_url ? 'disabled' : '') + '">'
        if (prev_page_url) {
          rowStr += '<a href="' + prev_page_url + '" rel="prev">«</a>'
        } else {
          rowStr += '<span>«</span>'
        }
        rowStr += '</li>'
        rowStr += '<li class="show-mobile ' + (current_page === from ? 'active' : '') +'">'
        rowStr += '<span>' + from + '</span>'
        rowStr += '</li>'
        let pageIndex = current_page - 1;
        let pagesCount = pagesLinksLimit - 4;
        while (pagesCount < pagesLinksLimit) {
            // console.log('asd', pagesCount, pagesLinksLimit, pageIndex)
            if (pageIndex === 0 || pageIndex === from) {
                pageIndex++
                continue
            } else if (pagesCount === pagesLinksLimit -1 && pageIndex !== last_page -1) {
                rowStr += '<li class="disabled">'
                rowStr += '<span>...</span>'
                rowStr += '</li>'
                pageIndex++
                pagesCount++
                continue
            }
            if (pageIndex === last_page) break;

            rowStr += '<li class="show-mobile ' + (pageIndex === current_page ? 'active' : '') +'">'
            rowStr += '<a href="/estates?page=' + pageIndex + '">' + pageIndex + '</a>'
            rowStr += '</li>'
            pageIndex++
            pagesCount++
        }
        //   if (i < from || i > last_page) {
        //     rowStr += '<li class="disabled">'
        //     rowStr += '<span>...</span>'
        //     rowStr += '</li>'
        //   } else {
        //     rowStr += '<li class="show-mobile ' + (i === current_page ? 'active' : '') +'">'
        //     rowStr += '<a href="/estates?page=' + i + '">' + i + '</a>'
        //     rowStr += '</li>'
        //   }
        rowStr += '<li class="show-mobile' + (current_page === last_page ? 'active' : '') +'">'
        rowStr += '<a href="/estates?page=' + last_page + '">' + last_page + '</a>'
        rowStr += '</li>'
        rowStr += '<li class="show-mobile ' + (!next_page_url ? 'disabled' : '') + '">'
        if (next_page_url) {
          rowStr += '<a href="' + next_page_url + '" rel="next">»</a>'
        } else {
          rowStr += '<span>»</span>'
        }
        rowStr += '</li>'
        pagination.append(rowStr)


    //   <li class="disabled show-mobile"><span>«</span></li>
      // pages.forEach(function(page) {
        // let rowStr = '<tr class="show-mobile">'
        //     rowStr += '<th scope="row"><a href="/estates/' + row.id + '">' + row.id + '</a></th>'
        //     rowStr += '<td>' + row.ref + '</td>'
        //     rowStr += '<td>' + row.label + '</td>'
        //     rowStr += '<td>' + row.address + '</td>'
        //     estatesList.append(rowStr)


        // <li class="show-mobile"><a href="http://localhost:8000/estates?page=13" rel="prev">«</a></li>
      // }
    }

    function search(inputs) {
      $.get(
        url,
        getData(inputs),
        function(response) {
          console.log('response', response)
          regenPagination(response)
          const { data } = response
          const estatesList = $('#estates-list')
          const sectionTitle = $('#section-title')
          const dataLength = data && data.length ? data.length : 0
          estatesList.empty()
          sectionTitle.html('Result (' + dataLength + ')')
          if (!dataLength) {
            let rowStr = '<tr>'
            rowStr += '<td colspan="4" class="text-center">No Results Found</td>'
            rowStr += '</tr>'
            return estatesList.append(rowStr)
          }
          data.forEach(function(row) {
            let rowStr = '<tr>'
            rowStr += '<th scope="row"><a href="/estates/' + row.id + '">' + row.id + '</a></th>'
            rowStr += '<td>' + row.ref + '</td>'
            rowStr += '<td>' + row.label + '</td>'
            rowStr += '<td>' + row.address + '</td>'
            estatesList.append(rowStr)
          })
        }
      )
    }

  }

})()
