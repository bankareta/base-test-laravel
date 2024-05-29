@extends('layouts.list')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('filters')
<div class="field">
	<select id="company" name="filter[company]" class="ui fluid search dropdown">
        {!! App\Models\Master\Site::options('name','id',[
          'filters' => [
            function ($site) {
                $site->whereIn('id', auth()->user()->site->pluck('id')->toArray());
              },
            ]
          ], 'Choose Company') !!}
      </select>
</div>
<div class="field year">
	<input type="text" name="filter[year]" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')"  placeholder="Year" value="">
</div>
{{-- <div class="field">
	<input type="text" name="filter[name]"  placeholder="Area" value="">
</div> --}}


<button type="button" class="ui teal icon filter button" data-content="Cari Data">
	<i class="search icon"></i>
</button>
<button type="reset" class="ui icon reset button" data-content="Bersihkan Pencarian">
	<i class="refresh icon"></i>
</button>
@endsection

@section('js-filters')
d.year = $("input[name='filter[year]']").val();
{{-- d.contract_no = $("input[name='filter[contract_no]']").val(); --}}
d.company = $("select[name='filter[company]']").val();
@endsection

@section('toolbars')
  <button type="button" class="ui green @if($pagePerms != '' && !auth()->user()->can($pagePerms.'-add')) disabled @endif button add-recap">
    <i class="server icon"></i>
      Print Summary
  </button>
  <button type="button" class="ui red @if($pagePerms != '' && !auth()->user()->can($pagePerms.'-add')) disabled @endif button add-restock">
    <i class="refresh icon"></i>
      Transactions
    </button>
  <button type="button" class="ui blue @if($pagePerms != '' && !auth()->user()->can($pagePerms.'-add')) disabled @endif button add">
    <i class="add icon"></i>
      Create New Data
  </button>
@endsection

@section('rules')
<script type="text/javascript">
	formRules = {
		judul: 'empty',
		sub_judul: 'empty',
		url: 'url',
	};
</script>
@endsection

