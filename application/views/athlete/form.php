<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Form</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().$this->session->userdata('type')?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>athlete/shows">Forms</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a>View</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Form information</h3>
                  <?php $form=$form[0];?>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div id="success" class="alert alert-success" role="alert" style="display:none;">
                </div>
                <div id="error" class="alert alert-warning" role="alert" style="display:none;">
                </div>
              <form id="applyForm">
              <div class="row mb-1">
                <input type="hidden" name="forms_id" value="<?php echo $form['id'];?>"/>
                <div class="col-sm"><?php echo $form['name'];?><a class="btn btn-primary btn-sm ml-3" href="<?php echo base_url($form['file']);?>">View</a></div>
              </div>
              <div class="row mb-5 mt-4">
                <div class="col-md-12 col-lg-6">Please provide signature for above form<br>
                <input type="hidden" name="data" id="data" />
                <canvas></canvas>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Apply</button>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>