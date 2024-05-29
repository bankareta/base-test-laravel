<script>
    initModal = function(){
        $(document).ready(function () {
            var csrftoken = '{{ csrf_token() }}';
            var on_button = false;
            $(window).on('unload', function() {
                if (!on_button)
                {
                    deletefile();
                }
            });
            $('.mindate').calendar({
                type: 'date',
                initialDate: new Date(),
                minDate: new Date(),
                text: {
                },
                onChange: function (date, text) {
                    var dateShow= date.getDate();
                    var monthShow= date.getMonth()+1;
                    $('.maxdate').calendar({
                        type: 'date',
                        minDate: new Date(" "+monthShow+" "+dateShow+" "+date.getFullYear()),
                    });
                },
            });
        });
        $('.special.cards .image').dimmer({
            on: 'hover'
        });
        $('#materialFile').change(function() {
            var el = $(this);
            if(el.val() == ''){
                $('#fileArea').css('display','none');
                $('#ytArea').css('display','none');
            }else{
                if(el.val() === '0') {
                $('#fileArea').css('display','none');
                $('#ytArea').css('display','');
                }
                else{
                    $('#fileArea').css('display','');
                    $('#ytArea').css('display','none');
                }
            }
        });

        
        $('.deny').on('click', function(){
            deletefile();
        });
        
        $('.delete-file').on('click', function(){
            url = $(this).data('url');
            $(this).parent().parent().parent().parent().parent().remove();
            if($('.ui.dimmable.small.card').length == 0){
                $('.areafile').css('display','none');
            }

            $('.showdeletefile').append(`
                <input type="hidden" value="`+url+`" name="filedelete[]">
            `);
        });

        function deletefile() {
            var urldel = '{{ url('picture/bulk-unlink') }}';
            var csrftoken = '{{ csrf_token() }}';
            var element = $('input[name="fileurl[]"]')
            if(element.length > 0)
            {
                var filedelete = [];
                var payload = new FormData();
                payload.append('_token', csrftoken)
                for(i=0; i < element.length; i++)
                {
                    payload.append('filedelete['+i+']', element[i].value)
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', urldel, false);
                xhr.send(payload);
                xhr.onreadystatechange = function() {
                    if(xhr.readyState == XMLHttpRequest.DONE)
                    {
                        console.log(filedelete);
                    }
                }
            }
        }
    }
  </script>