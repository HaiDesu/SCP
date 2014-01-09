<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-tags"></span> Series Types</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/stypes" class="btn btn-default"><span class="icon-home"></span> Series Types Overview</a> 
			<a href="/stypes/new" class="btn btn-primary"><span class="icon-plus"></span> New Type</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="list-group">
		<?php echo $this->getContent() ?>
		<? foreach ($stypes as $stype) { ?>
		<a href="/stypes/show/<?=str_replace(' ','_', strtolower($stype->name));?>" class="list-group-item">
			<h4 class="list-group-item-heading"><?=$stype->name;?></h4>
			<p class="list-group-item-text"><?=$stype->description;?></p>
		</a>
		<? } ?>
	</div>
</div>

