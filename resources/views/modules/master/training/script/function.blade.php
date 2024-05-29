<script type="text/javascript">
$(document).ready(function () {
    $('input[name="time_limit"]').parents('.ui.checkbox').checkbox({
        onChecked : function () {
            $('.timelimit').removeClass('disabled');
        },
        onUnchecked : function () {
            $('.timelimit').addClass('disabled');
        },
    })
    if($('input[name="time_limit"]').parents('.ui.checkbox').checkbox('is checked'))
    {
        $('.timelimit').removeClass('disabled');
    }else{
        $('.timelimit').addClass('disabled');
    }
    $('input[name="min_score"]').parents('.ui.checkbox').checkbox({
        onChecked : function () {
            $('.minscore').removeClass('disabled');
            $('.minscore').attr('disabled', false);
        },
        onUnchecked : function () {
            $('.minscore').addClass('disabled');
            $('.minscore').attr('disabled', true);
        },
    })
    if($('input[name="min_score"]').parents('.ui.checkbox').checkbox('is checked'))
    {
        $('.minscore').removeClass('disabled');
        $('.minscore').attr('disabled', false);
    }else{
        $('.minscore').addClass('disabled');
        $('.minscore').attr('disabled', true);
    }

    $('input[name="retake"][value="2"]').parents('.ui.checkbox').checkbox({
        onChecked : function () {
            $('.retake').removeClass('disabled');
            $('input[name="retake"][value="1"]').parents('.ui.checkbox').checkbox('set unchecked');
        },
        onUnchecked : function () {
            $('.retake').addClass('disabled');
        },
    })
    if($('input[name="retake"][value="2"]').parents('.ui.checkbox').checkbox('is checked'))
    {
        $('.retake').removeClass('disabled');
        $('input[name="retake"][value="1"]').parents('.ui.checkbox').checkbox('set unchecked');
    }else{
        $('.retake').addClass('disabled');
    }

    $('input[name="retake"][value="1"]').parents('.ui.checkbox').checkbox({
        onChecked : function () {
            $('.retake').addClass('disabled');
            $('input[name="retake"][value="2"]').parents('.ui.checkbox').checkbox('set unchecked');
        },
        onUnchecked : function () {
            $('.retake').removeClass('disabled');
        },
    })
    if($('input[name="retake"][value="1"]').parents('.ui.checkbox').checkbox('is checked'))
    {
        $('.retake').addClass('disabled');
        $('input[name="retake"][value="2"]').parents('.ui.checkbox').checkbox('set unchecked');
    }else{
        $('.retake').removeClass('disabled');
    }
    $('input[name="sent_email"][value="1"]').parents('.ui.checkbox').checkbox({
        onChecked : function () {
            $('.sendemail').removeClass('disabled');
        },
        onUnchecked : function () {
            $('.sendemail').addClass('disabled');
        },
    })
    if($('input[name="sent_email"][value="1"]').parents('.ui.checkbox').checkbox('is checked'))
    {
        $('.sendemail').removeClass('disabled');
    }else{
        $('.sendemail').addClass('disabled');
    }
    $('input[name="expired"]').parents('.ui.checkbox').checkbox({
        onChecked : function () {
            $('input[name="expired_date"]').attr('disabled', false);
        },
        onUnchecked : function () {
            $('input[name="expired_date"]').attr('disabled', true);
        },
    })
    if($('input[name="expired"]').parents('.ui.checkbox').checkbox('is checked'))
    {
        $('input[name="expired_date"]').attr('disabled', false);
    }else{
        $('input[name="expired_date"]').attr('disabled', true);
    }
    $('input[name="repeat"]').parents('.ui.checkbox').checkbox({
        onChecked : function () {
            $('.repeatmonths').removeClass('disabled');
            $('.repeatmonths').attr('disabled', false);
        },
        onUnchecked : function () {
            $('.repeatmonths').addClass('disabled');
            $('.repeatmonths').attr('disabled', true);
        },
    })
    if($('input[name="repeat"]').parents('.ui.checkbox').checkbox('is checked'))
    {
        $('.repeatmonths').removeClass('disabled');
        $('.repeatmonths').attr('disabled', false);
    }else{
        $('.repeatmonths').addClass('disabled');
        $('.repeatmonths').attr('disabled', true);
    }
})
</script>
