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
            <div >
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
</div>