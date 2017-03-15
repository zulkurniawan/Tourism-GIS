<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-check"></i>
                    <span class="caption-subject bold uppercase">Pilih Kategori Objek Wisata</span>
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
					            	<a href="<?=site_url('panel/artikel/index/' . $c->kategori_id . '-' . format_uri($c->nama_kategori))?>" class="btn btn-info btn-block">
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