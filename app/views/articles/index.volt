<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-newspaper"></span> Articles</li>
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
	<?php echo $this->getContent() ?>
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Articles List</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<th>ID</th>
						<th>Title</th>
					</thead>
					<tbody>
						<? foreach ($articles as $article) { ?>
						<tr>
							<td><?=$article->id;?></td>
							<td><a href="/articles/show/<?=$article->slug;?>"><?=$article->title;?></a></td>
						</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
