<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/pages"><span class="icon-file"></span> Pages</a></li>
		  <li class="active"><span class="icon-eye"></span> View Page</li>
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
		<h3><?=$page->title;?> <a href="/pages/edit/<?=$page->id;?>" class="btn btn-warning btn-sm"><span class="icon-pencil"></span> Edit</a></h3>
		<p><?=$page->content;?></p>
	</div>
</div>