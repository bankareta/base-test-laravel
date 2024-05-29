function slugify(text)
{
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}

function toggleSidebar() {
	if($('.pusher').hasClass('first-shown')) { $('.pusher').removeClass('first-shown') }

	if($('.ui.sidebar').sidebar('is hidden')){
          $('.pusher').addClass('shown')
          $('.ui.sidebar')
          .sidebar({
          	dimPage: false,
          	closable: false
          })
          .sidebar('show').removeClass('uncover');
      }else{
        // alert('no u')
        $('.pusher').removeClass('shown')
        $('.ui.sidebar')
        .sidebar({
        	dimPage: false,
        	closable: false
        })
        .sidebar('hide');
    }
}

$(document).ready(function() {
	$('.pusher').addClass('shown')
	$('.ui.sidebar')
		.sidebar({
			dimPage: false,
			closable: false
		})
		.sidebar('show');

	$('.message .close').on('click', function() {
		$(this).closest('.message').transition('fade');
	});

	$('.ui.accordion').accordion();

	$('.ui.sidebar > div').slimScroll({
		size: '5px',
		height: '100%'
	});
	setTimeout( function(){
		$('#cover').fadeOut('400');
	}, 500)


	$('.card').find('.three.buttons').slideUp(1)
	$('.layout.buttons button').tab()
	// $('table').tablesort()
	$('.filter .rangestart').calendar({
		type: 'date',
        text: {
          months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        },
		endCalendar: $('.filter .rangeend')
	});
	$('.filter .rangeend').calendar({
		type: 'date',
        text: {
          months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        },
		startCalendar: $('.filter .rangestart')
	});

	$('a.card').hover(function() {
		$(this).find('.three.buttons').slideDown(100)
	}, function(){
		$(this).find('.three.buttons').slideUp(100)
	});


  $(document).on('keydown', '.number.field input', function (e) {
      var key = e.which || e.keyCode; // http://keycode.info/

      if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
          // alphabet
          key >= 65 && key <= 90 ||
          // spacebar
          key == 32) {
          e.preventDefault();
          return false;
      }

      if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
          // numbers
          key >= 48 && key <= 57 ||
          // Numeric keypad
          key >= 96 && key <= 105 ||

          // allow: Ctrl+A
          (e.keyCode == 65 && e.ctrlKey === true) ||
          // allow: Ctrl+C
          (key == 67 && e.ctrlKey === true) ||
          // Allow: Ctrl+X
          (key == 88 && e.ctrlKey === true) ||

          // allow: home, end, left, right
          (key >= 35 && key <= 39) ||
          // Backspace and Tab and Enter
          key == 8 || key == 9 || key == 13 ||
          // Del and Ins
          key == 46 || key == 45) {
          return true;
      }


      var v = this.value; // v can be null, in case textbox is number and does not valid
      // if minus, dash
      if (key == 109 || key == 189) {
          // if already has -, ignore the new one
          if (v[0] === '-') {
              // console.log('return, already has - in the beginning');
              return false;
          }
      }

      if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
          // comma, period and numpad.dot
          key == 190 || key == 188 || key == 110) {
          // console.log('already having comma, period, dot', key);
          if (/[\.,]/.test(v)) {
              // console.log('return, already has , . somewhere');
              return false;
          }
      }
  });

  $(document).on('keyup', '.number.field input', function (e) {
      var v = this.value;

      if(false) {
      // if (+v) {
          // this condition check if convert to number success, let it be
          // put this condition will have better performance
          // but I haven't test it with cultureInfo = comma decimal separator, so, to support both . and , as decimalSeparator, I remove this condition
          //                      "1000"  "10.9"  "1,000.9"   "011"   "10c"   "$10"
          //+str, str*1, str-0    1000    10.9    NaN         11      NaN     NaN
      } else if (v) {
          // refine the value

          // this replace also remove the -, we add it again if needed
          // v = (v[0] === '-' ? '-' : '') +
          //     (useCommaAsDecimalSeparator ?
          //         v.replace(/[^0-9\,]/g, '') :
          //         v.replace(/[^0-9\.]/g, ''));
          v = (v[0] === '-' ? '-' : '') + v.replace(/[^0-9\.]/g, '');

          // remove all decimalSeparator that have other decimalSeparator following. After this processing, only the last decimalSeparator is kept.
          // if(useCommaAsDecimalSeparator){
          //     v = v.replace(/,(?=(.*),)+/g, '');
          // } else {
          //     v = v.replace(/\.(?=(.*)\.)+/g, '');
          // }
          v = v.replace(/\.(?=(.*)\.)+/g, '');

          //console.log(this.value, v);
          this.value = v; // update value only if we changed it
      }
  });

  $(document).on('keydown', '.coderegex.field input', function (e) {
      var key = e.which || e.keyCode; // http://keycode.info/

      if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
          // alphabet
          key >= 65 && key <= 90 ||
          // spacebar
          key == 32) {
          e.preventDefault();
          return false;
      }

      if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
          // numbers
          key >= 48 && key <= 57 ||
          // Numeric keypad
          key >= 96 && key <= 105 ||

          // allow: Ctrl+A
          (e.keyCode == 65 && e.ctrlKey === true) ||
          // allow: Ctrl+C
          (key == 67 && e.ctrlKey === true) ||
          // Allow: Ctrl+X
          (key == 88 && e.ctrlKey === true) ||

          // allow: home, end, left, right
          (key >= 35 && key <= 39) ||
          // Backspace and Tab and Enter
          key == 8 || key == 9 || key == 13 ||
          // Del and Ins
          key == 46 || key == 45) {
          return true;
      }


      var v = this.value; // v can be null, in case textbox is number and does not valid
      // if minus, dash
      if (key == 109 || key == 189) {
          // if already has -, ignore the new one
          if (v[0] === '-') {
              // console.log('return, already has - in the beginning');
              return false;
          }
      }

      if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
          // comma, period and numpad.dot
          key == 190 || key == 188 || key == 110) {
          // console.log('already having comma, period, dot', key);
          if (/[\.,]/.test(v)) {
              // console.log('return, already has , . somewhere');
              return false;
          }
      }
  });

  $(document).on('keyup', '.coderegex.field input', function (e) {
      var v = this.value;
      if(false) {
      // if (+v) {
          // this condition check if convert to number success, let it be
          // put this condition will have better performance
          // but I haven't test it with cultureInfo = comma decimal separator, so, to support both . and , as decimalSeparator, I remove this condition
          //                      "1000"  "10.9"  "1,000.9"   "011"   "10c"   "$10"
          //+str, str*1, str-0    1000    10.9    NaN         11      NaN     NaN
      } else if (v) {
          // refine the value

          // this replace also remove the -, we add it again if needed
          // v = (v[0] === '-' ? '-' : '') +
          //     (useCommaAsDecimalSeparator ?
          //         v.replace(/[^0-9\,]/g, '') :
          //         v.replace(/[^0-9\.]/g, ''));
          v = (v[0] === '-' ? '' : '') + v.replace(/[^0-9\.\-\/]/g, '');

          // remove all decimalSeparator that have other decimalSeparator following. After this processing, only the last decimalSeparator is kept.
          // if(useCommaAsDecimalSeparator){
          //     v = v.replace(/,(?=(.*),)+/g, '');
          // } else {
          //     v = v.replace(/\.(?=(.*)\.)+/g, '');
          // }
          v = v.replace(/\.(?=(.*)\.)+/g, '');

          //console.log(this.value, v);
          this.value = v; // update value only if we changed it
      }
  });
});
