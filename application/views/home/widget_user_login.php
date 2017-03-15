<div class="portlet light" style="margin-bottom: 0px;">
    <div class="portlet-body">
    	<h5>Selamat Datang, <strong><?=$user_profile->nama?></strong>.</h5>
    	<h6>Terakhir Login : <strong><?=$login_terakhir?></strong></h6>
    </div>
</div>
<div class="btn-group btn-group-solid btn-group-justified">
	<a href="<?=site_url('panel/dashboard')?>" class="btn blue">
		<i class="fa fa-dashboard"></i>&nbsp;&nbsp;&nbsp;Masuk Panel
	</a>    	
	<a href="<?=site_url('API/auth/logout')?>" class="btn red-sunglo">
		Logout&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-out"></i>
	</a>    	
</div> 