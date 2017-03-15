<div class="container">
    <div class="row">
        <!--
        <div class="col-md-4">
            <div class="portlet light"  style="height: 800px; overflow-y: auto;">
                <div class="portlet-body">
                    <?php if($kontributor->status == '200'){ ?>
                        <?php foreach($kontributor->data as $key => $c): ?>
                            <div class="row">
                                <div class="col-md-12 text-center" style="margin-bottom: 10px;">
                                    <img src="<?=$c->foto?>" class="thumbnails" width="40%"><br/>
                                     <?=label_user_verified($c)?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group" style="margin-bottom: 0px;">
                                        <li class="list-group-item">
                                            Nama <span style="float:right; font-weight: bold"><?=$c->nama?></span>
                                        </li>
                                        <li class="list-group-item">
                                            Alamat <br/><span style="float:left; font-weight: bold"><?=$c->alamat?></span>
                                        </li>
                                        <li class="list-group-item">
                                            Organisasi <span style="float:right; font-weight: bold"><?=$c->organisasi?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="<?=$c->profil?>" class="btn btn-block btn-info">
                                                <i class="fa fa-user"></i>&nbsp;&nbsp;Profil
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr/>
                        <?php endforeach; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        -->
    	<div class="col-md-6 col-md-offset-3">
    		<div class="portlet light" >
                <div class="portlet-title">
                    <a data-toggle="modal" href="#bagikan_halaman" class="btn btn-sm btn-info pull-right">
                        <i class="fa fa-share"></i><span class="hidden-xs hidden-sm"> Bagikan Halaman</span>
                    </a>
                    <a href="<?=site_url()?>" class="btn btn-sm grey pull-right" style="margin-right: 5px;">
                        <i class="fa fa-home"></i><span class="hidden-xs hidden-sm"> Beranda</span>
                    </a>
                </div>
                <div class="portlet-body form">
                    <center>
                        <img src="<?=load_foto_user($data->foto)?>" width="60%" class="thumbnails"><br/>
                    </center>
                    <hr/>
                    <form>
                        <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                            <div class="form-control form-control-static">
                                <?=$data->nama?>
                            </div>
                            <label>Nama</label>
                        </div>
                        
                        <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                            <div class="form-control form-control-static">
                        	<?=date('d-m-Y H:i:s', strtotime($data->terakhir_login))?>
                            </div>
                            <label>Terakhir Login</label>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                            <div class="form-control form-control-static">
                                <?=label_user_verified($data, '-', $data->waktu_post_kode)?>
                            </div>
                            <label>Status Verifikasi</label>
                        </div>
                        <?php if(!empty($data->tentang)){ ?>
                            <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                <div class="form-control form-control-static">
                                    <?=$data->tentang?>
                                </div>
                                <label>Tentang</label>
                            </div>
                            <hr/>
                        <?php } ?>
                        <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                            <div class="form-control form-control-static"><?=empty($data->organisasi) ? ' - ' : $data->organisasi?></div>
                            <label><?=$data->level == 'Kontributor' ? 'Organisasi / Komunitas' : ($data->level == 'Partners' ? 'Nama Bisnis' : 'Organisasi / Komunitas')?></label>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                            <div class="form-control form-control-static"><?=empty($data->alamat) ? ' - ' : $data->alamat?></div>
                            <label><?=$data->level == 'Kontributor' ? 'Alamat' : ($data->level == 'Partners' ? 'Alamat Usaha' : 'Alamat')?></label>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>