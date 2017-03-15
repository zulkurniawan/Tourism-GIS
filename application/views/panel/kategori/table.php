<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Kategori Objek Wisata</span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="row">         			
                    <div class="col-md-9">
	                    <a href="<?=site_url('panel/kategori/form')?>" class="btn green">
	                        <i class="fa fa-plus hidden-xs"></i> Tambah 
	                    </a>
	                    <hr class="hidden-lg hidden-md">
                    </div>
                    <hr class="hidden-lg hidden-md">
            		<div class="col-md-3">
            			<h4>Cari Data</h4>
		           		<form method="GET" action="<?=site_url('panel/kategori')?>">
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
								<th class="col-md-1 text-center">Marker</th>
								<th class="">Nama Kategori</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $key => $c): ?>
								<tr>
									<td class="text-center">
										<a href="<?=site_url('panel/kategori/form/' . $c->kategori_id)?>" class="btn blue btn-xs" title="Perbaharui / Update">
											<i class="fa fa-edit"></i>
										</a>
										<a onclick="confirm_hapus('<?=$c->kategori_id?>')" class="btn red btn-xs" title="Hapus">
											<i class="fa fa-trash"></i>
										</a>
									</td>	
									<td class="text-center">
										<?php if(!empty($c->marker_path)){ ?>
								        	<img src="<?=base_url('uploads/' . $c->marker_path)?>">
										<?php } ?>
									</td>	
									<td><?=$c->nama_kategori?></td>	
								</tr>
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
            	<a href="<?=site_url('panel/kategori')?>" id="btn-yes" class="btn red">
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
		$('#modal-hapus #btn-yes').attr({'href' : '<?=site_url('panel/kategori/hapus')?>/' + id});
		$('#modal-hapus').modal();
	}
</script>