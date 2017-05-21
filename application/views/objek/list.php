<div class="portlet light">
    <div class="portlet-title">
    	<a href="<?=site_url()?>" class="btn btn-sm grey">
    		<i class="fa fa-home"></i><span class="hidden-xs hidden-sm"> Beranda</span>
    	</a>
    	<a data-toggle="modal" href="#bagikan_halaman" class="btn btn-sm btn-info pull-right">
    		<i class="fa fa-share"></i><span class="hidden-xs hidden-sm"> Bagikan Halaman</span>
    	</a>
		<hr/>
        <div class="caption">
            <i class="fa fa-info-circle"></i>
            <span class="caption-subject bold uppercase">&nbsp;&nbsp;Profil</span>
        </div>
    </div>
    <div class="portlet-body">
    	<div class="row">
    		<div class="col-md-12">
		    	<p style="line-height: 25px;"><?=$data->data->info_deskripsi?></p>
		    </div>
		</div>
		<hr/>
    	<div class="row">
		    <div class="col-md-6">
            	<div id="map_objek" style=" width: 100%; height: 250px; margin-bottom: 5px;"></div>
		    </div>
    		<div class="col-md-6">
            	<div id="street_view" style="width: 100%; height: 250px; margin-bottom: 5px;"></div>
		    </div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-md-6">
				<?php if($data->data->jenis == 'objek'){ ?>
					<div class="portlet light bordered">
					    <div class="portlet-title">
					        <div class="caption">
					            <i class="fa fa-briefcase"></i>
					            <span class="caption-subject bold uppercase">&nbsp;&nbsp;Fasilitas</span>
					        </div>
					    </div>
					    <div class="portlet-body">
					    	<ul class="list-group">
					    		<li class="list-group-item">Tempat Ibadah : <?=$data->data->info_tempat_ibadah?></li>
					    		<li class="list-group-item">Penginapan : <?=$data->data->info_penginapan?></li>
					    		<li class="list-group-item">Toilet : <?=$data->data->info_toilet?></li>
					    		<li class="list-group-item">Akses Jalan : <?=$data->data->info_akses_jalan?></li>
					    	</ul>
					    	<hr/>
					    	<p><strong>Tiket</strong><br/> <?=$data->data->info_tiket?></p>    	
					    </div>
					</div>
				<?php } else { ?>
					<div class="portlet light bordered">
					    <div class="portlet-title">
					        <div class="caption">
					            <i class="fa fa-briefcase"></i>
					            <span class="caption-subject bold uppercase">&nbsp;&nbsp;Layanan</span>
					        </div>
					    </div>
					    <div class="portlet-body">
			            	<p>
			            		<strong>Barang / Jasa</strong><br/>
			            		<?=$data->data->akomodasi_jasa?>
			            	</p>
			            	<p>
			            		<strong>Layanan Tambahan</strong><br/>
			            		<?=$data->data->akomodasi_layanan_tambahan?>
			            	</p>
					    </div>
					</div>
				<?php } ?>
			</div>
			<div class="col-md-6">
				<div class="portlet light bordered">
				    <div class="portlet-title">
				        <div class="caption">
				            <i class="fa fa-phone-square"></i>
				            <span class="caption-subject bold uppercase">&nbsp;&nbsp;Kontak</span>
				        </div>
				    </div>
				    <div class="portlet-body">
		            	<ul class="list-group">
		            		<li class="list-group-item">Email : <?=empty($data->data->kontak_email) ? '-' : $data->data->kontak_email?></li>
		            		<li class="list-group-item">Website : <a href="<?=empty($data->data->kontak_website) ? '-' : $data->data->kontak_website?>"><?=empty($data->data->kontak_website) ? '-' : $data->data->kontak_website?></a></li>
		            		<!--<li class="list-group-item">No Handphone : <?=empty($data->data->kontak_handphone) ? '-' : $data->data->kontak_handphone?></li>-->
		            		<li class="list-group-item">No Handphone : <a target="blank" href="https://api.whatsapp.com/send?phone=<?=empty($data->data->kontak_handphone) ? '-' : $data->data->kontak_handphone?>&text=Hallo,%0ASaya%20mau%20tanya%20..." class="btn btn-success">+<?=empty($data->data->kontak_handphone) ? '-' : $data->data->kontak_handphone?>&nbsp;&nbsp;<i class="fa fa-whatsapp fa-lg"></i></a></li>
		            		<li class="list-group-item">Facebook : <?=empty($data->data->kontak_facebook) ? '-' : $data->data->kontak_facebook?></li>
		            		<li class="list-group-item">Twitter : <?=empty($data->data->kontak_twitter) ? '-' : $data->data->kontak_twitter?></li>
		            		<li class="list-group-item">Instagram : <?=empty($data->data->kontak_instagram) ? '-' : $data->data->kontak_instagram?></li>
		            	</ul>
		            </div>
		        </div>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light bordered">
		            <div class="portlet-title">
		                <div class="caption">
		                    <i class="fa fa-list"></i>
		                    <span class="caption-subject bold uppercase">Artikel</span>
		                </div>
		            </div>
		            <div class="portlet-body">
						<?php if(!empty($data->artikel)){ ?>
							<ul class="media-list" id="objek_artikel_list">
				            	<?php foreach($data->artikel as $key => $c): ?>
					        		<li class="media">
						        		<a class="pull-left" href="<?=$c->link?>">
							        		<img class="media-object thumbnails" src="<?=$c->foto?>" width="100px">
						        		</a>
						        		<div class="media-body">
							        		<h4 class="media-heading"><?=$c->judul?></h4>
							        		<p style="margin:0px;"><?=$c->singkat?></p>
							        		<div class="btn-group">
								        		<a class="btn btn-xs white">
								        			<i class="fa fa-user"></i>&nbsp;&nbsp;<?=$c->nama_kontributor?>&nbsp;&nbsp;
									        		<i class="fa fa-calendar"></i>&nbsp;&nbsp;<?=$c->tgl_posting?>
									        	</a>
					        					<a href="<?=$c->link?>" class="btn btn-xs btn-info">
					        						<i class="fa fa-eye"></i>&nbsp;&nbsp;Baca 
					        					</a>
					        				</div>
					        			</div>
					        			<hr/>
					        		</li>		
				            	<?php endforeach; ?>
							</ul>
			            <?php } else { ?>
			            	<?=info_msg('Artikel kosong.', false)?>
			            <?php } ?>
						<?php if(!empty($data->artikel)){ ?>
							<a class="btn btn-sm btn-info btn-block" href="<?=site_url('artikel/index/' . $data->data->objek_id . '/' . $data->data->url_seo)?>">
								<i class="fa fa-list"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Lihat Artikel Lainnya</span>
							</a>
						<?php } ?>
		            </div>
		        </div>	
				<div class="portlet light bordered">
		            <div class="portlet-title">
		                <div class="caption">
		                    <i class="fa fa-image"></i>
		                    <span class="caption-subject bold uppercase">Foto</span>
		                </div>
		            </div>
		            <div class="portlet-body">
		            	<div class="row">
							<?php if(!empty($data->foto)){ ?>
				            	<?php foreach($data->foto as $key => $c): ?>
					        		<div class="col-md-4">
						        		<div class="thumbnail">
							        		<img src="<?=$c->foto?>">
			    				    		<div class="caption">
			        							<h5><?=$c->nama?></h5>
			        							<p>
			        								<a class="btn btn-xs white btn-block">
			        									<i class="fa fa-user"></i>&nbsp;&nbsp;<?=$c->nama_kontributor?>
			        								</a>
			        								<a class="btn btn-xs white btn-block">
			        									<i class="fa fa-calendar"></i>&nbsp;&nbsp;<?=$c->tgl_upload?>
			        								</a>
			        								<a href="<?=$c->link?>" class="btn btn-xs btn-info btn-block">
			        									<i class="fa fa-eye"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Lihat</span>
			        								</a>
			        							</p>
	                        				</div>
			        					</div>
			        				</div>
				            	<?php endforeach; ?>
				            <?php } else { ?>
				            	<div class="col-md-12">
					            	<?=info_msg('Foto kosong.', false)?>
					            </div>
				            <?php } ?>
	                    </div>
						<?php if(!empty($data->foto)){ ?>
							<a class="btn btn-sm btn-info btn-block" href="<?=site_url('galeri/index/' . $data->data->objek_id . '/' . $data->data->url_seo)?>">
								<i class="fa fa-image"></i>&nbsp;&nbsp;Lihat Foto Lainnya
							</a>
						<?php } ?>
		            </div>
		        </div>	            						
		    </div>
		</div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        map = new google.maps.Map(document.getElementById('map_objek'), {
            center          : <?=$data->objek_wisata->lokasi_koordinat?>,
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

        marker  = new google.maps.Marker({
                            position    : <?=$data->objek_wisata->lokasi_koordinat?>,
                            map         : map,
                            animation   : google.maps.Animation.DROP,
                            title       : "<?=$data->objek_wisata->nama?>",
                        });       
    });
