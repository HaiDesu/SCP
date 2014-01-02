<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li class="active"><span class="icon-file"></span> Pages</li>
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
	<?php echo $this->getContent() ?>
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Pages List</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<th>ID</th>
						<th>Title</th>
					</thead>
					<tbody>
						<? foreach ($pages as $page) { ?>
						<tr>
							<td><?=$page->id;?></td>
							<td><a href="/pages/show/<?=str_replace(' ','_', strtolower($page->slug));?>"><?=$page->title;?></a></td>
						</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
