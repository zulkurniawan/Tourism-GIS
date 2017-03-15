<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Foto untuk Akomodasi : <?=$nama_objek?></span>
                </div>
            </div>
            <div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<a href="<?=site_url('panel/akomodasi_galeri/index/' . $uri_kategori . '/' . $uri_objek)?>" class="btn blue">
							<i class="fa fa-history"></i> Kembali
						</a>
					</div>
				</div>
				<hr/>
				<form class="form-horizontal" method="POST" action="<?=site_url('panel/akomodasi_galeri/submit/' . $uri_kategori . '/' . $uri_objek . '/' . $id)?>" enctype="multipart/form-data">
				    <div class="row">
				    	<div class="col-md-12">
							<div class="portlet light">
					            <div class="portlet-body">
								    <div class="form-group form-md-line-input">
								        <label class="col-md-2 control-label">Foto</label>
								        <div class="col-md-8">
								        	<img src="<?=base_url('uploads/galeri/' . $data->foto)?>" class="thumbnail" width="100%">
								        </div>
								    </div>
								    <!--
								    <div class="form-group form-md-line-input">
								        <label class="col-md-2 control-label">Ganti Foto baru</label>
								        <div class="col-md-8">
								            <input type="file" class="form-control" name="userfiles">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
								    -->
								    <div class="form-group form-md-line-input">
								        <label class="col-md-2 control-label">Nama</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="nama" value="<?=@$data->nama?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
								    <div class="form-group form-md-line-input">
								        <label class="col-md-2 control-label">Keterangan</label>
								        <div class="col-md-8">
								        	<textarea class="form-control" name="keterangan" id="keterangan" rows="5"><?=@$data->keterangan?></textarea>
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
					           	</div>
					       	</div>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="col-md-12">
						    <div class="form-group form-md-line-input">
						        <div class="col-md-12">
						            <button type="submit" class="btn btn-success pull-right" style="margin-left: 5px;">
						            	<i class="fa fa-check"></i>&nbsp;&nbsp;Simpan
						            </button>
						            <a href="<?=site_url('panel/akomodasi_galeri/index/' . $uri_kategori . '/' . $uri_objek)?>" class="btn btn-warning pull-right">
						            	<i class="fa fa-times"></i>&nbsp;&nbsp;Batal
						            </a>
						        </div>
						    </div>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>