<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/groups"><span class="icon-user-4"></span> Groups</a></li>
		  <li class="active"><span class="icon-plus"></span> New Group</li>
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
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Create a New User Group</h3>
			</div>
			<div class="panel-body">
				<?=$this->getContent();?>
				<form action="/groups/create" class="form-horizontal" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-8">
							<?php echo $this->tag->textField(array("name", 'maxlength' => 24, 'class' => 'form-control', 'placeholder' => 'Group Name')) ?>
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

