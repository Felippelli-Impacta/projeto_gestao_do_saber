var slider_id;
$(function () {

	$(".slider").slider({
		range: "min",
		value: 0,
		min: 0,
		max: 100,
		animate: true,
		slide: function (event, ui) {
			$('span.at' + slider_id).html(ui.value);
			$('input.at' + slider_id).val(ui.value);

		},
		change: function (event, ui) {
			$('span.at' + slider_id).html(ui.value);
			$('input.at' + slider_id).val(ui.value);
		},
		stop: function (event, ui) {
			var data = $('#form' + slider_id).serialize();
			$.post(APP + 'saber/save/',
			data
			, function (e) {
				if(e.error==false){
					if($('#form' + slider_id+' .id').length ==0 )
						$('#form' + slider_id).append("<input name='Saber[id]' class='id' type='hidden'  value='"+e.saber.id+"'>");
				}
			}, 'json');
		},
		start: function (event, ui) {
			slider_id = event.currentTarget.getAttribute("rel");
		}
	});
    //$( ".nivel" ).val( "$" + $( ".slider"+$(this).attr('id') ).slider( "value" ) );
	//$(".nivel").val(0);


	//Seta o sliders nos valores salvos no banco
	$('.nivel').each(function(){
		slider_id=$(this).attr('rel')*1;
		$('.slider'+slider_id).slider('value',$(this).val());
	});
});
