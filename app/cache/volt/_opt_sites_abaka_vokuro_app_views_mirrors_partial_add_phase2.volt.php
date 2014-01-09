<div class="form-group" id="phase2">
	<label class="control-label col-sm-3" for="episode">Episode</label>
	<div class="col-sm-4">
		<select name="episode" id="episode" class="form-control">
			<option>Choose...</option>
			<? foreach ($episodes as $episode) { ?>
			<option value="<?=$episode->id;?>">Episode #<?=$episode->number;?></option>
			<? } ?>
		</select>
	</div>
</div>