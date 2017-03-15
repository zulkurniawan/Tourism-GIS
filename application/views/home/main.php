<div id="map"></div>
<div id="page">
    <?php if(!empty($msg)){ ?>
        <div class="col-md-12 hidden-xs">
            <?php  echo $msg; ?>
        </div>
    <?php } ?>
    <div class="col-md-4 col-lg-3 col-sm-5 home-content">
        <?php if(!empty($login_status)){ ?>
            <a href="<?=site_url('panel/dashboard')?>" class="btn btn-info btn-block hidden-md hidden-lg"> 
                Masuk Panel&nbsp;<i class="fa fa-sign-in"></i>
            </a>
        <?php } ?>
    	<?php $this->load->view('home/widget_cari_objek'); ?>
    	<?php $this->load->view('home/widget_petunjuk_arah'); ?>
        <?php $this->load->view('home/widget_informasi_objek'); ?>
        <?php $this->load->view('home/widget_info'); ?>
    </div> 
</div>
<script type="text/javascript">
    var myStyles =[
	  {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
          {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
          {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
          {
            featureType: 'administrative',
            elementType: 'geometry.stroke',
            stylers: [{color: '#c9b2a6'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'geometry.stroke',
            stylers: [{color: '#dcd2be'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'labels.text.fill',
            stylers: [{color: '#ae9e90'}]
          },
          {
            featureType: 'landscape.natural',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
	  {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#f5f1e6'}]
          },
          {
            featureType: 'road.arterial',
            elementType: 'geometry',
            stylers: [{color: '#fdfcf8'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#f8c967'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [{color: '#e9bc62'}]
          },
          {
            featureType: 'road.highway.controlled_access',
            elementType: 'geometry',
            stylers: [{color: '#e98d58'}]
          },
          {
            featureType: 'road.highway.controlled_access',
            elementType: 'geometry.stroke',
            stylers: [{color: '#db8555'}]
          },
          {
            featureType: 'road.local',
            elementType: 'labels.text.fill',
            stylers: [{color: '#806b63'}]
          },
	  {
            featureType: 'transit.line',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'labels.text.fill',
            stylers: [{color: '#8f7d77'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'labels.text.stroke',
            stylers: [{color: '#ebe3cd'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
	  {
            featureType: 'water',
            elementType: 'geometry.fill',
            stylers: [{color: '#b9d3c2'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#92998d'}]
          },
          {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#93817c'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry.fill',
            stylers: [{color: '#a5b076'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#447530'}]
          },

    	  {
      	    featureType: "poi",
	    elementType: "labels",
	    stylers: [{ visibility: "off" }]
    	  }
    
];


    var map, myloc = {};
    $(document).ready(function(){
        map = new google.maps.Map(document.getElementById('map'), {
            mapTypeId	    : 'terrain',
            mapTypeControl  : true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                position: google.maps.ControlPosition.TOP_RIGHT
            },
            fullscreenControl	: true,
            fullscreenControlOptions: {
            	position: google.maps.ControlPosition.RIGHT_TOP
            },
            streetViewControl	: true,
            streetViewControlOptions: {
	        position: google.maps.ControlPosition.RIGHT_CENTER
    	    },
            center          : <?=$this->config->item('map_center_coordinat')?>,
            zoom            : <?=$this->config->item('map_zoom')?>,
            zoomControl     : true,
            zoomControlOptions	: {
        	position: google.maps.ControlPosition.RIGHT_CENTER
    	    },
            scaleControl	: true,
            rotateControl	: true,
            styles		: myStyles
        });

        if (navigator.geolocation) 
        {
            navigator.geolocation.getCurrentPosition(function(position) {
                myloc = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

            }, function() {
                // handleLocationError(true, infoWindow, map.getCenter());
            });
        }
    });

    var markers 	 = [], 
    	markers_info = [], 
    	LatLngList 	 = [], 
    	infowindow 	 = new google.maps.InfoWindow();	

    function setMapOnAll(map) 
    {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    function deleteMarkers() 
    {
        setMapOnAll(null);
        markers         = [];
        markers_info    = [];
        LatLngList      = [];
    }    

</script>