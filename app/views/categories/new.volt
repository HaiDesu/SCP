<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/categories"><span class="icon-bookmark"></span> Categories</a></li>
		  <li class="active"><span class="icon-plus"></span> New Category</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/categories" class="btn btn-default"><span class="icon-home"></span> Categories Overview</a> 
			<a href="/categories/new" class="btn btn-primary"><span class="icon-plus"></span> New Category</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-3">
		<div class="well">
			<?=$this->getContent();?>
			<form action="/categories/create" class="form-horizontal" method="post" accept-charset="utf-8">
				<div class="form-group">
					<?php echo $this->tag->textField(array("name", 'maxlength' => 20, 'class' => 'form-control')) ?>
				</div>
				<div class="form-group">
					<?php echo $this->tag->textArea(array('description', 'type' => 'date', 'class' => 'form-control ckeditor', 'rows' => 4)) ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

