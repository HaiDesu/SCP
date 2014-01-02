<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/genres"><span class="icon-tags"></span> Genres</a></li>
		  <li class="active"><span class="icon-pencil"></span> Edit Genre</li>
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
	<div class="col-lg-3">
		<div class="well">
			<?php echo $this->getContent(); ?>
			<form action="/genres/save" class="form-horizontal" method="post" accept-charset="utf-8">
				<div class="form-group">
					<?php echo $this->tag->textField(array("label", "size" => 30, 'class' => 'form-control')) ?>
				</div>
				<div class="form-group">
					<?php echo $this->tag->textArea(array('description', 'type' => 'date', 'class' => 'form-control', 'rows' => 4)) ?>
					<?php echo $this->tag->hiddenField("id") ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Save & Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

