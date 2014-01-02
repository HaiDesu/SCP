<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/users"><span class="icon-users"></span> Users</a></li>
		  <li class="active"><span class="icon-eye"></span> Show User</li>
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
	<div class="col-lg-5">
		<div class="well">
			<div class="row">
				<div class="col-lg-5">
					<img src="http://www.gravatar.com/avatar/<?=md5(mb_strtolower(trim($user->email)));?>?s=200" alt="" width="200px" height="200px" />
				</div>
				<div class="col-lg-6">
					<h3><?=$user->username;?></h3>
					<table class="table table-condensed">
						<tbody>
							<tr>
								<td class="text-muted">Email:</td>
								<td><?=$user->email;?></td>
							</tr>
							<tr>
								<td class="text-muted">Registered:</td>
								<td><?=$user->regDate;?></td>
							</tr>
							<tr>
								<td class="text-muted">Group:</td>
								<td><?=$user->group->name;?></td>
							</tr>
							<tr>
								<td class="text-muted">Validated:</td>
								<td>
									<?php if ($user->validated == 'Y') { ?>
										<span class="label label-success">validated</span>
									<?php } elseif ($user->validated == 'N') { ?>
										<span class="label label-default">unvalidated</span>
									<?php } ?>
								</td>
							</tr>
							<tr>
								<td class="text-muted">isBanned:</td>
								<td>
									<?php if ($user->banned == 'Y') { ?>
										<span class="label label-danger">banned</span>
									<?php } elseif ($user->banned == 'N') { ?>
										<span class="label label-success">unbanned</span>
									<?php } ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel panel-success">
			<div class="panel-heading">Successful Logins</div>
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>IP Address</th>
						<th>Timestamp</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($successlogins as $successlogin) { ?>
					<tr>
						<td><?=$successlogin->ipAddress;?></td>
						<td><?=$successlogin->date;?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>