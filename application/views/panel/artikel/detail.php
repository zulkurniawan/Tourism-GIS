<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Baca Artikel</span>
                </div>
				<div class="actions">
				    <a class="btn blue" href="<?=site_url('panel/artikel/index/' . $uri_kategori . '/' . $uri_objek)?>">
				    	<i class="fa fa-history"></i> Kembali
				    </a>
				    <?php if($login_level == 'Administrator' || $login_uid == $data->user_id){ ?>
						<a href="<?=site_url('panel/artikel/form/' . $uri_kategori . '/' . $uri_objek . '/' . $data->artikel_id)?>" class="btn blue btn-xs" title="Perbaharui / Update">
							<i class="fa fa-edit"></i> Perbaharui
						</a>
					<?php } ?>
				    <?php if($login_level == 'Administrator'){ ?>
					    <a class="btn green" onclick="modal_set_status()">
					    	<i class="fa fa-check"></i> Moderasi Status
					    </a>
					<?php } ?>
				</div>
            </div>
            <div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet light bordered">
				            <div class="portlet-title">
				                <div class="caption">
				                    <span class="caption-subject bold uppercase"><?=$data->judul?></span>
				                </div>
				            </div>
				            <div class="portlet-body">
								<?php if(!empty($data->moderasi_keterangan)){ ?>
									<div class="row">
										<div class="col-md-12">
											<div class="note note-warning">
												<h5>Pesan Moderasi Oleh <?=$data->nama_moderator?> pada <?=date('H:i:s d-m-Y', strtotime($data->moderasi_waktu))?></h5>
												<p><?=$data->moderasi_keterangan?></p>
											</div>
										</div>
									</div>
								<?php } ?>
				            	<div class="row">
				            		<div class="col-md-5">
					            		<?php if(!empty($data->foto)){ ?>
					            			<img src="<?=base_url('uploads/' . $data->foto)?>" class="thumbnails" width="100%">
					            		<?php } ?>
				            		</div>
				            		<div class="col-md-7">
						            	<div class="well well-lg">
		                                    <h4 style="line-height: 2; font-style: italic"><?=$data->singkat?></h4>
		                                </div>
				            		</div>
				            	</div>
				            	<div class="row">
				            		<div class="col-md-12">
				            			<?=$data->isi?>
				            		</div>
				            	</div>
				            	<hr/>
				            	<div class="row">
				            		<div class="col-md-12">
										<ul class="list-group">
	                                        <li class="list-group-item"> Kontributor
	                                            <span class="badge badge-info"> <?=$data->nama_kontributor?> </span>
	                                        </li>
	                                        <li class="list-group-item"> Objek Wisata
	                                            <span class="badge badge-info"> <?=$data->nama_objek_wisata?> </span>
	                                        </li>
	                                        <li class="list-group-item"> Status Artikel
	                                            <span class="badge badge-info"> <?=$data->status?> </span>
	                                        </li>
	                                        <li class="list-group-item"> Tanggal Posting
	                                            <span class="badge badge-info"> <?=date('H:i:s Y-m-d', strtotime($data->tgl_posting))?> </span>
	                                        </li>
	                                        <?php if(!empty($data->terakhir_update)){ ?>
		                                        <li class="list-group-item"> Terakhir Update
	                                     	       <span class="badge badge-info"> <?=date('H:i:s Y-m-d', strtotime($data->terakhir_update))?> </span>
		                                        </li>
	                                        <?php } ?>
	                                    </ul>				            			
				            		</div>
				            	</div>
				            </div>
				        </div>
				    </div>
                </div>            
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-status" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form class="form-horizontal" action="<?=site_url('panel/artikel/set_status/' . $uri_kategori . '/' . $uri_objek . '/' . $data->artikel_id)?>" method="POST">
	            <div class="modal-header">
	                <h4 class="modal-title"><i class="icon-check"></i>&nbsp;&nbsp;&nbsp;Moderasi Status</h4>
	            </div>
	            <div class="modal-body">             
					<div class="form-group form-md-line-input">
                        <label class="col-md-3 control-label" style="text-align: left;">Status</label>
                        <div class="col-md-6">
		                    <?=form_dropdown('status', array('Publish' => 'Publish', 'Moderasi' => 'Moderasi', 'Draft' => 'Draft'), $data->status, 'class="form-control" id="status" onchange="set_field(this.value)"')?>
							<div class="form-control-focus"> </div>
                        </div>
                    </div>
					<div class="form-group form-md-line-input" id="input-poin">
                        <label class="col-md-3 control-label" style="text-align: left;">Poin</label>
                        <div class="col-md-6">
				            <input type="number" class="form-control" name="poin">
							<div class="form-control-focus"> </div>
                        </div>
                    </div>
					<div class="form-group form-md-line-input">
                        <label class="col-md-8 control-label" style="text-align: left;">Berikan Keterangan / Penjelasan, contoh : Data tidak valid</label>
                    </div>
					<div class="form-group form-md-line-input">
						<div class="col-md-12">
							<textarea class="form-control" name="keterangan" rows="5"></textarea>
						</div>
                    </div>
          	    </div>
	            <div class="modal-footer">
	                <button type="submit" class="btn blue">
	                	<i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Submit
	                </button>
	                <button type="button" class="btn dark btn-outline" data-dismiss="modal">
	                	<i class="fa fa-cross"></i>&nbsp;&nbsp;&nbsp;Batal
	                </button>
	            </div>
	        </form>
        </div>
    </div>
</div>
<script>
	function modal_set_status()
	{
		$('#modal-status').modal();
		set_field($('#status').val());
	}

	function set_field(val)
	{
		if(val == 'Publish')
		{
			$('#input-poin').removeAttr('style');
		}
		else
		{
			$('#input-poin').attr({'style' : 'display:none'});			
		}
	}
</script>