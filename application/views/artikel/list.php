<div class="portlet light">
    <div class="portlet-title">
    	<a href="<?=site_url()?>" class="btn btn-sm grey">
    		<i class="fa fa-home"></i> <span class="hidden-xs hidden-sm">Beranda</span>
    	</a>
    	<a data-toggle="modal" href="#bagikan_halaman" class="btn btn-sm btn-info pull-right">
    		<i class="fa fa-share"></i> <span class="hidden-xs hidden-sm">Bagikan Halaman</span>
    	</a>
		<hr/>
        <div class="caption">
            <i class="fa fa-list"></i>
            <span class="caption-subject bold uppercase">&nbsp;&nbsp;Artikel</span>
        </div>
    </div>
    <div class="portlet-body">
    	<?php if($data->status == '200'){ ?>
			<ul class="media-list">
				<?php foreach ($data->data as $key => $c){ ?>
	        		<li class="media">
		        		<a class="pull-left" href="<?=site_url('artikel/baca/' . $c->artikel_id . '-' . $c->objek_id . '-' . $c->url_seo)?>">
			        		<img class="media-object thumbnails" src="<?=$c->foto?>" width="150px">
		        		</a>
		        		<div class="media-body">
			        		<h4 class="media-heading"><?=$c->judul?></h4>
			        		<p style="margin:0px;"><?=$c->singkat?></p>
			        		<div class="btn-group">
				        		<a class="btn btn-xs white">
				        			<i class="fa fa-user"></i>&nbsp;&nbsp;<?=$c->nama_kontributor?>&nbsp;&nbsp;
		        					<i class="fa fa-calendar"></i>&nbsp;&nbsp;<?=$c->tgl_posting?>
		        				</a>
				        		<a href="<?=site_url('artikel/baca/' . $c->artikel_id . '-' . $c->objek_id . '-' . $c->url_seo)?>" class="btn btn-xs btn-info">
				        			<i class="fa fa-eye"></i>&nbsp;&nbsp;Baca 
				        		</a>
		        			</div>
		        		</div><hr/>
	        		</li>								
				<?php } ?>
			</ul>
			<center><?=$pagination?></center>
		<?php } else { ?>
			<?=info_msg($data->msg, false)?>
		<?php } ?>
    </div>
</div>
