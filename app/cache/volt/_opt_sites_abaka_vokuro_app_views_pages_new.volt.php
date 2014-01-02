<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/pages"><span class="icon-file"></span> Pages</a></li>
		  <li class="active"><span class="icon-plus"></span> New Page</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/pages" class="btn btn-default"><span class="icon-home"></span> Pages Overview</a> 
			<a href="/pages/new" class="btn btn-primary"><span class="icon-plus"></span> New Page</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="well">
			<?=$this->getContent();?>
			<form action="/pages/create" class="form-horizontal" method="post" accept-charset="utf-8">
				<div class="form-group">
					<?php echo $this->tag->textField(array("title", "size" => 32, 'class' => 'form-control', 'placeholder' => 'Title')) ?>
				</div>
				<div class="form-group">
					<?php echo $this->tag->textField(array("slug", "size" => 32, 'class' => 'form-control', 'placeholder' => 'Slug (common-case-and-no-spaces)')) ?>
				</div>
				<div class="form-group">
					<?php echo $this->tag->textArea(array('content', 'type' => 'date', 'class' => 'form-control ckeditor', 'rows' => 8, 'placeholder' => 'Page Content')) ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

