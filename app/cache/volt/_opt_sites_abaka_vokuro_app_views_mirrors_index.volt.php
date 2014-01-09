<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-play"></span> Mirrors</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/mirrors" class="btn btn-default"><span class="icon-home"></span> Mirrors Overview</a> 
			<a href="/mirrors/new" class="btn btn-primary"><span class="icon-plus"></span> New Mirror</a> 
		</div>
	</div>
</div>

<div class="row">
	<?php echo $this->getContent() ?>
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Unapproved Mirrors (Needs Approval)</h3>
			</div>
			<table class="table" style="text-align:center">
				<thead>
					<th style="text-align:center">Mirror Info</th>
					<th style="text-align:center">Episode Info</th>
					<th style="width:160px;text-align:center;">Screencap</th>
					<th style="text-align:center">Uploader</th>
					<th>&nbsp;</th>
				</thead>
				<tbody>
					<?=(count($mirrors_not_approved) == 0) ? '<tr><td colspan="8">No Mirrors to approve.</td></tr>' : '' ;?>
					<? foreach ($mirrors_not_approved as $mirror) { ?>
					<tr>
						<td>
							<span class="text-muted">MirrorID: </span><?=$mirror->m->id;?><br>
							<span class="text-muted">Type: </span><?=$mirror->mirror_type;?><br>
							<span class="text-muted">Host: </span><?=$mirror->videohost;?><br>
							<span class="text-muted">HostID: </span><?=$mirror->m->vhost_uid;?><br>
							<span class="text-muted">Submitted: </span><?=date_format(date_create($mirror->m->dateAdded), 'M jS Y h:i a');?><br>
						</td>
						<td>
							<a href="/series/show/<?=rawurldecode($mirror->series_slug);?>"><strong><?=$mirror->series;?></strong></a><br>
							<p class="text-muted">
								Episode <?=$mirror->episode_number;?><br>
								<?=($mirror->episode_title) ? $mirror->episode_title : '<small>No title found for this episode. <a href="/episodes/edit/'.$mirror->m->episode_id.'">[Add]</a></small>' ;?>
							</p>
						</td>
						<td style="width:160px;"><?=($mirror->m->screencap) ? $mirror->m->screencap : '<img src="http://placehold.it/150x100" alt="screencap<?=$mirror->m->id;?>" />' ;?></td>
						<td><br><br><?=$mirror->username;?></td>
						<td>
							<a href="#" class="btn btn-success btn-lg btn-block"><span class="icon-checkmark"></span> Approve</a> 
							<a href="#" class="btn btn-danger btn-lg btn-block"><span class="icon-close"></span> Remove</a> 
						</td>							
					</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

