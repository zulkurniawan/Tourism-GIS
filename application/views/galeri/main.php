<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="portlet light bordered">
	            <div class="portlet-title">
	                <div class="caption">
	                    <i class="icon-pointer"></i>
	                    <span class="caption-subject bold uppercase">Objek Wisata</span>
	                </div>
	            </div>
	            <div class="portlet-body">
					<img class="thumbnail" width="100%" src="<?=$data->objek_wisata->foto?>" style="margin-bottom: 15px;">
	            	<ul class="list-group">
	            		<li class="list-group-item">Nama <span style="float:right; font-weight: bold"><?=$data->objek_wisata->nama?></span></li>
	            		<li class="list-group-item">Kategori <span style="float:right; font-weight: bold"><?=$data->objek_wisata->nama_kategori?></span></li>
	            		<li class="list-group-item">Desa <span style="float:right; font-weight: bold"><?=$data->objek_wisata->lokasi_desa?></span></li>
	            		<li class="list-group-item">Kecamatan <span style="float:right; font-weight: bold"><?=$data->objek_wisata->lokasi_kecamatan?></span></li>
	            		<li class="list-group-item">Kabupaten / Kota <span style="float:right; font-weight: bold"><?=$data->objek_wisata->lokasi_kabupaten_kota?></span></li>
	            	</ul>
	            	<ul class="list-group">
	            		<li class="list-group-item">Kontributor <span style="float:right; font-weight: bold"><?=$data->objek_wisata->nama_kontributor?></span></li>
	            		<li class="list-group-item">Terakhir Update <span style="float:right; font-weight: bold"><?=$data->objek_wisata->terakhir_update?></span></li>
	            	</ul>
					<div class="btn-group btn-group-justified">
						<a href="<?=site_url('artikel/index/' . $data->objek_wisata->objek_id . '-' . $data->objek_wisata->url_seo)?>" class="btn btn-info">
							<i class="fa fa-list"></i>&nbsp;&nbsp;Artikel
						</a>
						<a href="<?=site_url('galeri/index/' . $data->objek_wisata->objek_id . '-' . $data->objek_wisata->url_seo)?>" class="btn btn-default">
							<i class="fa fa-image"></i>&nbsp;&nbsp;Galeri Foto
						</a>
                    </div>	            	
	        	</div>
	        </div>				            						

			<div class="portlet light bordered">
	            <div class="portlet-title">
	                <div class="caption">
	                    <i class="icon-target"></i>
	                    <span class="caption-subject bold uppercase">Terdekat</span>
	                </div>
	            </div>
	            <div class="portlet-body">
					<ul class="media-list" id="objek_artikel_list">
			            <?php foreach($data->objek_terdekat as $key => $c): ?>
			        		<li class="media">
				        		<a class="pull-left" href="<?=$c->link?>">
					        		<img class="media-object thumbnails" src="<?=$c->foto?>" width="100px">
				        		</a>
				        		<div class="media-body">
					        		<h4 class="media-heading"><?=$c->nama?></h4>
					        		<h5><?=$c->jarak?> km, <i class="fa fa-user"></i>&nbsp;&nbsp;<?=$c->nama_kontributor?></h5>
					        		<a href="<?=$c->link?>" class="btn btn-xs btn-info btn-block">
					        			<i class="fa fa-eye"></i>&nbsp;&nbsp;Lihat 
					        		</a>
				        		</div><hr/>
			        		</li>		
			        	<?php endforeach; ?>
		        	</ul>
	        	</div>
	        </div>				            						

		</div>
		<div class="col-md-8">
			<?php if(!empty($sub_main_content)){ $this->load->view($sub_main_content); } ?>
		</div>
	</div>
</div>