<?php if($data->status == '200'){ ?>
	<?php foreach($data->data as $key => $c): ?>
		<div class="blog-page blog-content-2">
			<div class="blog-single-content bordered blog-container">
				<a onclick="window.history.back()" class="btn btn-sm grey">
					<i class="fa fa-history"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Kembali</span>
				</a>
				<a href="<?=site_url('artikel/index/' . $data->objek_wisata->objek_id . '-' . $data->objek_wisata->url_seo)?>" class="btn btn-sm grey">
					<i class="fa fa-list"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Index Artikel</span>
				</a>
	        	<a href="<?=site_url()?>" class="btn btn-sm grey">
	        		<i class="fa fa-home"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Beranda</span>
	        	</a>
		    	<a data-toggle="modal" href="#bagikan_halaman" class="btn btn-sm btn-info pull-right">
		    		<i class="fa fa-share"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Bagikan Halaman</span>
		    	</a>
				<hr/>
	            <div class="blog-single-head">
	                <h1 class="blog-single-head-title"><?=$c->judul?></h1>
	            </div>
	            <div class="blog-single-img">
	                <img src="<?=$c->foto?>"> </div>
		            <div class="blog-single-desc">
		            	<?=$c->isi?>
		            </div>
		            <div class="blog-single-foot">
		                <ul class="blog-post-tags">
		                    <li class="uppercase">
		                        <a href="javascript:;"><i class="fa fa-user"></i>&nbsp;&nbsp;<?=$c->nama_kontributor?></a>
		                    </li>
		                    <li class="uppercase">
		                        <a href="javascript:;"><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?=$c->tgl_posting?></a>
		                    </li>
		                </ul>
		            </div>
		        </div>
	        </div>
	    </div>
	<?php endforeach; ?>
<?php } else { ?>
	<?=war_msg($data->msg); ?>
<?php } ?>

<link href="<?=base_url()?>/assets/pages/css/blog.min.css" rel="stylesheet" type="text/css" />