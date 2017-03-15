<div id="w-petunjuk-arah" class="w-home">
    <div class="portlet light portlet_objek_wisata">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="icon-directions"></i><span class="caption-subject bold uppercase"> Petunjuk Arah</span>
	        </div>
	    </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn default btn-block" onclick="batalPetunjukArah();">
                        <i class="fa fa-angle-left"></i> Objek Wisata
                    </button>
                </div>
            </div><hr/>
            <div class="row">
                <div class="col-md-12">
                	<form role="form" onsubmit="return submitPetunjukArah();">
                		<div class="form-body hidden-xs">
        					<div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <input type="text" class="form-control" id="PetunjukLatLngAsal" readonly="readonly">
                                    <label>Titik Asal (A)</label>
                                </div>
                            </div>
        					<div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <input type="text" class="form-control" id="PetunjukNamaTujuan" readonly="readonly">
                                    <input type="hidden" class="form-control" id="PetunjukLatLngTujuan">
                                    <label>Objek Tujuan (B)</label>
                                </div>
                            </div>
                		</div>
        				<div class="form-actions noborder">
                            <button id="btn-seb-sukses" type="submit" class="btn blue btn-block">
                                <i class="fa fa-check"></i> Cari Rute
                            </button>
                            <div id="btn-set-sukses" style="display: none;">
                                <button type="button" class="btn default btn-block" onclick="resetPetunjukArah();">
                                    <i class="fa fa-refresh"></i> Reset
                                </button>
                                <button type="button" class="btn blue btn-block" onclick="$('#modal-petunjuk-arah-rute').modal();">
                                    <i class="fa fa-info"></i> Lihat Rute
                                </button>
                            </div>
                        </div>
                	</form>
                </div>
            </div>
        </div>	
    </div>
</div>

