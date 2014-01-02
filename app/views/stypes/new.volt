<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/stypes"><span class="icon-tags"></span> Series Types</a></li>
		  <li class="active"><span class="icon-plus"></span> New Type</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/stypes" class="btn btn-default"><span class="icon-home"></span> Series Types Overview</a> 
			<a href="/stypes/new" class="btn btn-primary"><span class="icon-plus"></span> New Type</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-3">
		<div class="well">
			<?=$this->getContent();?>
			<form action="/stypes/create" class="form-horizontal" method="post" accept-charset="utf-8">
				<div class="form-group">
					<?php echo $this->tag->textField(array("label", "size" => 30, 'class' => 'form-control', 'placeholder' => 'Type Name')) ?>
				</div>
				<div class="form-group">
					<?php echo $this->tag->textArea(array('description', 'type' => 'date', 'class' => 'form-control ckeditor', 'rows' => 4, 'placeholder' => 'Type Description')) ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

