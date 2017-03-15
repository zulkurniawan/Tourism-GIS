<div class="portlet light widget_info portlet_objek_wisata hidden-xs hidden-sm" style="padding: 5px 5px 3px !important">
    <div class="portlet-body">
        <div class="btn-group btn-group-justified">
            <a href="#modal-info-kontributor" class="btn btn-sm" role="button" data-toggle="modal">
                <i class="fa fa-user"></i>&nbsp;&nbsp;Kontributor 
            </a>
            <a href="http://lewatlawet.com/" class="btn btn-sm" target="_blank"> 
                <i class="fa fa-gift"></i>&nbsp;&nbsp;Merchandise 
            </a>
        </div>        
        <div class="btn-group btn-group-justified">
            <a href="#modal-info-tentang" class="btn btn-sm" role="button" data-toggle="modal">
                <i class="fa fa-building"></i>&nbsp;&nbsp;Tentang 
            </a>
            <a href="#modal-info-hubungi" class="btn btn-sm" role="button" data-toggle="modal">
                <i class="fa fa-phone-square"></i>&nbsp;&nbsp;Hubungi 
            </a>
        </div>        
    </div>
</div>

<!-- Kontributor -->
<div class="modal fade" id="modal-info-kontributor" tabindex="-1" role="basic" aria-hidden="true" style="margin-bottom: 40px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> 
                <div class="text-right pull-right hidden-lg hidden-md">
                    <button type="button" class="btn btn-info" data-dismiss="modal" onclick="manual_show_modal_bagikan_halaman('<?=site_url('kontributor')?>');">
                        <i class="fa fa-share"></i>
                    </button>
                    <button type="button" class="btn default" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <h4 class="modal-title">
                    <span class="hidden-xs hidden-sm">
                        <i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;Kontributor
                    </span>&nbsp;
                </h4>
            </div>
            <div class="modal-body" style="height: 350px; overflow-y: auto;">
                <?php if($kontributor->status == '200'){ ?>
                    <?php foreach($kontributor->data as $key => $c): ?>
                        <div class="row">
                            <div class="col-md-4 text-center" style="margin-bottom: 10px;">
                                <img src="<?=$c->foto?>" class="thumbnails" width="60%">
                                 <?=label_user_verified($c)?>
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group" style="margin-bottom: 0px;">
                                    <li class="list-group-item">
                                        Nama <span style="float:right; font-weight: bold"><?=$c->nama?></span>
                                    </li>
                                    <li class="list-group-item">
                                        Alamat <br/><span style="float:right; font-weight: bold"><?=$c->alamat?></span>
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
                <?php } else { ?>
                    <?=war_msg('Data Kontributor tidak ada')?>
                <?php } ?>
            </div>
            <div class="modal-footer hidden-sm hidden-xs">
                <button type="button" class="btn btn-info" data-dismiss="modal" onclick="manual_show_modal_bagikan_halaman('<?=site_url('kontributor')?>');">
                    <i class="fa fa-share"></i><span class="hidden-xs hidden-sm">&nbsp;Bagikan</span>
                </button>
                <button type="button" class="btn default" data-dismiss="modal">
                    <i class="fa fa-times"></i><span class="hidden-xs hidden-sm">&nbsp;Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Of Kontributor -->

<!-- Hubungi -->
<div class="modal fade" id="modal-info-hubungi" tabindex="-1" role="basic" aria-hidden="true" style="margin-bottom: 40px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-right pull-right hidden-lg hidden-md">
                    <button type="button" class="btn btn-info" data-dismiss="modal" onclick="manual_show_modal_bagikan_halaman('<?=site_url('hubungi')?>');">
                        <i class="fa fa-share"></i>
                    </button>
                    <button type="button" class="btn default" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <h4 class="modal-title">
                    <span class="hidden-sm hidden-xs">
                        <i class="fa fa-phone-square"></i>&nbsp;&nbsp;&nbsp;Hubungi
                    </span>&nbsp;
                </h4>
            </div>
            <div class="modal-body" style="height: 350px; overflow-y: auto;">
                <p><?=$this->config->item('halaman_kontak')?></p>
                <!--<h4><strong>Kami menerima donasi melalui : </strong></h4><hr/>
                <div class="row">
                    <?php foreach($donasi->data as $key => $c): ?>
                        <div class="col-md-6">
                            <img src="<?=$c->gambar?>" style="width: 100px;">
                            <p style="margin: 7px 0px;">
                                Bank : <strong><?=$c->nama_bank?></strong><br/>
                                Nomor Rekening : <strong><?=$c->nomor_rekening?></strong><br/>
                                Atas Nama : <strong><?=$c->atas_nama?></strong><br/>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>-->
            </div>
            <div class="modal-footer hidden-sm hidden-xs">
                <button type="button" class="btn btn-info" data-dismiss="modal" onclick="manual_show_modal_bagikan_halaman('<?=site_url('hubungi')?>');">
                    <i class="fa fa-share"></i><span class="hidden-sm hidden-xs">&nbsp;Bagikan</span>
                </button>
                <button type="button" class="btn default" data-dismiss="modal">
                    <i class="fa fa-times"></i><span class="hidden-sm hidden-xs">&nbsp;Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Of Hubungi -->

<!-- Tentang -->
<div class="modal fade" id="modal-info-tentang" tabindex="-1" role="basic" aria-hidden="true" style="margin-bottom: 40px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-right pull-right hidden-lg hidden-md">
                    <button type="button" class="btn btn-info" data-dismiss="modal" onclick="manual_show_modal_bagikan_halaman('<?=site_url('tentang')?>');">
                        <i class="fa fa-share"></i>
                    </button>
                    <button type="button" class="btn default" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <h4 class="modal-title">
                    <span class="hidden-sm hidden-xs">
                        <i class="fa fa-building"></i>&nbsp;&nbsp;&nbsp;Tentang
                    </span>&nbsp;
                </h4>
            </div>
            <div class="modal-body" style="height: 350px; overflow-y: auto;">
                <p><?=$this->config->item('halaman_tentang')?></p>
            </div>
            <div class="modal-footer hidden-xs hidden-sm">
                <button type="button" class="btn btn-info" data-dismiss="modal" onclick="manual_show_modal_bagikan_halaman('<?=site_url('tentang')?>');">
                    <i class="fa fa-share"></i><span class="hidden-sm hidden-xs">Bagikan</span>
                </button>
                <button type="button" class="btn default" data-dismiss="modal">
                    <i class="fa fa-times"></i><span class="hidden-sm hidden-xs">Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Of Tentang -->