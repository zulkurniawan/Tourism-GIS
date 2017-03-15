<div class="row">
	<div class="col-md-6 col-md-offset-3" style="margin-top: 20px;">
		<div class="portlet light">
		    <div class="portlet-title">
		        <div class="caption">
		            <i class="icon-check"></i>
		            <span class="caption-subject bold uppercase">&nbsp;&nbsp;Verifikasi Pendaftaran</span>
		        </div>
		    </div>
		    <div class="portlet-body">
		    	<?=@$msg?>		    	
				<form class="form-horizontal" method="POST" id="form-verifikasi">
				    <div class="form-group form-md-line-input">
				        <label class="col-md-4 control-label">No Handphone *</label>
				        <div class="col-md-7">
				            <input type="text" class="form-control" name="no_hp">
							<div class="form-control-focus"> </div>
				        </div>
				    </div>
				    <div class="form-group form-md-line-input">
				        <label class="col-md-4 control-label">Kode Verifikasi *</label>
				        <div class="col-md-7">
				            <input type="text" class="form-control" name="kode_registrasi">
							<div class="form-control-focus"> </div>
				        </div>
				    </div>
                    <div id="form-verifikasi-result"></div>
                    <hr/>
				    <div class="form-group form-md-line-input">
				    	<div class="col-md-6">
                            <a href="<?=site_url()?>" class="btn grey btn-block">
                                <i class="fa fa-history"></i>&nbsp;&nbsp;Kembali Halaman Utama
                            </a>
				    	</div>				    	
				        <div class="col-md-6">
				            <button type="submit" class="btn btn-info btn-block">
				            	<i class="fa fa-check"></i>&nbsp;&nbsp;Verifikasi Akun Saya
				            </button>
				        </div>
				    </div>				    
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    $('#form-verifikasi').on('submit',function(){
    	$('.alert').remove();
        $('#form-verifikasi-result').html('');
        $.ajax({
            url         : "<?=site_url('API/auth/verifikasi')?>",
            // url         : "<?=site_url('API/auth/post_kode_verifikasi_hp')?>",
            method      : "POST",
            dataType    : "json",
            data        : $('#form-verifikasi').serialize(),
            success     : function(result){
                if(result.status == '201')
                {
                    $('#form-verifikasi-result').html('<div class="alert alert-danger" role="alert"><strong>Kesalahan !</strong><br/>' + result.data + '</div>');
                }
                else
                {
                    $('#form-verifikasi-result').html('<div class="alert alert-success" role="alert">' + result.data + '</div>');
                    // $('#modal-login').modal();
                    // window.location = "<?=site_url()?>";
                }
            },
            error       : function(result){
                $('#form-verifikasi-result').html('<?=err_msg('Gagal melakukan verifikasi.')?>');
            }
        })
        return false;
    });	
</script>