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
    	<div class="col-md-10 col-md-offset-1">
            <div class="portlet-title"><br/>
            <!--<a href="<?=site_url()?>" class="btn btn-sm grey" style="margin-right: 5px;margin-bottom: 10px;margin-top: 20px;">
                <i class="fa fa-home"></i><span class="hidden-xs hidden-sm"> Beranda</span>
            </a>
            <a data-toggle="modal" href="#bagikan_halaman" class="btn btn-sm btn-info" style="margin-left: 5px;margin-bottom: 10px;margin-top: 20px;">
                <i class="fa fa-share-alt"></i><span class="hidden-xs hidden-sm"> Bagikan Profil</span>
            </a>-->
	    <a href="<?=site_url()?>" class="btn btn-sm grey">
	    	<i class="fa fa-home"></i> Beranda
	    </a>
            <a data-toggle="modal" href="#bagikan_halaman" class="btn btn-sm btn-info pull-right">
	    	<i class="fa fa-share-alt"></i> Bagikan
	    </a><hr/>
		<div class="caption" style="margin-bottom: 20px;">
	            <i class="fa fa-user"></i>
	            <span class="caption-subject bold ">&nbsp;&nbsp;Profil Kontributor</span>
	        </div>
            </div>
            <div class="portlet light card-new">
                <div class="portlet-body form">
                    <div class="row--flex">
                        <div class="col-md-6 no-padding">
                            <div class="crop">
                                <img src="<?=load_foto_user($data->foto)?>" width="40%" class="thumbnails">
                            </div>
                        </div>
                        <div class="col-md-6">
                                <form>
                                    <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                        <div class="form-control form-control-static">
                                            <h3 style="margin-top: 0;"><?=$data->nama?></h3>
                                        </div>
                                        <label>Nama</label>
                                    </div>
                                    
                                    <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                        <div class="form-control form-control-static verifikasi-label">
                                            <?=label_user_verified($data)?>
                                            <!--<?=label_user_verified($data, '-', $data->waktu_post_kode)?>-->
                                        </div>
                                        <label>Identitas</label>
                                    </div>
                                  
                                    <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                        <div class="form-control form-control-static"><?=empty($data->organisasi) ? ' - ' : $data->organisasi?></div>
                                        <label><?=$data->level == 'Kontributor' ? 'Organisasi / Komunitas' : ($data->level == 'Partners' ? 'Nama Bisnis' : 'Organisasi / Komunitas')?></label>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                        <div class="form-control form-control-static"><?=empty($data->alamat) ? ' - ' : $data->alamat?></div>
                                        <label><?=$data->level == 'Kontributor' ? 'Alamat' : ($data->level == 'Partners' ? 'Alamat Usaha' : 'Alamat')?></label>
                                    </div>

                                    <div class="form-group last-login form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                        <div class="form-control form-control-static">
                                        <?=date('d-m-Y H:i:s', strtotime($data->terakhir_login))?>
                                        </div>
                                        <label>Terakhir Login</label>
                                    </div>
                                      <?php if(!empty($data->tentang)){ ?>
                                        <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                            <div class="form-control form-control-static">
                                                <?=$data->tentang?>
                                            </div>
                                            <label>Tentang</label>
                                        </div>
                                      <?php } ?>
                                    <!--<hr>
                                     <a data-toggle="modal" href="#bagikan_halaman" class="btn btn-sm btn-info">
                                        <i class="fa fa-share"></i><span class="hidden-xs hidden-sm"> Bagikan Profil</span>
                                    </a>-->
                                   
                                </form>
                        </div>
                    </div>
                    <!-- <hr/> -->
                </div>
            </div>
        </div>
    </div>
<!--<div class="row">
        <div class="col-md-12">
          <h2 class="header-new">Kontributor Lainnya</h2>
            <div class="owl-carousel owl-theme show-kontributor">
                    <?php if($kontributor->status == '200'){ ?>
                        <?php foreach($kontributor->data as $key => $c): ?>
                            <div class="item item__kontributor">
                                <a class="link-wrapper" href="<?=$c->profil?>">
                                    <div class="wrapper">
                                        <div class="image">
                                            <img src="<?=$c->foto?>" class="thumbnails" width="60%">
                                        </div>    
                                    </div>
                                    <h4 class="name__item"><?=$c-> nama?></h4>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <?=war_msg('Data Kontributor sedang diperbarui')?>
                    <?php } ?>
            </div>
        </div>
    </div>-->
</div>