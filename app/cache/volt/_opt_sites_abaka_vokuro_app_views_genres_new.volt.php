<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/genres"><span class="icon-tags"></span> Genres</a></li>
		  <li class="active"><span class="icon-plus"></span> New Genre</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/genres" class="btn btn-default"><span class="icon-home"></span> Genres Overview</a> 
			<a href="/genres/new" class="btn btn-primary"><span class="icon-plus"></span> New Genre</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Create a New Genre</h3>
			</div>
			<div class="panel-body">
				<?=$this->getContent();?>
				<form action="/genres/create" class="form-horizontal" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-8">
							<?php echo $this->tag->textField(array("name", 'maxlength' => 16, 'class' => 'form-control', 'placeholder' => 'Genre Name')) ?>
							<span class="help-block"><em>Letters and spaces only</em></span>
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
							<?php echo $this->tag->textArea(array('description', 'type' => 'date', 'class' => 'form-control ckeditor', 'rows' => 8)) ?>
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

