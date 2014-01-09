<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/series"><span class="icon-tv"></span> Series</a></li>
		  <li class="active"><span class="icon-loop"></span> Prequel/Sequel Relationships</li>
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
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Add a New Prequel/Sequel</h3>
			</div>
			<div class="panel-body">
				<?=$this->getContent();?>
				<form action="/series/prequelsequelcreate" class="form-horizontal" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="prequel" class="col-sm-2 control-label">Prequel</label>
						<div class="col-sm-10">
							<select name="prequel" id="prequel" class="form-control" required>
								<? foreach ($series as $title) { ?>
								<option value="<?=$title->id;?>"><?=$title->title;?></option>
								<? } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="sequel" class="col-sm-2 control-label">Sequel</label>
						<div class="col-sm-10">
							<select name="sequel" id="sequel" class="form-control" required>
								<? foreach ($series as $title) { ?>
								<option value="<?=$title->id;?>"><?=$title->title;?></option>
								<? } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="reset" class="btn btn-default">Reset</button>
							<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>