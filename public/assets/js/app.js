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
		var optionLabel = $('[name="assign_countries"] option').first().text();

		if (optionText != optionLabel)
		{
			var optionValue = $('[name="assign_countries"] option:selected').val();

			if (dataSelect.indexOf(optionValue) !== -1) return;

			$('[name="federation_countries"]').append('<option value="' + optionValue + '">' + optionText + '</option>');
			dataSelect.push(optionValue);
			$('[name="countries_id"]').val(dataSelect.join(','));
		}
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
    	$('[name="federation_countries"] option').each(function() {
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

	$('#sendFilled').click(function(event) {
        var id = $('#sendFilled').data('id');
        var dataFilled = {
        	'filled': $('input[name="filled"]').val(), 
        	'_token': $('input[name="_token"]').val()
        };

        $.ajax({
            type:'POST',
            url:'/ajax/servers/filled/' + id,
            data: dataFilled,
            success: function(data)
            { 
            	data = JSON.parse(data);
            	if (data.is_filled == 1)
            	{
            		message('is filled', type = 'success');
            	}
            }
        });

        $(this).hide('1000');
    });

    $('#sendFilledRole').click(function(event) {
        var id = $('#sendFilledRole').data('id');
        var dataFilled = {
        	'filled': $('input[name="filled"]').val(),
        	'_token': $('input[name="_token"]').val()
        };

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
    
    $('#assing_subdomain').click(function (){
        var subdomain_id = $('#assign_subdomain_id').val();
        if (subdomain_id == '') {
            notify('Select subdomain',  type = 'danger');
        }
        else{
            var data = {
                club_id : $(this).attr('data-clubId'),
                subdomain_id : subdomain_id,
                _token: $('#club_edit_form input[name=_token]').val(),
            };
            $.ajax({
                type: "POST",
                url: '/ajax/clubs/assing_subdomain',
                data: data,
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.success == true){
                        notify(data.message,  type = 'success');
                        setTimeout(function(){
                            window.location.reload();
                        },3000);
                    }
                    else{
                        notify(data.message,  type = 'danger');
                    }
                },
            });
        }
    });
    
    var Clubs = function() {
        var add = function() {
                sendForm(selector_form='#club_add_form', redirectUrl = '/clubs/lists');
            };
        var edit = function() {
                sendForm(selector_form='#club_edit_form');
                sendForm(selector_form='#club_adress_form');
            };
        return {
            init: function() {
                add();
                edit();
            }
        };
    }();
    
    var Federations = function() {
        var add = function() {
                sendForm(selector_form = '#federation_add_form', redirectUrl = '/federations/lists');
            };
        var edit = function() {
                sendForm(selector_form='#federation_edit_form');
                sendForm(selector_form='#federation_adress_form');
            };
        return {
            init: function() {
                add();
                edit();
            }
        };
    }();
    
    var Servers = function() {
        var add = function() {
                sendForm(selector_form = '#server_add_form', redirectUrl = '/servers/lists');
            };
        var edit = function() {
                sendForm(selector_form='#server_edit_form');
            };
        return {
            init: function() {
                add();
                edit();
            }
        };
    }();
    
    var Subdomains = function() {
        var add = function() {
                sendForm(selector_form = '#subdomain_add_form', redirectUrl = '/subdomains/lists');
            };
        var edit = function() {
                sendForm(selector_form='#subdomain_edit_form');
            };
        return {
            init: function() {
                add();
                edit();
            }
        };
    }();
    
    var SsoCalls = function() {
        var send = function() {
            $('.sso-send-form').on('submit', function(){
               return false; 
            });
            $('.sso-send').on('click', function(){
                var formId = $(this).data('formId');
                var form = $('form#'+formId);
                var data = {
                   method : $(this).data('method'),
                   func : formId,
                   data : form.serialize(),
                   _token: $('input[name="_token"]').val()
                };
                $.ajax({
                    type: 'post',
                    url: '/ajax/calls/send',
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        if (data.success = true){
                            $(form).find('span.success').removeClass('hidden');
                        }
                        else{
                            $(form).find('span.error').removeClass('hidden');
                        }
                        $('textarea#'+formId).val(data.response);
                    },
                });


            });
        };
        return {
            init: function() {
                send();
            }
        };
    }();

    jQuery(document).ready(function() {
        Clubs.init();
        Federations.init();
        Servers.init();
        Subdomains.init();
        SsoCalls.init();
    });
    
    function sendForm(selector_form, redirectUrl = false, timeout = 3000){
        $(selector_form).submit(function(){
                var data = $(selector_form).serialize();
                var url = $(selector_form).attr('action');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        if (data.success == true){
                            notify(data.errors, type = 'success')
                            if (redirectUrl != false){
                                setTimeout(function(){
                                    window.location.href = redirectUrl;
                                },timeout);
                            }
                            else{
                                setTimeout(function(){
                                    window.location.reload();
                                },timeout);
                            }
                        }
                        else{
                            notify(data.errors, type = 'danger');
                            for (var i in data.errors){
                                $(selector_form+' input[name='+i+']').closest('.form-group').addClass('has-error');
                                $(selector_form+' select[name='+i+']').closest('.form-group').addClass('has-error');
                            }
                        }
                    },
                });
                return false;
            });
    }
    
    function notify(text, type = 'danger', life = 3000){
        var theme = 'smoke';
        switch (type){
            case 'success': 
                theme = 'lime';
                break;
            case 'danger':
                theme = 'ruby';
                break;
        }
        if (typeof(text) == 'object'){
            for (var i in text){
                var t ='';
                $.notific8(t+text[i],{
                    theme: theme,
                    life: life
                });
            }
        }
        else{
            $.notific8(text,{
                theme: theme,
                life: life
            });
        }
        
    }

    function message(text, type = 'success')
    {
        var content = '<div class="alert alert-'+type+' alert-dismissable fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button> <span>' + '' + text + '</span></div>';
        $('[data-target="message"]').html(content);
    };

    function buttonSendText()
    {
    	if ( $('input[name="filled"]').val() == 1)
    	{
    		$('#sendFilled, #sendFilledRole').text('Mark is filled');
    	}
    	else
    	{
    		$('#sendFilled, #sendFilledRole').text('Mark is not filled');
    	}
    };
 
})()
;
