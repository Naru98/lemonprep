</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
    <div class="modal-content bg-gradient-danger">
      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="py-3 text-center">
          <i class="ni ni-bell-55 ni-3x"></i>
          <h4 class="heading mt-4">Are you sure you want to delete this!</h4>
          <p>You can not retrive deleted data back.</p>
        </div>
      </div>
      <div class="modal-footer">
        <button id="modal_delete_button" type="button" class="btn btn-white">Delete</button>
        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
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
  <script src="<?php echo base_url()?>assets/js/dist/additional-methods.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/select2/dist/js/select2.min.js"></script>
  <!-- Argon JS -->
  <script src="<?php echo base_url()?>assets/js/argon.js?v=1.2.0"></script>
  <script>
    const SITE_URL = '<?php echo base_url();?>'
    $(document).ready( function () {
      $('.select-input').select2({
        placeholder: 'Select an option'
      });
      if(SELECTED_VALUE )
        $('.select-input').val(SELECTED_VALUE).trigger('change');
      $('#dtabel').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('api/company/coach'); ?>",
            "type": "POST"
        },
        //Set column definition initialisation properties
        "columnDefs": [
          { 
            "targets": [0],
            "orderable": false
          },
          { 
            "className": "text-right",
            "targets": [3] 
          }
        ],
        'language': {
          'paginate': {
            'next': '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
            'previous': '<i class="fa fa-arrow-left" aria-hidden="true"></i>'  
          }
        }
      });

      $('#athleteDataTable').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('api/company/athlete'); ?>",
            "type": "POST"
        },
        //Set column definition initialisation properties
        "columnDefs": [
          { 
            "targets": [0],
            "orderable": false
          },
          { 
            "className": "text-right",
            "targets": [4] 
          }
        ],
        'language': {
          'paginate': {
            'next': '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
            'previous': '<i class="fa fa-arrow-left" aria-hidden="true"></i>'  
          }
        }
      });
    } );

    function deleteModal(user,id)
    {
      $('#modal_delete_button').attr('onclick','deleteData("'+user+'",'+id+')');
      $('#modal-delete').modal('show');
    }

    function deleteData(user, id)
    {
      $.ajax({
          url: SITE_URL+'api/company/delete',
          type: 'POST',
          data: { id:id, table: user },
          success: function(data){
            window.location.href= SITE_URL+'company/'+user;
          },
          error:function (e){
            window.location.href= SITE_URL+'company/'+user;
          }
      })
    }

    $("#addCoach").validate({
      rules: {
        password: {
          required: true,
          minlength: 6,
          maxlength: 16
        },
        cpassword: {
          equalTo: "#input-password"
        },
        image:{
          extension: "png,jpeg,jpg,svg,gif,webp"
        },
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
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res?.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.href= SITE_URL+'company/coach';
              },2000);
            }else{
              $('#error').text(res.msg? res.msg : 'Error occurred! Please try again later.');
              $('#error').show();
              $("#error").scroll();
            }
          },
          error:function (e){
            $('#overlay').hide();
            $('#error').text('Error occurred! Please try again later.');
            $('#error').show();
            $("#error").scroll();
          }
        })
      }
    })

    $("#editCoach").validate({
      rules: {
        password: {
          minlength: 6,
          maxlength: 16
        },
        cpassword: {
          equalTo: "#input-password"
        },
        image:{
          extension: "png,jpeg,jpg,svg,gif,webp"
        },
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
          url: SITE_URL+'api/company/coach/edit',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res?.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.reload();
              },3000);
            }else{
              $('#error').text(res.msg? res.msg : 'Error occurred! Please try again later.');
              $('#error').show();
              $("#error").scroll();
            }
          },
          error:function (e){
            $('#overlay').hide();
            $('#error').text('Error occurred! Please try again later.');
            $('#error').show();
            $("#error").scroll();
          }
        })
      }
    })

    $("#companyProfile").validate({
      rules: {
        password: {
          minlength: 6,
          maxlength: 16
        },
        cpassword: {
          equalTo: "#input-password"
        },
        image:{
          extension: "png,jpeg,jpg,svg,gif,webp"
        },
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
          url: SITE_URL+'api/company/profile/edit',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res?.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.reload();
              },3000);
            }else{
              $('#error').text(res.msg? res.msg : 'Error occurred! Please try again later.');
              $('#error').show();
              $("#error").scroll();
            }
          },
          error:function (e){
            $('#overlay').hide();
            $('#error').text('Error occurred! Please try again later.');
            $('#error').show();
            $("#error").scroll();
          }
        })
      }
    })

    $("#addAthlete").validate({
      rules: {
        password: {
          required: true,
          minlength: 6,
          maxlength: 16
        },
        cpassword: {
          equalTo: "#input-password"
        },
        image:{
          extension: "png,jpeg,jpg,svg,gif,webp"
        },
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
          url: SITE_URL+'api/company/athlete/add',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res?.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.href= SITE_URL+'company/athlete';
              },2000);
            }else{
              $('#error').text(res.msg? res.msg : 'Error occurred! Please try again later.');
              $('#error').show();
              $("#error").scroll();
            }
          },
          error:function (e){
            $('#overlay').hide();
            $('#error').text('Error occurred! Please try again later.');
            $('#error').show();
            $("#error").scroll();
          }
        })
      }
    })

    $("#editAthlete").validate({
      rules: {
        password: {
          minlength: 6,
          maxlength: 16
        },
        cpassword: {
          equalTo: "#input-password"
        },
        image:{
          extension: "png,jpeg,jpg,svg,gif,webp"
        },
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
          url: SITE_URL+'api/company/athlete/edit',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res?.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.reload();
              },2000);
            }else{
              $('#error').text(res.msg? res.msg : 'Error occurred! Please try again later.');
              $('#error').show();
              $("#error").scroll();
            }
          },
          error:function (e){
            $('#overlay').hide();
            $('#error').text('Error occurred! Please try again later.');
            $('#error').show();
            $("#error").scroll();
          }
        })
      }
    })
  </script>
</body>

</html>