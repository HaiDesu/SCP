<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-tags"></span> Genres</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/genres" class="btn btn-default"><span class="icon-home"></span> Genres Overview</a> 
			<a href="/genres/new" class="btn btn-primary"><span class="icon-plus"></span> New Genre</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="list-group">
		<?php echo $this->getContent() ?>
		<? foreach ($genres as $genre) { ?>
		<a href="/genres/show/<?=str_replace(' ','_', strtolower($genre->name));?>" class="list-group-item">
			<h4 class="list-group-item-heading"><?=$genre->name;?></h4>
			<p class="list-group-item-text"><?=$genre->description;?></p>
		</a>
		<? } ?>
	</div>
</div>


