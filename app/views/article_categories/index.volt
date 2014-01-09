<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-bookmark"></span> Categories</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/article_categories" class="btn btn-default"><span class="icon-home"></span> Categories Overview</a> 
			<a href="/article_categories/new" class="btn btn-primary"><span class="icon-plus"></span> New Category</a> 
		</div>
	</div>
</div>

<div class="row">
	<?php echo $this->getContent() ?>
	<? foreach ($categories as $category) { ?>
	<div class="col-lg-6">
		<div class="well">
			<h4><a href="/article_categories/show/<?=str_replace(' ','_', strtolower($category->name));?>"><?=$category->name;?></a></h4>
			<p><?=$category->description;?></p>
		</div>
	</div>
	<? } ?>
</div>
