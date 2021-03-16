<!-- Header -->
<div class="header bg-primary pb-2">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-2">
                    <div class="col-12 mx-auto text-center">
                      <img class="clogo" src="<?php if(!empty($this->session->userdata('cimage'))){ echo base_url($this->session->userdata('cimage')); } else { echo base_url('assets/img/company.png');} ?>" />
                    </div>
                    <div class="col-12 mx-auto text-center">
                      <h4><?php if(!empty($this->session->userdata('cname'))){ echo $this->session->userdata('cname'); } ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Dashboard</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                      </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>