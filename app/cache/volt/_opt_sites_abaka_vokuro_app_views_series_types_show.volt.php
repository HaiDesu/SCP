<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/series_types"><span class="icon-tags"></span> Series Types</a></li>
		  <li class="active"><span class="icon-eye"></span> View Type</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/series_types" class="btn btn-default"><span class="icon-home"></span> Series Types Overview</a> 
			<a href="/series_types/new" class="btn btn-primary"><span class="icon-plus"></span> New Type</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<h3><?=$stype->name;?> <a href="/series_types/edit/<?=$stype->id;?>" class="btn btn-default btn-sm"><span class="icon-pencil"></span> Edit</a> <a data-toggle="modal" data-target="#deleteConfirm" class="btn btn-danger btn-xs"><span class="icon-hammer-2"></span></a></h3>
		<p><?=$stype->description;?></p>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Confirm your Actions</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to <em>delete</em> the Series Type "<?=$stype->name;?>" from the database? Keep in mind that <strong>this action is irreversible</strong> and that any series associated with this genre will be affected as well.</p>
				<p>If you still want to delete it, then continue. <span class="label label-warning">Actually, nope. No series types can be deleted from here at this stage.</span></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a href="#" data-dismiss="modal" class="btn btn-danger">Nope.mkv</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->