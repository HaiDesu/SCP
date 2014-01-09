<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-tv"></span> Series</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/series" class="btn btn-default"><span class="icon-home"></span> Series Overview</a> 
			<a href="/series/new" class="btn btn-primary"><span class="icon-plus"></span> New Series</a> 
			<a href="/series/relations" class="btn btn-primary"><span class="icon-plus"></span> New Relation</a>
		</div>
	</div>
</div>

<div class="row">
	<?php echo $this->getContent() ?>
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Series List</h3>
			</div>
			<table class="table">
				<thead>
					<th>Title</th>
					<th>altTitle</th>
					<th>Status</th>
					<th>Type</th>
					<th>Genres</th>
				</thead>
				<tbody>
					<? foreach ($series1 as $series) { ?>
					<tr>
						<td><a href="/series/show/<?=rawurldecode($series->s->slug);?>"><?=$series->s->title;?></a></td>
						<td><span class="text-muted"><?=$series->s->altTitle;?></span></td>
						<td><?=$series->s->status;?></td>
						<td><?=$series->name;?></td>
						<td><?=$series->genres;?></td>
					</tr>
					<? } ?>
				</tbody>
			</table>

		</div>
	</div>
</div>
