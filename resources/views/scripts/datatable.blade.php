<script type="text/javascript">
	$(document).ready(function() {
		$('button[data-content]').popup({
			hoverable: true,
			position : 'top center',
			delay: {
				show: 300,
				hide: 800
			}
		});
		$('.ui.search.dropdown').dropdown({
            fullTextSearch: 'exact',
        });
		dt = $('#listTable').DataTable({
      dom: 'rt<"bottom"ip><"clear">',
			responsive: true,
			autoWidth: false,
			processing: false,
			serverSide: true,
			lengthChange: false,
			pageLength: 10,
			filter: false,
			deferRender: true,
			sorting: [],
			stripeClasses: [],
			ajax:  {
				url: "{{ url($pageUrl) }}/grid",
				type: 'POST',
				data: function (d) {
					d._token = "{{ csrf_token() }}";
					@yield('js-filters')
				}
			},
			columns: {!! json_encode($tableStruct) !!},
			drawCallback: function() {
				var api = this.api();

				api.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i, x, y) {
					cell.innerHTML = parseInt(cell.innerHTML)+i+1;
				} );

				$('[data-content]').popup({
					hoverable: true,
					position : 'top center',
					delay: {
						show: 300,
						hide: 800
					}
				});
				$('.ui.cekpopup').popup({
					hoverable: true,
					setFluidWidth:'100%',
		            position : 'right center',
		            boundary: '.ui.segments'
		        });
			}
		});

    $('select[name="filter[page]"]').on('change', function(e) {
    	var length = this.value // $("input[name='filter[entri]']").val();
			length = (length != '') ? length : 10;
			dt.page.len(length).draw();
			e.preventDefault();
		});

		$('input[name^="filter"]').keyup(function(event) {
		    if (event.which == 13 && this.value != '') {
		        event.preventDefault();
		        $('.filter.button').trigger('click');
		    }
		});

		$('.filter.button').on('click', function(e) {
			dt.draw();
			e.preventDefault();
		});

    $.fn.dataTable.ext.errMode = 'none';

    $('#listTable').on( 'error.dt', function ( e, settings, techNote, message ) {
    	console.log( 'An error has been reported by DataTables: ', message );
    }) ;

	});
</script>
