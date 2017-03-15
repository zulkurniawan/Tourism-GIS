<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Statistik Objek</span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="row">
            		<div class="col-md-4">
            			<h4>&nbsp;</h4>
            			<button onclick="load_grafik();" class="btn btn-info">
            				<i class="fa fa-bar-chart"></i>&nbsp;Grafik
            			</button>
            		</div>         			
            		<div class="col-md-8">
            			<h4>Cari Data</h4>
		           		<form method="GET" action="<?=site_url('panel/statistik_objek')?>">
		           			<div class="row">
		           				<div class="col-md-6" style="margin-bottom: 10px;">
			                        <?=form_dropdown('kategori', $opt_kategori, $kategori, 'class="form-control"')?>
			                  	</div>
			                  	<div class="col-md-6" style="margin-bottom: 10px;">
			                        <div class="input-group">
			                            <input type="text" class="form-control input" placeholder="" name="q" value="<?=$keyword?>">
			                            <span class="input-group-btn">
			                                <button class="btn green" type="submit">Cari !</button>
			                            </span>
			                        </div>
			                    </div>
			                </div>
		           		</form>
                    </div>
                </div>
                <hr/>
                <div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="col-md-1 text-center"></th>
								<th class="col-md-2"></th>
								<th class="">Nama</th>
								<th class="col-md-2 text-center">Dilihat Sebanyak</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $key => $c): ?>
								<tr>
									<td class="text-center">
										<a href="<?=site_url('panel/statistik_objek/detail/' . $c->objek_id)?>" class="btn blue btn-xs" title="Perbaharui / Update">
											<i class="fa fa-line-chart "></i>
										</a>
									</td>	
	 								<td class="text-center">
										<img src="<?=!empty($c->foto) ? base_url('uploads/' . $c->foto) : base_url('assets/default.png')?>" width="100px" class="thumbnails">
									</td>	
									<td><?=$c->nama?></td>	
									<td class="text-center"><?=empty($c->jml_visitor) ? 0 : $c->jml_visitor?></td>	
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<?=$pagination?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-grafik">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                	<i class="fa fa-bar-chart"></i>&nbsp;&nbsp;Grafik
                </h4>
            </div>
            <div class="modal-body">
            	<div id="charts" style="width:100%;";></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey" data-dismiss="modal">
                	<i class="fa fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/highcharts/js/highcharts.js')?>"></script>
<script type="text/javascript">
	function load_grafik()
	{
		$('#modal-grafik').modal();
	}

	$('#modal-grafik').on('shown.bs.modal', function() {
	 	$('#charts').highcharts({
	        chart: {
	            type: 'column'
	        },
	        title: {
	            text: 'Grafik Objek Wisata Populer'
	        },
	        xAxis: {
	            type: 'category',
	            labels: {
	                rotation: -45,
	                style: {
	                    fontSize: '12px',
	                    fontFamily: 'Verdana, sans-serif'
	                }
	            }
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: 'Dilihat Sebanyak '
	            }
	        },
	        legend: {
	            enabled: false
	        },
	        series: [{
	            name: 'Objek Wisata',
	            data: [
	            	<?php 
	            		$i = 0; 
	            		foreach($populer as $key => $c): 
	            			echo "['$c->nama', $c->jml_visitor]";
		                	if($i < count($populer))
		                	{ 
		                		echo ","; 
		                	}
		                	$i++; 
		                endforeach; 
		            ?>
	            ],
	            dataLabels: {
	                enabled: true,
	                // rotation: -90,
	                color: '#FFFFFF',
	                align: 'center',
	                format: '{point.y:.f}', // one decimal
	                y: 5, // 10 pixels down from the top
	                style: {
	                    fontSize: '10px',
	                    fontFamily: 'Verdana, sans-serif'
	                }
	            }
	        }]
	    });
	});
</script>

