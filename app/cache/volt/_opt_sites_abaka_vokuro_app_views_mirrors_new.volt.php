<div class="row">
	<div class="col-lg-6">
		<ol class="breadcrumb">
		  <li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
		  <li><a href="/mirrors"><span class="icon-play"></span> Mirrors</a></li>
		  <li class="active"><span class="icon-plus"></span> New Mirror</li>
		</ol>
	</div>
	<div class="col-lg-6 clearfix">
		<div class="pull-right">
			<a href="/mirrors" class="btn btn-default"><span class="icon-home"></span> Mirrors Overview</a> 
			<a href="/mirrors/new" class="btn btn-primary"><span class="icon-plus"></span> New Mirror</a> 
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<?=$this->getContent();?>
		<form action="/mirrors/create" class="form-horizontal" method="post" accept-charset="utf-8">
			<div class="form-group" id="phase1">
				<label class="control-label col-sm-3" for="series">Series</label>
				<div class="col-sm-8">
					<?=$this->tag->select(array("series", Abstaff\Models\Series::find(), "using" => array("id", "title"), "useEmpty" => true, 'class' => 'form-control'));?>
				</div>
			</div>
			<div class="form-group" id="phase3a" style="display:none;">
				<label class="control-label col-sm-3" for="url">Video URL</label>
				<div class="col-sm-8">
					<?php echo $this->tag->textField(array('videourl', 'class' => 'form-control', 'placeholder' => 'Video URL')) ?>
				</div>
			</div>
			<div class="form-group" id="phase3c" style="display:none;">
				<label class="control-label col-sm-3" for="videotype">Video Type</label>
				<div class="col-sm-4">
					<?=$this->tag->select(array("videotype", Abstaff\Models\MirrorTypes::find(), "using" => array("id", "shortcode"), "useEmpty" => false, 'class' => 'form-control'));?>
				</div>
			</div>
			<div class="form-group" id="phase3d" style="display:none;">
				<div class="col-sm-8 col-sm-offset-3">
					<button type="button" id="validateVideo" class="btn btn-info">Validate Video URL</button>
				</div>
			</div>
			<div class="form-group" id="phase5" style="display:none;">
				<div class="col-sm-10 col-sm-offset-3">
					<p>If you see your video embedded above, then you're all set. Just click Submit now.</p>
					<button type="submit" class="btn btn-success"><span class="icon-disk"></span> Submit for Approval</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-lg-1" id="loading">
		<div class="blankblock"></div>
	</div>
</div>


<script type="text/javascript">
	var site_url = 'http://vokuro.abaka.pw/';
	$("#series").change(function (e) {
		$('.blankblock').addClass('ajax-loading');
		e.preventDefault();
		if($("#series:selected").val()===""){ alert("Please select a series!");return false;}
		if(document.getElementById("phase2") !== null){$('#phase2').remove();}
		$.ajax({
			type : 'POST',
			async: false,
			data : { phase : "episode", sid : $("#series").val() },
			url : site_url+'mirrors/addmirror',
			success :   function(data){
				$("#phase1").after(data);
				$("#phase3a").show();
				$("#phase3b").show();
				$("#phase3c").show();
				$("#phase3d").show();
				$('.blankblock').removeClass('ajax-loading');
			},
			error: function(){alert("Error processing series title!");}
		});
	});

	$('#validateVideo').click(function (e) {
		$('.blankblock').addClass('ajax-loading');
		if(document.getElementById("validate-check") !== null){$('#validate-check').remove();}
		e.preventDefault();
		$.ajax({
			type : 'POST',
			async: false,
			data : { phase : "validate", sid : $("#series").val(), episode_id : $("#episode").val(), mirror_type : $("#videotype").val(), video_url : $("#videourl").val() },
			url : site_url+'mirrors/addmirror',
			success :   function(data){
				$("#phase3d").after(data);
				$('.blankblock').removeClass('ajax-loading');
			},
		})
		//error: function(){alert("Error processing video");}
	});
	
	function onLoadHandler() {
		$("#phase5").show();
	}
	
</script>

