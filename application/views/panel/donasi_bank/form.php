<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Master Bank</span>
                </div>
            </div>
            <div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<a href="<?=site_url('panel/donasi_bank')?>" class="btn blue">
							<i class="fa fa-history"></i> Kembali
						</a>
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">
						<form class="form-horizontal " method="POST" action="<?=site_url('panel/donasi_bank/submit/' . $id)?>" enctype="multipart/form-data">
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Nama Bank</label>
						        <div class="col-md-6">
						            <input type="text" class="form-control" name="nama" value="<?=@$data->nama?>">
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <?php if(!empty($data->gambar)){ ?>
							    <div class="form-group form-md-line-input">
							        <label class="col-md-4 control-label">Logo saat ini</label>
							        <div class="col-md-6">
							        	<img src="<?=base_url('uploads/' . $data->gambar)?>" width="200px">
							        </div>
							    </div>
						    <?php } ?>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Upload logo baru</label>
						        <div class="col-md-6">
						            <input type="file" class="form-control" name="userfile">
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <div class="col-md-offset-4 col-md-6">
						            <button type="submit" class="btn btn-success">
						            	<i class="fa fa-check"></i>&nbsp;&nbsp;Simpan
						            </button>
						            <a href="<?=site_url('panel/donasi_bank')?>" class="btn btn-warning">
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