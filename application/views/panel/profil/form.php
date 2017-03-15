<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-users"></i>
                    <span class="caption-subject bold uppercase">Profil</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" method="POST" action="<?=site_url('panel/profil/submit/')?>" enctype="multipart/form-data">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label"><?=$this->login_level == 'Kontributor' ? 'Nama' : ($data->level == 'Partners' ? 'Nama Pemilik' : 'Nama')?> * </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nama" value="<?=@$data->nama?>">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="<?=@$data->email?>" <?=!empty($data->email) ? "readonly" : ""?>>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label">No Handphone</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="no_hp" value="<?=@$data->no_hp?>" <?=!empty($data->no_hp) ? 'readonly' : ''?>>
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" value="">
                            <div class="form-control-focus"> </div>
                            <span class="help-block">Kosongkan jika password tidak ingin diganti.</span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label">Ulangi Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="cpassword" value="">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label"><?=$this->login_level == 'Kontributor' ? 'Komunitas / Organisasi *' : ($data->level == 'Partners *' ? 'Nama Bisnis' : 'Komunitas / Organisasi')?></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="organisasi" value="<?=@$data->organisasi?>">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label"><?=$this->login_level == 'Kontributor' ? 'Alamat *' : ($data->level == 'Partners' ? 'Alamat Usaha *' : 'Alamat')?></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="alamat" value="<?=@$data->alamat?>">
                            <div class="form-control-focus"> </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label"><?=$this->login_level == 'Kontributor' ? 'Sekilas Tentang Anda' : 'Sekilas Tentang Bisnis Anda'?></label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="tentang" rows="5" onkeyup="countChar(this)"><?=@$data->tentang?></textarea>
                            <div class="form-control-focus"> </div>
                            <span class="help-block" id="charNum">Sisa <?=empty($data->singkat) ? '250' : 250 - strlen($data->singkat)?> Karakter</span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-md-offset-4 col-md-6">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i>&nbsp;&nbsp;Simpan
                            </button>
                            <a href="<?=site_url('panel/profil')?>" class="btn btn-warning">
                                <i class="fa fa-times"></i>&nbsp;&nbsp;Batal
                            </a>
                        </div>
                    </div>
                </form>
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