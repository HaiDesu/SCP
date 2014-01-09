<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	{{ getTitle() }}
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/staffcp.css" rel="stylesheet">
	<link href="/assets/css/icomoon.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" type="text/javascript"></script>
  </head>
  <body>
	<div id="wrapper">
		{{ content() }}
	</div>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script src="/assets/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		$('.modal').modal('toggle');
	</script>
  </body>
</html>