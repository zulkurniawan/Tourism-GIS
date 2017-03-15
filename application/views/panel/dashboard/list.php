<div class="row">
	<div class="col-md-8">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Dashboard</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php if($this->login_level == 'Administrator'){ ?>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 5px;">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontributor?>"><?=@$kontributor?></span>
                                    </div>
                                    <div class="desc"> Kontributor</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/user')?>"> Lihat
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 5px;">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_objek?>"><?=@$kontribusi_objek?></span>
                                    </div>
                                    <div class="desc"> Objek Wisata</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/objek')?>"> Lihat
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption red">
                                <i class="icon-bulb"></i>
                                <span class="caption-subject bold uppercase red">Data Moderasi</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 5px;">
                                    <div class="dashboard-stat default">
                                        <div class="visual">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?=$pending_user?>"><?=@$pending_user?></span>
                                            </div>
                                            <div class="desc"> User</div>
                                        </div>
                                        <a class="more" href="<?=site_url('panel/user')?>"> Lihat
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 5px;">
                                    <div class="dashboard-stat red-pink">
                                        <div class="visual">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?=$pending_objek?>"><?=@$pending_objek?></span>
                                            </div>
                                            <div class="desc"> Objek </div>
                                        </div>
                                        <a class="more" href="<?=site_url('panel/objek?status=moderasi')?>"> Lihat
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 5px;">
                                    <div class="dashboard-stat red-pink">
                                        <div class="visual">
                                            <i class="fa fa-list"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?=$pending_artikel?>"><?=@$pending_artikel?></span>
                                            </div>
                                            <div class="desc"> Artikel </div>
                                        </div>
                                        <a class="more" href="<?=site_url('panel/artikel')?>"> Lihat
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 5px;">
                                    <div class="dashboard-stat red-pink">
                                        <div class="visual">
                                            <i class="fa fa-image"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?=$pending_foto?>"><?=@$pending_foto?></span>
                                            </div>
                                            <div class="desc"> Foto </div>
                                        </div>
                                        <a class="more" href="<?=site_url('panel/galeri')?>"> Lihat
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 5px;">
                                    <div class="dashboard-stat blue-soft">
                                        <div class="visual">
                                            <i class="fa fa-briefcase"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?=$pending_artikel?>"><?=@$pending_akomodasi?></span>
                                            </div>
                                            <div class="desc"> Akomodasi </div>
                                        </div>
                                        <a class="more" href="<?=site_url('panel/akomodasi_objek')?>"> Lihat
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 5px;">
                                    <div class="dashboard-stat blue-soft">
                                        <div class="visual">
                                            <i class="fa fa-list"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?=$pending_artikel_akomodasi?>"><?=@$pending_artikel_akomodasi?></span>
                                            </div>
                                            <div class="desc"> Artikel Akomodasi </div>
                                        </div>
                                        <a class="more" href="<?=site_url('panel/akomodasi_artikel')?>"> Lihat
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 5px;">
                                    <div class="dashboard-stat blue-soft">
                                        <div class="visual">
                                            <i class="fa fa-image"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?=$pending_foto_akomodasi?>"><?=@$pending_foto_akomodasi?></span>
                                            </div>
                                            <div class="desc"> Foto Akomodasi </div>
                                        </div>
                                        <a class="more" href="<?=site_url('panel/akomodasi_galeri')?>"> Lihat
                                            <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } elseif($this->login_level == 'Kontributor') { ?>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 5px;">
                            <div class="dashboard-stat default">
                                <div class="visual">
                                    <i class="fa fa-database"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$poin?>"><?=@$poin?></span>
                                    </div>
                                    <div class="desc"> Total Poin Reward</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/poin')?>"> Lihat
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 5px;">
                            <div class="dashboard-stat blue-sharp">
                                <div class="visual">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_objek?>"><?=@$kontribusi_objek?></span>
                                    </div>
                                    <div class="desc"> Kontribusi Objek </div>
                                </div>
                                <a class="more" href="<?=site_url('panel/objek')?>"> Lihat
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 5px;">
                            <div class="dashboard-stat blue-sharp">
                                <div class="visual">
                                    <i class="fa fa-list"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_artikel?>"><?=@$kontribusi_artikel?></span>
                                    </div>
                                    <div class="desc"> Kontribusi Artikel </div>
                                </div>
                                <a class="more" href="<?=site_url('panel/artikel')?>"> Lihat
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 5px;">
                            <div class="dashboard-stat blue-sharp">
                                <div class="visual">
                                    <i class="fa fa-image"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_foto?>"><?=@$kontribusi_foto?></span>
                                    </div>
                                    <div class="desc"> Kontribusi Foto </div>
                                </div>
                                <a class="more" href="<?=site_url('panel/galeri')?>"> Lihat
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } elseif($this->login_level == 'Partners'){ ?>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 5px;">
                            <div class="dashboard-stat blue-sharp">
                                <div class="visual">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_objek?>"><?=@$kontribusi_objek?></span>
                                    </div>
                                    <div class="desc"> Data Akomodasi </div>
                                </div>
                                <a class="more" href="<?=site_url('panel/akomodasi_objek')?>"> Lihat
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 5px;">
                            <div class="dashboard-stat blue-sharp">
                                <div class="visual">
                                    <i class="fa fa-list"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_artikel?>"><?=@$kontribusi_artikel?></span>
                                    </div>
                                    <div class="desc"> Data Artikel Akomodasi</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/akomodasi_artikel')?>"> Lihat
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 5px;">
                            <div class="dashboard-stat blue-sharp">
                                <div class="visual">
                                    <i class="fa fa-image"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_foto?>"><?=@$kontribusi_foto?></span>
                                    </div>
                                    <div class="desc"> Data Foto Akomodasi</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/akomodasi_galeri')?>"> Lihat
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
	</div>
    <div class="col-md-4">
        <?php if($this->login_level == 'Kontributor' || $this->login_level == 'Administrator'){ ?>
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list"></i>
                        <span class="caption-subject bold uppercase">Top Kontributor</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <?php foreach($kontributor_terbaik as $key => $c): ?>
                                    <tr>
                                        <td>
                                            <img src="<?=load_foto_user($c->foto)?>" class="thumbnails" width="50%">
                                        </td>
                                        <td class="col-md-6">
                                            <?=$c->nama?><br/>
                                            <?=label_user_verified($c)?>
                                        </td>
                                        <td class="col-md-3 text-center"><?=empty($c->jml_poin) ? '0' : $c->jml_poin?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <a href="<?=site_url('panel/poin/top')?>" class="btn btn-info btn-sm btn-block">
                                            Lihat Lainnya
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php } elseif($this->login_level == 'Partners'){ ?>
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list"></i>
                        <span class="caption-subject bold uppercase">Top Objek Wisata</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th class="text-center">Dilihat Sebanyak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($objek_wisata_terbaik as $key => $c): ?>
                                    <tr>
                                        <td class="col-md-6"><?=$c->nama?></td>
                                        <td class="col-md-3 text-center"><?=empty($c->jml_visitor) ? '0' : $c->jml_visitor?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                        <a href="<?=site_url('panel/statistik_objek')?>" class="btn btn-info btn-sm btn-block">
                                            Lihat Lainnya
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>