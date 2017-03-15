<div class="portlet light">
    <div class="portlet-title">
    	<a href="<?=site_url()?>" class="btn btn-sm grey">
    		<i class="fa fa-home"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Beranda</span>
    	</a>
    	<a data-toggle="modal" href="#bagikan_halaman" class="btn btn-sm btn-info pull-right">
    		<i class="fa fa-share"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Bagikan Halaman</span>
    	</a>
		<hr/>
        <div class="caption">
            <i class="fa fa-image"></i>
            <span class="caption-subject bold uppercase">&nbsp;&nbsp;Galeri</span>
        </div>
    </div>
    <div class="portlet-body">
    	<?php if($data->status == '200'){ ?>
			<!-- <ul class="media-list"> -->
			<div class="row">
				<?php foreach ($data->data as $key => $c){ ?>
					<div class="col-md-6">
						<div class="thumbnail">
	                        <img src="<?=$c->foto?>" style="height:200px;">
	                        <div class="caption">
	                            <h4><?=substr($c->nama, 0, 35)?></h4>
				        		<div class="btn-group btn-group-justified">
					        		<a class="btn btn-xs white">
					        			<i class="fa fa-user"></i>&nbsp;&nbsp;<?=$c->nama_kontributor?>&nbsp;&nbsp;
					        		</a>
					        		<a class="btn btn-xs white">					        		
			        					<i class="fa fa-calendar"></i>&nbsp;&nbsp;<?=$c->tgl_upload?>
			        				</a>
			        			</div>
				        		<a href="<?=site_url('galeri/lihat/' . $c->foto_id . '-' . $c->objek_id . '-' . $c->url_seo)?>" class="btn btn-sm btn-info btn-block">
				        			<i class="fa fa-eye"></i>&nbsp;&nbsp;Lihat 
				        		</a>
	                        </div>
	                    </div>
	                </div>
				<?php } ?>
			</div>
			<!-- </ul> -->
			<center><?=$pagination?></center>
		<?php } else { ?>
			<?=info_msg($data->msg)?>
		<?php } ?>
    </div>
</div>
