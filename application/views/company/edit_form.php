<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Edit Form</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().$this->session->userdata('type')?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>/company/forms">Forms</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a>Edit</a></li>
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
                  <h3 class="mb-0">Edit Form </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div id="success" class="alert alert-success" role="alert" style="display:none;">
                </div>
                <div id="error" class="alert alert-warning" role="alert" style="display:none;">
                </div>
              <form id="editForm" >
                <h6 class="heading-small text-muted mb-4">Form information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $forms[0]['id']?>"/>
                        <label class="form-control-label" for="input-name">Name</label>
                        <input type="text" id="input-title" class="form-control" placeholder="Name" name="name" value="<?php echo $forms[0]['name']?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="file">File</label>
                        <input class="form-control" type="file" id="file" name="file">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <a class="text-dark" targe="_blank" href="<?php echo base_url($forms[0]['file']);?>">View File</a>
                      </div>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>