<div class="modal fade" id="modal-petunjuk-arah-rute" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn default pull-right hidden-lg hidden-md" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">
                    <span class="hidden-xs hidden-sm"><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Rute</span>&nbsp;
                </h4>
            </div>
            <div class="modal-body">
                <div  id="hasilPetunjukArah"></div>
            </div>
            <div class="modal-footer hidden-xs hidden-sm">
                <button type="button" class="btn default" data-dismiss="modal">
                    <i class="fa fa-times"></i>&nbsp;Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	var marker_posisi_saya;
	var marker_posisi_tujuan;
    var marker_posisi_tujuan_index;
	var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});    	

    function petunjukArah(index)
    {
        $('.w-home').attr({'style' : 'display:none'});
        $('#w-petunjuk-arah').removeAttr('style');

        $('#btn-set-sukses').attr({'style' : 'display:none'});
        $('#btn-seb-sukses').removeAttr('style');       

        directionsDisplay.setMap(null);
        if(marker_posisi_saya != undefined){ marker_posisi_saya.setMap(null); }
        setMapOnAll(null);

        marker_posisi_tujuan_index = index;
        marker_posisi_tujuan  = new google.maps.Marker({
                            position    : markers[index].position,
                            map         : map,
                            animation   : google.maps.Animation.DROP,
                            title       : markers[index].title,
                            icon        : markers[index].icon,
                            // icon        : 'https://mts.googleapis.com/maps/vt/icon/name=icons/spotlight/spotlight-waypoint-b.png&text=B&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=1'
                        });       
        // marker_posisi_tujuan.setMap(map);
        google.maps.event.addListener(marker_posisi_tujuan, 'click', (function(marker_posisi_tujuan) {
            return function(){
                infowindow.setPosition(marker_posisi_tujuan.position);
                infowindow.setContent(markers_info[index]);
                infowindow.open(map, marker_posisi_tujuan);
            }
        })(marker_posisi_tujuan));


        if(myloc.lat == undefined || myloc.lng == undefined)
        {
            myloc = <?=$this->config->item('map_center_coordinat')?>;
        }

        marker_posisi_saya  = new google.maps.Marker({
                            position    : myloc,
                            map         : map,
                            animation   : google.maps.Animation.DROP,
                            title       : '<center>Tentukan lokasi Anda<br/>Drag pin untuk merubah lokasi</center>',
                            draggable   : true,
                            icon        : 'https://mts.googleapis.com/maps/vt/icon/name=icons/spotlight/spotlight-waypoint-a.png&text=&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=1'
                        });       

		google.maps.event.addListener(marker_posisi_saya, 'dragend', function(evt){
			var lat = evt.latLng.lat().toFixed(3);
			var lng = evt.latLng.lng().toFixed(3);
	        $('#PetunjukLatLngAsal').val('(' + lat + ', ' + lng + ')');
            if(windowWidth > 1024)
            {
                submitPetunjukArah();
            }
		});

        google.maps.event.addListener(marker_posisi_saya, 'click', (function(marker_posisi_saya) {
            return function(){
		        infowindow.setPosition(marker_posisi_saya.position);
                infowindow.setContent(marker_posisi_saya.title);
                infowindow.open(map, marker_posisi_saya);
            }
        })(marker_posisi_saya));

        $('#PetunjukLatLngAsal').val(marker_posisi_saya.position);
        $('#PetunjukNamaTujuan').val(markers[index].title);
        $('#PetunjukLatLngTujuan').val(markers[index].position);

        infowindow.setPosition(marker_posisi_saya.position);
        infowindow.setContent(marker_posisi_saya.title);
        infowindow.open(map, marker_posisi_saya);
        map.setCenter(myloc);
    }	

    function submitPetunjukArah()
    {        
        App.blockUI({target: "#map", animate: !0});
		directionsDisplay.setMap(map);

        var input_origin 	  = $('#PetunjukLatLngAsal').val();
        var input_destination = $('#PetunjukLatLngTujuan').val();        

		directionsService.route({
          	origin 		: input_origin.replaceArray(['(', ')', ' '], ['','','']),
          	destination : input_destination.replaceArray(['(', ')', ' '], ['','','']),
          	travelMode 	: 'DRIVING'
        }, 
        function(response, status) {
	        if (status === 'OK') 
	        {
	        	$('#btn-seb-sukses').attr({'style' : 'display:none'});
	        	$('#btn-set-sukses').removeAttr('style');
				marker_posisi_saya.setMap(null);
				marker_posisi_tujuan.setMap(null);
            	directionsDisplay.setDirections(response);
                
                //Custom Window Origin
                marker_posisi_saya = new google.maps.Marker({
                                    position    : response.routes[0].legs[0].start_location,
                                    map         : map,
                                    // animation   : google.maps.Animation.DROP,
                                    title       : '<center>Tentukan lokasi Anda<br/>Drag pin untuk merubah lokasi</center>',
                                    icon        : 'https://mts.googleapis.com/maps/vt/icon/name=icons/spotlight/spotlight-waypoint-a.png&text=&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=1',
                                    draggable   : true,
                                });              

                google.maps.event.addListener(marker_posisi_saya, 'click', function() {
                    infowindow.setContent('Posisi Anda');
                    infowindow.open(map, marker_posisi_saya);
                });

                google.maps.event.addListener(marker_posisi_saya, 'dragend', function(evt){
                    if(windowWidth > 1024)
                    {
                        submitPetunjukArah();
                    }
                    else
                    {   
                        resetPetunjukArah();
                    }

                    var lat = evt.latLng.lat().toFixed(3);
                    var lng = evt.latLng.lng().toFixed(3);
                    $('#PetunjukLatLngAsal').val('(' + lat + ', ' + lng + ')');
                });

                //Custom Window Dest
                marker_posisi_tujuan = new google.maps.Marker({
                                    position    : response.routes[0].legs[0].end_location,
                                    map         : map,
                                    title       : markers_info[marker_posisi_tujuan_index].title,
                                    icon        : markers[marker_posisi_tujuan_index].icon
                                    // icon        : 'https://mts.googleapis.com/maps/vt/icon/name=icons/spotlight/spotlight-waypoint-b.png&text=B&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=1'
                                });    

                google.maps.event.addListener(marker_posisi_tujuan, 'click', function() {
                    infowindow.setContent(markers_info[marker_posisi_tujuan_index]);
                    infowindow.open(map, marker_posisi_tujuan);
                });

				directionsDisplay.setPanel(document.getElementById('hasilPetunjukArah'));
          	} 
          	else 
          	{
                $('#hasilPetunjukArah').html('<h5>Rute tidak ditemukan. Status :' + status + '</h5>');
                $('#modal-petunjuk-arah-rute').modal();
          	}
            App.unblockUI("#map");
        });  
        return false;      
    }

    function resetPetunjukArah()
    {
		directionsDisplay.setMap(null);
		marker_posisi_saya.setMap(map);
		marker_posisi_tujuan.setMap(map);
    	$('#btn-set-sukses').attr({'style' : 'display:none'});
    	$('#btn-seb-sukses').removeAttr('style');    	
    }

    function batalPetunjukArah()
    {
		directionsDisplay.setMap(null);
        marker_posisi_tujuan.setMap(null);
		marker_posisi_saya.setMap(null);
		marker_posisi_saya = undefined;
		setMapOnAll(map);

        latlngbounds = new google.maps.LatLngBounds();
        LatLngList.forEach(function(latLng){
            latlngbounds.extend(latLng);
        });                    
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds); 

        $('#btn-set-sukses').attr({'style' : 'display:none'});
        $('#btn-seb-sukses').removeAttr('style');       

        $('.w-home').attr({'style' : 'display:none'});
        $('#w-cari-objek').removeAttr('style');
    }

	String.prototype.replaceArray = function(find, replace){
 		var replaceString = this;
  		for (var i = 0; i < find.length; i++) {
    		replaceString = replaceString.replace(find[i], replace[i]);
  		}
	  	return replaceString;
	};    
</script>