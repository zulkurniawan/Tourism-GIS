<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Objek Wisata</span>
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
				<form class="form-horizontal" method="POST" action="<?=site_url('panel/objek/submit/' . $id)?>" enctype="multipart/form-data">
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
						<div class="col-md-6">
							<div class="portlet light bordered">
					            <div class="portlet-title">
					                <div class="caption">
					                    <i class="icon-list"></i>
					                    <span class="caption-subject bold uppercase">Informasi Dasar</span>
					                </div>
					            </div>
					            <div class="portlet-body">
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Nama</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="nama" value="<?=@$data->nama?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Kategori</label>
								        <div class="col-md-8">
								        	<?=form_dropdown('kategori_id', $opt_kategori, @$data->kategori_id, 'class="form-control"')?>
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
						
						
						<div class="form-group form-md-line-input">
							<label class="col-md-4 control-label">Koordinat</label>
							<div class="col-md-8">
								<div class="input-group input-group-sm">
		                                        		<div class="input-group-control">
										<input type="text" class="form-control" name="lokasi_koordinat" value="<?=@$data->lokasi_koordinat?>" id="lokasi_koordinat" readonly="readonly">
		                                        			<div class="form-control-focus"> </div>
		                                        		</div>
									
									<?php if(!empty($id)){ ?>
		                                        			<?php if(!empty($data->objek_id)){ ?>
				                                       			<span class="input-group-btn btn-right">
				                                       				<button class="btn green-haze" type="button" id="set_koordinat">
				                                       					<i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;&nbsp;Lihat Lokasi
				                                       				</button>
				                                       			</span>
		                                        			<?php } else { ?>
				                                       			<span class="input-group-btn btn-right">
				                                       				<button class="btn green-haze" type="button" id="set_koordinat">
				                                       					<i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;&nbsp;Set Koordinat
				                                       				</button>
				                                       			</span>
		                                        			<?php } ?>
		                                       			<?php } else { ?>
			                                        		<span class="input-group-btn btn-right">
			                                        			<button class="btn green-haze" type="button" id="set_koordinat">
			                                        				<i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;&nbsp;Set Koordinat
			                                        			</button>
			                                        		</span>
			                                 		<?php } ?>
									
									<!--
									<?php if(!empty($id)){ ?>
		                                        			<?php if(!empty($data->duplikat_dari_id)){ ?>
				                                       			<span class="input-group-btn btn-right">
				                                       				<button class="btn green-haze" type="button" id="set_koordinat">
				                                       					<i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;&nbsp;Lihat Lokasi
				                                       				</button>
				                                       			</span>
		                                        			<?php } else { ?>
				                                       			<span class="input-group-btn btn-right">
				                                       				<button class="btn green-haze" type="button" id="set_koordinat">
				                                       					<i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;&nbsp;Set Koordinat
				                                       				</button>
				                                       			</span>
		                                        			<?php } ?>
		                                       			<?php } else { ?>
			                                        		<span class="input-group-btn btn-right">
			                                        			<button class="btn green-haze" type="button" id="set_koordinat">
			                                        				<i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;&nbsp;Set Koordinat
			                                        			</button>
			                                        		</span>
			                                 		<?php } ?>
			                                 		-->
		                                    		</div>
							</div>
						</div>
						
						
						
						
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Desa</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="lokasi_desa" value="<?=@$data->lokasi_desa?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Kecamatan</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="lokasi_kecamatan" value="<?=@$data->lokasi_kecamatan?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Kabupaten / Kota</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="lokasi_kabupaten_kota" value="<?=empty($data->lokasi_kabupaten_kota) ? $this->config->item('kabupaten') : $data->lokasi_kabupaten_kota?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
								    <?php if(!empty($data->foto)){ ?>
									    <div class="form-group form-md-line-input">
									        <label class="col-md-4 control-label">Foto saat ini</label>
									        <div class="col-md-8">
									        	<img src="<?=base_url('uploads/' . $data->foto)?>" width="100%">
									        </div>
									    </div>
								    <?php } ?>
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Upload Foto baru</label>
								        <div class="col-md-8">
								            <input type="file" class="form-control" name="userfiles">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Street View URL</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="street_view_url" value="<?=@$data->street_view_url?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="portlet light bordered">
					            <div class="portlet-title">
					                <div class="caption">
					                    <i class="icon-briefcase"></i>
					                    <span class="caption-subject bold uppercase">Fasilitas</span>
					                </div>
					            </div>
					            <div class="portlet-body">
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Tempat Ibadah</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="info_tempat_ibadah" value="<?=@$data->info_tempat_ibadah?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>							
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Penginapan</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="info_penginapan" value="<?=@$data->info_penginapan?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>							
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Toilet</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="info_toilet" value="<?=@$data->info_toilet?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>							
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Akses Jalan</label>
								        <div class="col-md-8">
								            <input type="text" class="form-control" name="info_akses_jalan" value="<?=@$data->info_akses_jalan?>">
											<div class="form-control-focus"> </div>
								        </div>
								    </div>	
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Tiket</label>
								        <div class="col-md-8">
								        	<textarea class="form-control" name="info_tiket" id="info_tiket" rows="5"><?=@$data->info_tiket?></textarea>
											<div class="form-control-focus"> </div>
								        </div>
								    </div>							
								</div>
							</div>						
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="portlet light bordered">
					            <div class="portlet-title">
					                <div class="caption">
					                    <i class="icon-note"></i>
					                    <span class="caption-subject bold uppercase">Berikan Gambaran / Deskripsi mengenai Objek Wisata</span>
					                </div>
					            </div>
					            <div class="portlet-body">
								    <div class="form-group form-md-line-input">
								        <div class="col-md-12">
								        	<textarea name="info_deskripsi" id="info_deskripsi"><?=@$data->info_deskripsi?></textarea>
											<div class="form-control-focus"> </div>
								        </div>
								    </div>				
								</div>
							</div>									
						</div>
					</div>
					<div class="portlet light bordered">
			            <div class="portlet-title">
			                <div class="caption">
			                    <i class="icon-notebook"></i>
			                    <span class="caption-subject bold uppercase">Kontak</span>
			                </div>
			            </div>
			            <div class="portlet-body">
							<div class="row">
								<div class="col-md-6">
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Email</label>
								        <div class="col-md-8">
											<div class="input-group">
									            <input type="text" class="form-control" name="kontak_email" value="<?=@$data->kontak_email?>">
			                                    <span class="input-group-addon">
			                                        <i class="fa fa-envelope"></i>
			                                    </span>
												<div class="form-control-focus"> </div>
			                                </div>
										</div>
								    </div>							
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Website</label>
								        <div class="col-md-8">
											<div class="input-group">
									            <input type="text" class="form-control" name="kontak_website" value="<?=@$data->kontak_website?>">
			                                    <span class="input-group-addon">
			                                        <i class="fa fa-globe"></i>
			                                    </span>
												<div class="form-control-focus"> </div>
			                                </div>
								        </div>
								    </div>							
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">No Handphone</label>
								        <div class="col-md-8">
											<div class="input-group">
									            <input type="text" class="form-control" name="kontak_handphone" value="<?=@$data->kontak_handphone?>">
			                                    <span class="input-group-addon">
			                                        <i class="fa fa-mobile"></i>
			                                    </span>
												<div class="form-control-focus"> </div>
			                                </div>
								        </div>
								    </div>							
								</div>
								<div class="col-md-6">
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Facebook</label>
								        <div class="col-md-8">
											<div class="input-group">
									            <input type="text" class="form-control" name="kontak_facebook" value="<?=@$data->kontak_facebook?>">
			                                    <span class="input-group-addon">
			                                        <i class="fa fa-facebook-official"></i>
			                                    </span>
												<div class="form-control-focus"> </div>
			                                </div>
								        </div>
								    </div>							
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Twitter</label>
								        <div class="col-md-8">
											<div class="input-group">
									            <input type="text" class="form-control" name="kontak_twitter" value="<?=@$data->kontak_twitter?>">
			                                    <span class="input-group-addon">
			                                        <i class="fa fa-twitter-square"></i>
			                                    </span>
												<div class="form-control-focus"> </div>
			                                </div>
								        </div>
								    </div>							
								    <div class="form-group form-md-line-input">
								        <label class="col-md-4 control-label">Instagram</label>
								        <div class="col-md-8">
											<div class="input-group">
									            <input type="text" class="form-control" name="kontak_instagram" value="<?=@$data->kontak_instagram?>">
			                                    <span class="input-group-addon">
			                                        <i class="fa fa-instagram"></i>
			                                    </span>
												<div class="form-control-focus"> </div>
			                                </div>
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
						            <a href="<?=site_url('panel/objek')?>" class="btn btn-warning pull-right">
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
	var ComponentsEditors = function() {
	    var s = function() {
	            $("#info_deskripsi").summernote({
	                height: 300,
	                onImageUpload: function(files, editor, welEditable) {
               			sendFile(files[0], editor, welEditable);
            		}
	            });
	            $("#info_tiket").summernote({
	                height: 150,
					toolbar: [
					  		    ['style', ['bold', 'italic', 'underline', 'ul', 'ol']],
			                ]
                });
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
            url 			: "<?=site_url('panel/objek/upload_gambar_deskripsi')?>",
            cache 		 	: false,
            contentType 	: false,
            processData 	: false,
            success: function(url) 
            {
            	$('#info_deskripsi').summernote('editor.insertImage', url);
                // editor.insertImage(welEditable, url);
            }
        });
    }
	jQuery(document).ready(function() {
	    ComponentsEditors.init()
	});
