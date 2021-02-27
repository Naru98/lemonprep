$("#register").validate({
	rules: {
		password: {
		  required: true,
		  minlength: 6,
		  maxlength: 16
		}
	},
    submitHandler: function (form){
		$('#overlay').show();
		$('#error').text('');
		$('#error').hide();
		$('#success').text('');
		$('#success').hide();
		$.ajax({
			url: SITE_URL+'api/web/register',
			data: $(form).serializeArray(),
			type: 'POST',
			success: function(data){
				$('#overlay').hide();
				const res = JSON.parse(data)
				if(res?.status==1)
				{
					$('#success').text(res.msg);
					$('#success').show();
					window.location.href= SITE_URL+'company';
				}else{
					$('#error').text(res.msg? res.msg : 'Error occurred! Please try again later.');
					$('#error').show();
				}
			},
			error:function (e){
				$('#overlay').hide();
				$('#error').text('Error occurred! Please try again later.');
				$('#error').show();
			}
		})
    }
});