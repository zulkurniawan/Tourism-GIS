<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Import KML</span>
                </div>
            </div>
            <div class="portlet-body">
				<div class="row" style="margin-bottom: 10px;">
					<div class="col-md-12">
						<a href="<?=site_url('panel/objek')?>" class="btn blue">
							<i class="fa fa-history"></i> Kembali
						</a>
					</div>
				</div>
				<form class="form-horizontal" method="POST" action="<?=site_url('panel/objek/submit_kml/')?>" enctype="multipart/form-data">
				    <div class="form-group form-md-line-input">
				        <label class="col-md-4 control-label">File KML</label>
				        <div class="col-md-6">
				            <input type="file" class="form-control" name="userfiles">
							<div class="form-control-focus"> </div>
				        </div>
				    </div>
				    <div class="form-group form-md-line-input">
				        <div class="col-md-6 col-md-offset-4">
				            <button type="submit" class="btn btn-success">
				            	<i class="fa fa-check"></i>&nbsp;&nbsp;Submit
				            </button>
				            <a href="<?=site_url('panel/objek')?>" class="btn btn-warning">
				            	<i class="fa fa-times"></i>&nbsp;&nbsp;Batal
				            </a>
				        </div>
				    </div>
				</form>
            </div>
        </div>
     </div>
</div>