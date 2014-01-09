<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-cloud-upload"></span> Videohosts</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/videohosts" class="btn btn-default"><span class="icon-home"></span> Videohosts Overview</a> 
			<a href="/videohosts/new" class="btn btn-primary"><span class="icon-plus"></span> New Host</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="list-group">
		<?php echo $this->getContent() ?>
		<?=(count($vhosts) == 0) ? 'No Hosts found.' : '' ;?>
		<? foreach ($vhosts as $host) { ?>
		<a href="/videohosts/show/<?=$host->name;?>" class="list-group-item">
			<h4 class="list-group-item-heading"><?=$host->name;?></h4>
		</a>
		<? } ?>
	</div>
</div>

