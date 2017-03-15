<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Rekening Bank</span>
                </div>
            </div>
            <div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<a href="<?=site_url('panel/donasi_rekening')?>" class="btn blue">
							<i class="fa fa-history"></i> Kembali
						</a>
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">
						<form class="form-horizontal" method="POST" action="<?=site_url('panel/donasi_rekening/submit/' . $id)?>">
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Nama Bank</label>
						        <div class="col-md-6">
						        	<?=form_dropdown('bank_id', $opt_bank, @$data->bank_id, 'class="form-control"')?>
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Nomor Rekening</label>
						        <div class="col-md-6">
						            <input type="text" class="form-control" name="nomor_rekening" value="<?=@$data->nomor_rekening?>" <?=!empty($id) && !empty($data->nomor_rekening) ? 'readonly="readonly"' : ''?>>
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Atas Nama</label>
						        <div class="col-md-6">
						            <input type="text" class="form-control" name="atas_nama" value="<?=@$data->atas_nama?>">
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <div class="col-md-offset-4 col-md-6">
						            <button type="submit" class="btn btn-success">
						            	<i class="fa fa-check"></i>&nbsp;&nbsp;Simpan
						            </button>
						            <a href="<?=site_url('panel/donasi_rekening')?>" class="btn btn-warning">
						            	<i class="fa fa-times"></i>&nbsp;&nbsp;Batal
						            </a>
						        </div>
						    </div>
						</form>
					</div>
				</div>				
            </div>
        </div>
    </div>
</div>