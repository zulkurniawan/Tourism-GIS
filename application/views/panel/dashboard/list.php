<div class="row">
	<div class="col-md-9">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase"> Control Panel</span>
                </div>
            </div>
            <div class="portlet-body">
                <?php if($this->login_level == 'Administrator'){ ?>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 5px;">
                            <div class="dashboard-stat green">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontributor?>"><?=@$kontributor?></span>
                                    </div>
                                    <div class="desc"> User</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/user/kontributor')?>"> Kontributor & Partner
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
                                    <div class="desc"> Objek</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/objek')?>"> Objek Wisata & Akomodasinya
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
                                <div class="col-md-12" style="margin-bottom: 5px;">
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
                            </div>
                            <div class="row">
                                <div class="col-md-4" style="margin-bottom: 5px;">
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
                                <div class="col-md-4" style="margin-bottom: 5px;">
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
                            
                                <div class="col-md-4" style="margin-bottom: 5px;">
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
                                <div class="col-md-4" style="margin-bottom: 5px;">
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
                                <div class="col-md-4" style="margin-bottom: 5px;">
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
                            
                                <div class="col-md-4" style="margin-bottom: 5px;">
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
                    <div class="col-md-3" style="margin-bottom: 5px;">
                            <div class="dashboard-stat yellow-casablanca">
                                <div class="visual">
                                    <i class="fa fa-camera"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_foto?>"><?=@$kontribusi_foto?></span>
                                    </div>
                                    <div class="desc"> Foto </div>
                                </div>
                                <a class="more" href="<?=site_url('panel/galeri')?>"> Upload Foto
                                    <i class="m-icon-big-swapup m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-bottom: 5px;">
                            <div class="dashboard-stat red-sunglo">
                                <div class="visual">
                                    <i class="fa fa-pencil-square-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_artikel?>"><?=@$kontribusi_artikel?></span>
                                    </div>
                                    <div class="desc"> Artikel </div>
                                </div>
                                <a class="more" href="<?=site_url('panel/artikel')?>"> Tulis Artikel
                                    <i class="m-icon-big-swapup m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-bottom: 5px;">
                            <div class="dashboard-stat green-meadow">
                                <div class="visual">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_objek?>"><?=@$kontribusi_objek?></span>
                                    </div>
                                    <div class="desc"> Info Lokasi Wisata</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/objek')?>"> Tambah / Edit
                                    <i class="m-icon-big-swapup m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-bottom: 5px;">
                            <div class="dashboard-stat default">
                                <div class="visual">
                                    <i class="fa fa-thumbs-up"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$poin?>"><?=@$poin?></span>
                                    </div>
                                    <div class="desc"> Poin Kamu</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/poin/top')?>"> Lihat Poin Teratas
                                    <i class="m-icon-big-swapup m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    <!--    <div class="col-md-3" style="margin-bottom: 5px;">
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
                        </div> -->
                    </div>
                <?php } elseif($this->login_level == 'Partners'){ ?>
                    <div class="row">
                        <div class="col-md-3" style="margin-bottom: 5px;">
                            <div class="dashboard-stat yellow-casablanca">
                                <div class="visual">
                                    <i class="fa fa-camera"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_foto?>"><?=@$kontribusi_foto?></span>
                                    </div>
                                    <div class="desc"> Foto Produk</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/akomodasi_galeri')?>"> Upload Foto Produk Anda
                                    <i class="m-icon-big-swapup m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-bottom: 5px;">
                            <div class="dashboard-stat blue-sharp">
                                <div class="visual">
                                    <i class="fa fa-gift"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_objek?>"><?=@$kontribusi_objek?></span>
                                    </div>
                                    <div class="desc"> Informasi Bisnis </div>
                                </div>
                                <a class="more" href="<?=site_url('panel/akomodasi_objek')?>"> Promosikan Produk Anda
                                    <i class="m-icon-big-swapup m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-bottom: 5px;">
                            <div class="dashboard-stat red-sunglo">
                                <div class="visual">
                                    <i class="fa fa-pencil-square-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$kontribusi_artikel?>"><?=@$kontribusi_artikel?></span>
                                    </div>
                                    <div class="desc"> Artikel Produk</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/akomodasi_artikel')?>"> Tulis Artikel Tentang Produk
                                    <i class="m-icon-big-swapup m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
	</div>
    <div class="caption">
        <?php if($this->login_level == 'Kontributor'){ ?>
            <div class="col-md-9">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-list"></i>
                            <span class="caption-subject bold uppercase">Poin Terbanyak Saat ini</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <?php foreach($kontributor_terbaik as $key => $c): ?>
                                        <tr>
                                        <!--<td class="col-md-3">
                                                <img src="<?=load_foto_user($c->foto)?>" class="thumbnails" width="60%">
                                            </td> -->
                                            <td class="col-md-3">
                                                <?=$c->nama?><br/>
                                                <b><?=empty($c->jml_poin) ? '0' : $c->jml_poin?> Poin</b>
                                            </td>
                                            <td class="col-md-2">
                                                <?=label_user_verified($c)?>
                                            </td>
                                        <!--<td class="col-md-3 text"><?=empty($c->jml_poin) ? '0' : $c->jml_poin?></td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <a href="<?=site_url('panel/poin/top')?>" class="btn btn-info btn-sm btn-block">
                                                Lihat Kontributor Lainnya
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif($this->login_level == 'Partners'){ ?>
            <div class="col-md-9">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-list"></i>
                            <span class="caption-subject bold uppercase"> Lokasi Wisata Terpopuler</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Lokasi Wisata</th>
                                        <th class="text-center">Viewer</th>
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
                                                Lihat Lokasi Lainnya
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>    
        <?php } ?>
    </div>
</div>