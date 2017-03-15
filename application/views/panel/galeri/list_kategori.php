<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-check"></i>
                    <span class="caption-subject bold uppercase">Pilih Galeri Objek Wisata</span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="row">
            		<?php foreach ($data as $key => $c) { ?>
            			<div class="col-md-4">
							<div class="portlet light bordered">
					            <div class="portlet-title">
					                <div class="caption">
					                    <span class="caption-subject bold uppercase"><?=$c->nama_kategori?></span>
					                </div>
					            </div>
					            <div class="portlet-body">
									<ul class="list-group">
									    <li class="list-group-item"> Objek Wisata
									        <span class="badge badge-default"> <?=empty($c->jml_objek) ? 0 : $c->jml_objek?> </span>
									    </li>
									    <li class="list-group-item"> Foto Publish
									        <span class="badge badge-success"> <?=empty($c->jml_foto_publish) ? 0 : $c->jml_foto_publish?> </span>
									    </li>
									    <li class="list-group-item"> Foto Moderasi
									        <span class="badge badge-warning"> <?=empty($c->jml_foto_moderasi) ? 0 : $c->jml_foto_moderasi?> </span>
									    </li>
									    <li class="list-group-item"> Foto Draft
									        <span class="badge badge-danger"> <?=empty($c->jml_foto_draft) ? 0 : $c->jml_foto_draft?> </span>
									    </li>
									</ul>
									<hr/>
					            	<a href="<?=site_url('panel/galeri/index/' . $c->kategori_id . '-' . format_uri($c->nama_kategori))?>" class="btn btn-info btn-block">
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