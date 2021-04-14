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
  <script src="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/quill/dist/quill.min.js"></script>
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
      var table = $('#athleteDataTable').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('api/coach/athlete'); ?>",
            "type": "POST"
        },
        //Set column definition initialisation properties
        "columnDefs": [
          { 
            "targets": [0],
            "orderable": false,
          },
          { 
            "className": "text-right",
            "targets": [5],
            "orderable": false
          }
        ],
        "createdRow": function( row, data, dataIndex ) {
          $( row ).find('td:eq(0)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(1)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(2)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(3)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(4)')
            .attr('data-id', data.id)
            .addClass('clickable');
        },
        'language': {
          'paginate': {
            'next': '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
            'previous': '<i class="fa fa-arrow-left" aria-hidden="true"></i>'  
          }
        }
      });

      $('#athleteDataTable').on('click', 'td.clickable', function () {
        window.location.href=SITE_URL+'coach/athlete/view/'+$(this).attr('data-id');
      });

      $('#workoutDataTable').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('api/coach/getWorkout'); ?>",
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
            "targets": [3],
            "orderable": false
          }
        ],
        "createdRow": function( row, data, dataIndex ) {
          $( row ).find('td:eq(0)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(1)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(2)')
            .attr('data-id', data.id)
            .addClass('clickable');
        },
        'language': {
          'paginate': {
            'next': '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
            'previous': '<i class="fa fa-arrow-left" aria-hidden="true"></i>'  
          }
        }
      });

      $('#workoutDataTable').on('click', 'td.clickable', function () {
        window.location.href=SITE_URL+'coach/workout/edit/'+$(this).attr('data-id');
      });

      $('#dietDataTable').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('api/coach/getDiet'); ?>",
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
            "targets": [3],
            "orderable": false
          }
        ],
        "createdRow": function( row, data, dataIndex ) {
          $( row ).find('td:eq(0)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(1)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(2)')
            .attr('data-id', data.id)
            .addClass('clickable');
        },
        'language': {
          'paginate': {
            'next': '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
            'previous': '<i class="fa fa-arrow-left" aria-hidden="true"></i>'  
          }
        }
      });

      $('#dietDataTable').on('click', 'td.clickable', function () {
        window.location.href=SITE_URL+'coach/diet/edit/'+$(this).attr('data-id');
      });

      $('#athleteshowsDataTable').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('api/coach/getAthleteShows'); ?>",
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
            "targets": [3],
            "orderable": false
          }
        ],
        "createdRow": function( row, data, dataIndex ) {
          $( row ).find('td:eq(0)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(1)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(2)')
            .attr('data-id', data.id)
            .addClass('clickable');
        },
        'language': {
          'paginate': {
            'next': '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
            'previous': '<i class="fa fa-arrow-left" aria-hidden="true"></i>'  
          }
        }
      });

      $('#athleteshowsDataTable').on('click', 'td.clickable', function () {
        window.location.href=SITE_URL+'coach/shows/edit/'+$(this).attr('data-id');
      });

      $('#formsDataTable').DataTable({
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('api/coach/getForms'); ?>",
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
            "targets": [2],
            "orderable": false
          }
        ],
        "createdRow": function( row, data, dataIndex ) {
          $( row ).find('td:eq(0)')
            .attr('data-id', data.id)
            .addClass('clickable');
          $( row ).find('td:eq(1)')
            .attr('data-id', data.id)
            .addClass('clickable');
        },
        'language': {
          'paginate': {
            'next': '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
            'previous': '<i class="fa fa-arrow-left" aria-hidden="true"></i>'  
          }
        }
      });

      $('#formsDataTable').on('click', 'td.clickable', function () {
        window.location.href=SITE_URL+'coach/forms/edit/'+$(this).attr('data-id');
      });
      $( "#date" ).datepicker();
      $('.datepicker').datepicker({
          format: {
              /*
              * Say our UI should display a week ahead,
              * but textbox should store the actual date.
              * This is useful if we need UI to select local dates,
              * but store in UTC
              */
              toDisplay: function (date, format, language) {
                  var d = new Date(date);
                  d.setDate(d.getDate() - 7);
                  return d.toISOString();
              },
              toValue: function (date, format, language) {
                  var d = new Date(date);
                  d.setDate(d.getDate() + 7);
                  return new Date(d);
              }
          }
      });
    });

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
            window.location.href= SITE_URL+'coach/'+user;
          },
          error:function (e){
            window.location.href= SITE_URL+'coach/'+user;
          }
      })
    }

    $("#coachProfile").validate({
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
            if(res.status==1)
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
    });

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
            if(res.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.href= SITE_URL+'coach/athlete';
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
    });

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
            if(res.status==1)
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
    });

    $("#addWorkout").validate({
      submitHandler: function (form){
        $('#overlay').show();
        $('#error').text('');
        $('#error').hide();
        $('#success').text('');
        $('#success').hide();
        $.ajax({
          url: SITE_URL+'api/coach/addWorkout',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.href= res.data.url;
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
    });

    $("#addDiet").validate({
      submitHandler: function (form){
        $('#overlay').show();
        $('#error').text('');
        $('#error').hide();
        $('#success').text('');
        $('#success').hide();
        $.ajax({
          url: SITE_URL+'api/coach/addDiet',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.href= res.data.url;
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
    });

    $("#addShow").validate({
      submitHandler: function (form){
        $('#overlay').show();
        $('#error').text('');
        $('#error').hide();
        $('#success').text('');
        $('#success').hide();
        $.ajax({
          url: SITE_URL+'api/coach/addShow',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.href= SITE_URL+'coach/shows';
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
    });

    $("#editShow").validate({
      submitHandler: function (form){
        $('#overlay').show();
        $('#error').text('');
        $('#error').hide();
        $('#success').text('');
        $('#success').hide();
        $.ajax({
          url: SITE_URL+'api/coach/editShow',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res.status==1)
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
    });

    $("#addForm").validate({
      submitHandler: function (form){
        $('#overlay').show();
        $('#error').text('');
        $('#error').hide();
        $('#success').text('');
        $('#success').hide();
        $.ajax({
          url: SITE_URL+'api/coach/addForm',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.href= SITE_URL+'coach/forms';
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
    });

    $("#editForm").validate({
      submitHandler: function (form){
        $('#overlay').show();
        $('#error').text('');
        $('#error').hide();
        $('#success').text('');
        $('#success').hide();
        $.ajax({
          url: SITE_URL+'api/coach/editForm',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res.status==1)
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
    });

    $("#checkinSetting").validate({
      submitHandler: function (form){
        $('#overlay').show();
        $('#error').text('');
        $('#error').hide();
        $('#success').text('');
        $('#success').hide();
        $.ajax({
          url: SITE_URL+'api/coach/checkinSetting',
          type: 'POST',
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(data){
            $('#overlay').hide();
            const res = JSON.parse(data)
            if(res.status==1)
            {
              $('#success').text(res.msg);
              $('#success').show();
              $("#success").scroll();
              setTimeout(function(){
                window.location.reload()
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
    });
  </script>
</body>

</html>
