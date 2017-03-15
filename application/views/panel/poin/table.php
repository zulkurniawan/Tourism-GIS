<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Log Poin</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="col-md-2">Tanggal</th>
								<th class="">Keterangan</th>
								<th class="col-md-3 text-center">Jenis Konten</th>
								<th class="col-md-1 text-center">Jumlah</th>
							</tr>
						</thead>
						<tbody>
							<?php $sub_poin = 0; foreach($data as $key => $c): ?>
								<tr>
									<td><?=date('d-m-Y H:i:s', strtotime($c->tanggal))?></td>	
									<td><?=$c->keterangan?></td>	
									<td class="text-center"><?=$c->jenis?></td>	
									<td class="text-center"><?=$c->jumlah?></td>	
								</tr>
							<?php $sub_poin += $c->jumlah; endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="2"></th>
								<th class="text-center">Sub Total</th>
								<th class="text-center"><?=$sub_poin?></th>
							</tr>
							<tr>
								<th colspan="2"></th>
								<th class="text-center">Total</th>
								<th class="text-center"><?=$poin?></th>
							</tr>
						</tfoot>
					</table>
				</div>
				<?=$pagination?>
            </div>
        </div>
    </div>
</div>