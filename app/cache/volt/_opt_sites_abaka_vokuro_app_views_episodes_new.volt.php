<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/episodes"><span class="icon-drawer-2"></span> Episodes</a></li>
		  <li class="active"><span class="icon-plus"></span> Add Episodes</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/episodes" class="btn btn-default"><span class="icon-home"></span> Episodes Overview</a> 
			<a href="/episodes/new" class="btn btn-primary"><span class="icon-plus"></span> New Series</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-3">
		<table class="table table-condensed table-bordered">
			<tr>
				<td>Title</td>
				<td><?=$series->title;?></td>
			</tr>
			<tr>
				<td>Alternative Titles</td>
				<td><?=$series->altTitle;?></td>
			</tr>
			<tr>
				<td>Type</td>
				<td><?=$series->type->name;?></td>
			</tr>
			<tr>
				<td>Status</td>
				<td><?=$series->status;?></td>
			</tr>
			<tr>
				<td>Series episodes value</td>
				<td><?=($series->episodes ? $series->episodes : '<span class="text-muted">N/A</span>');?></td>
			</tr>
			<tr>
				<td>No. of episodes in Episodes table</td>
				<td><?=($series->episodeslist ? count($series->episodeslist) : '<span class="text-muted">N/A</span>');?></td>
			</tr>
		</table>
	</div>
	<div class="col-lg-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Add a Single Episode</h3>
			</div>
			<div class="panel-body">
				<form action="/episodes/createsingle" class="form-horizontal" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="epstarts" class="col-sm-6 control-label">Start from Ep. <?=($series->lastep + 1);?></label>
						<div class="col-sm-6">
							<input type="number" name="epstarts" id="epstarts" value="<?=($series->lastep + 1);?>" class="form-control" />
							<span class="help-block"><em>Last stored episode is <?=$series->lastep;?></em></span>
							<input type="hidden" name="sid" id="sid" value="<?=$series->id;?>" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="reset" class="btn btn-default">Reset</button>
							<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Add Episode</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Add Multiple Episodes</h3>
			</div>
			<div class="panel-body">
				<form action="/episodes/createmulti" class="form-horizontal" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="epstart" class="col-sm-3 control-label">Start from Ep. <?=($series->lastep + 1);?></label>
						<div class="col-sm-3">
							<input type="number" name="epstart" id="epstart" value="<?=($series->lastep + 1);?>" class="form-control" />
							<span class="help-block"><em>Last stored episode is <?=$series->lastep;?></em></span>
						</div>
						<label for="epamt" class="col-sm-3 control-label">Ep. Amount</label>
						<div class="col-sm-3">
							<input type="number" name="epamt" id="epamt" value="10" class="form-control" />
							<span class="help-block"><em>Inclusive of start number!</em></span>
							<input type="hidden" name="sid" id="sid" value="<?=$series->id;?>" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="reset" class="btn btn-default">Reset</button>
							<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Add Episodes</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Existing Episodes</h3>
			</div>
			<table class="table table-condensed">
				<thead>
					<th>ID</th>
					<th>Ep.#</th>
					<th>Title</th>
				</thead>
				<tbody>
					<? if (count($series->episodeslist) !== 0) { ?>
						<? foreach ($series->episodeslist as $episode) { ?>
						<tr>
							<td><?=$episode->id;?></td>
							<td>Episode <?=$episode->number;?></td>
							<td><span class="text-muted"><?=$episode->title;?></span></td>
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

<script type="text/javascript">
/*	$("#series").on('change', function(){
		//alert( this.value );
		var seriesId = $(this).val();
		//alert( "Series id: " + seriesId );
		
		var request = $.ajax({
			url: "/episodes/new1",
			type: "POST",
			data: { id : seriesId },
			dataType: "html"
		});
		 
		request.done(function( msg ) {
			alert( "Request failed: " + msg );
		});
		 
		request.fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
		});   		
	});*/
</script>