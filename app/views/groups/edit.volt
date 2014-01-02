<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/groups"><span class="icon-user-4"></span> Groups</a></li>
		  <li class="active"><span class="icon-pencil"></span> Edit Group</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/groups" class="btn btn-default"><span class="icon-home"></span> Groups Overview</a> 
			<a href="/groups/new" class="btn btn-primary"><span class="icon-plus"></span> New Group</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-3">
		<div class="well">
			<?php echo $this->getContent(); ?>
			<form action="/groups/save" class="form-horizontal" method="post" accept-charset="utf-8">
				<div class="form-group">
					<?php echo $this->tag->textField(array("name", "size" => 30, 'class' => 'form-control')) ?>
				</div>
				<div class="form-group">
					<?php echo $this->tag->textArea(array('description', 'type' => 'date', 'class' => 'form-control ckeditor', 'rows' => 8)) ?>
					<?php echo $this->tag->hiddenField("id") ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Save & Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