</script>

<div class="modal fade" id="modal-map" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="icon-login"></i>&nbsp;&nbsp;&nbsp;Tentukan Koordinat / Posisi Objek</h4>
            </div>
            <div class="modal-body"> 
            	<div id="map" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="modal-footer">
            
                <?php if(!empty($id)){ ?>
                	<?php if(empty($data->objek_id)){ ?>
		                <button type="button" class="btn blue" onclick="set_posisi()">
		                	<i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Set Posisi
		                </button>
		        <?php } ?>
		<?php } else { ?>
	                <button type="button" class="btn blue" onclick="set_posisi()">
	                	<i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Set Posisi
	                </button>
		<?php } ?>
                
                <!--
                <?php if(!empty($id)){ ?>
                	<?php if(empty($data->duplikat_dari_id)){ ?>
		                <button type="button" class="btn blue" onclick="set_posisi()">
		                	<i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Set Posisi
		                </button>
		        <?php } ?>
		<?php } else { ?>
	                <button type="button" class="btn blue" onclick="set_posisi()">
	                	<i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Set Posisi
	                </button>
		<?php } ?>
		-->
		       	
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">
                	<i class="fa fa-times"></i>&nbsp;&nbsp;&nbsp;Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=<?=$this->config->item('map_api')?>&callback=initMap" async defer></script>        
