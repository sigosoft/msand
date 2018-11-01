<?php
				$i = 0;
            	foreach($users as $row){
            	$i++;
				?>
				<div class="col-md-8 col-xs-offset-2">
				<div class="form-group" >
                  <div class="col-sm-12">
                    <p style="text-align:center;"><b><?php echo $row['name']; ?></b></p>
                  </div>
                </div>
								<div class="clearfix"></div>
				<div class="form-group" style="margin-top:20px">
                  <label class="col-sm-6 control-label"> Mobile</label>

                  <div class="col-sm-6">
                    <?php echo $row['mobile']; ?>
                  </div>
                </div>
								<div class="clearfix"></div>
				<div class="form-group">
                  <label class="col-sm-6 control-label"> Address</label>

                  <div class="col-sm-6">
                    <?php echo $row['address']; ?>
                  </div>
                </div>
								<div class="clearfix"></div>
			<div class="form-group">
                  <label class="col-sm-6 control-label"> Email</label>

                  <div class="col-sm-6">
                    <?php echo $row['email']; ?>
                  </div>
                </div>
								<div class="clearfix"></div>
				<div class="form-group">
                  <label class="col-sm-6 control-label"> User Type</label>

                  <div class="col-sm-6">
                    <?php echo $row['user_type']; ?>
                  </div>
                </div>

				</div>
				<?php } ?>
