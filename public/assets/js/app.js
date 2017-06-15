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
	$.get('/api/clubs/clubsOwnersGet', {}, function(data) {
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

function clubsOwnersSaved(data)
{
	clubsOwnersGet(data);
	$('#add-owner').modal('hide');
}

function federationsOwnersGet(id = false)
{
	var federation_id = '/' + (window.location.pathname.split('/')[3] || 0);

	$.get('/api/federations/federationsOwnersGet' + federation_id, {}, function(data) {
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

})();

;

(function() {
	$('#not-club-add-modal').modal('show');
})()
;
