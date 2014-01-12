<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-chart"></span> Statistics</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/series" class="btn btn-default"><span class="icon-home"></span> Statistics Overview</a> 
		</div>
	</div>
</div>

<div class="row">
	<?php echo $this->getContent() ?>
	<div class="col-lg-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Site Totals</h3>
			</div>
			<table class="table table-hover table-bordered">
				<tbody>
					<tr>
						<td>Series</td>
						<td><?=$total['series'];?></td>
					</tr>
					<tr>
						<td>Episodes</td>
						<td><?=$total['episodes'];?></td>
					</tr>
					<tr>
						<td>Mirrors</td>
						<td><?=$total['mirrors'];?></td>
					</tr>
					<tr>
						<td>Mirror Types</td>
						<td><?=$total['mirrortypes'];?></td>
					</tr>
					<tr>
						<td>Users</td>
						<td><?=$total['users'];?></td>
					</tr>
					<tr>
						<td>Articles</td>
						<td><?=$total['articles'];?></td>
					</tr>
					<tr>
						<td>Pages</td>
						<td><?=$total['pages'];?></td>
					</tr>
				</tbody>
			</table>

		</div>
	</div>
</div>
