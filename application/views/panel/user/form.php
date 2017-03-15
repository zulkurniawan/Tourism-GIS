<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">User <?=ucwords($jenis == 'index' ? 'administrator' : $jenis)?></span>
                </div>
            </div>
            <div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<a href="<?=site_url('panel/user/' . $jenis)?>" class="btn blue">
							<i class="fa fa-history"></i> Kembali
						</a>
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">
						<form class="form-horizontal" method="POST" action="<?=site_url('panel/user/submit/' . $jenis . '/' . $id)?>" enctype="multipart/form-data">
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label"><?=$jenis == 'kontributor' ? 'Nama' : ($jenis == 'partners' ? 'Nama Pemilik' : 'Nama')?> * </label>
						        <div class="col-md-6">
						            <input type="text" class="form-control" name="nama" value="<?=@$data->nama?>">
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Email</label>
						        <div class="col-md-6">
						            <input type="email" class="form-control" name="email" value="<?=@$data->email?>">
						            <!--<input type="email" class="form-control" name="email" value="<?=@$data->email?>" <?=!empty($data->email) && !empty($id) ? "readonly" : ""?>>-->
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">No Handphone</label>
						        <div class="col-md-6">
						            <input type="text" class="form-control" name="no_hp" value="<?=@$data->no_hp?>">
						            <!--<input type="text" class="form-control" name="no_hp" value="<?=@$data->no_hp?>" readonly>-->
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Password</label>
						        <div class="col-md-6">
						            <input type="password" class="form-control" name="password" value="">
									<div class="form-control-focus"> </div>
									<?php if(!empty($id)): ?>
										<span class="help-block">Kosongkan jika password tidak ingin diganti.</span>
									<?php endif; ?>
						        </div>
						    </div>
		                    <div class="form-group form-md-line-input">
		                        <label class="col-md-4 control-label">Ulangi Password</label>
		                        <div class="col-md-6">
		                            <input type="password" class="form-control" name="cpassword" value="">
		                            <div class="form-control-focus"> </div>
		                        </div>
		                    </div>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Status</label>
						        <div class="col-md-6">
						        	<?=form_dropdown('status', array('moderasi' => 'Moderasi', 'aktif' => 'Aktif', 'blokir' => 'Blokir'), @$data->status, 'class="form-control"')?>
									<div class="form-control-focus"> </div>						       
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Level</label>
						        <div class="col-md-6">
						        	<?=form_dropdown('level', $opt_level, $jenis, 'class="form-control"')?>
									<div class="form-control-focus"> </div>						       
						        </div>
						    </div>
						    
						    <!--
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Level</label>
						        <div class="col-md-6">
						        	<?=form_dropdown('level', array('administrator' => 'Administrator', 'kontributor' => 'Kontributor', 'partners' => 'Partners'), @$data->level, 'class="form-control"')?>
									<div class="form-control-focus"> </div>						       
						        </div>
						    </div>
						    -->
						    
						    <hr/>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label"><?=$jenis == 'kontributor' ? 'Komunitas / Organisasi *' : ($jenis == 'partners' ? 'Nama Bisnis *' : 'Organisasi')?></label>
						        <div class="col-md-6">
						            <input type="text" class="form-control" name="organisasi" value="<?=@$data->organisasi?>">
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label"><?=$jenis == 'kontributor' ? 'Alamat *' : ($jenis == 'partners' ? 'Alamat Usaha *' : 'Alamat')?></label>
						        <div class="col-md-6">
						            <input type="text" class="form-control" name="alamat" value="<?=@$data->alamat?>">
									<div class="form-control-focus"> </div>
						        </div>
						    </div>

		                    <div class="form-group form-md-line-input">
		                        <label class="col-md-4 control-label"><?=$jenis == 'kontributor' ? 'Sekilas' : ($jenis == 'Sekilas tentang Bisnis' ? 'Alamat Usaha' : 'Sekilas')?></label>
		                        <div class="col-md-8">
		                            <textarea class="form-control" name="tentang" rows="5" onkeyup="countChar(this)"><?=@$data->tentang?></textarea>
		                            <div class="form-control-focus"> </div>
		                            <span class="help-block" id="charNum">Sisa <?=empty($data->singkat) ? '250' : 250 - strlen($data->singkat)?> Karakter</span>
		                        </div>
		                    </div>
		                    <div class="form-group form-md-line-input">
		                        <label class="col-md-4 control-label"><?=$jenis == 'kontributor' ? 'Foto' : 'Logo / Foto'?></label>
		                        <div class="col-md-3">
		                            <?php if(!empty($data->foto)){ ?>
		                                <img src="<?=load_foto_user($data->foto)?>" class="thumbnails" width="100%"><hr/>
		                                <a href="<?=site_url('panel/user/hapus_foto/' . $jenis . '/' . $data->user_id)?>" class="btn btn-danger btn-sm btn-block">
		                                	<i class="fa fa-trash"></i> Hapus Foto
		                                </a>
		                            <?php } else { ?>
		                                <img src="<?=base_url('assets/user.png')?>" width="100%" class="thumbnails">
		                            <?php } ?>
		                        </div>
		                    </div>
		                    <div class="form-group form-md-line-input">
		                        <label class="col-md-4 control-label">Upload <?=$jenis == 'kontributor' ? 'Foto' : 'Logo / Foto'?> Baru</label>
		                        <div class="col-md-6">
		                            <input type="file" class="form-control" name="userfiles">
		                            <div class="form-control-focus"> </div>
		                        </div>
		                    </div>
						    <div class="form-group form-md-line-input">
						        <div class="col-md-offset-4 col-md-6">
						            <button type="submit" class="btn btn-success">
						            	<i class="fa fa-check"></i>&nbsp;&nbsp;Simpan
						            </button>
						            <a href="<?=site_url('panel/user/' . $jenis)?>" class="btn btn-warning">
						            	<i class="fa fa-times"></i>&nbsp;&nbsp;Batal
						            </a>
						        </div>
						    </div>
						</form>
					</div>
				</div>				
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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