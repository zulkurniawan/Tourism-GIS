<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Detail Objek Wisata</span>
                </div>
				<div class="actions">
				    <a class="btn blue" href="<?=site_url('panel/akomodasi_objek')?>">
				    	<i class="fa fa-history hidden-xs"></i> Kembali
				    </a>
				    <?php if($login_level == 'Administrator' || $login_uid == $data->user_id){ ?>
						<a href="<?=site_url('panel/akomodasi_objek/form/' . $data->objek_id)?>" class="btn blue btn-xs" title="Perbaharui / Update">
							<i class="fa fa-edit hidden-xs"></i> Perbaharui
						</a>
					<?php } ?>
				    <?php if($login_level == 'Administrator'){ ?>
					    <a class="btn green" onclick="modal_set_status()">
					    	<i class="fa fa-check hidden-xs"></i> Moderasi
					    </a>
					<?php } ?>
				</div>
            </div>
            <div class="portlet-body">
            	<div class="row">
            		<div class="col-md-12">
						<div class="note note-info">
            				<p>Partners : <strong><?=$data->nama_kontributor?></strong>, 
            				   Terakhir Update : <strong><?=date('H:i:s d-m-Y', strtotime($data->terakhir_update))?></strong>,
            				   Maksimal Waktu Tayang : <strong><?=empty($data->akomodasi_maks_waktu_tayang) ? 'Tak Terbatas' : date('H:i:00 d-m-Y', strtotime($data->akomodasi_maks_waktu_tayang))?>.</strong>
            				</p>
    					</div>
            		</div>
            	</div>
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
	            	<div class="col-md-5">
	            		<?php if(!empty($data->foto)){ ?>
					    	<img src="<?=base_url('uploads/' . $data->foto)?>" class="thumbnail" width="100%">
						<?php } ?>
						<div class="portlet light">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="icon-list"></i>
				                    <span class="caption-subject bold uppercase">Informasi</span>
				                </div>
				            </div>
				            <div class="portlet-body">
				            	<ul class="list-group">
				            		<li class="list-group-item">Nama : <?=$data->nama?></li>
				            		<li class="list-group-item">Kategori : <?=$data->nama_kategori?></li>
				            		<li class="list-group-item">Desa : <?=$data->lokasi_desa?></li>
				            		<li class="list-group-item">Kecamatan : <?=$data->lokasi_kecamatan?></li>
				            		<li class="list-group-item">Kabupaten / Kota : <?=$data->lokasi_kabupaten_kota?></li>
				            	</ul>
				        	</div>
				        </div>
						<div class="portlet light">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="icon-briefcase"></i>
				                    <span class="caption-subject bold uppercase">Layanan</span>
				                </div>
				            </div>
				            <div class="portlet-body">
				            	<ul class="list-group">
				            		<li class="list-group-item">Barang / Jasa : <br/><?=nl2br($data->akomodasi_jasa)?></li>
				            		<li class="list-group-item">Layanan Tambahan : <br/><?=nl2br($data->akomodasi_layanan_tambahan)?></li>
				            	</ul>
				        	</div>
				        </div>
						<div class="portlet light">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="icon-notebook"></i>
				                    <span class="caption-subject bold uppercase">Kontak</span>
				                </div>
				            </div>
				            <div class="portlet-body">
				            	<ul class="list-group">
				            		<li class="list-group-item">Email : <?=$data->kontak_email?></li>
				            		<li class="list-group-item">Website : <?=$data->kontak_website?></li>
				            		<li class="list-group-item">No Handphone : <?=$data->kontak_handphone?></li>
				            		<li class="list-group-item">Facebook : <?=$data->kontak_facebook?></li>
				            		<li class="list-group-item">Twitter : <?=$data->kontak_twitter?></li>
				            		<li class="list-group-item">Instagram : <?=$data->kontak_instagram?></li>
				            	</ul>
				        	</div>
				        </div>
	            	</div>
	            	<div class="col-md-7">
	            		<?php if(!empty($data->info_deskripsi)){ ?>
							<div class="portlet light">
					            <div class="portlet-body">
				            		<?=$data->info_deskripsi?>
								</div>
							</div>
						<?php } ?>
						<div class="portlet light">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="icon-globe"></i>
				                    <span class="caption-subject bold uppercase">Lokasi</span>
				                </div>
				            </div>
				            <div class="portlet-body">
				            	<div id="map" style="width: 100%; height: 400px;"></div>
				            </div>
				        </div>
	            	</div>
	            </div>
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
        });        
		
		map.setCenter(marker.position);
		marker.setMap(map);
  	}
</script>

<div class="modal fade" id="modal-status" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form class="form-horizontal" action="<?=site_url('panel/akomodasi_objek/set_status/' . $data->objek_id)?>" method="POST">
	            <div class="modal-header">
	                <h4 class="modal-title"><i class="icon-check"></i>&nbsp;&nbsp;&nbsp;Moderasi Status</h4>
	            </div>
	            <div class="modal-body">             
					<div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label" style="text-align: left;">Status</label>
                        <div class="col-md-6">
		                    <?=form_dropdown('status', array('Publish' => 'Publish', 'Moderasi' => 'Moderasi', 'Draft' => 'Draft'), $data->status, 'class="form-control" id="status" onchange="set_field(this.value)"')?>
							<div class="form-control-focus"> </div>
                        </div>
                    </div>
					<div class="form-group form-md-line-input" id="input-waktu-tayang">
                        <label class="col-md-4 control-label" style="text-align: left;">Maksimal Waktu Tayang</label>
                        <div class="col-md-6">             
                        	<div class="input-group date form_datetime">
					            <input type="text" class="form-control" name="akomodasi_maks_waktu_tayang" readonly="readonly" value="<?=empty($data->akomodasi_maks_waktu_tayang) ? '' : date('H:i d-m-Y', strtotime($data->akomodasi_maks_waktu_tayang))?>">
                                <span class="input-group-btn">
                                    <button class="btn default date-set" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
								<div class="form-control-focus"> </div>
							</div>
                        </div>
                    </div>
					<div class="form-group form-md-line-input">
                        <label class="col-md-12 control-label" style="text-align: left;">Berikan Keterangan / Penjelasan, contoh : Data tidak valid</label>
                    </div>
					<div class="form-group form-md-line-input">
						<div class="col-md-12">
							<textarea class="form-control" name="keterangan" rows="5"></textarea>
						</div>
                    </div>
          	    </div>
	            <div class="modal-footer">
	                <button type="submit" class="btn blue">
	                	<i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Submit
	                </button>
	                <button type="button" class="btn dark btn-outline" data-dismiss="modal">
	                	<i class="fa fa-cross"></i>&nbsp;&nbsp;&nbsp;Batal
	                </button>
	            </div>
	        </form>
        </div>
    </div>
</div>


<link href="<?=base_url()?>/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script>
	$(".form_datetime").datetimepicker({
        autoclose: !0,
        isRTL: App.isRTL(),
        format: "hh:ii dd-mm-yyyy",
        pickerPosition: App.isRTL() ? "bottom-right" : "bottom-left"
    });

	function modal_set_status()
	{
		$('#modal-status').modal();
		set_field($('#status').val());
	}

	function set_field(val)
	{
		if(val == 'Publish')
		{
			$('#input-waktu-tayang').removeAttr('style');
		}
		else
		{
			$('#input-waktu-tayang').attr({'style' : 'display:none'});			
		}
	}
</script>