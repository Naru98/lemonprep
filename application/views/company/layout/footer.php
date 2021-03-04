</div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?php echo base_url()?>assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="<?php echo base_url()?>assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/dist/jquery.validate.js"></script>
  <!-- Argon JS -->
  <script src="<?php echo base_url()?>assets/js/argon.js?v=1.2.0"></script>
  <script>
    $(document).ready( function () {
        $('#dtabel').DataTable();
    } );

    $("#addCoach").validate({
      rules: {
        password: {
          required: true,
          minlength: 6,
          maxlength: 16
        },
        cpassword: {
          equalTo: "#input-password"
        }
      },
      messages: {
        cpassword:{
          equalTo: 'Please enter the same password again.'
        }
      },
      submitHandler: function (form){
        $('#overlay').show();
        $('#error').text('');
        $('#error').hide();
        $('#success').text('');
        $('#success').hide();
        $.ajax({
          url: SITE_URL+'api/company/coach/add',
          data: $(form).serializeArray(),
          type: 'POST',
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res?.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              window.location.href= res.data.url;
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
    })

    $("#login").validate({
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
			url: SITE_URL+'api/web/login',
			data: $(form).serializeArray(),
			type: 'POST',
			success: function(data){
				$('#overlay').hide();
				const res = JSON.parse(data)
				if(res?.status==1)
				{
					$('#success').text(res.msg);
					$('#success').show();
					window.location.href= res.data.url;
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
  </script>
</body>

</html>