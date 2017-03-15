<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Konfigurasi : <?=@$data->judul?></span>
                </div>
            </div>
            <div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<a href="<?=site_url('panel/konfigurasi')?>" class="btn blue">
							<i class="fa fa-history"></i> Kembali
						</a>
					</div>
				</div>
				<div class="row">		
					<div class="col-md-12">
						<form class="form-horizontal" method="POST" action="<?=site_url('panel/konfigurasi/submit/' . $id)?>">
							<div class="portlet light">
					            <div class="portlet-title">
					                <div class="caption">
					                    <i class="icon-note"></i>
					                    <span class="caption-subject bold uppercase">Isi Konfigurasi</span>
					                </div>
					            </div>
					            <div class="portlet-body">
								    <div class="form-group form-md-line-input">
								        <div class="col-md-12">
								        	<textarea class="form-control" name="isi" rows="10" id="isi"><?=@$data->isi?></textarea>
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
					           	</div>
					       	</div>
						    <div class="form-group form-md-line-input">
						        <div class="col-md-12">
						            <button type="submit" class="btn btn-success">
						            	<i class="fa fa-check"></i>&nbsp;&nbsp;Simpan
						            </button>
						            <a href="<?=site_url('panel/konfigurasi')?>" class="btn btn-warning">
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
<?php if(@$data->editor == 'Y'){ ?>
<link href="<?=base_url()?>/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>/assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script type="text/javascript">
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
            url 			: "<?=site_url('panel/konfigurasi/upload_gambar_isi')?>",
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
<?php } ?>