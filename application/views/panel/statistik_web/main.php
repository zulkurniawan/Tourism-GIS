<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Statistik Web</span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="row">         			
            		<div class="col-md-6 col-md-offset-6">
		           		<form method="GET" action="<?=site_url('panel/statistik_web')?>">
		           			<h4>Periode Statistik</h4>
		           			<div class="row">
		           				<div class="col-md-9 col-xs-12" style="margin-bottom: 10px;">
									<div class="input-group input-large date-picker input-daterange" data-date="10-12-2012" data-date-format="dd-mm-yyyy">
                                        <input type="text" class="form-control" name="awal" value="<?=$awal?>">
                                        <span class="input-group-addon"> - </span>
                                        <input type="text" class="form-control" name="akhir" value="<?=$akhir?>"> 
                                    </div>
		           				</div>
			                  	<div class="col-md-3">
	                                <button class="btn green btn-block" type="submit">Filter !</button>
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
                <div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="col-md-2">Tanggal</th>
								<th class="">Hari</th>
								<th class="col-md-2 text-center">Pengunjung Baru</th>
								<th class="col-md-2 text-center">Total Pengunjung</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $key => $c): ?>
								<tr>
									<td><?=date('d-m-Y', strtotime($c->waktu))?></td>	
									<td><?=hari_indonesia($c->hari)?></td>	
									<td class="text-center"><?=empty($c->jml_visitor_unik) ? 0 : $c->jml_visitor_unik?></td>	
									<td class="text-center"><?=empty($c->jml_visitor) ? 0 : $c->jml_visitor?></td>	
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>

<link href="<?=base_url()?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/highcharts/js/highcharts.js')?>"></script>

<script type="text/javascript">
	$(".date-picker").datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: !0
    })	;

    $(function () {
        $('#chart_2').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Statistik <?=$awal?> s/d <?=$akhir?>'
            },
            subtitle: {
                // text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: [
                                <?php 
                                    $i = 1; 
                                    foreach($data as $key => $c)
                                    { 
                                    	echo "'" . date('d-m-Y', strtotime($c->waktu)) . "'";
                                        echo ($i < count($data) ? ',' : ''); 
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
                name: '<i>Pengunjung</i>',
                data:   [
                            <?php 
                                $i = 1; 
                                foreach($data as $key => $c)
                                { 
                                    $jml = 0;
									echo empty($c->jml_visitor) ? 0 : $c->jml_visitor;
                                    echo ($i < count($data) ? ',' : ''); 
                                    $i++; 
                                } 
                            ?>
                        ]
            }, {
                name: 'Pengunjung Baru',
                data:   [
                            <?php 
                                $i = 1; 
                                foreach($data as $key => $c)
                                { 
                                    $jml = 0;
									echo empty($c->jml_visitor_unik) ? 0 : $c->jml_visitor_unik;
                                    echo ($i < count($data) ? ',' : ''); 
                                    $i++; 
                                } 
                            ?>
                        ]
            }]
        });
    });    

</script>





