<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/genres"><span class="icon-tags"></span> Genres</a></li>
		  <li class="active"><span class="icon-eye"></span> View Genre</li>
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
	<div class="col-lg-6">
		<h3><?=$genre->label;?> <a href="/genres/edit/<?=$genre->id;?>" class="btn btn-warning btn-sm"><span class="icon-pencil"></span> Edit</a></h3>
		<p><?=$genre->description;?></p>
	</div>
</div>