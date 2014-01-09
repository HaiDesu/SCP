<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/news"><span class="icon-newspaper"></span> News</a></li>
		  <li class="active"><span class="icon-eye"></span> View Article</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/news" class="btn btn-default"><span class="icon-home"></span> News Overview</a> 
			<a href="/news/new" class="btn btn-primary"><span class="icon-plus"></span> New Article</a> 
		</div>
	</div>
</div>

<div class="row">
	<?php echo $this->getContent() ?>
	<div class="col-lg-6">
		<h2><?=$article->title;?> <a href="/news/edit/<?=$article->id;?>" class="btn btn-default"><span class="icon-pencil"></span> Edit</a></h2>
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="icon-user"></span> <?=$article->author->username;?> / <span class="icon-calendar"></span> <?=$article->createdOn;?> / <span class="icon-bookmark"></span> <?=$article->category->name;?> / Published: <?=$article->isPublished;?> / <span class="icon-eye"></span> <?=$article->views;?>
			</div>
			<div class="panel-body">
				<?=$article->content;?>
			</div>
		</div>
	</div>
</div>