
		<section class="panel">
			<header class="panel-heading">
                User Interest Event Details <span class="pull-right">User :<?php echo $before->firstname." ".$before->lastname; ?></span>
            </header>
			<table class="table table-striped table-hover border-top " id="sample_1" cellpadding="0" cellspacing="0" >
			<thead>
				<tr>
					<!--<th>Id</th>-->
					<th>Event</th>
					<th>Time Stamp</th>
				</tr>
			</thead>
			<tbody>
			   <?php foreach($table as $row) { ?>
					<tr>
						<!--<td><?php echo $row->id; ?></td>-->
						<td><?php echo $row->event; ?></td>
						<td><?php echo $row->timestamp; ?></td>
					</tr>
					<?php } ?>
			</tbody>
			</table>
		</section>
	