<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Foto untuk Objek Wisata : <?=$nama_objek?></span>
                </div>
            </div>
            <div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<a href="<?=site_url('panel/akomodasi_galeri/index/' . $uri_kategori)?>" class="btn blue">
							<i class="fa fa-history hidden-xs"></i> Kembali
						</a>
					</div>
				</div>
				<hr/>
                <form id="fileupload" action="<?=site_url('panel/akomodasi_galeri_uploadhandler/index/' . $uri_kategori . '/' . $uri_objek)?>" method="POST" enctype="multipart/form-data">
                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                    <div class="row fileupload-buttonbar">
                        <div class="col-lg-7">
                            <!-- The fileinput-button span is used to style the file input field as button -->
                            <span class="btn green fileinput-button">
                                <i class="fa fa-plus hidden-xs"></i>
                                <span> Tambahkan Foto </span>
                                <input type="file" name="files[]" multiple=""> 
                            </span>
                            <button type="submit" class="btn blue start">
                                <i class="fa fa-upload hidden-xs"></i>
                                <span> Upload Semua </span>
                            </button>
                            <!-- The global file processing state -->
                            <span class="fileupload-process"> </span>
                        </div>
                        <!-- The global progress information -->
                        <div class="col-lg-5 fileupload-progress fade">
                            <!-- The global progress bar -->
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                            </div>
                            <!-- The extended global progress information -->
                            <div class="progress-extended"> &nbsp; </div>
                        </div>
                    </div>
                    <div class="table-responsive">
	                    <!-- The table listing the files available for upload/download -->
	                    <table role="presentation" class="table table-striped clearfix">
	                    	<thead>
	                    		<tr>
	                    			<th class="col-md-2"></th>
	                    			<th class="col-md-2 text-center">Preview</th>
	                    			<th class="col-md-3">Informasi</th>
	                    			<th class="col-md-2">Tgl Upload</th>
	                    			<th class="col-md-1">Status</th>
	                    			<th class="col-md-2">Partners</th>
	                    		</tr>
	                    	</thead>
	                        <tbody class="files"> </tbody>
	                    </table>
	                </div>
                </form>
				<script id="template-upload" type="text/x-tmpl"> 
					{% for (var i=0, file; file=o.files[i]; i++) { %}
					    <tr class="template-upload fade">
					        <td class="center"> 
					        	{% if (!i && !o.options.autoUpload) { %}
						            <button class="btn blue start btn-xs" disabled>
						                <i class="fa fa-upload"></i>
						            </button> 
					            {% } %} {% if (!i) { %}
						            <button class="btn red cancel btn-xs">
						                <i class="fa fa-ban"></i>
						            </button> 
					            {% } %} 
					        </td>
					        <td class="text-center">
					            <span class="preview"></span>
					            <p class="size">Processing...</p>
					            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
					                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
					            </div>
					        </td>
					        <td>
							    <div class="form-group form-md-line-input form-md-floating-label">
						        	<input type="text" name="nama[]" class="form-control" value="" maxlength="250" required placeholder="">
									<label>Nama Foto</label>
									<div class="form-control-focus"> </div>
					        	</div>
							    <div class="form-group form-md-line-input form-md-floating-label">
						        	<input type="text" name="keterangan[]" class="form-control" maxlength="250">
									<label>Keterangan</label>
									<div class="form-control-focus"> </div>
					        	</div>
					            <strong class="error text-danger label label-danger"></strong>
					        </td>
					        <td></td>
					        <td></td>
					        <td></td>
					    </tr> 
				    {% } %} 
				</script>
				<!-- The template to display files available for download -->
				<script id="template-download" type="text/x-tmpl"> 
					{% for (var i=0, file; file=o.files[i]; i++) { %}
					    <tr class="template-download fade">
					        <td> 
								<a href="{%=file.detailUrl%}" class="btn grey btn-xs" title="Lihat Foto">
									<i class="fa fa-list"></i>
								</a>
					            <a class="btn blue btn-xs" href="{%=file.updateUrl%}">
					                <i class="fa fa-edit"></i>
					            </a>
					        	{% if (file.deleteUrl) { %}
						            <button onclick="return check();" class="btn red delete btn-xs" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
						                <i class="fa fa-trash-o"></i>
						            </button>
						            <input type="checkbox" name="delete" value="1" class="toggle" style="visibility:hidden"> 
					            {% } else { %}
						            <button class="btn yellow cancel btn-xs">
						                <i class="fa fa-ban"></i>
						            </button> 
					            {% } %} 
					       </td>
					        <td class="text-center">
					            <span class="preview"> 
					            	{% if (file.thumbnailUrl) { %}
					                	<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
					                	    <img src="{%=file.thumbnailUrl%}">
					                	</a> 
					                {% } %} 
					            </span>
								<p>{%=o.formatFileSize(file.size)%}</p>
					        </td>
					        <td>
					            <p class="name">{%=file.nama%}</p> <hr/>
								<i>{%=file.keterangan%}</i>
					            {% if (file.error) { %}
					            	<div><span class="label label-danger">Error</span> {%=file.error%}</div> 
					            {% } %} 
					         </td>
					        <td><p class="name">{%=file.tgl_upload%}</p></td>
					        <td>
								<a href="{%=file.detailUrl%}" class="btn green btn-xs" title="Silahkan Periksa terlebih dahulu sebelum mengganti status">
					        		{%=file.status%}
						        </a>
					        </td>
					        <td><p class="name">{%=file.nama_kontributor%}</p></td>
					    </tr>
				        {% if (file.moderator_keterangan) { %}
						    <tr>
						    	<td></td>
								<td><i class="fa fa-caret-right"></i>&nbsp;&nbsp;Pesan Moderasi</td>
								<td colspan="4">
									<div class="note note-warning">
										<h5>Oleh {%=file.moderator_nama%} pada {%=file.moderator_waktu%}</h5>
										<p>{%=file.moderator_keterangan%}</p>
									</div>
								</td>
						    </tr> 
			            {% } %} 						
				    {% } %} 
				</script>                
            </div>
        </div>
    </div>
</div>

<link href="<?=base_url()?>/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />

<script src="<?=base_url()?>/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>

<script type="text/javascript">
	var FormFileUpload = function() {
	    return {
	        init: function() {
	            $("#fileupload").fileupload({
	                disableImageResize 	: !1,
	                autoUpload 			: !1,
	                disableImageResize 	: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
	                maxFileSize 		: 5e6,
	                acceptFileTypes 	: /(\.|\/)(gif|jpe?g|png)$/i
	            }), 

	            $("#fileupload").addClass("fileupload-processing"), 

	            $.ajax({
	                url 		: $("#fileupload").attr("action"),
	                dataType 	: "json",
	                context 	: $("#fileupload")[0],
	            }).success(function(e){
	            }).always(function() {
	                $(this).removeClass("fileupload-processing")
	            }).done(function(e) {
	                $(this).fileupload("option", "done").call(this, $.Event("done"), {
	                    result: e
	                })
	            })
	        }
	    }
	}();
	jQuery(document).ready(function() {
	    FormFileUpload.init()
	});	
</script>