<script>
   	var myLatLng		= <?=empty($data->lokasi_koordinat) ? $this->config->item('map_center_coordinat') : $data->lokasi_koordinat?>;
    function initMap() 
    {
        var map 		= new google.maps.Map(document.getElementById('map'), {
            center          : myLatLng,
            zoom            : <?=$this->config->item('map_zoom')?>,
            zoomControl     : true,
            mapTypeControl  : true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.TOP_RIGHT
            },                    
            scaleControl: true,
            streetViewControl: true,
            rotateControl: true,
        });

		var marker = new google.maps.Marker({
          	position	: myLatLng,
          	map 		: map,
   			draggable	: true,
    		// animation	: google.maps.Animation.DROP,
            title		: 'Pilih Lokasi Objek'
        });        
		
		google.maps.event.addListener(marker, 'dragend', function(evt){
			myLatLng = {'lat' : evt.latLng.lat(), 'lng' : evt.latLng.lng()};
		});

		map.setCenter(marker.position);
		marker.setMap(map);
  	}

  	function set_posisi()
  	{
  		var strtobox = '{lat:' + myLatLng.lat + ', lng:' + myLatLng.lng + '}';
  		$('#lokasi_koordinat').val(strtobox);
		$('#modal-map').modal('hide');
  	}

	$('#set_koordinat').on('click', function(){
		$('#modal-map').modal();
	});
	
	$('#modal-map').on('shown.bs.modal', function(){
    	initMap();
    });
</script>

