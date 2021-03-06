<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/articles"><span class="icon-newspaper"></span> Articles</a></li>
		  <li class="active"><span class="icon-pencil"></span> Edit Article</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/articles" class="btn btn-default"><span class="icon-home"></span> Articles Overview</a> 
			<a href="/articles/new" class="btn btn-primary"><span class="icon-plus"></span> New Article</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Edit Article</h3>
			</div>
			<div class="panel-body">
				<?=$this->getContent();?>
				<form action="/articles/save" class="form-horizontal" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-8">
							<?php echo $this->tag->textField(array("title", "maxlength" => 128, 'class' => 'form-control')) ?>
							<span class="help-block"><em>Letters and spaces only</em></span>
						</div>
					</div>
					<div class="form-group">
						<label for="category" class="col-sm-2 control-label">Category</label>
						<div class="col-sm-4">
							<?=$this->tag->select(array("category", Abstaff\Models\ArticleCategories::find(), "using" => array("id", "name"), "useEmpty" => true, 'class' => 'form-control'));?>
						</div>
					</div>
					<div class="form-group">
						<label for="isPublished" class="col-sm-2 control-label">Publish/Draft</label>
						<div class="col-sm-4">
							<?=$this->tag->selectStatic(array("isPublished", array("N" => "Save as Draft", "Y" => "Publish when Saved"), 'class' => 'form-control'));?>
						</div>
					</div>
					<div class="form-group">
						<label for="content" class="col-sm-2 control-label">Content</label>
						<div class="col-sm-10">
							<?php echo $this->tag->textArea(array('content', 'type' => 'date', 'class' => 'form-control ckeditor', 'rows' => 8)) ?>
							<?php echo $this->tag->hiddenField("id") ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="reset" class="btn btn-default">Reset</button>
							<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Save and Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

