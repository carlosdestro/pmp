$(function()
{
$("#dialog").hide();
	$.last_value = '';

	var change = function(e)
	{
		setTimeout(change, 200);
		
		var value = $('form').serialize();

		if(value == $.last_value)
			return;

		$.last_value = value;

		update();

	}

	setTimeout(change, 200);

	var $grid = $("TBODY:first");

	var $template = $(".tr_template");

	var update_callback = function(data)
	{
		$grid.empty();

		for(var i = 0; i < data.length; i++)
		{
			var $item = $template.clone().removeClass("tr_template").addClass("item");

		//	$item.css('background-color', heatMapColorforValue(data[i].TEMPO / data[i].TEMPO_MAXIMO) );

		//	$item.css('color', heatMapColorforValueText(data[i].TEMPO / data[i].TEMPO_MAXIMO) );

			$grid.append($item);

			$("img", $item).attr('src', 'consulta.php?size=1&type=foto&registro=' + data[i].registro);
			$("a", $item).attr('href', 'consulta.php?type=cv&registro=' + data[i].registro);


			$item.bind('click', function()
			{
				$('#dialog textarea').val('');
				$('#dialog #situacao_nova').val(0);

				$('#dialog img').attr('src', $("img", this).attr('src').replace("size=1","size=2"));

				var url = $("img", this).attr('src').replace("size=1","size=2");


				
				var $data = $('span', this);



				var $cpf = $('#dialog span.cpf');

				var $spans = $('#dialog span');

				$spans.html('');

				for(var i=0; i< $spans.length; i++)
				{
					$($spans[i]).html($($data[i]).text());
				}

				$("#dialog").
					dialog({ position: 'center', width: 800, height: 600 });

				$("#dialog #salvar").off('click');

				$("#dialog #salvar").bind('click', function() {
					$.ajax({
						url: "data.php",
						method: "POST",
						data: {
							cpf : $cpf.text(),
							observacao  : $('#dialog textarea').val(),
							sit1 : $('#dialog .situacao').text(),
							sit2 : $('#dialog #situacao_nova').val()
						},
						dataType: "JSON",
						success: function() { update(); }
					});

					$("#dialog").hide();
				});

				$('#BaixarCV').bind('click', function()
				{
					document.location.href = url.replace('foto', 'cv');
				});


			});


			var $spans = $("span", $item);

			var j = 1;

			var keys = Object.keys(data[i]);

			$spans.each(function()
			{
				$(this).text(data[i][keys[j++]]);
			});
			
		}
	}

	var update = function()
	{
		$.ajax({
			url: "data.php",
			data: $('form').serialize(),
			dataType: "JSON",
			success: update_callback
		});
	}

	update();

});
