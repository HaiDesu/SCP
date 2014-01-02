<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-users"></span> Users</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/users" class="btn btn-default"><span class="icon-home"></span> Users Overview</a> 
			<a href="/users/new" class="btn btn-primary"><span class="icon-plus"></span> New User</a> 
		</div>
	</div>
</div>

<div class="row">
	<?php echo $this->getContent() ?>
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Users List</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<th>ID</th>
						<th>Username</th>
					</thead>
					<tbody>
						<? foreach ($users as $user) { ?>
						<tr>
							<td><?=$user->id;?></td>
							<td><a href="/users/show/<?=$user->id;?>"><?=$user->username;?></a></td>
						</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
