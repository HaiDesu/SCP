<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/series"><span class="icon-tv"></span> Series</a></li>
		  <li class="active"><span class="icon-pencil"></span> Edit Series</li>
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
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Edit Series</h3>
			</div>
			<div class="panel-body">
				<?=$this->getContent();?>
				<form action="/series/save" class="form-horizontal" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-8">
							<?php echo $this->tag->textField(array("title", 'maxlength' => 128, 'class' => 'form-control', 'placeholder' => 'Series Title', 'required' => 'required')) ?>
							<span class="help-block"><em>Paste as plain text only. Make sure your browser uses UTF-8 encoding.</em></span>
						</div>
					</div>
					<div class="form-group">
						<label for="altTitle" class="col-sm-2 control-label">Alt.Titles</label>
						<div class="col-sm-8">
							<?php echo $this->tag->textArea(array('altTitle', 'type' => 'date', 'class' => 'form-control ckeditor', 'rows' => 8)) ?>
							<span class="help-block"><em>Paste as plain text only. Japanese as well as English titles.</em></span>
						</div>
					</div>
					<div class="form-group">
						<label for="type" class="col-sm-2 control-label">Type</label>
						<div class="col-sm-4">
							<?=$this->tag->select(array("type", Abstaff\Models\SeriesTypes::find(), "using" => array("id", "name"), "useEmpty" => false, 'class' => 'form-control'));?>
						</div>
					</div>
					<div class="form-group">
						<label for="status" class="col-sm-2 control-label">Status</label>
						<div class="col-sm-4">
							<?=$this->tag->selectStatic(array("status", array(
								"Not Yet Aired" => "Not Yet Aired", 
								"Ongoing" => "Ongoing",
								"Completed" => "Completed"
							), 'class' => 'form-control'));?>
						</div>
					</div>
					<div class="form-group">
						<label for="poster" class="col-sm-2 control-label">Poster</label>
						<div class="col-sm-8">
							<?php echo $this->tag->textField(array("poster", 'maxlength' => 96, 'class' => 'form-control', 'placeholder' => 'Poster URL')) ?>
							<span class="help-block"><em>Use only direct image links. Use imgur.com for now.</em></span>
						</div>
					</div>
					<div class="form-group">
						<label for="synopsis" class="col-sm-2 control-label">Synopsis</label>
						<div class="col-sm-8">
							<?php echo $this->tag->textArea(array('synopsis', 'type' => 'date', 'class' => 'form-control ckeditor', 'rows' => 8)) ?>
							<span class="help-block"><em>Paste as plain text only. Make sure your browser uses UTF-8 encoding.</em></span>
						</div>
					</div>
					<div class="form-group">
						<label for="poster" class="col-sm-2 control-label">Genres</label>
						<div class="col-sm-10">
							<ul class="list-unstyled">
								{% for genre in genreslist %}
								<li style="display:inline-block;width:25%;">
									<input type="checkbox" name="genres[]" value="<?=$genre->id;?>" required /> <label for="genres" class="no-weight"><?=$genre->name;?></label>
								</li>
								{% endfor %}
							<ul>
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

