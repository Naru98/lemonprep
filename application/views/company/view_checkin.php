<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">View</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().$this->session->userdata('type')?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>/company/checkin">Check IN</a></li>
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
                  <h3 class="mb-0">Checkin information</h3>
                  <?php 
                  $checkin=$checkin[0];
                  $data=json_decode($checkin['data']);
                  ?>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div id="success" class="alert alert-success" role="alert" style="display:none;">
                </div>
                <div id="error" class="alert alert-warning" role="alert" style="display:none;">
                </div>
                <?php
                foreach($data as $value) {
                    ?>
                    <div class="row mb-1">
                        <div class="col-sm-2"><?php echo $value->l;?>:- </div>
                        <div class="col-sm-2"><?php
                            if($value->t=='File')
                            {
                                ?> <a href="<?php echo base_url($value->v);?>">View</a><?php
                            }elseif($value->t=='Image')
                            {
                                ?> <a href="<?php echo base_url($value->v);?>"><img src="<?php echo base_url($value->v);?>" style="width:250px;"/></a><?php
                            }else
                            {
                                echo $value->v;
                            }
                        ?>
                        </div>
                    </div>
                    <?php

                }
                ?>
                <form id="checkinNote">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $checkin['id']?>" />
                            <label class="form-control-label">Note</label>
                            <textarea class="form-control" name="note" required><?php echo $checkin['note']?></textarea>
                        </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
          </div>
        </div>
    </div>
</div>