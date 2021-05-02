<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Add Show</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().$this->session->userdata('type')?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>/company/shows">Shows</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a>Add</a></li>
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
                  <h3 class="mb-0">Add Show </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div id="success" class="alert alert-success" role="alert" style="display:none;">
                </div>
                <div id="error" class="alert alert-warning" role="alert" style="display:none;">
                </div>
              <form id="addShow">
              <?php if(!empty($this->session->userdata('company_id'))){ ?><input type="hidden" name="company_id" value="<?php echo $this->session->userdata('company_id'); ?>"> <?php } ?>
                <h6 class="heading-small text-muted mb-4">Show information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-name">title</label>
                        <input type="text" id="input-title" class="form-control" placeholder="Title" name="title" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-image">Athlete</label>
                        <select class="form-control select-input" name='athlete[]' data-toggle="select" multiple data-placeholder="Select multiple options">
                        <?php
                        if(!empty($athlete))
                        {
                            foreach($athlete as $a)
                            {
                                ?>
                                <option value="<?php echo $a['id'];?>"><?php echo $a['name'];?></option>
                                <?php
                            }
                        }
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="date">Date</label>
                        <input class="form-control" type="text" id="date" name="date">
                      </div>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Add</button>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>