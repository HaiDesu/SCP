<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-user-4"></span> User Groups</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/user_groups" class="btn btn-default"><span class="icon-home"></span> User Groups Overview</a> 
			<a href="/user_groups/new" class="btn btn-primary"><span class="icon-plus"></span> New User Group</a> 
		</div>
	</div>
</div>

<div class="row">
	<?php echo $this->getContent() ?>
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Groups List</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<th>ID</th>
						<th>Title</th>
						<th>Description</th>
					</thead>
					<tbody>
						<? foreach ($groups as $group) { ?>
						<tr>
							<td><?=$group->id;?></td>
							<td><a href="/user_groups/show/<?=str_replace(' ','_', mb_strtolower($group->name));?>"><?=$group->name;?></a></td>
							<td><?=$group->description;?></td>
						</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
