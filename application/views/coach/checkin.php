<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Check In Settings</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().$this->session->userdata('type')?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>coach/athlete">Settings</a></li>
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
                  <h3 class="mb-0">Check In Settings </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form id="checkinSetting">
              <?php $data=json_decode($company[0]['data']);?>
                <h6 class="heading-small text-muted mb-4">Check In fields</h6>
                <div id="success" class="alert alert-success" role="alert" style="display:none;">
                </div>
                <div id="error" class="alert alert-warning" role="alert" style="display:none;">
                </div>
                <?php if(!empty($this->session->userdata('id'))){ ?><input type="hidden" name="id" value="<?php echo $this->session->userdata('id'); ?>"> <?php } ?>
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th>Fields</th>
                        <th>Order</th>
                        <th>Required</th>
                        <th>Mandatory</th>
                        <th>Label</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                        <?php foreach($data as $d) {?>
                        <tr>
                            <td><?php echo $d->t;?></td>
                            <td>
                                <input class="form-control"  type="number" name="o<?php echo $d->f;?>" value="<?php echo $d->o;?>" >
                            </td>
                            <td>
                                <label class="custom-toggle">
                                    <input type="checkbox" name="r<?php echo $d->f;?>" <?php if($d->r){ echo 'checked';}?> value="1">
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                </label>
                            </td>
                            <td>
                                <label class="custom-toggle">
                                    <input type="checkbox" name="m<?php echo $d->f;?>" <?php if($d->m){ echo 'checked';}?> value="1">
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                </label>
                            </td>
                            <td>
                                <input class="form-control"  type="text" name="v<?php echo $d->f;?>" value="<?php echo $d->l;?>">
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="submit">Save</button>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>