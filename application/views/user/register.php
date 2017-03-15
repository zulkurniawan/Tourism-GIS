<div class="container" style="margin-top: 10px; margin-bottom: 30px;">
	<div class="row">
		<div class="col-md-6 hidden-xs hidden-sm">
			<div class="portlet light bordered">
			    <div class="portlet-title">
			        <div class="caption">
			            <i class="icon-list"></i>
			            <span class="caption-subject bold">&nbsp;&nbsp;Syarat & Ketentuan</span>
			        </div>
			    </div>
			    <div class="portlet-body" style="max-height: 742px; overflow-y: scroll;">
			    	<div class="text_perjanjian_kontributor">
			    		<h3 class="text-center" style="margin-top: 0px;">Kontributor Pariwisata</h3><!--<hr style="margin-top: 15px;" />-->

					    <div class="form-group form-md-line-input">
					     	<div class="modal-footer">
                                <a href="<?=site_url('API/auth/login_with_google')?>" class="btn btn-danger btn-block">
                                    <i class="fa fa-google-plus"></i> Daftar dengan Google+
                                </a>
                               		      <a href="<?=site_url('API/auth/login_with_fb')?>" class="btn btn-primary btn-block">
                              		      	<i class="fa fa-facebook"></i> Daftar dengan Facebook
                     			      </a>
                  		              <a href="<?=site_url('API/auth/login_with_ig')?>" class="btn purple-studio btn-block">
                 		              	<i class="fa fa-instagram"></i> Daftar dengan Instagram
                           		      </a>
                            		     </div>
					    </div>

				    	<?=$this->config->item('registrasi_perjanjian')?>
				    </div>
			    	<div class="text_perjanjian_partners">
			    		<h3 class="text-center" style="margin-top: 0px;">Partners Akomodasi</h3><hr style="margin-top: 15px;" />
				    	<?=$this->config->item('registrasi_perjanjian_partners')?>
				    </div>
			   	</div>
			   	<a href="<?=site_url()?>" class="btn btn-block grey">
			   		<i class="fa fa-angle-left"></i>&nbsp;&nbsp;Kembali Ke Peta Wisata
			   	</a>
		    	<hr/>
			</div>
		</div>
		<div class="col-md-6">
			<div class="portlet light bordered">
			    <div class="portlet-title">
			        <div class="caption">
			            <i class="icon-user"></i>
			            <span class="caption-subject bold">&nbsp;&nbsp;Pendaftaran</span>
			        </div>
			    </div>
			    <!--
			    <div class="form-group" align="center">
			        <?=@$msg?>
			    	<span class="caption-subject"><i>"Pilih jenis user sesuai kebutuhan Anda"</i></span><br>
			    	<span class="caption">
			    		<br><i>Aktifis sebagai <b>Kontributor</b></i>
			    		<br><i>Marketing sebagai <b>Partners </b></i>
			    	</span>
			    </div>
			    -->
			    <div class="portlet-body">
			    	<?=@$msg?>
					<!--<a class="btn red hidden-md hidden-lg btn-block" data-toggle="modal" href="#ketentuan_perjanjian_modal" style="margin-bottom: 5px;"> Syarat & Ketentuan </a>-->
					<form id="form-pendaftaran" class="form-horizontal" method="POST" action="<?=site_url('user/register_submit/')?>" enctype="multipart/form-data">
					    <div class="form-group form-md-line-input">
					        <label class="col-md-4 control-label"><b>Daftar sebagai :</b></label>
					        <div class="col-md-7">
							<select class="form-control" name="regas" id="regas" onchange="get_regas_aggrement_text(this.value)">
                                    				<option value="Kontributor" <?=@$data->regas == 'Kontributor' ? 'selected="selected"' : ''?>>Kontributor Pariwisata</option>
                                    				<option value="Partners" <?=@$data->regas == 'Partners' ? 'selected="selected"' : ''?>>Partners Akomodasi</option>
                                			</select>					        
								<div class="form-control-focus"> </div>
								<span class="help-block">Silahkan pelajari Syarat & Ketentuan.</span>
					        </div><br>
					    </div>
					    <div class="col-md-7">
					    	<a class="btn red hidden-md hidden-lg btn-block" data-toggle="modal" href="#ketentuan_perjanjian_modal" style="margin-bottom: 5px;"> Syarat & Ketentuan </a>
					    </div>
					    <div class="form-group form-md-line-input">
					        <label class="col-md-4 control-label" for="nama">Nama Kontributor *</label>
					        <div class="col-md-7">
					            <input type="text" class="form-control" name="nama" value="<?=@$data->nama?>">
								<div class="form-control-focus"> </div>
					        </div>
					    </div>
					    <div class="form-group form-md-line-input">
					        <label class="col-md-4 control-label"><b>Email *</b></label>
					        <div class="col-md-7">
					            <input type="email" class="form-control" name="email" value="<?=@$data->email?>">
								<div class="form-control-focus"> </div>
					        </div>
					    </div>
					    <div class="form-group form-md-line-input">
					        <label class="col-md-4 control-label"><b>Password *</b></label>
					        <div class="col-md-7">
					            <input type="password" class="form-control" name="password" value="">
								<div class="form-control-focus"> </div>
					        </div>
					    </div>
					    <div class="form-group form-md-line-input">
					        <label class="col-md-4 control-label"><b>Konfirmasi Password *</b></label>
					        <div class="col-md-7">
					            <input type="password" class="form-control" name="cpassword" value="">
								<div class="form-control-focus"> </div>
					        </div>
					    </div>
					    <div class="form-group form-md-line-input">
					        <label class="col-md-4 control-label"><b>No. Ponsel Pribadi *</b></label>
					        <div class="col-md-7">
					            <input type="text" class="form-control" name="no_hp" value="<?=@$data->no_hp?>">
								<div class="form-control-focus"> </div>
					        </div>
					    </div>
					    
					    <!--<hr/>
					    <div class="form-group form-md-line-input">
					        <label class="col-md-4 control-label" for="organisasi">Organisasi</label>
					        <div class="col-md-7">
					            <input type="text" class="form-control" name="organisasi" value="<?=@$data->organisasi?>">
								<div class="form-control-focus"> </div>
					        </div>
					    </div>
					    <div class="form-group form-md-line-input">
					        <label class="col-md-4 control-label" for="alamat">Alamat</label>
					        <div class="col-md-7">
					            <input type="text" class="form-control" name="alamat" value="<?=@$data->alamat?>">
								<div class="form-control-focus"> </div>
					        </div>
					    </div>
	                    <div class="form-group form-md-line-input">
	                        <label class="col-md-4 control-label" for="tentang">Sekilas Tentang Anda</label>
	                        <div class="col-md-7">
	                            <textarea class="form-control" name="tentang" rows="5" onkeyup="countChar(this)"><?=@$data->tentang?></textarea>
	                            <div class="form-control-focus"> </div>
	                            <span class="help-block" id="charNum">Sisa <?=empty($data->singkat) ? '250' : 250 - strlen($data->singkat)?> Karakter</span>
	                        </div>
	                    </div>
	                    <div class="form-group form-md-line-input">
	                        <label class="col-md-4 control-label" for="userfiles">Foto</label>
	                        <div class="col-md-7">
	                            <input type="file" class="form-control" name="userfiles">
	                            <div class="form-control-focus"> </div>
	                            <span>File harus berjenis JPG / PNG<br/>Maksimal Ukuran : 2 MB</span>
	                        </div>
	                    </div>
	                    <hr/>-->
					    <div class="form-group form-md-line-input">
					        <div class="col-md-12 col-xs-12">
					            <button type="submit" class="btn btn-info btn-block">
					            	<i class="fa fa-check"></i>&nbsp;&nbsp;Lanjutkan Pendaftaran
					            </button>
					        </div>
					    </div>
					    <!--<hr/>-->
					</form>		    	
			    </div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ketentuan_perjanjian_modal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Syarat & Ketentuan</h4>
            </div>
            <div class="modal-body"> 
		    	<div class="text_perjanjian_kontributor">
		    		<h3 class="text-center" style="margin-top: 0px; margin-bottom: 0px;">Kontributor Pariwisata</h3><!--<hr style="margin-top: 10px;" />-->
			    	
					    <div class="form-group form-md-line-input">
					     <div class="modal-footer">
                               		      <a href="<?=site_url('API/auth/login_with_fb')?>" class="btn btn-primary btn-block">
                              		      	<i class="fa fa-facebook"></i> Daftar dengan Facebook
                     			      </a>
                  		              <a href="<?=site_url('API/auth/login_with_ig')?>" class="btn purple-studio btn-block">
                 		              	<i class="fa fa-instagram"></i> Daftar dengan Instagram
                           		      </a>
                            		     </div>
					    </div>
			    	
			    	<?=$this->config->item('registrasi_perjanjian')?>
			    </div>
		    	<div class="text_perjanjian_partners">
		    		<h3 class="text-center" style="margin-top: 0px; margin-bottom: 0px;">Partners Akomodasi</h3><hr style="margin-top: 10px;" />
			    	<?=$this->config->item('registrasi_perjanjian_partners')?>
			    </div>
            </div>
            <div class="modal-footer">
			   	<a href="<?=site_url()?>" class="btn btn grey">
			   		Tidak Setuju
			   	</a>
                <button type="button" class="btn blue" data-dismiss="modal">
                	<i class="fa fa-check"></i> Setuju
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	function get_regas_aggrement_text(val)
	{
		if(val == 'Kontributor')
		{
			$('.text_perjanjian_partners').fadeOut(500, function(){
				$('.text_perjanjian_kontributor').fadeIn();
			});

			$('#form-pendaftaran label[for="nama"]').html('Nama Kontributor');
			$('#form-pendaftaran label[for="organisasi"]').html('Organisasi / Komunitas');
			$('#form-pendaftaran label[for="alamat"]').html('Alamat Rumah');
			$('#form-pendaftaran label[for="tentang"]').html('Sekilas Tentang Anda');
			$('#form-pendaftaran label[for="userfiles"]').html('Foto Profil');
		}
		else if(val == 'Partners')
		{
			$('.text_perjanjian_kontributor').fadeOut(500, function(){
				$('.text_perjanjian_partners').fadeIn();
			});

			$('#form-pendaftaran label[for="nama"]').html('Nama Partners');
			$('#form-pendaftaran label[for="organisasi"]').html('Nama Bisnis');
			$('#form-pendaftaran label[for="alamat"]').html('Alamat Bisnis');
			$('#form-pendaftaran label[for="tentang"]').html('Sekilas Tentang Bisnis');
			$('#form-pendaftaran label[for="userfiles"]').html('Logo Bisnis / Foto');
		}
		else
		{
			alert('Hello !!!');
			window.location = "<?=site_url()?>";
		}
	}

	get_regas_aggrement_text($('#regas').val());

    function countChar(val) 
    {
        var len = val.value.length;
        if (len > 250) 
        {
            val.value = val.value.substring(0, 250);
        } 
        else 
        {
            $('#charNum').text('Sisa ' + (250 - len) + ' Karakter');
        }
    };
</script>