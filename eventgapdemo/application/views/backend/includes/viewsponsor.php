<div class=" row" style="padding:1% 0;">
	<div class="col-md-12">
	
		<a class="btn btn-primary pull-right"  href="<?php echo site_url('site/createticketevent'); ?>"><i class="icon-plus"></i>Create </a> &nbsp; 
	</div>
	
</div>
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">
               Ticket  Details
            </header>
			<table class="table table-striped table-hover fpTable lcnp" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<tr>
					<!--<th>Id</th>-->
					<th>Event</th>
					<th>User</th>
					<th>Amount</th>
					<th>Image</th>
					<td>Start Time</td>
					<td>End Time</td><td><i class=" icon-edit"></i>Status</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
			   <?php foreach($table as $row) { ?>
					<tr>
						<td><?php echo $row->event;?></td>
						<td><?php echo $row->user;?></td>
						<td><?php echo $row->amountsponsor;?></td>
						<td><?php echo $row->image;?></td>
						<td><?php echo $row->starttime;?></td>
						<td><?php echo $row->endtime;?></td>
						<td><?php if($row->status==1) { ?>
							<a href="<?php echo site_url('site/changesponsorstatus?user='.$row->user.'&event='.$row->event); ?>" class="label label-success label-mini">Enable</a>
						<?php } else { ?>
							<a href="<?php echo site_url('site/changesponsorstatus?user='.$row->user.'&event='.$row->event); ?>" class="label label-danger label-mini">Disable</a>
						<?php } ?>
						</td>
						<td>
							<?php if($row->status==0) { ?>
							<a href="<?php// echo site_url('site/deleteuser?id=').$row->id; ?>" class="btn btn-danger btn-xs">
								<i class="icon-trash "></i>
							</a> 
							<?php } ?>
						
						</td>
					</tr>
					<?php } ?>
			</tbody>
			</table>
		</section>
	</div>
</div>