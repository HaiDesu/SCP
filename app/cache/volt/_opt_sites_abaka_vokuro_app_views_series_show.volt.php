<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/series"><span class="icon-tv"></span> Series</a></li>
		  <li class="active"><span class="icon-eye"></span> View Series</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/series" class="btn btn-default"><span class="icon-home"></span> Series Overview</a> 
			<a href="/series/new" class="btn btn-primary"><span class="icon-plus"></span> New Series</a>  
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="well">
			<div class="row">
				<div class="col-lg-4">
					<img src="<?=$series->poster;?>" alt="" />
				</div>
				<div class="col-lg-8">
					<h3><?=$series->title;?></h3>
					<p class="text-muted"><?=$series->altTitle;?></p>
					<table class="table table-condensed">
						<tbody>
							<tr>
								<td class="text-muted" style="width:100px;">Channel ID:</td>
								<td><?=$series->id;?></td>
							</tr>
							<tr>
								<td class="text-muted">Status:</td>
								<td><?=$series->status;?></td>
							</tr>
							<tr>
								<td class="text-muted">Type:</td>
								<td><?=$series->type->name;?></td>
							</tr>
							<tr>
								<td class="text-muted">Episodes:</td>
								<td><?=($series->episodes ? $series->episodes : '<span class="text-muted">N/A</span>');?></td>
							</tr>
							<tr>
								<td class="text-muted">Genres:</td>
								<td>
								<? foreach ($series->genres as $series->genre) { ?>
									<a href="/genres/show/<?=str_replace(' ','_', strtolower($series->genre->name));?>"><?=$series->genre->name;?></a>
								<? } ?>
								</td>
							</tr>
							<tr>
								<td class="text-muted">Added:</td>
								<td><?=date_format(date_create($series->dateAdded), 'M jS Y h:i a');?></td>
							</tr>
							<tr>
								<td class="text-muted">Prequel:</td>
								<td><?=($series->prequel ? $series->prequel->title : '<span class="text-muted">N/A</span>');?></td>
							</tr>
							<tr>
								<td class="text-muted">Sequel:</td>
								<td><?=($series->sequel ? $series->sequel->title : '<span class="text-muted">N/A</span>');?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-3">
				<a href="/series/edit/<?=$series->id;?>" class="btn btn-warning btn-lg btn-block"><span class="icon-pencil"></span> Edit</a>
			</div>
			<div class="col-lg-3">
				<form action="/episodes/new" class="form-horizontal" method="post" accept-charset="utf-8">
					<input type="hidden" name="series" id="series" value="<?=$series->id;?>" />
					<button type="submit" class="btn btn-info btn-lg btn-block"><span class="icon-plus"></span> Add Episodes</button>
				</form>
			</div>
			<div class="col-lg-3">
				<a href="/series/relations" class="btn btn-default btn-lg btn-block"><span class="icon-plus"></span> New Relation</a>
			</div>
			<div class="col-lg-3">
				<? if ($series->status == 'Ongoing') { ?>
					<a href="#" class="btn btn-default btn-lg btn-block">Mark Completed</a>
				<? } elseif ($series->status == 'Not Yet Aired') { ?>
					<a href="#" class="btn btn-default btn-lg btn-block">Mark Ongoing</a>
				<? } ?>
			</div>
		</div>
		<br>
		<div class="panel panel-default">
			<div class="panel-heading">Synopsis</div>
			<div class="panel-body">
				<?=$series->synopsis;?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Episodes</h3>
			</div>
			<table class="table table-condensed">
				<thead>
					<th>Ep.#</th>
					<th>Title</th>
				</thead>
				<tbody>
					<? if (count($series->episodeslist) !== 0) { ?>
						<? foreach ($series->episodeslist as $episode) { ?>
						<tr>
							<td><a href="/episodes/show/<?=$episode->id;?>">Episode <?=$episode->number;?></a></td>
							<td><span class="text-muted"><?=($episode->title ? $episode->title : '<span class="text-muted">N/A</span>');?></span></td>
						</tr>
						<? } ?>
					<? } else { ?>
						<tr>
							<td colspan="3">No episodes exist for this series.</td>
						</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>