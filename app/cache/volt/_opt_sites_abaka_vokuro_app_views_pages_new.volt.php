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
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Create a New Page</h3>
			</div>
			<div class="panel-body">
				<?=$this->getContent();?>
				<form action="/pages/create" class="form-horizontal" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-8">
							<?php echo $this->tag->textField(array("title", "size" => 32, 'class' => 'form-control', 'placeholder' => 'Page Title')) ?>
							<span class="help-block"><em>Alphanumeric characters only</em></span>
						</div>
					</div>
					<div class="form-group">
						<label for="slug" class="col-sm-2 control-label">Slug</label>
						<div class="col-sm-8">
							<?php echo $this->tag->textField(array("slug", "size" => 32, 'class' => 'form-control', 'placeholder' => 'Slug')) ?>
							<span class="help-block"><em>No spaces, caps or anything other than: common-letters-numbers-and-dashes</em></span>
						</div>
					</div>
					<div class="form-group">
						<label for="content" class="col-sm-2 control-label">Content</label>
						<div class="col-sm-10">
							<?php echo $this->tag->textArea(array('content', 'type' => 'date', 'class' => 'form-control ckeditor', 'rows' => 8, 'placeholder' => 'Page Content')) ?>
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

