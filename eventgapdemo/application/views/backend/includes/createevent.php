<div class="row" style="padding:1% 0">
	<div class="col-md-12">
		<div class="pull-right">
			<a href="<?php echo site_url('site/viewevents'); ?>" class="btn btn-primary pull-right"><i class="icon-long-arrow-left"></i>&nbsp;Back</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
	    <section class="panel">
		    <header class="panel-heading">
				 Event Details
			</header>
			<div class="panel-body">
			  <form class="form-horizontal tasi-form" method="post" action="<?php echo site_url('site/createeventsubmit');?>" enctype= "multipart/form-data">
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Title</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="title" value="<?php echo set_value('title');?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Alias</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="alias" value="<?php echo set_value('alias');?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Location</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="location" value="<?php echo set_value('location');?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Starttime</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="starttime" value="<?php echo set_value('starttime');?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Endtime</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="endtime" value="<?php echo set_value('endtime');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Description</label>
				  <div class="col-sm-4">
					<textarea id="normal-field" class="form-control" name="description" ><?php echo set_value('description');?></textarea>
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Location Latitude</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="locationlat" value="<?php echo set_value('locationlat');?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Location Longitude</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="locationlon" value="<?php echo set_value('locationlon');?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Venue</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="venue" value="<?php echo set_value('venue');?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Start Date</label>
				  <div class="col-sm-4">
					<input type="date" id="normal-field" class="form-control" name="startdate" value="<?php echo set_value('startdate');?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">End Date</label>
				  <div class="col-sm-4">
					<input type="date" id="normal-field" class="form-control" name="enddate" value="<?php echo set_value('enddate');?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Event Logo</label>
				  <div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="logo" value="<?php echo set_value('logo');?>">
				  </div>
				</div>
				<!--
				<div class="form-group">
					<label class="col-sm-2 control-label">Categories</label>
					<div class="col-sm-4">
					   <?php /*
							echo form_dropdown('category',$category,set_value('category'),'id="select1" class="form-control populate placeholder select2-offscreen"');
							 */
						?>
					</div>
				</div>-->
				<div class="form-group">
					<label class="col-sm-2 control-label">Organizer</label>
					<div class="col-sm-4">
					   <?php 
							echo form_dropdown('organizer',$organizer,set_value('organizer'),'id="select1" class="form-control populate placeholder select2-offscreen"');
							 
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Listing Type</label>
					<div class="col-sm-4">
					   <?php 
							echo form_dropdown('listingtype',$listingtype,set_value('listingtype'),'id="select2" class="form-control populate placeholder select2-offscreen"');
							 
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Show remaining ticket</label>
					<div class="col-sm-4">
					   <?php 
							echo form_dropdown('showremainingticket',$remainingticket,set_value('showremainingticket'),'id="select3" class="form-control populate placeholder select2-offscreen"');
							 
						?>
					</div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label">&nbsp;</label>
				  <div class="col-sm-4">
				  <button type="submit" class="btn btn-primary">Save</button>
				  <a href="<?php echo site_url('site/viewevents'); ?>" class="btn btn-secondary">Cancel</a>
				</div>
				</div>
			  </form>
			</div>
		</section>
	</div>
</div>