(function() {

	$('[name=owner_id]').on('change', function() {
		if ($(this).val() == '0')
		{
			$('.contact-person-list').removeClass('col-sm-12').addClass('col-sm-6');
			$('.contact-person-name').removeClass('hidden').addClass('col-sm-6');
		}
		else
		{
			$('.contact-person-list').removeClass('col-sm-6').addClass('col-sm-12');
			$('.contact-person-name').removeClass('col-sm-6').addClass('hidden');
		}
	});

	$('[data-remove]').on('click', function() {
		if (confirm('Do you really want to remove this item?'))
		{
			window.location.href = $(this).data('remove');
		}
	});

})();

;