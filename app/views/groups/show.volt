<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/groups"><span class="icon-user-4"></span> Groups</a></li>
		  <li class="active"><span class="icon-eye"></span> View Group</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/groups" class="btn btn-default"><span class="icon-home"></span> Groups Overview</a> 
			<a href="/groups/new" class="btn btn-primary"><span class="icon-plus"></span> New Group</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<h3><?=$group->name;?> <a href="/groups/edit/<?=$group->id;?>" class="btn btn-warning btn-sm"><span class="icon-pencil"></span> Edit</a></h3>
		<p><?=$group->description;?></p>
	</div>
</div>