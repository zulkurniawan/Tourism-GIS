<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">User Manajemen</span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="row">         			
                    <div class="col-md-9">
	                    <a href="<?=site_url('panel/user/form/' . $jenis)?>" class="btn green">
	                        <i class="fa fa-plus hidden-xs"></i> Tambah 
	                    </a>
                    </div>
                    <hr class="hidden-lg hidden-md">
            		<div class="col-md-3">
            			<h4>Cari Data</h4>
		           		<form method="GET" action="<?=site_url('panel/user/' . $jenis)?>">
	                        <div class="input-group">
	                            <input type="text" class="form-control input" placeholder="" name="q" value="<?=$keyword?>">
	                            <span class="input-group-btn">
	                                <button class="btn green" type="submit">Cari !</button>
	                            </span>
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
								<th class=""></th>
								<!-- <th class="">Nama</th> -->
								<th class="">Nama</th>
								<th class="text-center">Level</th>
								<th class="text-center">Status</th>
								<th class="text-center">Terakhir Login</th>
								<th class="text-center">Tgl Daftar</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $key => $c): ?>
								<tr>
									<td class="text-center">
										<?php if($c->level == 'Kontributor'){ ?>
											<a href="<?=site_url('panel/poin/log_detail/' . $c->user_id)?>" class="btn default btn-xs" title="Detail">
												<i class="fa fa-pie-chart"></i>
											</a>
										<?php } ?>
										<a href="<?=site_url('panel/user/form/' . $jenis . '/' . $c->user_id)?>" class="btn blue btn-xs" title="Perbaharui / Update">
											<i class="fa fa-edit"></i>
										</a>
										<?php if($c->user_id != $login_uid){ ?>
											<a onclick="confirm_hapus('<?=$c->user_id?>')" class="btn red btn-xs" title="Hapus">
												<i class="fa fa-trash"></i>
											</a>
										<?php } ?>
									</td>	
									<td>
		                                <img src="<?=load_foto_user($c->foto)?>" class="thumbnails" width="50px">
									</td>	
									<!-- <td><?=$c->nama?></td>	 -->
									<td>
										<strong><?=$c->nama?></strong><br/>
										<?=$c->email?><br/>										
										<?=label_user_verified($c, '', $c->waktu_req_kode)?>
									</td>	
									<td class="text-center"><?=$c->level?></td>	
									<td class="text-center">
										<a href="<?=site_url('panel/user/form/' . $jenis . '/'. $c->user_id)?>" class="btn btn-xs blue">
											<?=ucfirst($c->status)?>
										</a>
									</td>	
									<td class="text-center"><?=!empty($c->terakhir_login) ? date("H:i:s d-m-Y", strtotime($c->terakhir_login)) : ' - '?></td>	
									<td class="text-center"><?=!empty($c->tgl_daftar) ? date("H:i:s d-m-Y", strtotime($c->tgl_daftar)) : ' - '?></td>	
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<?=$pagination?>
				<div class="note note-info">
                    <h4 class="block">Keterangan</h4>
                    <ul>
                    	<li>
                    		Informasi Tombol
                    		<ul>
	                        	<li><a class="btn default btn-xs"><i class="fa fa-pie-chart"></i></a> : Klik untuk melihat poin user</li>
								<li><a class="btn blue btn-xs"><i class="fa fa-edit"></i></a> : Klik untuk memperbaharui data user</li>
								<li><a class="btn red btn-xs"><i class="fa fa-trash"></i></a> : Klik untuk menghapus user</li>
                    		</ul>
                    	</li>
                    </ul>
                </div>
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
            	<a href="<?=site_url('panel/user')?>" id="btn-yes" class="btn red">
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
		$('#modal-hapus #btn-yes').attr({'href' : '<?=site_url('panel/user/hapus/' . $jenis)?>/' + id});
		$('#modal-hapus').modal();
	}
</script>