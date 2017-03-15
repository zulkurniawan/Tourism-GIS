<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-check"></i>
                    <span class="caption-subject bold uppercase">Pilih Akomodasi dari Kategori : <?=$nama_kategori?></span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="row">
            		<div class="col-md-12">
            			<a href="<?=site_url('panel/akomodasi_artikel')?>" class="btn blue"><i class="fa fa-history"></i> Kembali</a>
            		</div>
            	</div>
            	<hr/>
            	<div class="row">
            		<?php foreach ($data as $key => $c) { ?>
            			<div class="col-md-4">
							<div class="portlet light bordered">
					            <div class="portlet-title">
					                <div class="caption">
					                    <span class="caption-subject bold uppercase"><?=substr($c->nama, 0, 26)?></span>
					                </div>
					            </div>
					            <div class="portlet-body">
					            	<center>
						            	<?php if(!empty($c->foto)){ ?>
						            		<img src="<?=base_url('uploads/'. $c->foto)?>" class="thumbnail" height="90px">
						            	<?php } else { ?>
						            		<img src="<?=base_url('assets/default.png')?>" class="thumbnail" height="90px">
						            	<?php } ?>
						            </center>
									<ul class="list-group">
									    <li class="list-group-item"> Artikel Publish
									        <span class="badge badge-success"> <?=empty($c->jml_artikel_publish) ? 0 : $c->jml_artikel_publish?> </span>
									    </li>
									    <li class="list-group-item"> Artikel Moderasi
									        <span class="badge badge-warning"> <?=empty($c->jml_artikel_moderasi) ? 0 : $c->jml_artikel_moderasi?> </span>
									    </li>
									    <li class="list-group-item"> Artikel Draft
									        <span class="badge badge-danger"> <?=empty($c->jml_artikel_draft) ? 0 : $c->jml_artikel_draft?> </span>
									    </li>
									</ul>
					            	<hr/>
					            	<a href="<?=site_url('panel/akomodasi_artikel/index/' . $uri_kategori . '/' . $c->objek_id . '-' . format_uri($c->nama))?>" class="btn btn-info btn-block">
					            		<i class="fa fa-check"></i>&nbsp;&nbsp;Pilih
					            	</a>
					            </div>
					        </div>
					    </div>
            		<?php } ?>
            	</div>
            </div>
        </div>
    </div>
</div>