<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Artikel untuk Objek Wisata : <?=$nama_objek?></span>
                </div>
            </div>
            <div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<a href="<?=site_url('panel/artikel/index/' . $uri_kategori . '/' . $uri_objek)?>" class="btn blue">
							<i class="fa fa-history"></i> Kembali
						</a>
					</div>
				</div>
				<hr/>
				<form class="form-horizontal" method="POST" action="<?=site_url('panel/artikel/submit/' . $uri_kategori . '/' . $uri_objek . '/' . $id)?>" enctype="multipart/form-data">
				    <div class="row">
				    	<div class="col-md-12">
							<div class="portlet light">
					            <div class="portlet-body">
								    <div class="form-group form-md-line-input">
								        <label class="col-md-2 control-label">Judul</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="judul" value="<?=@$data->judul?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
								    <?php if(!empty($data->foto)){ ?>
									    <div class="form-group form-md-line-input">
									        <label class="col-md-2 control-label">Foto saat ini</label>
									        <div class="col-md-8">
									        	<img src="<?=base_url('uploads/' . $data->foto)?>" class="thumbnail" width="100%">
									        </div>
									    </div>
								    <?php } ?>
								    <div class="form-group form-md-line-input">
								        <label class="col-md-2 control-label">Upload Foto baru</label>
								        <div class="col-md-8">
								            <input type="file" class="form-control" name="userfiles">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
					           	</div>
					       	</div>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="col-md-12">
							<div class="portlet light">
					            <div class="portlet-title">
					                <div class="caption">
					                    <i class="icon-list"></i>
					                    <span class="caption-subject bold uppercase">Sekilas</span>
					                </div>
					            </div>
					            <div class="portlet-body">
								    <div class="form-group form-md-line-input">
								        <div class="col-md-12">
								        	<textarea class="form-control" name="singkat" id="singkat" rows="5" onkeyup="countChar(this)"><?=@$data->singkat?></textarea>
											<div class="form-control-focus"> </div>
											<span class="help-block" id="charNum">Sisa <?=empty($data->singkat) ? '250' : 250 - strlen($data->singkat)?> Karakter</span>
								        </div>
								    </div>
					           	</div>
					       	</div>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="col-md-12">
							<div class="portlet light">
					            <div class="portlet-title">
					                <div class="caption">
					                    <i class="icon-note"></i>
					                    <span class="caption-subject bold uppercase">Isi</span>
					                </div>
					            </div>
					            <div class="portlet-body">
								    <div class="form-group form-md-line-input">
								        <div class="col-md-12">
								        	<textarea class="form-control" name="isi" rows="5" id="isi"><?=@$data->isi?></textarea>
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
						            <a href="<?=site_url('panel/artikel/index/' . $uri_kategori . '/' . $uri_objek)?>" class="btn btn-warning pull-right">
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
<link href="<?=base_url()?>/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>/assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script type="text/javascript">
 	function countChar(val) 
 	{
        var len = val.value.length;
        if (len > 250) 
        {
          	val.value = val.value.substring(0, 250);
        } 
        else 
        {
          	$('#charNum').text('Sisa ' + (250 - len) + ' Karakter');
        }
    };

	var ComponentsEditors = function() {
	    var s = function() {
	            $("#isi").summernote({
	                height: 300,
	                onImageUpload: function(files, editor, welEditable) {
               			sendFile(files[0], editor, welEditable);
            		}
	            })
	        };
	    return {
	        init: function() {
	            s()
	        }
	    }
	}();
	function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
            data 			: data,
            type 			: "POST",
            url 			: "<?=site_url('panel/artikel/upload_gambar_isi')?>",
            cache 		 	: false,
            contentType 	: false,
            processData 	: false,
            success: function(url) 
            {
            	$('#isi').summernote('editor.insertImage', url);
                // editor.insertImage(welEditable, url);
            }
        });
    }
	jQuery(document).ready(function() {
	    ComponentsEditors.init()
	});
</script>