<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Template Email Notifikasi</span>
                </div>
            </div>
            <div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<a href="<?=site_url('panel/sms_templates')?>" class="btn blue">
							<i class="fa fa-history"></i> Kembali
						</a>
					</div>
				</div>
				<hr/>
				<div class="row">		
					<div class="col-md-12">
						<form class="form-horizontal" method="POST" action="<?=site_url('panel/sms_templates/submit/' . $id)?>" enctype="multipart/form-data">
						    <div class="form-group form-md-line-input">
						        <label class="col-md-2 control-label">Nama</label>
						        <div class="col-md-10">
						            <input type="text" class="form-control" value="<?=@$data->nama?>" readonly>
									<div class="form-control-focus"> </div>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input" style="margin-bottom: 0px;">
						        <label class="col-md-2 control-label">Keterangan</label>
						        <div class="col-md-10">
						        	<div class="form-control form-control-static"><?=$data->keterangan?></div>
						        </div>
						    </div>
						    <hr/>
						    <div class="form-group form-md-line-input" style="margin-bottom: 0px;">
						        <label class="col-md-2 control-label">Aktif</label>
						        <div class="col-md-3">
						        	<?=form_dropdown('aktif', array('Y' => 'Y', 'N' => 'N'), $data->aktif, 'class="form-control"')?>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <div class="col-md-12">
						        	<textarea class="form-control" name="isi" rows="5" id="isi" onkeyup="countChar(this)"><?=@$data->isi?></textarea>
									<div class="form-control-focus"> </div>
									<span class="help-block" id="charNum">Sisa <?=empty($data->singkat) ? '160' : 160 - strlen($data->singkat)?> Karakter</span>
						        </div>
						    </div>
						    <div class="form-group form-md-line-input">
						        <div class="col-md-12">
						            <button type="submit" class="btn btn-success pull-right" style="margin-left: 5px;">
						            	<i class="fa fa-check"></i>&nbsp;&nbsp;Simpan
						            </button>
						            <a href="<?=site_url('panel/kategori')?>" class="btn btn-warning pull-right">
						            	<i class="fa fa-times"></i>&nbsp;&nbsp;Batal
						            </a>
						        </div>
						    </div>
						</form>
					</div>
				</div>	
				<hr/>			
				<div class="note note-info">
                    <h4 class="block">Informasi</h4>
                    <ul>
                    	<li>Pada templates terdapat nilai variable yang ditandai dengan tanda pembuka "{" dan penutup "}".</li>
                    	<li>Jangan merubah nama variable default</li>
                    </ul>
                </div>            
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
 	function countChar(val) 
 	{
        var len = val.value.length;
        if (len > 160) 
        {
          	val.value = val.value.substring(0, 160);
        } 
        else 
        {
          	$('#charNum').text('Sisa ' + (160 - len) + ' Karakter');
        }
    };	
</script>
