<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-tags"></span> Mirror Types</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/mirror_types" class="btn btn-default"><span class="icon-home"></span> Mirror Types Overview</a> 
			<a href="/mirror_types/new" class="btn btn-primary"><span class="icon-plus"></span> New Type</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="list-group">
		<?php echo $this->getContent() ?>
		<?=(count($mirror_types) == 0) ? 'No Types found.' : '' ;?>
		<? foreach ($mirror_types as $mtype) { ?>
		<a href="/mirror_types/show/<?=$mtype->shortcode;?>" class="list-group-item">
			<h4 class="list-group-item-heading"><?=$mtype->name;?> [<?=$mtype->shortcode;?>]</h4>
			<p class="list-group-item-text"><?=$mtype->description;?></p>
		</a>
		<? } ?>
	</div>
</div>

