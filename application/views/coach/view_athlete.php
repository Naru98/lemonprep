<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">View Athlete</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().$this->session->userdata('type')?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>coach/athlete">Athlete</a></li>
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
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="<?php echo base_url()?>assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a>
                    <img src="<?php if($athlete[0]['image']){  echo base_url($athlete[0]['image']); } else { echo base_url("assets/img/athlete.png"); } ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="text-center pt-7">
                <h5 class="h3">
                    <?php echo $athlete[0]['name'];?>
                </h5>
                <h5 class="h3">
                    <?php echo $athlete[0]['email'];?>
                </h5>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0  <?php if(empty($this->session->userdata('success')) && empty($this->session->userdata('error'))) {  echo 'd-none';}?>">
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
            </div>
            <div class="card-header border-0">
              <div class="row">
                <div class="col-6">Workouts</div>
                <div class="col-6 text-right"><a class="btn btn-primary" href="<?php echo base_url('coach/athlete/workout/add/'.$athlete[0]['id']);?>">Add</a></div>
              </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table id="workoutDataTable" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th scope="col" class="sort" data-sort="name">Start Date</th>
                    <th scope="col" class="sort" data-sort="budget">End Date</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  
                </tbody>
              </table>
            </div>
          </div><div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <div class="row">
                <div class="col-6">Diet</div>
                <div class="col-6 text-right"><a class="btn btn-primary" href="#">Add</a></div>
              </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table id="athleteDataTable" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th scope="col" class="sort" data-sort="name">Name</th>
                    <th scope="col" class="sort" data-sort="budget">Email</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>
<?php
if(!empty($selected_coach))
{
    ?>
    <script>
        <?php
            foreach($selected_coach as $scoach)
            {
                ?> SELECTED_VALUE.push(<?php echo $scoach['coach_id'];?>);<?php
            }
        ?>
    </script>
    <?php
}
?>