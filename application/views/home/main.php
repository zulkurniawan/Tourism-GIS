<!--<div id="map"></div>-->
<div id="map"></div>

<div id="page">
    <?php if(!empty($msg)){ ?>
        <div class="col-md-12 hidden-xs">
            <?php  echo $msg; ?>
        </div>
    <?php } ?>
    <div class="col-md-4 col-lg-3 col-sm-5 home-content">
    <!--    <?php if(!empty($login_status)){ ?>
            <a href="<?=site_url('panel/dashboard')?>" class="btn btn-info btn-block hidden-md hidden-lg"> 
                Masuk Panel&nbsp;<i class="fa fa-sign-in"></i>
            </a>
        <?php } ?> -->
        <?php $this->load->view('home/widget_cari_objek'); ?>
    	<?php $this->load->view('home/widget_petunjuk_arah'); ?>
        <?php $this->load->view('home/widget_informasi_objek'); ?>
        <?php $this->load->view('home/widget_info'); ?>
    </div> 
</div>

<script type="text/javascript">
    var map, myloc = {};
    $(document).ready(function(){
        map = new google.maps.Map(document.getElementById('map'), {
            styles		: myStyles,
            center          : <?=$this->config->item('map_center_coordinat')?>,
            zoom            : <?=$this->config->item('map_zoom')?>,
            mapTypeControl  : true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.BOTTOM_LEFT
            },
            mapTypeId	    : 'roadmap',
            streetViewControl	: false, 
            streetViewControlOptions: { 
	        position: google.maps.ControlPosition.TOP_LEFT 
    	    }, 
            fullscreenControl	: false,
            fullscreenControlOptions: {
            	position: google.maps.ControlPosition.LEFT_TOP
            },
            zoomControl     : true,
            zoomControlOptions	: {
        	position: google.maps.ControlPosition.LEFT_BOTTOM
    	    },
            scaleControl	: false,
            rotateControl	: false
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
    	markers_info 	 = [], 
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

    var myStyles =[
    {
        featureType: "administrative",
        stylers: [
            {
                visibility: "off"
            }
        ]
    },
    {
        featureType: "poi",
        stylers: [
            {
                visibility: "simplified"
            }
        ]
    },
    {
        featureType: "road",
        elementType: "labels",
        stylers: [
            {
                visibility: "simplified"
            }
        ]
    },
    {
        featureType: "water",
        stylers: [
            {
                visibility: "simplified"
            }
        ]
    },
    {
        featureType: "transit",
        stylers: [
            {
                visibility: "simplified"
            }
        ]
    },
    {
        featureType: "landscape",
        stylers: [
            {
                visibility: "simplified"
            }
        ]
    },
    {
        featureType: "road.highway",
        stylers: [
            {
                visibility: "off"
            }
        ]
    },
    {
        featureType: "road.local",
        stylers: [
            {
                visibility: "on"
            }
        ]
    },
    {
        featureType: "road.highway",
        elementType: "geometry",
        stylers: [
            {
                visibility: "on"
            }
        ]
    },
    {
        featureType: "water",
        stylers: [
            {
                color: "#84afa3"
            },
            {
                lightness: 52
            }
        ]
    },
    {
        stylers: [
            {
                saturation: -17
            },
            {
                gamma: 0.36
            }
        ]
    },
    {
        featureType: "transit.line",
        elementType: "geometry",
        stylers: [
            {
                color: "#3f518c"
            }
        ]
    },
    {
      	    featureType: "poi",
    	    elementType: "labels",
    	    stylers: [{ visibility: "off" }]
    }
];

</script>
          
