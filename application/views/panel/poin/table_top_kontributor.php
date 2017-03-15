<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Top Kontributor</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="col-md-2"></th>
								<th class="">Nama</th>
								<th class="col-md-2 text-center">Poin</th>
								<th class="col-md-1"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $key => $c): ?>
								<tr>
									<td class="text-center">
                                        <img src="<?=load_foto_user($c->foto)?>" class="thumbnails" width="50%">
									</td>	
									<td>
										<strong><?=$c->nama?></strong><br/><?=label_user_verified($c)?>
										<p style="margin-top: 10px;"><?=$c->tentang?></p>
									</td>	
									<td class="text-center"><?=empty($c->jml_poin) ? '0' : $c->jml_poin?></td>	
									<td>
										<?php if($login_level == 'Administrator' || $login_level == 'Partners'){ ?>
											<a href="<?=site_url('panel/poin/log_detail/' . $c->user_id)?>" class="btn blue btn-xs" title="Detail">
												<i class="fa fa-list"></i>
											</a>										
										<?php } ?>
									</td>
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