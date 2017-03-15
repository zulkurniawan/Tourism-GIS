<div class="row">
	<div class="col-md-12">
	   <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-line-chart "></i>&nbsp;&nbsp;
                    <span class="caption-subject sbold uppercase">Akomodasi <?=$data_objek->nama?></span>
                </div>
            </div>
            <div class="portlet-body">
                <a href="<?=site_url('panel/statistik_akomodasi')?>" class="btn blue">
                    <i class="fa fa-history"></i>&nbsp;Kembali
                </a>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-inline" action="<?=site_url('panel/statistik_akomodasi/detail/' . $data_objek->objek_id)?>" method="GET">
                            <div class="form-group form-md-line-input">
                                <label class="control-label">Mulai Tanggal</label>
                                <div class="">             
                                    <div class="input-group date form_datetime">
                                        <input type="text" class="form-control" name="mulai" readonly="readonly" value="<?=$tgl_mulai?>">
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
                                <label class="control-label">Sampai</label>
                                <div class="">             
                                    <div class="input-group date form_datetime">
                                        <input type="text" class="form-control" name="sampai" readonly="readonly" value="<?=$tgl_selesai?>">
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
                                <label class="control-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i>&nbsp;&nbsp;Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <div id="chart_2"></div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Tentang Objek</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-2">Desa</td>
                                    <td><?=$data_objek->lokasi_desa?></td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td><?=$data_objek->lokasi_kecamatan?></td>
                                </tr>
                                <tr>
                                    <td>Sekilas</td>
                                    <td><?=$data_objek->info_deskripsi?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>	
	</div>
</div>

<link href="<?=base_url()?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/highcharts/js/highcharts.js')?>"></script>
<script type="text/javascript">
    $(function () {
        $(".form_datetime").datepicker({
            autoclose: true,
            isRTL: App.isRTL(),
            format: "dd-mm-yyyy",
            pickerPosition: App.isRTL() ? "bottom-right" : "bottom-left"
        });

        $('#chart_2').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Statistik <?=$tgl_mulai?> s/d <?=$tgl_selesai?>'
            },
            subtitle: {
                // text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: [
                                <?php 
                                    $i = 1; 
                                    foreach($list_tanggal as $key => $c)
                                    { 
                                        echo "'" . date('d-m-Y', strtotime($c)) . "'";
                                        echo ($i < count($list_tanggal) ? ',' : ''); 
                                        $i++; 
                                    } 
                                ?>
                            ]
            },
            yAxis: {
                title: {
                    text: 'Total'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: '<i>Page View</i>',
                data:   [
                            <?php 
                                $i = 1; 
                                foreach($list_tanggal as $key => $c)
                                { 
                                    $jml = 0;
                                    if(!empty($data_view_objek[$c]))
                                    {
                                        $jml = $data_view_objek[$c];
                                    }
                                    else
                                    {
                                        continue;
                                    }
                                    echo $jml;
                                    echo ($i < count($list_tanggal) ? ',' : ''); 
                                    $i++; 
                                } 
                            ?>
                        ]
            }, {
                name: 'Pengunjung Baru',
                data:   [
                            <?php 
                                $i = 1; 
                                foreach($list_tanggal as $key => $c)
                                { 
                                    $jml = 0;
                                    if(!empty($data_view_unik_visitor[$c]))
                                    {
                                        $jml = $data_view_unik_visitor[$c];
                                    }
                                    else
                                    {
                                        continue;
                                    }
                                    echo $jml;
                                    echo ($i < count($list_tanggal) ? ',' : ''); 
                                    $i++; 
                                } 
                            ?>
                        ]
            }]
        });
    });    
</script>