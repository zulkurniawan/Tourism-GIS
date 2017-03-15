<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list"></i>
                    <span class="caption-subject bold uppercase">Template Email Notifikasi</span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="row">       
            		<div class="col-md-7">
            			<a class="btn btn-info btn-sm" onclick="test_email();"><i class="fa fa-envelope"></i> Test Email</a>
            		</div>  			
            		<div class="col-md-5">
            			<h4>Cari Data</h4>
		           		<form method="GET" action="<?=site_url('panel/mail_templates')?>">
	                        <div class="input-group">
	                            <input type="text" class="form-control input" placeholder="" name="q" value="<?=$keyword?>">
	                            <span class="input-group-btn">
	                                <button class="btn green" type="submit">Cari !</button>
	                            </span>
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
								<th class="col-md-4">Nama</th>
								<th>Keterangan</th>
								<th class="col-md-2">Terakhir Update</th>
								<th class="col-md-1 text-center">Aktif</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $key => $c): ?>
								<tr>
									<td class="text-center">
										<a href="<?=site_url('panel/mail_templates/form/' . $c->templates_id)?>" class="btn blue btn-xs" title="Perbaharui / Update">
											<i class="fa fa-cog"></i>
										</a>
									</td>	
									<td><?=$c->nama?></td>	
									<td><?=$c->keterangan?></td>	
									<td><?=empty($c->terakhir_update) ? '-' : date('H:i:s d-m-Y', strtotime($c->terakhir_update))?></td>	
									<td class="text-center"><?=$c->aktif?></td>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal-test-email">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                	<i class="fa fa-envelope"></i>&nbsp;&nbsp;Test Email
                </h4>
            </div>
            <div class="modal-body">
				<form class="form-horizontal" action="<?=site_url('panel/konfigurasi/test_email')?>" method="POST">
				  	<div class="form-group form-md-line-input">
				    	<label class="col-md-4 control-label">Email</label>
				    	<div class="col-md-6">
				    		<input type="email" class="form-control" name="email">
				    		<div class="form-control-focus"> </div>
				    	</div>
				  	</div>
				  	<div class="form-group">
				    	<div class="col-md-offset-4 col-md-8">
				      		<button type="submit" class="btn btn-info">Submit</button>
				      		<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				    	</div>
				  	</div>
				</form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function test_email()
	{
		$('#modal-test-email').modal({'backdrop' : 'static', 'keyboard' : false});
	}
</script>