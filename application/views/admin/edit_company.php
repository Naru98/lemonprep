<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Company</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'admin'?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/company'?>">Company</a></li>
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
    <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="<?php echo base_url()?>assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a>
                    <img src="<?php if($company[0]['image']){  echo base_url($company[0]['image']); } else { echo base_url("assets/img/company.png"); } ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="text-center pt-7">
                <h5 class="h3">
                    <?php echo $company[0]['name'];?>
                </h5>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit Profile </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div id="success" class="alert alert-success" role="alert" style="display:none;">
                </div>
                <div id="error" class="alert alert-warning" role="alert" style="display:none;">
                </div>
              <form id="editCompany">
                <h6 class="heading-small text-muted mb-4">Company information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-name">Name</label>
                        <input type="text" id="input-name" class="form-control" placeholder="Name" name="name" value="<?php echo $company[0]['name']?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="hidden" name="id" value="<?php echo $user[0]['id']?>">
                        <input type="hidden" name="company_id" value="<?php echo $company[0]['id']?>">
                        <input type="email" id="input-email" class="form-control" placeholder="jesse@example.com" name="email"  value="<?php echo $user[0]['email']?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-password">New Password</label>
                        <input type="password" id="input-password" class="form-control" placeholder="***********" name="password">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-confirm-password">Confirm password</label>
                        <input type="password" id="input-confirm-password" class="form-control" placeholder="**********" name="cpassword">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label d-block" for="input-image">Check-In Setting</label>
                        <label class="custom-toggle">
                          <input type="hidden" name="isVerifiyed" value="0">
                          <input type="checkbox" name="isVerifiyed" value="1" <?php if($user[0]['isVerifiyed']==1){ echo 'checked';}?>>
                          <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                        </label>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-image">Picture</label>
                        <input type="file" id="input-image" class="form-control" name="image">
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