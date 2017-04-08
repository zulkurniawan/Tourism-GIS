<div id="w-cari-objek" class="w-home">
    <div class="portlet light portlet_objek_wisata">
        <div class="portlet-body form">        
            <form role="form" onsubmit="return cariData();" autocomplete="off" class="hidden-sm hidden-xs">
                <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0 0 25px;">
                    <div class="input-icon">
                        <input type="text" class="form-control" id="keyword_objek">
                        <label>Pencarian</label>
                        <i class="fa fa-search"></i>
                        <span class="help-block">Tekan "Enter" untuk mulai pencarian</span>
                    </div>
                </div>
            </form>
            <div class="panel-group accordion scrollable" id="mob_panel_kategori">
                <div class="panel panel-default" id="mob_panel_kategori_parent">
                    <div class="panel-heading hidden-md hidden-lg">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#mob_panel_kategori" href="#mob_panel_kategori_list"> 
                                <h5>
                                    <strong><i class="fa fa-bars"></i>&nbsp;&nbsp;Objek</strong> 
                                    <span class="jml_objek_master">
                                        <button type="button" class="btn white btn-block btn-xs" id="jml_all_objek"></button>
                                    </span>
                                </h5>
                            </a>
                        </h4>
                    </div>
                    <form role="form" onsubmit="return cariData();" autocomplete="off" class="hidden-md hidden-lg" id="pencarian_mobile" style="display: none;">
                        <div style="margin: 10px 0 10px;">
                            <div class="form-group" style="margin-bottom: 5px;">
                                <div class="input-icon">
                                    <i class="fa fa-search"></i>
                                    <input type="text" class="form-control" id="keyword_objek_mobile" placeholder="Pencarian ...">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="mob_panel_kategori_list" class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="panel-group accordion scrollable" style="margin-bottom: 0px;">
                                <!-- Templates -->
                                <div class="panel panel-default" id="panel_kategori_0" style="display: none;">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#acc_list_objek" href="#body_kategori_0" id="link_kategori_0"> 
                                                Collapsible Group Item #2 
                                                <span class="jml_objek">0</span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="body_kategori_0" class="panel-collapse collapse">
                                        <div class="panel-body"></div>
                                    </div>
                                </div>
                                <!-- End Of Templates -->
                                <div  id="acc_list_objek">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden-lg hidden-md" style="margin-top: 5px; display: none;" id="tombol_info_mobile">
                    <div class="btn-group btn-group-justified">
                        <a href="#modal-info-kontributor" class="btn btn-sm" role="button" data-toggle="modal">
                            <i class="fa fa-user"></i>&nbsp;&nbsp;Kontributor 
                        </a>
                        <a href="http://lewatlawet.com/" class="btn btn-sm" target="_blank"> 
                            <i class="fa fa-gift"></i>&nbsp;&nbsp;Merchandise 
                        </a>
                    </div>        
                    <div class="btn-group btn-group-justified">
                        <a href="#modal-info-tentang" class="btn btn-sm" role="button" data-toggle="modal">
                            <i class="fa fa-building"></i>&nbsp;&nbsp;Tentang 
                        </a>
                        <a href="#modal-info-hubungi" class="btn btn-sm" role="button" data-toggle="modal">
                            <i class="fa fa-phone"></i>&nbsp;&nbsp;Hubungi 
                        </a>
                    </div>        
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-cari-objek" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn default pull-right hidden-lg hidden-md" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title"><i class="icon-info"></i>&nbsp;&nbsp;&nbsp;Informasi</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn blue" data-dismiss="modal">
                    <i class="fa fa-times"></i>&nbsp;Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // if(windowWidth < 1024)
    // {
        $('#mob_panel_kategori_parent').on('show.bs.collapse', function () {
            $('#pencarian_mobile').removeAttr('style');
            $('#tombol_info_mobile').removeAttr('style');
            $('#tombol_info_mobile').attr({'style' : 'margin-top: 5px;'});
        });
        $('#mob_panel_kategori_parent').on('hide.bs.collapse', function (e) {
            if(e.target.id == 'mob_panel_kategori_list')
            {
                $( "#pencarian_mobile" ).slideUp(500, function() {
                    $('#pencarian_mobile').attr({'style' : 'display:none'});
                });            
                $( "#tombol_info_mobile" ).slideUp(500, function() {
                    $('#tombol_info_mobile').attr({'style' : 'display:none'});
                });            
            }
        });
    // }

    var windowWidth = $(window).width();
    var windowHeight = $(window).height();
    var kategori_show   = [];
    var group_show      = [];

    function cariData(method)
    {
        $('#jml_all_objek').html('0');
        $('.w-home').attr({'style' : 'display:none'});
        $('#w-cari-objek').removeAttr('style');

        $('#modal-cari-objek .modal-body').html('');
        App.blockUI({target: "#map", animate: !0});
        deleteMarkers();
        directionsDisplay.setMap(null);

        /* Remove Last Data */
        var $div    = $('div[id^="panel_kategori_"]:last'); 
        var cur_num = parseInt($div.prop("id").match(/\d+/g), 10);
        for(var i = cur_num; i > 0; i--)
        {
            $('#panel_kategori_' + i).remove();            
        }
        $('.akomodasi_label_cari').remove();
        /* End Of Last Data */

        var keyword = $('#keyword_objek').val();
        if(keyword == '')
        {
            keyword = $('#keyword_objek_mobile').val();            
        }

        $.ajax({
            url         : "<?=site_url('API/objek/get_data')?>",
            method      : "POST",
            dataType    : "json",
            data        : "keyword=" + keyword,
            success     : function(result)
            {
                if(result.status == '200')
                {
                    var show_akomodasi = false;
                    var show_objek = false;
                    var i = 0;
                    var all = 0;
                    $.each(result.data, function(kex, x){

                        if(x.jenis == 'akomodasi' && show_akomodasi == false)
                        {
                            show_akomodasi = true;
                            // var str_akomodasi   = '<h5 class="akomodasi_label_cari"><hr/><strong>Akomodasi</strong></h5>';
                            // $('#acc_list_objek').append(str_akomodasi);
                            var str_akomodasi_link  =   '<strong>Akomodasi</strong>' +
                                                        '<span class="jml_objek" style="margin-top: 0px;">' +
                                                            // '<div class="btn-group btn-group-xs btn-group-justified">' +
                                                                // '<button type="button" class="btn white">' + x.jml_data + '</button>' +
                                                                '<button type="button" class="btn red btn-xs btn-block" id="btn_hide_show" onclick="show_hide_jenis(\'' + x.jenis + '\')"><i class="fa fa-eye-slash" style="margin: 0px;"></i></button>' +
                                                            // '</div>' +
                                                        '</span>';

                            var str_akomodasi   = '<hr/>';
                            str_akomodasi       += '<div class="panel panel-default" id="akomodasi_header">' +
                                                        '<div class="panel-heading" style="background-color: #FFFFFF; margin-bottom: 20px;">' +
                                                            '<h4 class="panel-title">' +
                                                                '<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#acc_list_objek" href="#body_akomodasi_header" id="link_akomodasi_header">' + str_akomodasi_link + '</a>' +
                                                            '</h4>' +
                                                        '</div>';
                                                    '</div>';
                            $('#acc_list_objek').append(str_akomodasi);

                            group_show[x.jenis] = false; //default tidak tampil
                        }
                        else if(x.jenis == 'objek' && show_objek == false)
                        {
                            show_objek = true;
                            // var str_akomodasi   = '<h5 class="akomodasi_label_cari"><hr/><strong>Akomodasi</strong></h5>';
                            // $('#acc_list_objek').append(str_akomodasi);
                            var str_objek_link  =   '<strong>Objek Wisata</strong>' +
                                                        '<span class="jml_objek" style="margin-top: 0px;">' +
                                                            // '<div class="btn-group btn-group-xs btn-group-justified">' +
                                                                // '<button type="button" class="btn white">' + x.jml_data + '</button>' +
                                                                '<button type="button" class="btn btn-info btn-xs btn-block" id="btn_hide_show" onclick="show_hide_jenis(\'' + x.jenis + '\')"><i class="fa fa-eye" style="margin: 0px;"></i></button>' +
                                                            // '</div>' +
                                                        '</span>';

                            var str_objek   = '<div class="panel panel-default" id="objek_header" style="margin-bottom: 10px;">' +
                                                        '<div class="panel-heading" style="background-color: #FFFFFF;">' +
                                                            '<h4 class="panel-title">' +
                                                                '<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#acc_list_objek" href="#body_objek_header" id="link_objek_header">' + str_objek_link + '</a>' +
                                                            '</h4>' +
                                                        '</div>';
                                                    '</div>';
                            $('#acc_list_objek').append(str_objek);

                            group_show[x.jenis] = true; //default tampil
                        }

                        /* Panel Template */
                        var $div    = $('div[id^="panel_kategori_"]:last'); 
                        var cur_num = parseInt($div.prop("id").match(/\d+/g), 10);
                        var num     = cur_num + 1;                        
                        kategori_show[num] = true;

                        var $klon   = $div.clone().prop('id', 'panel_kategori_' + num).appendTo("#acc_list_objek");
                        $('#panel_kategori_' + num + ' #link_kategori_' + cur_num).attr({'id' : 'link_kategori_' + num, 'href' : '#body_kategori_' + num});
                       
                        var str_kategori_link = '<img src="' + x.marker_path + '" style="margin-right: 10px; height: 35px;"><span class="nama_kategori_objek">' + x.nama_kategori + '</span>';
                        if(x.jenis == 'akomodasi')
                        {
                            str_kategori_link   += '<span class="jml_objek">' +
                                                        // '<div class="btn-group btn-group-xs btn-group-justified">' +
                                                            '<button type="button" class="btn white btn-xs btn-block">' + x.jml_data + '</button>' +
                                                            // '<button type="button" class="btn btn-info" id="btn_hide_show" onclick="show_hide_kategori(' + num + ')"><i class="fa fa-eye"></i></button>' +
                                                        // '</div>' +
                                                   '</span>';
                        }
                        else if(x.jenis == 'objek')
                        {
                            str_kategori_link   += '<span class="jml_objek">' +
                                                        '<div class="btn-group btn-group-xs btn-group-justified">' +
                                                            '<button type="button" class="btn white">' + x.jml_data + '</button>' +
                                                            '<button type="button" class="btn btn-info" id="btn_hide_show" onclick="show_hide_kategori(' + num + ')"><i class="fa fa-eye"></i></button>' +
                                                        '</div>' +
                                                   '</span>';
                        }


                        // $('#panel_kategori_' + num + ' #link_kategori_' + num).html('<img src="' + x.marker_path + '" style="margin-right: 10px; width: 20px;">' + x.nama_kategori + '<span class="jml_objek">' + x.jml_data + '</span>');
                        $('#panel_kategori_' + num + ' #link_kategori_' + num).html(str_kategori_link);
                        $('#panel_kategori_' + num + ' #link_kategori_' + num).attr({'class' : 'is_' + x.jenis + '_item'})
                        $('#panel_kategori_' + num + ' #body_kategori_' + cur_num).attr({'id' : 'body_kategori_' + num});
                        $('#panel_kategori_' + num).removeAttr('style');
                        /* End Of Panel Template */

                        /* Marker */
                        var objek_info = '<div class="list-group">';
                        $.each(x.data, function(key, y){

                            var latLng      = new google.maps.LatLng(y.lat, y.lng);
                            LatLngList[i]   = latLng; 

                            marker  = new google.maps.Marker({
                                                position    : latLng,
                                                map         : map,
                                                animation   : google.maps.Animation.DROP,
                                                title       : y.nama,
                                                icon        : x.marker_path,
                                                jenis       : x.jenis,
                                                kategori    : num,
                                                // label       : y.nama,
                                            });       
                            markers.push(marker);
                            marker_index = (markers.length - 1);
                            
                            /* Marker Info */
                            var info     = '<div class="text-center"><img src="' + y.foto + '" class="thumbnails" width="150px"><br/>';
                            info    += '<strong>' + y.nama + '</strong></div><hr style="margin: 5px 0px;"/>';
                            info    += '<button class="btn btn-block blue btn-sm" onclick="petunjukArah(' + marker_index + ')"><i class="fa fa-map-signs"></i> Petunjuk Arah</button>';
                            info    += '<button class="btn btn-block blue btn-sm" onclick="informasiObjek(' + y.objek_id + ',' + marker_index + ')"><i class="fa fa-info"></i> Informasi Objek</button>';
                            /* End Of Marker Info */

                            markers_info.push(info);

                            /* Marker Add To List */
                            objek_info += '<a onclick="fokusObjek(\'' + marker_index + '\')" class="list-group-item">';
                            objek_info += '<h5 class="list-group-item-heading"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;' + y.nama + '</h5>';
                            /* End Of Add To List */
                            
                            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                return function(){
                                    infowindow.setContent(info);
                                    infowindow.open(map, marker);
                                    map.setCenter(marker.getPosition());                                        
                                }
                            })(marker, i));
                            marker.setMap(map);
                            i++;
                            all++;
                        });
                        objek_info += '</div>';
                        $('#panel_kategori_' + num + ' #body_kategori_' + num).html(objek_info);
                        /* End Of Marker */

                        $('#jml_all_objek').html(all);

                        if(x.jenis == 'akomodasi')
                        {
                            $('.is_akomodasi_item').attr({'style' : 'display:none'});
                            show_hide_kategori(num);   
                        }
                    });

                    latlngbounds = new google.maps.LatLngBounds();
                    LatLngList.forEach(function(latLng){
                        latlngbounds.extend(latLng);
                    });                    
                    map.setCenter(latlngbounds.getCenter());
                    map.fitBounds(latlngbounds); 

                    if(method != 'auto')
                    {                        
                        $('#mob_panel_kategori').collapse('show');
                    }

                }                    
                else
                {
                    $('#modal-cari-objek .modal-body').html('<h4>' + result.msg + '</h4>');
                    $('#modal-cari-objek').modal();
                }
                App.unblockUI("#map");
            },
            error       : function()
            {
                App.unblockUI("#map");                
            }
        });  
        return false;
    }    

    function fokusObjek(index)
    {
        infowindow.setContent(markers_info[index]);
        infowindow.open(map, markers[index]);

        if(windowWidth <= 1024)
        {
            $( "#pencarian_mobile" ).slideUp(500, function() {
                $('#pencarian_mobile').attr({'style' : 'display:none'});
            });            
            $( "#tombol_info_mobile" ).slideUp(500, function() {
                $('#tombol_info_mobile').attr({'style' : 'display:none'});
            });            
            $('#mob_panel_kategori_list').removeClass('in')
        }
        map.setCenter(markers[index].getPosition());
    }

    function set_list_objek_mobile()
    {
        if(windowWidth <= 1024)
        {
            $('#mob_panel_kategori_list').removeClass('in')
        }
        else
        {
            $('#mob_panel_kategori_list').addClass('in');
        }        
    }

    function show_hide_jenis(jenis)
    {
        if(group_show[jenis] == true)
        {
            if(jenis == 'akomodasi')
            {
                $('.is_akomodasi_item').attr({'style' : 'display:none'});
            }
            group_show[jenis] = false;   

            for (var i = 0; i < markers.length; i++) 
            {
                if(markers[i].jenis == jenis)
                {
                    markers[i].setMap(null);
                }
            }

            $('#' + jenis + '_header #btn_hide_show').attr({'class' : 'btn red btn-xs btn-block'});
            $('#' + jenis + '_header #btn_hide_show').html('<i class="fa fa-eye-slash"></i>');
        }
        else
        {
            if(jenis == 'akomodasi')
            {
                $('.is_akomodasi_item').removeAttr('style');                
            }
            group_show[jenis] = true;
            for (var i = 0; i < markers.length; i++) 
            {
                if(markers[i].jenis == jenis)
                {
                    markers[i].setMap(map);
                }

            }
            $('#' + jenis + '_header #btn_hide_show').attr({'class' : 'btn btn-info btn-xs btn-block'});
            $('#' + jenis + '_header #btn_hide_show').html('<i class="fa fa-eye"></i>');
        }

        latlngbounds = new google.maps.LatLngBounds();
        LatLngList.forEach(function(latLng){
            latlngbounds.extend(latLng);
        });                    
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds); 
    }

    function show_hide_kategori(key)
    {
        if(kategori_show[key] == true)
        {
            kategori_show[key] = false;   

            for (var i = 0; i < markers.length; i++) 
            {
                if(markers[i].kategori == key)
                {
                    markers[i].setMap(null);
                }
            }

            $('#panel_kategori_' + key + ' #btn_hide_show').attr({'class' : 'btn red'});
            $('#panel_kategori_' + key + ' #btn_hide_show').html('<i class="fa fa-eye-slash"></i>');
        }
        else
        {
            kategori_show[key] = true;
            for (var i = 0; i < markers.length; i++) 
            {
                if(markers[i].kategori == key)
                {
                    markers[i].setMap(map);
                }
            }

            $('#panel_kategori_' + key + ' #btn_hide_show').attr({'class' : 'btn btn-info'});
            $('#panel_kategori_' + key + ' #btn_hide_show').html('<i class="fa fa-eye"></i>');
        }
        
        $("#body_kategori_" + key).collapse('hide');

        latlngbounds = new google.maps.LatLngBounds();
        LatLngList.forEach(function(latLng){
            latlngbounds.extend(latLng);
        });                    
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds); 
    }

    // if(windowWidth < 1024)
    // {
    //     $( window ).resize(function(){
    //        $( "#pencarian_mobile" ).slideDown(500, function() {
    //             // $('#pencarian_mobile').attr({'style' : 'display:none'});
    //         });            
    //     });
    //     // $('#mob_panel_kategori_list').on('show.bs.collapse', function () {
    //     //     $('#mob_panel_kategori_list .in').collapse('hide');
    //     // });
    // }


    $(document).ready(function() {
        cariData('auto');
        set_list_objek_mobile();

        $(window).resize(function(){
            set_list_objek_mobile();

            if(windowWidth < 1024)
            {
                if($('#mob_panel_kategori_list .panel-collapse collapse in').length > 0)
                {
                    $( "#pencarian_mobile" ).slideDown(500, function() {
                        // $('#pencarian_mobile').attr({'style' : 'display:none'});
                    });                                
                }
            }

            // $( "#pencarian_mobile" ).slideUp(500, function() {
            //     $('#pencarian_mobile').attr({'style' : 'display:none'});
            // });            
            $( "#tombol_info_mobile" ).slideUp(500, function() {
                $('#tombol_info_mobile').attr({'style' : 'display:none'});
            });                        
        });

        if(windowHeight < 500)
        {
            $('#acc_list_objek').attr({'style' : 'height:250px;'});            
        }
    });
</script>