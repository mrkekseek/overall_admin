(function() {

	$.fn.select2.defaults.set("theme", "bootstrap");
	$('[name=owner_id]').select2({
        placeholder: $('[name=owner_id]').data('placeholder'),
        width: null
    });

	$('[data-remove]').on('click', function() {
		if (confirm('Do you really want to remove this item?'))
		{
			window.location.href = $(this).data('remove');
		}
	});


	$('[data-toggle="tooltip"]').tooltip();

	init();

})();

;

function init()
{
	formAjax();
}

function formAjax()
{
	$('.formAjax').attr('novalidate', 'novalidate');
	$('.formAjax').on('submit', function(event) {
		event.preventDefault();
		var form = this;
		$(form).find('.has-error').removeClass('has-error');

		var errors = true;
		var fields = {};
		$(form).find('[name]').each(function() {
			var value = $.trim($(this).val());
			if (value == '' && $(this).attr('required'))
			{
				errors = false;
				$(this).closest('.form-group').addClass('has-error');
			}
			else
			{
				fields[$(this).attr('name')] = $.trim($(this).val());
			}
		});
		if (errors)
		{
			$.ajax({
				type: "PUT",
				url: $(form).prop('action'),
				data: fields,
				success: function(data) {
					var callback = $(form).data('callback');
					if (callback && window[callback])
					{
						window[callback](data);	
					}
				},
				error: function(data) {
					for (var k in data.responseJSON)
					{
						var content = '';
						for (var e in data.responseJSON[k])
						{
							content += '<p>' + data.responseJSON[k][e] + '</p>';
						}
						$(form).find('.alert-box').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + content + '</div>');
					}
				},
				dataType: 'json'
			});
		}

		return false;
	});
}

function clubsOwnersGet(id = false)
{
	$.get('/ajax/clubs/clubsOwnersGet', {}, function(data) {
		var owners = '<option></option>';
		console.log(owners);
		for (var k in data)
		{
			owners += '<option value="' + data[k].id + '">' + data[k].first_name + ' ' + data[k].last_name + '</option>';
		}
		$('[name=owner_id]').html(owners);

		if (id)
		{
			$('[name=owner_id]').val(id).trigger('change');
		}
	}, 'json');
}

function clubsOwnersSaved(data)
{
	clubsOwnersGet(data);
	$('#add-owner').modal('hide');
}

function federationsOwnersGet(id = false)
{
	var federation_id = '/' + (window.location.pathname.split('/')[3] || 0);

	$.get('/ajax/federations/federationsOwnersGet' + federation_id, {}, function(data) {
		var owners = '<option></option>';
		for (var k in data)
		{
			owners += '<option value="' + data[k].id + '">' + data[k].first_name + ' ' + data[k].last_name + '</option>';
		}
		$('[name=owner_id]').html(owners);

		if (id)
		{
			$('[name=owner_id]').val(id).trigger('change');
		}
	}, 'json');
}

function federationsOwnersSaved(data)
{
	federationsOwnersGet(data);
	$('#add-owner').modal('hide');
}

(function() {
	var dataSelect = [];
	
	$('#add-country').click(function(){
		var optionText = $('[name="assign_countries"] option:selected').text();
		var optionValue = $('[name="assign_countries"] option:selected').val();
		if (dataSelect.indexOf(optionValue) !== -1) return;
		$('[name="federation_countries"]').append('<option value="' + optionValue + '">' + optionText + '</option>');
		dataSelect.push(optionValue);
		$('[name="countries_id"]').val(dataSelect.join(','));
	});

	$('#remove-country').click(function(){
		var removeOption = $('[name="federation_countries"] option:selected').remove().val();
		var newValues = [];
		for (key in dataSelect)
		{
			if (dataSelect[key] != removeOption)
			{
				newValues.push(dataSelect[key]);
			}
		}

		dataSelect = newValues;
		$('[name="countries_id"]').val(dataSelect.join(','));
	});

	function selectInit()
    {
    	$('[name="federation_countries"] option').each(function(){
			dataSelect.push($(this).val());
		});
		$('[name="countries_id"]').val(dataSelect.join(','));
    };

    selectInit();

})();

;

(function() {
	$('#not-club-add-modal').modal('show');
})()
;

(function() {

	buttonSendText();

$('#sendFilled').click(function(event){
        var id = $('#sendFilled').data('id');
        var dataFilled = {'filled': $('input[name="filled"]').val(), '_token':  $('input[name="_token"]').val()};
        $.ajax({
            type:'POST',
            url:'/ajax/servers/filled/' + id,
            data: dataFilled,
            success: function(data)
            { 
            	data = JSON.parse(data);
            	if (data.is_filled == 1)
            	{
            		$('input[name="filled"]').val(0);
            		message('is filled', type = 'success');
            		buttonSendText();
            	}
            	else
            	{
            		$('input[name="filled"]').val(1);
            		message('is not filled', type = 'success');
            		buttonSendText();
            	}
            }
        });
    });
	
    function message(text, type = 'success')
    {
        var content = '<div class="alert alert-success alert-dismissable fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button> <span>Server ' + '' + text + '</span></div>';
        $('[data-target="message"]').html(content);
    };

    function buttonSendText()
    {
	    if ($('input[name="filled"]').val() == 1)
		{
			$('#sendFilled').text('Mark is not filled');
		}
		else
		{
			$('#sendFilled').text('Mark is filled');
		}
    };
 
})()
;