@if(isset($userStruct))
<script>
$(document).ready(function () {
user = $('#userTable').DataTable({
      dom: 'rt<"bottom"ip><"clear">',
      responsive: true,
      autoWidth: false,
      processing: true,
      serverSide: true,
      lengthChange: false,
      pageLength: 10,
      filter: false,
      sorting: [],
      language: {
        url: "{{ asset('plugins/datatables/indonesian.json') }}"
      },
      ajax:  {
        url: "{{ url($pageUrl) }}/grid-user",
        type: 'POST',
        data: function (d) {
          d._token = "{{ csrf_token() }}";
          d.bulletin_id = "{{ $record->id }}";
          d.username = $('input[name="filter[username]"]').val();
          d.reviewed = $('select[name="filter[reviewed]"]').val();
        }
      },
      columns: {!! json_encode($userStruct) !!},
      drawCallback: function() {
        var api = this.api();
        api.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          start = cell.innerHTML;
          cell.innerHTML = (parseInt(start) + (i+1));
        });

        $('[data-content]').popup({
          hoverable: true,
          position : 'top center',
          delay: {
            show: 300,
            hide: 800
          }
        });

        //Popup
        $('.checked.checkbox')
          .popup({
            popup : $('.custom.popup'),
            on    : 'click'
          })
        ;
      }
    });
  });

  $(document).on('click', '.ui.icon.filter.button', function () {
    user.draw();
  })

  $(document).on('click', '.ui.icon.reset.button', function () {
    $('input[name^="filter"]').each(function (index, value) {
        $(value).val('');
    })
    user.draw();
  })
</script>
@endif
