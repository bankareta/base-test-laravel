
<script type="text/javascript">
$(document).on('change', '#file', function () {
    var payload = new FormData();
    payload.append('_token', '{{ csrf_token() }}')
    payload.append('file', document.getElementById('file').files[0])

    var xhr = new XMLHttpRequest();
    var progressBar = document.getElementById("progress");
    var element = $('#progress');
    xhr.open('POST', '{{ url('front/induction/upload') }}', true);

    xhr.upload.onprogress = function (e) {
        if (e.lengthComputable) {
            element.progress({
                total : e.total,
                value : e.loaded,
            })
        }
    }
    xhr.upload.onloadstart = function (e) {
        element.progress({
            total : e.total,
            value : 0,
        })
    }
    xhr.upload.onloadend = function (e) {
        element.progress({
            value : e.loaded,
        })
    }

    xhr.send(payload);

    xhr.onreadystatechange = function() {
        if(xhr.readyState == XMLHttpRequest.DONE)
        {
            var response = JSON.parse(xhr.responseText);
            if(!response['status'])
            {
                element.progress('set error');
                element.progress('set label', 'Upload Failed');
            }else{
                element.progress('set success');
                element.progress('set label', 'Upload Success');
            }
        }
    }
});
</script>
