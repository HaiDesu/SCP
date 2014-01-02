<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/users"><span class="icon-users"></span> Users</a></li>
		  <li class="active"><span class="icon-pencil"></span> Edit User</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/users" class="btn btn-default"><span class="icon-home"></span> Users Overview</a> 
			<a href="/users/new" class="btn btn-primary"><span class="icon-plus"></span> New User</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-3">
		<div class="well">
			<?php echo $this->getContent(); ?>
			<form action="/users/save" class="form-horizontal" method="post" accept-charset="utf-8">
				<div class="form-group">
					<?php echo $this->tag->textField(array("username", "maxlength" => 16, 'class' => 'form-control')) ?>
					<?php echo $this->tag->hiddenField("id") ?>
				</div>
				<div class="form-group">
					<?php echo $this->tag->textField(array("email", 'class' => 'form-control')) ?>
				</div>
				<div class="form-group">
					<?=$this->tag->select(array("group", Abstaff\Models\Groups::find(), "using" => array("id", "name"), "useEmpty" => false, 'class' => 'form-control'));?>
				</div>
				<div class="form-group">
					<?=$this->tag->selectStatic("validated", array("Y" => "Validated", "N" => "NOT validated"));?>
				</div>
				<div class="form-group">
					<?=$this->tag->selectStatic("banned", array("Y" => "Banned", "N" => "NOT Banned"));?>
				</div>
				
			
				<div class="form-group">
					<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Save & Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

