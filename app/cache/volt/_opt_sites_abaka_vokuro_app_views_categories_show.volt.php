<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/categories"><span class="icon-bookmark"></span> Categories</a></li>
		  <li class="active"><span class="icon-eye"></span> View Category</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/categories" class="btn btn-default"><span class="icon-home"></span> Categories Overview</a> 
			<a href="/categories/new" class="btn btn-primary"><span class="icon-plus"></span> New Category</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<h3><?=$category->name;?> <a href="/categories/edit/<?=$category->id;?>" class="btn btn-warning btn-sm"><span class="icon-pencil"></span> Edit</a></h3>
		<p><?=$category->description;?></p>
	</div>
</div>