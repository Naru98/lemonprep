<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Settings</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="<?php echo base_url().'admin'?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a>Settings</a></li>
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
                  <h3 class="mb-0">Settings </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form id="adminSettings">
                <div id="success" class="alert alert-success" role="alert" style="display:none;">
                </div>
                <div id="error" class="alert alert-warning" role="alert" style="display:none;">
                </div>
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th>Key</th>
                        <th>value</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    <?php 
                        $i=1;
                        foreach($data as $d) {
                            ?>
                        <tr>
                            <td>
                                <?php echo $d['key'];?>
                                <input type="hidden" name="id<?php echo $i;?>" value="<?php echo $d['id'];?>"/>
                            </td>
                            <td>
                                <label class="custom-toggle">
                                    <input type="checkbox" name="value<?php echo $i;?>" <?php if($d['value']){ echo 'checked';}?> value="1">
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                </label>
                            </td>
                        </tr>
                        <?php
                        $i++;
                     } ?>
                    </tbody>
                </table>
                <input type="hidden" name="count" value="<?php echo $i;?>"/>
                <button class="btn btn-primary" type="submit">Save</button>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>