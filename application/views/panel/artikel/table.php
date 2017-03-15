<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Artikel Objek Wisata : <?=$nama_objek?></span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="row">         			
                    <div class="col-md-6">
	                    <a href="<?=site_url('panel/artikel/index/' . $uri_kategori)?>" class="btn blue">
	                        <i class="fa fa-history hidden-xs"></i> Kembali 
	                    </a>
	                    <a href="<?=site_url('panel/artikel/form/' . $uri_kategori . '/' . $uri_objek)?>" class="btn green">
	                        <i class="fa fa-plus hidden-xs"></i> Tambah 
	                    </a>
                    </div>
                    <hr class="hidden-md hidden-lg">
            		<div class="col-md-6">
            			<h4>Cari Data</h4>
		           		<form method="GET" action="<?=site_url('panel/artikel/index/' . $uri_kategori . '/' . $uri_objek)?>">
		           			<div class="row">
		           				<div class="col-md-6 col-xs-12" style="margin-bottom: 10px;">
			                        <?=form_dropdown('status', array('' => 'Semua Status', 'Publish' => 'Publish', 'Moderasi' => 'Moderasi', 'Draft' => 'Draft'), $status, 'class="form-control"')?>
			                  	</div>
			                  	<div class="col-md-6 col-xs-12" style="margin-bottom: 10px;">
			                        <div class="input-group">
			                            <input type="text" class="form-control input" placeholder="" name="q" value="<?=$keyword?>">
			                            <span class="input-group-btn">
			                                <button class="btn green" type="submit">Cari !</button>
			                            </span>
			                        </div>
			                    </div>
			                </div>
		           		</form>
                    </div>
                </div>
                <hr/>
                <div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="col-md-2 text-center"></th>
								<th class="col-md-3">Judul</th>
								<th class="col-md-2">Tgl Posting</th>
								<th class="col-md-2">Tgl Update</th>
								<th class="col-md-1">Status</th>
								<th class="">Kontributor</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $key => $c): ?>
								<tr>
									<td class="text-center">
										<a href="<?=site_url('panel/artikel/detail/' . $uri_kategori . '/' . $uri_objek . '/' . $c->artikel_id)?>" class="btn grey btn-xs" title="Lihat Artikel">
											<i class="fa fa-list"></i>
										</a>
										<?php if($login_level == 'Administrator' || $login_uid == $c->user_id){ ?> 
											<a href="<?=site_url('panel/artikel/form/' . $uri_kategori . '/' . $uri_objek . '/' . $c->artikel_id)?>" class="btn blue btn-xs" title="Perbaharui / Update">
												<i class="fa fa-edit"></i>
											</a>
											<a onclick="confirm_hapus('<?=$c->artikel_id?>')" class="btn red btn-xs" title="Hapus">
												<i class="fa fa-trash"></i>
											</a>
										<?php } ?>
									</td>	
									<td><?=$c->judul?></td>	
									<!-- <td><?=empty($c->foto) ? '<img src="' . base_url('assets/uploads/default.png') . '" class="thumbnail" width="100%">' : '<img src="' . base_url('uploads/' . $c->foto) . '" class="thumbnail" width="100%">'?></td>	 -->
									<td><?=date('d-m-Y H:i:s', strtotime($c->tgl_posting))?></td>	
									<td><?=empty($c->terakhir_update) ? ' - ' : date('d-m-Y H:i:s', strtotime($c->terakhir_update))?></td>	
									<td>
										<a href="<?=site_url('panel/artikel/detail/' . $uri_kategori . '/' . $uri_objek . '/' . $c->artikel_id)?>" class="btn green btn-xs" title="Silahkan Periksa terlebih dahulu sebelum mengganti status">
											<?=$c->status?>
										</a>
									</td>	
									<td><?=$c->nama_kontributor?></td>	
								</tr>
								<?php if(!empty($c->moderasi_keterangan)){ ?>
									<tr>
										<td></td>
										<td>
											<i class="fa fa-caret-right"></i>&nbsp;&nbsp;Pesan Moderasi
										</td>
										<td colspan="4">
											<div class="note note-warning">
												<h5>Oleh <?=$c->nama_moderator?> pada <?=date('H:i:s d-m-Y', strtotime($c->moderasi_waktu))?></h5>
												<p><?=$c->moderasi_keterangan?></p>
											</div>
										</td>
									</tr>
								<?php } ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<?=$pagination?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-hapus">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                	<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Hapus Data
                </h4>
            </div>
            <div class="modal-body">
            	<h4>Apakah Anda yakin ? </h4>
            </div>
            <div class="modal-footer">
            	<a href="<?=site_url('panel/artikel')?>" id="btn-yes" class="btn red">
            		<i class="fa fa-check"></i> Ya, Saya Yakin
            	</a>
                <button type="button" class="btn grey" data-dismiss="modal">
                	<i class="fa fa-times"></i> Tidak
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function confirm_hapus(id)
	{
		$('#modal-hapus #btn-yes').attr({'href' : '<?=site_url('panel/artikel/hapus/' . $uri_kategori . '/' . $uri_objek)?>/' + id});
		$('#modal-hapus').modal();
	}
</script>