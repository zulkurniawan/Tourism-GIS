<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Akomodasi</span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="row">         			
                    <div class="col-md-3">
	                    <a href="<?=site_url('panel/akomodasi_objek/form')?>" class="btn green btn-sm btn-block">
	                        <i class="fa fa-plus hidden-xs "></i> Tambah Data
	                    </a>
		                <hr class="hidden-md hidden-lg">
                    </div>
            		<div class="col-md-9">
            			<h4>Cari Data</h4>
		           		<form method="GET" action="<?=site_url('panel/akomodasi_objek')?>">
		           			<div class="row">
		           				<div class="col-md-4" style="margin-bottom: 10px;">
			                        <?=form_dropdown('kategori', $opt_kategori, $kategori, 'class="form-control"')?>
			                  	</div>
		           				<div class="col-md-3" style="margin-bottom: 10px;">
			                        <?=form_dropdown('status', array('' => 'Semua Status', 'Publish' => 'Publish', 'Moderasi' => 'Moderasi', 'Draft' => 'Draft'), $status, 'class="form-control"')?>
			                  	</div>
			                  	<div class="col-md-5" style="margin-bottom: 10px;">
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
								<th class="text-center"></th>
								<th class="col-md-3">Nama</th>
								<th class="col-md-3">Kategori</th>
								<th class="col-md-2">Terakhir Update</th>
								<th class="col-md-2">Tgl Kadaluarsa</th>
								<th class="col-md-1">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $key => $c): ?>
								<tr>
									<td class="text-center">
										<div class="btn-group btn-group-justified" style="width:100px">
											<a href="<?=site_url('panel/akomodasi_objek/detail/' . $c->objek_id)?>" class="btn grey btn-xs" title="Lihat Objek">
												<i class="fa fa-list"></i>
											</a>
											<?php if($c->status != 'Moderasi'){ ?>
												<a href="<?=site_url('panel/akomodasi_objek/form/' . $c->objek_id)?>" class="btn blue btn-xs" title="Perbaharui / Update">
													<i class="fa fa-edit"></i>
												</a>
											<?php } ?>
											<?php if($login_level == 'Administrator'){ ?> 
												<a onclick="confirm_hapus('<?=$c->objek_id?>')" class="btn red btn-xs" title="Hapus">
													<i class="fa fa-trash"></i>
												</a>
											<?php } ?>
                                        </div>
									</td>	
									<td><?=$c->nama?><br><small>Oleh <?=$c->nama_kontributor?></small></td>	
									<td><?=$c->nama_kategori?></td>	
									<td><?=date('H:i:s d-m-Y', strtotime($c->terakhir_update))?></td>	
									<td><?=empty($c->akomodasi_maks_waktu_tayang) ? 'Tak Terbatas' : date('H:i:00 d-m-Y', strtotime($c->akomodasi_maks_waktu_tayang))?></td>	
									<td>
										<a href="<?=site_url('panel/akomodasi_objek/detail/' . $c->objek_id)?>" class="btn green btn-xs" title="Silahkan Periksa terlebih dahulu sebelum mengganti status">
											<?=$c->status?>
										</a>
									</td>	
								</tr>
								<?php if(!empty($c->moderasi_keterangan) && ($c->status == 'Moderasi' || $c->status == 'Draft')){ ?>
									<tr>
										<td></td>
										<td>
											<i class="fa fa-caret-right"></i>&nbsp;&nbsp;Pesan Moderasi
										</td>
										<td colspan="4">
											<div class="note note-warning">
												<h5>Oleh <?=$c->nama_moderator?> pada <?=$c->moderasi_waktu?></h5>
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
            	<a href="<?=site_url('panel/akomodasi_objek')?>" id="btn-yes" class="btn red">
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
		$('#modal-hapus #btn-yes').attr({'href' : '<?=site_url('panel/akomodasi_objek/hapus')?>/' + id});
		$('#modal-hapus').modal();
	}
</script>