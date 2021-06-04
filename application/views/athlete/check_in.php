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
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <?php if(!empty($this->session->userdata('success'))) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>Success!</strong> <?php echo $this->session->userdata('success');?></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <?php
                $this->session->set_userdata('success','');
                } ?>
                <?php if(!empty($this->session->userdata('error'))) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>Error!</strong> <?php echo $this->session->userdata('error');?></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <?php
                $this->session->set_userdata('error','');
                } ?>
                <?php if($status==1) { ?>
                <div class="row pt-3 pb-3">
                    <div class="col-sm-3">
                        Check In
                    </div>
                    <div class="col-sm-6">
                        <?php echo date('d-M',strtotime($csdate));?> -- <?php echo date('d-M',strtotime($cedate));?> 
                    </div>
                    <div class="col-sm-3 text-right">
                        <a href="<?php echo base_url()?>athlete/check_in/add" class="btn btn-primary ml-auto">Add</a>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- Light table -->
            <div class="d-none" >
              <table id="athletecheckinDatatable" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th scope="col" class="sort" data-sort="name">Start Date</th>
                    <th scope="col" class="sort" data-sort="name">End Date</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  
                </tbody>
              </table>
            </div>
            <h2 class="text-center pb-4">Check In History</h2>
            <div id="checkinHistory">
            </div>
          </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event)=>{
      getCheckin(0);
    })
</script>