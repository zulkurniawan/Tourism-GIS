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
				<table class="table table-striped">
					<thead>
						<tr>
							<th class="col-md-1 text-center"></th>
							<th class="col-md-2"></th>
							<th class="">Nama</th>
							<th class="col-md-2 text-center">Total Visitor</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; foreach($data as $key => $c): ?>
							<tr>
								<td class="text-center">
									<a href="<?=site_url('panel/statistik_objek/detail/' . $c->objek_id)?>" class="btn blue btn-xs" title="Perbaharui / Update">
										<i class="fa fa-eye"></i>
									</a>
								</td>	
								<td class="text-center">
									<img src="<?=!empty($c->foto) ? base_url('uploads/' . $c->foto) : base_url('assets/default.png')?>" width="100px" class="thumbnails">
								</td>	
								<td><?=$i?> . <?=$c->nama?></td>	
								<td class="text-center"><?=$c->jml_visitor?></td>	
							</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
            </div>
        </div>
    </div>
</div>