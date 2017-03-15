<div class="portlet">
    <div class="portlet-body">
	    <div class="btn-group btn-group-solid btn-group-justified">
	        <a data-toggle="modal" href="#modal-login" class="btn white">
	        	<i class="icon-login"></i>&nbsp;&nbsp;&nbsp;Login
	        </a>
	        <a href="<?=site_url('daftar')?>" class="btn red-haze">
	        	<i class="icon-note"></i>&nbsp;&nbsp;&nbsp;Daftar
	        </a>
	    </div> 
	</div>
</div> 

<div class="modal fade" id="modal-login" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
			<form role="form" id="form-login">
	            <div class="modal-header">
	                <h4 class="modal-title"><i class="icon-login"></i>&nbsp;&nbsp;&nbsp;Login</h4>
	            </div>
	            <div class="modal-body"> 
			        <div class="form-body">
			            <div class="form-group form-md-line-input form-md-floating-label">
			                <input type="text" class="form-control" name="email">
			                <label>Email</label>
			            </div>
			            <div class="form-group form-md-line-input form-md-floating-label">
			                <input type="password" class="form-control" name="password">
			                <label>Password</label>
			            </div>
			        </div>
			        <div id="form-login-result"></div>
	            </div>
	            <div class="modal-footer">
	                <button type="submit" class="btn blue">
	                	<i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Submit
	                </button>
	                <button type="button" class="btn dark btn-outline" data-dismiss="modal">
	                	<i class="fa fa-cross"></i>&nbsp;&nbsp;&nbsp;Batal
	                </button>
	            </div>
		    </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	$('#form-login').on('submit',function(){
		$('#form-login-result').html('');
		$.ajax({
			url 		: "<?=site_url('API/auth/login')?>",
			method		: "POST",
			dataType	: "json",
			data 		: $('#form-login').serialize(),
			success		: function(result){
				if(result.status == '201')
				{
					$('#form-login-result').html('<div class="alert alert-danger" role="alert"><strong>Kesalahan !</strong><br/>' + result.data + '</div>');
				}
				else
				{
					$('#form-login-result').html('<div class="alert alert-success" role="alert">' + result.data + '</div>');					
					window.location = "<?=site_url()?>";
				}
			},
			error 		: function(result){
				$('#form-login-result').html('<?=err_msg('Gagal melakukan login.')?>');
			}
		})
		return false;
	});
</script>