<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><span class="icon-drawer-2"></span> Episodes</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/episodes" class="btn btn-default"><span class="icon-home"></span> Episodes Overview</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Add episodes to a series</h3>
			</div>
			<div class="panel-body">
				<?=$this->getContent();?>
				<form action="/episodes/new" class="form-horizontal" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="series" class="col-sm-2 control-label">Series</label>
						<div class="col-sm-10">
							<select name="series" id="series" class="form-control" required>
								<option>Select a series...</option>
								<? foreach ($series as $title) { ?>
								<option value="<?=$title->id;?>"><?=$title->title;?></option>
								<? } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="reset" class="btn btn-default">Reset</button>
							<button type="submit" class="btn btn-success">Stage 2</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>