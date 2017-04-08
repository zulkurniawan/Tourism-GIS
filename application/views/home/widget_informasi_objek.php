<div class="modal fade" id="modal-informasi-objek-wisata" tabindex="-1" role="basic" aria-hidden="true" style="margin-bottom: 40px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            	<div class="hidden-md hidden-lg text-right" style="width: 100%;">
	                <button type="button" class="btn btn-info button-bagikan-halaman-objek" data-dismiss="modal">
	                    <i class="fa fa-share"></i>
	                </button>
	            	<a href="" class="btn btn-info button-goto-halaman-objek">
	                    <i class="fa fa-newspaper-o"></i>
	            	</a>
	                <button type="button" class="btn btn-info button-informasi-petunjuk-arah" data-dismiss="modal">
	                    <i class="fa fa-map-signs"></i>
	                </button>
	                <button type="button" class="btn default" data-dismiss="modal">
	                    <i class="fa fa-times"></i>
	                </button>
	            </div>
                <h4 class="modal-title hidden-xs hidden-sm">
                	<i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;
                	<span class="modal-title-text">Informasi Objek Wisata</span>
                </h4>
            </div>
            <div class="modal-body" style="height: 400px; overflow-y: auto;">
            	<div class="row">
	            	<div class="col-md-7">
		            	<div class="row">
		            		<div class="col-md-12">
							    <img class="thumbnail" width="100%" id="res_foto">
		            		</div>
		            	</div>
		            	<hr/>
		            	<div class="row">
		            		<div class="col-md-12">
				            	<p id="res_info_deskripsi"></p>
		            		</div>
		            	</div>
	            	</div>
	            	<div class="col-md-5">
		            	<div class="row">
		            		<div class="col-md-12">
								<div class="portlet light bordered">
						            <div class="portlet-title">
						                <div class="caption">
						                    <i class="fa fa-list"></i>
						                    <span class="caption-subject bold uppercase">Informasi</span>
						                </div>
						            </div>
						            <div class="portlet-body">
						            	<ul class="list-group">
						            		<li class="list-group-item">Nama : <span id="res_nama"></span></li>
						            		<li class="list-group-item">Kategori : <span id="res_nama_kategori"></span></li>
						            		<li class="list-group-item">Desa : <span id="res_lokasi_desa"></span></li>
						            		<li class="list-group-item">Kecamatan : <span id="res_kecamatan"></span></li>
						            		<li class="list-group-item">Kabupaten / Kota : <span id="res_lokasi_kabupaten_kota"></span></li>
						            	</ul>
						            	<ul class="list-group">
						            		<li class="list-group-item kontributor_area"><span class="label_kontributor">Kontributor</span> : <span id="res_nama_kontributor"></span></li>
						            		<li class="list-group-item">Terakhir Update : <span id="res_terakhir_update"></span></li>
						            	</ul>
						        	</div>
						        </div>				            			
		            		</div>
		            	</div>
	            	</div>
	            </div>
            	<hr/>
            	<div class="row">
				    <div class="col-md-6">
		            	<div id="map_objek" style="width: 100%; height: 250px; margin-bottom: 5px;"></div>
				    </div>
		    		<div class="col-md-6">
		            	<div id="street_view" style="width: 100%; height: 250px; margin-bottom: 5px;"></div>
				    </div>
            	</div>
            	<hr/>
            	<div class="row">
            		<div class="col-md-6">
						<div class="portlet light bordered" id="fasilitas_area">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="fa fa-briefcase"></i>
				                    <span class="caption-subject bold uppercase">Fasilitas</span>
				                </div>
				            </div>
				            <div class="portlet-body">
				            	<ul class="list-group">
				            		<li class="list-group-item">Tempat Ibadah : <span id="res_info_tempat_ibadah"></span></li>
				            		<li class="list-group-item">Penginapan : <span id="res_info_penginapan"></span></li>
				            		<li class="list-group-item">Toilet : <span id="res_info_toilet"></span></li>
				            		<li class="list-group-item">Akses Jalan : <span id="res_info_akses_jalan"></span></li>
				            	</ul>
				            	<hr/>
				            	<p>
				            		<strong>Tiket</strong><br/>
				            		<span id="res_info_tiket"></span>
				            	</p>
				        	</div>
				        </div>					            			
						<div class="portlet light bordered" id="layanan_area">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="fa fa-briefcase"></i>
				                    <span class="caption-subject bold uppercase">Layanan</span>
				                </div>
				            </div>
				            <div class="portlet-body">
				            	<p>
				            		<strong>Barang / Jasa</strong><br/>
				            		<span id="res_barang_jasa"></span>
				            	</p>
				            	<p>
				            		<strong>Layanan Tambahan</strong><br/>
				            		<span id="res_layanan_tambahan"></span>
				            	</p>
				        	</div>
				        </div>					            			
            		</div>
            		<div class="col-md-6">
						<div class="portlet light bordered">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="fa fa-phone-square"></i>
				                    <span class="caption-subject bold uppercase">Kontak</span>
				                </div>
				            </div>
				            <div class="portlet-body">
				            	<ul class="list-group">
				            		<li class="list-group-item">Email : <span id="res_kontak_email"></span></li>
				            		<li class="list-group-item">Website : <span id="res_kontak_website"></span></li>
				            		<li class="list-group-item">No Handphone : <span id="res_kontak_handphone"></span></li>
				            		<li class="list-group-item">Facebook : <span id="res_kontak_facebook"></span></li>
				            		<li class="list-group-item">Twitter : <span id="res_kontak_twitter"></span></li>
				            		<li class="list-group-item">Instagram : <span id="res_kontak_instagram"></span></li>
				            	</ul>
				        	</div>
				        </div>				            			
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-md-8">
						<div class="portlet light bordered">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="icon-list"></i>
				                    <span class="caption-subject bold uppercase">Artikel</span>
				                </div>
				            </div>
				            <div class="portlet-body">
				            	<div id="status_artikel"></div>
								<ul class="media-list" id="objek_artikel_list"></ul>
								<a class="btn btn-sm btn-info btn-block" id="res_readmore_artikel"><i class="fa fa-list"></i>&nbsp;&nbsp;Lihat Artikel Lainnya</a>
				            </div>
				        </div>	
						<div class="portlet light bordered">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="icon-picture"></i>
				                    <span class="caption-subject bold uppercase">Foto</span>
				                </div>
				            </div>
				            <div class="portlet-body">
				            	<div id="status_foto"></div>
				            	<div class="row" id="objek_foto_list"></div>
								<a class="btn btn-sm btn-info btn-block" id="res_readmore_foto"><i class="fa fa-list"></i>&nbsp;&nbsp;Lihat Foto Lainnya</a>
				            </div>
				        </div>	            			
            		</div>
            		<div class="col-md-4">
						<div class="portlet light bordered">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="icon-target"></i>
				                    <span class="caption-subject bold uppercase">Terdekat</span>
				                </div>
				            </div>
				            <div class="portlet-body">
								<ul class="media-list" id="objek_terdekat_list">
                                </ul>
				            </div>
				        </div>	            			
            		</div>
            	</div>
            </div>
            <div class="modal-footer hidden-xs hidden-sm">
                <button type="button" class="btn btn-info button-bagikan-halaman-objek" data-dismiss="modal">
                    <i class="fa fa-share"></i>&nbsp;<span class="hidden-xs hidden-sm">Bagikan</span>
                </button>
            	<a href="" class="btn btn-info button-goto-halaman-objek">
                    <i class="fa fa-newspaper-o"></i>&nbsp;<span class="hidden-xs hidden-sm">Lihat Selengkapnya</span>
            	</a>
                <button type="button" class="btn btn-info button-informasi-petunjuk-arah" data-dismiss="modal">
                    <i class="fa fa-map-signs"></i>&nbsp;<span class="hidden-xs hidden-sm">Petunjuk Arah</span>
                </button>
                <button type="button" class="btn default" data-dismiss="modal">
                    <i class="fa fa-times"></i>&nbsp;<span class="hidden-xs hidden-sm">Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	var map_single, myLatLng;

	function informasiObjek(id, index)
	{
		var STREETVIEW_MAX_DISTANCE = 100;
		var panorama;

        App.blockUI({target: "#map", animate: !0});
        $.ajax({
        	url 		: "<?=site_url('API/objek/detail')?>/" + id,
        	method		: "POST",
        	dataType	: "json",
        	success		: function(result)
        	{
        		var artikel = '', foto = '';

        		$('#objek_artikel_list').html('');
        		$('#objek_foto_list').html('');
        		$('#objek_terdekat_list').html('');
		        App.unblockUI("#map");
		        if(result.status == '200')
		        {
		        	var url_page_objek = '<?=base_url('objek/index/')?>/' + result.data.objek_id + '-' + result.data.url_seo;
					$('.button-bagikan-halaman-objek').attr({'onclick' : 'manual_show_modal_bagikan_halaman(\'' + url_page_objek + '\')'})
		        	$('.button-goto-halaman-objek').attr({'href' : url_page_objek});
		        	$('.button-informasi-petunjuk-arah').attr({'onclick' : 'petunjukArah(' + index + ')'});


	        		myLatLng 	= new google.maps.LatLng(parseFloat(result.data.lat), parseFloat(result.data.lng));

		        	// Map 
			        map_single = new google.maps.Map(document.getElementById('map_objek'), {
			            center          : myLatLng,
			            zoom            : <?=$this->config->item('map_zoom')?>,
			            zoomControl     : true,
			            mapTypeControl  : true,
			            mapTypeControlOptions: {
			                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			                position: google.maps.ControlPosition.TOP_RIGHT
			            },                    
			            scaleControl: true,
			            // streetViewControl: true,
			            rotateControl: true,
			        });	
			        marker_single  = new google.maps.Marker({
                            position    : myLatLng,
                            map         : map_single,
                            animation   : google.maps.Animation.DROP,
                            title       : result.data.nama,
                        });       
		
		        	// Panorama 
		        	if(result.data.street_view_url == null || result.data.street_view_url == '')
		        	{
						var streetViewService 	= new google.maps.StreetViewService();
						streetViewService.getPanoramaByLocation(myLatLng, STREETVIEW_MAX_DISTANCE, function (streetViewPanoramaData, status) {
						    if (status === google.maps.StreetViewStatus.OK) 
						    {
						        panorama = new google.maps.StreetViewPanorama(
						            document.getElementById('street_view'),
						            {
						              	position: myLatLng,
						              	pov: {heading: 165, pitch: 0},
						              	zoom: 1
						            }
						        );
						    } 
						    else 
						    {
						    	$('#street_view').attr({'style' : 'background-color: #000; color: #FFFFFF; text-align: center; height: 250px; padding-top: 100px;'});
						    	$('#street_view').html('<h4>Street view tidak tersedia.</h4>');
						    }
						});
		        	}
		        	else
		        	{
						$('#street_view').html('<iframe src="' + result.data.street_view_url + '" width="100%" height="250px" frameborder="0" style="border:0" allowfullscreen></iframe>');
		        	}

		        	if(result.artikel.length > 0)
		        	{
		        		$('#status_artikel').html('');
			        	$.each(result.artikel, function(k, v){
			        		var artikel = '<li class="media">';
			        		artikel 	+= '<a class="pull-left" href="' + v.link + '">';
			        		artikel 	+= '<img class="media-object thumbnails" src="' + v.foto + '" width="100px">';
			        		artikel 	+= '</a>';
			        		artikel 	+= '<div class="media-body">';
			        		artikel 	+= '<h4 class="media-heading">' + v.judul + '</h4>';
			        		artikel 	+= '<p style="margin:0px;">' + v.singkat + '</p>';
			        		artikel 	+= '<div class="btn-group">';
			        		artikel 	+= '<a class="btn btn-xs white"><i class="fa fa-user"></i>&nbsp;&nbsp;' + v.nama_kontributor + '&nbsp;&nbsp;';
			        		artikel 	+= '<i class="fa fa-calendar"></i>&nbsp;&nbsp;' + v.tgl_posting + '</a>';
			        		artikel 	+= '<a href="' + v.link + '" class="btn btn-xs btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;Baca </a>';
			        		artikel 	+= '</div>';
			        		artikel 	+= '</div><hr/>';
			        		artikel 	+= '</li>';		
			        		$('#objek_artikel_list').append(artikel);
			        	});
			        	$('#res_readmore_artikel').removeAttr('style');	        		
			        	$('#res_readmore_artikel').attr({'href' : "<?=site_url('artikel/index')?>/" + result.data.objek_id + '-' + result.data.url_seo});		        		
		        	}
		        	else
		        	{
		        		$('#status_artikel').html('<?=info_msg('Artikel Kosong.', false)?>');
			        	$('#res_readmore_artikel').attr({'style' : 'display:none'});   		
		        	}

		        	if(result.foto.length > 0)
		        	{
		        		$('#status_foto').html('');
			        	$.each(result.foto, function(k, v){
			        		var foto 	= '<div class="col-md-6">';
			        		foto 		+= '<div class="thumbnail">';
			        		foto 		+= '<img src="' + v.foto + '" style="height:200px;">';
			        		foto 		+= '<div class="caption">';
			        		foto 		+= '<h5>' + v.nama + '</h5>';
			        		foto 		+= '<p>';
			        		foto 		+= '<a class="btn btn-xs white btn-block"><i class="fa fa-user"></i>&nbsp;&nbsp;' + v.nama_kontributor + '</a>';
			        		foto 		+= '<a class="btn btn-xs white btn-block"><i class="fa fa-calendar"></i>&nbsp;&nbsp;' + v.tgl_upload + '</a>';
			        		foto 		+= '<a href="' + v.link + '" class="btn btn-xs btn-info btn-block"><i class="fa fa-eye"></i>&nbsp;&nbsp;Lihat </a>';
			        		foto 		+= '</p>';
			        		// foto 		+= '<p><a href="' + v.link + '" class="btn blue btn-block"> Lihat </a></p>';
	                        foto 		+= '</div>';
			        		foto		+= '</div>';
			        		foto 		+= '</div>';
			        		$('#objek_foto_list').append(foto);
			        	});
			        	$('#res_readmore_foto').attr({'href' : "<?=site_url('galeri/index')?>/" + result.data.objek_id + '-' + result.data.url_seo});
			        }
			        else
			        {
		        		$('#status_foto').html('<?=info_msg('Foto Kosong.', false)?>');
			        	$('#res_readmore_foto').attr({'style' : 'display:none'});   		
			        }

		        	$.each(result.terdekat, function(k, v){
		        		var terdekat = '<li class="media">';
		        		terdekat 	+= '<a class="" href="' + v.link + '">';
		        		terdekat 	+= '<img class="media-object thumbnails" src="' + v.foto + '" width="100%">';
		        		terdekat 	+= '</a>';
		        		terdekat 	+= '<div class="media-body">';
		        		terdekat 	+= '<h4 class="media-heading">' + v.nama + '</h4>';
		        		terdekat 	+= '<h5>' + v.jarak + ' km, <i class="fa fa-user"></i>&nbsp;&nbsp;' + v.nama_kontributor + '</h5>';
					   	terdekat 	+= '<a href="' + v.link + '" class="btn btn-xs btn-info btn-block">';
						terdekat 	+=	'<i class="fa fa-eye"></i>&nbsp;&nbsp;Lihat</a>';
		        		terdekat 	+= '</div><hr/>';
		        		terdekat 	+= '</li>';		
		        		$('#objek_terdekat_list').append(terdekat);
		        	});

		        	$('#res_foto').attr({'src' : result.data.foto});
		        	$('#res_info_deskripsi').html(result.data.info_deskripsi);
		        	$('#res_nama_kontributor').html(result.data.nama_kontributor);
		        	$('#res_terakhir_update').html(result.data.terakhir_update);
		        	$('#res_nama').html(result.data.nama);
		        	$('#res_nama_kategori').html(result.data.nama_kategori);
		        	$('#res_lokasi_desa').html(result.data.lokasi_desa);
		        	$('#res_kecamatan').html(result.data.lokasi_kecamatan);
		        	$('#res_lokasi_kabupaten_kota').html(result.data.lokasi_kabupaten_kota);
		        	$('#res_kontak_email').html(result.data.kontak_email);
		        	$('#res_kontak_website').html(result.data.kontak_website);
		        	$('#res_kontak_handphone').html(result.data.kontak_handphone);
		        	$('#res_kontak_facebook').html(result.data.kontak_facebook);
		        	$('#res_kontak_twitter').html(result.data.kontak_twitter);
		        	$('#res_kontak_instagram').html(result.data.kontak_instagram);

		        	if(result.data.jenis == 'objek')
		        	{
		        		$('.kontributor_area').removeAttr('style');
		        		$('.label_kontributor').html('Kontributor');
		        		$('#modal-informasi-objek-wisata .modal-title-text').html('Informasi Objek Wisata');
			        	$('#layanan_area').attr({'style' : 'display:none'});
			        	$('#fasilitas_area').removeAttr('style');
			        	$('#res_info_tiket').html(nl2br(result.data.info_tiket));
			        	$('#res_info_tempat_ibadah').html(result.data.info_tempat_ibadah);
			        	$('#res_info_penginapan').html(result.data.info_penginapan);
			        	$('#res_info_toilet').html(result.data.info_toilet);
			        	$('#res_info_akses_jalan').html(result.data.info_akses_jalan);		        		
		        	}
		        	else if(result.data.jenis == 'akomodasi')
		        	{
		        		$('.kontributor_area').attr({'style' : 'display:none'});
		        		$('.label_kontributor').html('Partner');
		        		$('#modal-informasi-objek-wisata .modal-title-text').html('Informasi Akomodasi');
			        	$('#fasilitas_area').attr({'style' : 'display:none'});
			        	$('#layanan_area').removeAttr('style');
			        	$('#res_barang_jasa').html(nl2br(result.data.akomodasi_jasa));
			        	$('#res_layanan_tambahan').html(nl2br(result.data.akomodasi_layanan_tambahan));
		        	}

		        	$('#modal-informasi-objek-wisata').modal();
		        }
        	},
        	error 		: function()
        	{
		        App.unblockUI("#map");        		
        	}
        });
	}

	$("#modal-informasi-objek-wisata").on("shown.bs.modal", function () {
	    google.maps.event.trigger(map_single, "resize");
	    map_single.setCenter(myLatLng);
	});

	function nl2br (str, is_xhtml) 
	{
    	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    	return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
	}	
</script>