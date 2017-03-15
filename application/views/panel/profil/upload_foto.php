<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-upload"></i>
                    <span class="caption-subject bold uppercase">Upload <?=$data->level == 'Kontributor' ? 'Foto' : ($data->level == 'Partners' ? 'Logo' : 'Foto')?></span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" method="POST" action="<?=site_url('panel/profil/do_upload/')?>" enctype="multipart/form-data">
                    <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                        <!-- <label>Foto saat ini</label> -->
                        <center>
                            <img src="<?=load_foto_user($data->foto)?>" class="thumbnails" width="50%">
                        </center>
                        <hr/>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label">Upload <?=$data->level == 'Kontributor' ? 'Foto' : ($data->level == 'Partners' ? 'Logo' : 'Foto')?> Baru</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="userfiles">
                            <div class="form-control-focus"> </div>
                            <span>File harus berjenis JPG / PNG, Maksimal Ukuran : 2 MB</span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <div class="col-md-offset-4 col-md-6">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i>&nbsp;&nbsp;Mulai Upload
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