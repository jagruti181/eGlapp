<div class="row">
	<div class="col-lg-12">
	    <section class="panel">
		    <header class="panel-heading">
				 Newsletter  Details
			</header>
			<div class="panel-body">
				<form class="form-horizontal row-fluid" method="post" action="<?php echo site_url('site/editnewslettersubmit');?>">
					<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
					<div class=" form-group">
					  <label class="col-sm-2 control-label">Title</label>
					  <div class="col-sm-4">
						<input type="text" id="normal-field" class="form-control" name="title" value="<?php echo set_value('title',$before->title);?>">
					  </div>
					</div>
					<div class=" form-group">
					  <label class="col-sm-2 control-label">Subject</label>
					  <div class="col-sm-4">
						<input type="text" id="normal-field" class="form-control" name="subject" value="<?php echo set_value('subject',$before->subject);?>">
					  </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">&nbsp;</label>
						<div class="col-sm-4">	
							<button type="submit" class="btn btn-info">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</section>
    </div>
</div>