</script>
<script type="text/javascript">
	var STREETVIEW_MAX_DISTANCE = 100;
	var panorama;
   	var myLatLngList	= <?=$data->objek_wisata->lokasi_koordinat?>;

	<?php if(empty($data->objek_wisata->street_view_url)){ ?>
		var streetViewService 	= new google.maps.StreetViewService();
		streetViewService.getPanoramaByLocation(myLatLngList, STREETVIEW_MAX_DISTANCE, function (streetViewPanoramaData, status) {
		    if (status === google.maps.StreetViewStatus.OK) {
		        panorama = new google.maps.StreetViewPanorama(
		            document.getElementById('street_view'),
		            {
		              position: myLatLngList,
		              pov: {heading: 165, pitch: 0},
		              zoom: 1
		            }
		        );
		    } else {
		    	$('#street_view').attr({'style' : 'background-color: #000; color: #FFFFFF; text-align: center; height: 250px; padding-top: 100px;'});
		    	$('#street_view').html('<h4>Street view tidak tersedia.</h4>');
		    }
		});
	<?php } else { ?>
		$('#street_view').html('<iframe src="<?=$data->objek_wisata->street_view_url?>" width="100%" height="250px" frameborder="0" style="border:0" allowfullscreen></iframe>');
	<?php } ?>
</script>
