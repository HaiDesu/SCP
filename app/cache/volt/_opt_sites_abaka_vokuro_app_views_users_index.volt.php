<? use Abstaff\Models\UserGroups as Groups;?>
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
	<div class="col-lg-2">
		<a href="/users/unvalidated" class="btn btn-default btn-lg btn-block">
			<span class="label label-default">
				<?=count(Abstaff\Models\Users::find(array(
				'validated = :validated: AND banned = :banned:',
				'bind' => array(
					'validated' => 'N',
					'banned' => 'N',
				))));?>
			</span>
		<br>Pending Users</a>
	</div>
	<div class="col-lg-2">
		<a href="/users/validated" class="btn btn-default btn-lg btn-block">
			<span class="label label-success">
				<?=count(Abstaff\Models\Users::find(array(
				'validated = :validated: AND banned = :banned:',
				'bind' => array(
					'validated' => 'Y',
					'banned' => 'N',
				))));?>
			</span>
		<br>Active Users</a>
	</div>
	<div class="col-lg-2">
		<a href="/users/banned" class="btn btn-default btn-lg btn-block"><span class="label label-danger"><?=count(Abstaff\Models\Users::find(array(
			'banned = ?0', 'bind' => array('Y')
		)));?></span><br>Banned Users</a>
	</div>
	<div class="col-lg-2">
		<a href="/users" class="btn btn-default btn-lg btn-block"><span class="label label-primary"><?=count(Abstaff\Models\Users::find());?></span><br>Total Users</a>
	</div>
</div>
<br>
<div class="row">
	<?php echo $this->getContent() ?>
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Users List</h3>
			</div>
			<table class="table">
				<thead>
					<th>&nbsp;</th>
					<th>Username</th>
					<th>Title</th>
					<th>Email</th>
					<th>Group</th>
					<th>Status</th>
					<th>Joined</th>
				</thead>
				<tbody>
					<? foreach ($users as $user) { ?>
					<tr>
						<td><img src="http://www.gravatar.com/avatar/<?=md5(mb_strtolower(trim($user->email)));?>?s=25" alt="" width="25px" height="25px" /></td>
						<td><a href="/users/show/<?=$user->id;?>"><?=$user->username;?></a></td>
						<td><span class="text-muted"><?=$user->usertitle;?></span></td>
						<td><?=$user->email;?></td>
						<td><?php $user->group = Abstaff\Models\UserGroups::findFirstByid($user->group); echo $user->group->name;?></td>
						<td>
							<?php if ($user->banned == 'N') { ?>
								<?php if ($user->validated == 'Y') { ?>
									<span class="label label-success">active</span>
								<?php } elseif ($user->validated == 'N') { ?>
									<span class="label label-default">pending</span>
								<?php } ?>
							<?php } elseif ($user->banned == 'Y') { ?>
								<span class="label label-danger">banned</span>
							<?php } ?>
						</td>
						<td><?=$user->regDate;?></td>
					</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>