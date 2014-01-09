<div class="form-group" id="validate-check">
	<div class="col-sm-9 col-sm-offset-3">
		<? if (isset($mirror['error'])) { ?>
		<div class="alert alert-danger"><strong>Error! </strong><?=$mirror['error'];?></div>
		<? } else { ?>		
		<iframe src="<?=$mirror['iframe_url'];?>" width="640" height="380" onload="onLoadHandler();" seamless></iframe>
		<input type="hidden" name="vhost" id="vhost" value="<?=$mirror['vhost_id'];?>" />
		<input type="hidden" name="vhost_domain" id="vhost_domain" value="<?=$mirror['vhost_domain'];?>" />
		<input type="hidden" name="vhost_uid" id="vhost_uid" value="<?=$mirror['vhost_uid'];?>" />
		<input type="hidden" name="user_id" id="user_id" value="<?=$i_user['id'];?>" />
		<? } ?>
	</div>
</div>