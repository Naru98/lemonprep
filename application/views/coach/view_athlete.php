<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-2">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">View Athlete</h6>
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
        <div class="col-md-12 mx-auto">
          <div class="card card-profile mt-5">
            <div class="row justify-content-center mt-3">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a>
                    <img src="<?php if($athlete[0]['image']){  echo base_url($athlete[0]['image']); } else { echo base_url("assets/img/athlete.png"); } ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body pt-0 pb-1">
              <div class="text-center pt-5 pb-1">
                <div class="row">
                  <div class="col-md-12">
                    <h5 class="h5">
                      Name:- <?php echo $athlete[0]['name'];?>
                    </h5>
                  </div>
                  <div class="col-md-12">
                    <h5 class="h5">
                    Email:- <?php echo $athlete[0]['email'];?>
                    </h5>
                  </div>
                  <div class="col-md-12">
                    <h5 class="h5">
                    Valid from :- <?php if($athlete[0]['sdate']){ echo date('m/d/Y',strtotime($athlete[0]['sdate']));}?> TO  <?php if($athlete[0]['edate']){ echo date('m/d/Y',strtotime($athlete[0]['edate']));}?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
            <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 <?php if($snav==1){ echo 'active'; } ?>" id="tabs-text-1-tab"  href="<?php echo base_url('coach/athlete/view/'.$id);?>" role="tab" aria-controls="tabs-text-1" aria-selected="true">Workouts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 <?php if($snav==2){ echo 'active'; } ?>" id="tabs-text-2-tab" href="<?php echo base_url('coach/athlete/view/'.$id.'/2');?>" role="tab" aria-controls="tabs-text-2" aria-selected="false">Nutritions</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 <?php if($snav==3){ echo 'active'; } ?>" id="tabs-text-3-tab"  href="<?php echo base_url('coach/athlete/view/'.$id.'/3');?>" role="tab" aria-controls="tabs-text-3" aria-selected="false">Check-In</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 <?php if($snav==4){ echo 'active'; } ?>" id="tabs-text-3-tab"  href="<?php echo base_url('coach/athlete/view/'.$id.'/4');?>" role="tab" aria-controls="tabs-text-3" aria-selected="false">Forms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 <?php if($snav==5){ echo 'active'; } ?>" id="tabs-text-3-tab"  href="<?php echo base_url('coach/athlete/view/'.$id.'/5');?>" role="tab" aria-controls="tabs-text-3" aria-selected="false">Shows</a>
              </li>
            </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-12 order-xl-1">
        <?php
          if($snav==1)
          {
            $this->load->view('coach/workout.php');
          }else if($snav==2)
          {
            $this->load->view('coach/diet.php');
          }else if($snav==3)
          {
            $this->load->view('coach/checkinA.php');
          }else if($snav==4)
          {
            $this->load->view('coach/formsA.php');
          }
          else if($snav==5)
          {
            $this->load->view('coach/showsA.php');
          }
        ?>
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