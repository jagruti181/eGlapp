<div class="row" style="padding:1% 0">
	<div class="col-md-12">
		<div class="pull-right">
			<a href="<?php echo site_url('site/viewticketevent'); ?>" class="btn btn-primary pull-right"><i class="icon-long-arrow-left"></i>&nbsp;Back</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
	    <section class="panel">
		    <header class="panel-heading">
				Ticket Details
			</header>
			<div class="panel-body">
			  <form class="form-horizontal tasi-form" method="post" action="<?php echo site_url('site/editticketeventsubmit');?>" >
				<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Event</label>
				  <div class="col-sm-4">
					<?php 
						echo form_dropdown('event',$event,set_value('event',$before->event),'id="select1" class="form-control populate placeholder select2-offscreen"');
					?>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Ticket</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="ticket" value="<?php echo set_value('ticket',$before->ticket);?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Ticket Type</label>
				  <div class="col-sm-4">
					<?php 
						echo form_dropdown('tickettype',$tickettype,set_value('tickettype',$before->tickettype),'id="select2" class="form-control populate placeholder select2-offscreen"');
					?>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Ticket Name</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="ticketname" value="<?php echo set_value('ticketname',$before->ticketname);?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Description</label>
				  <div class="col-sm-4">
					<textarea id="normal-field" class="form-control" name="description" ><?php echo set_value('description',$before->description);?></textarea>
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Amount</label>
				  <div class="col-sm-4">
					<input type="number" id="normal-field" class="form-control" name="amount" value="<?php echo set_value('amount',$before->amount);?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Quantity</label>
				  <div class="col-sm-4">
					<input type="number" id="normal-field" class="form-control" name="quantity" value="<?php echo set_value('quantity',$before->quantity);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Start Time</label>
				  <div class="col-sm-4">
					<input type="time" id="normal-field" class="form-control" name="starttime" value="<?php echo set_value('starttime',$before->starttime);?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">End Time</label>
				  <div class="col-sm-4">
					<input type="time" id="normal-field" class="form-control" name="endtime" value="<?php echo set_value('endtime',$before->endtime);?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Ticket Max Allowed</label>
				  <div class="col-sm-4">
					<input type="number" id="normal-field" class="form-control" name="ticketmaxallowed" value="<?php echo set_value('ticketmaxallowed',$before->ticketmaxallowed);?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Ticket Min Allowed</label>
				  <div class="col-sm-4">
					<input type="number" id="normal-field" class="form-control" name="ticketminallowed" value="<?php echo set_value('ticketminallowed',$before->ticketminallowed);?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label">&nbsp;</label>
				  <div class="col-sm-4">
				  <button type="submit" class="btn btn-primary">Save</button>
				  <a href="<?php echo site_url('site/viewticketevent'); ?>" class="btn btn-secondary">Cancel</a>
				</div>
				</div>
			  </form>
			</div>
		</section>
	</div>
</div>