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
	<?php echo $this->getContent() ?>
	<? foreach ($stypes as $stype) { ?>
	<div class="col-lg-6">
		<div class="well">
			<h4><a href="/stypes/show/<?=str_replace(' ','_', strtolower($stype->label));?>"><?=$stype->label;?></a></h4>
			<p><?=$stype->description;?></p>
		</div>
	</div>
	<? } ?>
</div>
