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

    function search(inputs) {
      $.get(
        url,
        getData(inputs),
        function(response) {
          const { data } = response
          const estatesList = $('#estates-list')
          estatesList.empty()
          if (!data || !data.length) {
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
