<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Show</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().$this->session->userdata('type')?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>athlete/shows">Shows</a></li>
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
                  <h3 class="mb-0">Show information</h3>
                  <?php $show=$show[0];?>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row mb-1">
                <div class="col-sm">Title:- <?php echo $show['title'];?></div>
              </div>
              <div class="row mb-1">
                <div class="col-sm">Date:- <?php echo $show['date'];?></div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>