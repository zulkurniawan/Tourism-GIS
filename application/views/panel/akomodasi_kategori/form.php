<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Kategori</span>
                </div>
            </div>
            <div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<a href="<?=site_url('panel/akomodasi_kategori')?>" class="btn blue">
							<i class="fa fa-history"></i> Kembali
						</a>
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">
						<form class="form-horizontal" method="POST" action="<?=site_url('panel/akomodasi_kategori/submit/' . $id)?>" enctype="multipart/form-data">
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Nama Kategori</label>
						        <div class="col-md-6">
						            <input type="text" class="form-control" name="nama_kategori" value="<?=@$data->nama_kategori?>">
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <?php if(!empty($data->marker_path)){ ?>
							    <div class="form-group form-md-line-input">
							        <label class="col-md-4 control-label">Marker saat ini</label>
							        <div class="col-md-6">
							        	<img src="<?=base_url('uploads/' . $data->marker_path)?>">
							        </div>
							    </div>
						    <?php } ?>
						    <div class="form-group form-md-line-input">
						        <label class="col-md-4 control-label">Icon Marker</label>
						        <div class="col-md-6">
						            <input type="file" class="form-control" name="userfiles">
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <div class="col-md-offset-4 col-md-6">
						            <button type="submit" class="btn btn-success">
						            	<i class="fa fa-check"></i>&nbsp;&nbsp;Simpan
						            </button>
						            <a href="<?=site_url('panel/akomodasi_kategori')?>" class="btn btn-warning">
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