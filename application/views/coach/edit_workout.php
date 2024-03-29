<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Edit Workout</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().$this->session->userdata('type')?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>coach/athlete">Workout</a></li>
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
                  <h3 class="mb-0">Edit Workout </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div id="success" class="alert alert-success" role="alert" style="display:none;">
                </div>
                <div id="error" class="alert alert-warning" role="alert" style="display:none;">
                </div>
              <form id="editWorkout">
                <h6 class="heading-small text-muted mb-4">Workout information</h6>
                <div class="pl-lg-4">
                  <?php if(!empty($id)){ ?><input type="hidden" name="athlete_id" value="<?php echo $id; ?>"> <?php } ?>
                  <input type="hidden" name="id" value="<?php echo $workout[0]['id']; ?>">
                  <div class="row input-daterange datepicker align-items-center">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Start date</label>
                        <input class="form-control" placeholder="Start date" type="text" name="sdate" id="sdate" onchange="workoutInput()" value="<?php echo date('m/d/Y',strtotime($workout[0]['sdate']));?>" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">End date</label>
                        <input class="form-control" placeholder="End date" type="text" name="edate" id="edate" onchange="workoutInput()" value="<?php echo date('m/d/Y',strtotime($workout[0]['edate']));?>" >
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label">Details</label>
                        <textarea class="form-control" name="data"><?php echo $workout[0]['data'];?></textarea>
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