@section('scripts')
<script>
  initModal = function(){
    $('.ui.tabular .item').tab();
    $('.date').calendar({
      type: 'date',
    });
    $('.year').calendar({
      type: 'year',
    });
    
    $('.yearTrans').calendar({
      type: 'year',
      onChange: function (date, text, mode) {
        $('#medicineTrans').dropdown('clear');
        var year = text;
        var val = $('#companyChoiseTrans option:selected').val();
        if(val !== '' && year !== ''){
          var url = '{{ url($pageUrl.'filter-medicine/') }}';
          $.ajax({
            url: url+'/'+val+'?type=trans&year='+year,
            type: "GET",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(resp){
                $('#medicineTrans').html(resp.data);
                $('#medicineTrans').dropdown();
                $('#medicineTrans').dropdown('refresh');
            },
            error : function(resp){

            },
          });
        }else{
          val = '-';
          var url = '{{ url($pageUrl.'filter-medicine/') }}';
          $.ajax({
            url: url+'/'+val+'?type=trans',
            type: "GET",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(resp){
                $('#medicineTrans').html(resp.data);
                $('#medicineTrans').dropdown();
                $('#medicineTrans').dropdown('refresh');
            },
            error : function(resp){

            },
          });
        }
      },
    });

    $('.yearStock').calendar({
      type: 'year',
      onChange: function (date, text, mode) {
        $('#medicine').dropdown('clear');
        var val = $('#companyChoise option:selected').val();
        var year = text;
        if(val !== '' && year !== ''){
          if(!val){
            val = '-';
          }
          var url = '{{ url($pageUrl.'filter-medicine/') }}';
          $.ajax({
            url: url+'/'+val+'?year='+year,
            type: "GET",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(resp){
                $('#medicine').html(resp.data);
                $('#medicine').dropdown();
                $('#medicine').dropdown('refresh');
            },
            error : function(resp){

            },
          });
        }else{
          val = '-';
          var url = '{{ url($pageUrl.'filter-medicine/') }}';
          $.ajax({
            url: url+'/'+val,
            type: "GET",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(resp){
                $('#medicine').html(resp.data);
                $('#medicine').dropdown();
                $('#medicine').dropdown('refresh');
            },
            error : function(resp){

            },
          });
        }
      }
    });

    $('#companyChoise').on('change', function(e){
      $('#medicine').dropdown('clear');
      var val = $('#companyChoise option:selected').val();
      var year = $('#year').val();
      if(val !== '' && year !== ''){
        if(!val){
          val = '-';
        }
        var url = '{{ url($pageUrl.'filter-medicine/') }}';
        $.ajax({
          url: url+'/'+val+'?year='+year,
          type: "GET",
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(resp){
              $('#medicine').html(resp.data);
              $('#medicine').dropdown();
              $('#medicine').dropdown('refresh');
          },
          error : function(resp){

          },
        });
      }else{
        val = '-';
        var url = '{{ url($pageUrl.'filter-medicine/') }}';
        $.ajax({
          url: url+'/'+val,
          type: "GET",
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(resp){
              $('#medicine').html(resp.data);
              $('#medicine').dropdown();
              $('#medicine').dropdown('refresh');
          },
          error : function(resp){

          },
        });
      }
    });

    $('#companyChoiseTrans').on('change', function(e){
      $('#medicineTrans').dropdown('clear');
      var year = $('#yearTrans').val();
      var val = $('#companyChoiseTrans option:selected').val();
      if(val !== '' && year !== ''){
        var url = '{{ url($pageUrl.'filter-medicine/') }}';
        $.ajax({
          url: url+'/'+val+'?type=trans&year='+year,
          type: "GET",
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(resp){
              $('#medicineTrans').html(resp.data);
              $('#medicineTrans').dropdown();
              $('#medicineTrans').dropdown('refresh');
          },
          error : function(resp){

          },
        });
      }else{
        val = '-';
        var url = '{{ url($pageUrl.'filter-medicine/') }}';
        $.ajax({
          url: url+'/'+val+'?type=trans',
          type: "GET",
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(resp){
              $('#medicineTrans').html(resp.data);
              $('#medicineTrans').dropdown();
              $('#medicineTrans').dropdown('refresh');
          },
          error : function(resp){

          },
        });
      }
    });
    
    $('#medicineTrans').on('change', function(e){
      $('#expireTrans').dropdown('clear');
      var val = $('#medicineTrans option:selected').val();
      if(!val){
        val = '-';
      }
      var url = '{{ url($pageUrl.'filter-medicine/') }}';
      $.ajax({
        url: url+'/'+val+'?type=stock',
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(resp){
            $('#totalStok').val(resp.data);
            $('#expireTrans').html(resp.expire);
            $('#expireTrans').dropdown();
            $('#expireTrans').dropdown('refresh');
        },
        error : function(resp){
          $('#expireTrans').html(resp.expire);
          $('#expireTrans').dropdown();
          $('#expireTrans').dropdown('refresh');
        },
      });
    });
    
    $('#expireTrans').on('change', function(e){
      var val = $('#expireTrans option:selected').val();
      if(!val){
        val = '-';
      }
      var id = $('#medicineTrans option:selected').val();
      if(!id){
        id = '-';
      }
      var url = '{{ url($pageUrl.'filter-medicine/') }}';
      $.ajax({
        url: url+'/'+id+'?type=stockExpire&expire_date='+val,
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(resp){
            $('#totalExpireStok').val(resp.data);
        },
        error : function(resp){
          
        },
      });
    });

    $('#medicine').on('change', function(e){
      var val = $('#medicine option:selected').val();
      if(!val){
        val = '-';
      }
      var url = '{{ url($pageUrl.'filter-medicine/') }}';
      $.ajax({
        url: url+'/'+val+'?type=stock',
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(resp){
            $('#totalStokExist').val(resp.data);
        },
        error : function(resp){

        },
      });
    });

    $(document).on('click', '.tab-set', function(e){
      $('#type-trans').val($(this).data('type'));
    });
  }
  $(document).on('click', '.ui.add-recap.button', function(event) {
    event.preventDefault();
    // /* Act on the event */
    loadModal({
        'url' : '{{ url($pageUrl) }}/recap',
        'modal' : '.{{ $modalSize }}.modal',
        'formId' : '#dataForm',
        'onShow' : function(){
            onShow();
        },
        'onApprove' : function(){
          modal = '.{{ $modalSize }}.modal';
          $(modal).find('.loading.dimmer').addClass('active');
          site_id = $('#site_id option:selected');
          year = $('#yearData').val();
          if(site_id.val() === '' && year === ''){
            index = 'site_id';
            val = ['Cannot be empty'];
            index2 = 'year';
            val2 = ['Cannot be empty'];
            clearFormError(index,val);
            showFormError(index,val);
            clearFormError(index2,val2);
            showFormError(index2,val2);

            time = 5;
            interval = setInterval(function(){
              time--;
              if(time == 0){
                clearInterval(interval);
                $('.pointing.prompt.label.transition.visible').fadeOut('slideUp', function(e) {
                  $(this).remove();
                });
                $('.error').each(function (index, val) {
                  $(val).removeClass('error');
                });
              }
            },1000);
          }else if(site_id === ''){
            index = 'site_id';
            val = ['Cannot be empty'];
            clearFormError(index,val);
            showFormError(index,val);
            time = 5;
            interval = setInterval(function(){
              time--;
              if(time == 0){
                clearInterval(interval);
                $('.pointing.prompt.label.transition.visible').fadeOut('slideUp', function(e) {
                  $(this).remove();
                });
                $('.error').each(function (index, val) {
                  $(val).removeClass('error');
                });
              }
            },1000);
          }else if(year === ''){
            index = 'year';
            val = ['Cannot be empty'];
            clearFormError(index,val);
            showFormError(index,val);

            time = 5;
            interval = setInterval(function(){
              time--;
              if(time == 0){
                clearInterval(interval);
                $('.pointing.prompt.label.transition.visible').fadeOut('slideUp', function(e) {
                  $(this).remove();
                });
                $('.error').each(function (index, val) {
                  $(val).removeClass('error');
                });
              }
            },1000);
          }else{
            $.ajax({
              url: '{{ url($pageUrl) }}/print-summary',
              type: "POST",
              data: $('#dataForm').serialize(),
              xhrFields: {
                  responseType: 'blob'  // without this, you will get blank pdf!
              },
              success: function(response){
                blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                saveAs(blob, site_id.html()+'-'+year+".xlsx");
                swal({
                  title: 'Successfully',
                  text: " ",
                  type: 'success',
                  allowOutsideClick: false
                }).then((result) => {
                  $(modal).modal('hide');
                  dt.draw('page');
                  return true;
                })
              },
              error : function(resp){
                var mes = 'Data not found.';
                swal(
										'Failed Action!',
										mes,
										'error'
									);
              },
            });
          }
          $(modal).find('.loading.dimmer').removeClass('active');
        }
    })
  });

  $(document).on('click', '.ui.add-restock.button', function(event) {
    event.preventDefault();
    // /* Act on the event */
    loadModal({
        'url' : '{{ url($pageUrl) }}/restock',
        'modal' : '.{{ $modalSize }}.modal',
        'formId' : '#dataForm',
        'onShow' : function(){
            onShow();
        },
    })
  });
</script>
@endsection
