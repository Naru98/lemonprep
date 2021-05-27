<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Check In</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().$this->session->userdata('type')?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a>Check In</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if($status==1)
{
?>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
                <div id="success" class="alert alert-success" role="alert" style="display:none;">
                </div>
                <div id="error" class="alert alert-warning" role="alert" style="display:none;">
                </div>
              <form id="adCheckIn">
                <h6 class="heading-small text-muted mb-4">Check In information</h6>
                <?php $data =json_decode($company[0]['data']);?>
                <div class="row align-items-center">
                    <?php 
                    foreach($data as $d)
                    {
                        if($d->r==1)
                        {
                        ?>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label"><?php echo $d->l;?></label>
                                    <input class="form-control <?php if($d->t=="Date"){ echo "date"; }?>" type="<?php if($d->t=='Image' || $d->t=='File'){ echo "file"; }else{ echo "text";} ?>" name="<?php echo $d->l;?>" <?php if($d->m==1){ echo "required"; }?>>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
                <button class="btn btn-primary" type="submit">Send</button>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
<?php }else{ ?>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <h2>Please contact admin for check in</h2>
        </div>
    </div>
<div>
<?php } ?>