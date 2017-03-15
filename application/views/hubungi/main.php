<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="portlet light">
		    <div class="portlet-title">
		    	<a href="<?=site_url()?>" class="btn btn-sm grey">
		    		<i class="fa fa-home"></i> Beranda
		    	</a>
		    	<a data-toggle="modal" href="#bagikan_halaman" class="btn btn-sm btn-info pull-right">
		    		<i class="fa fa-share"></i> Bagikan Halaman
		    	</a>
				<hr/>
		        <div class="caption">
		            <i class="fa fa-phone-square"></i>
		            <span class="caption-subject bold uppercase">&nbsp;&nbsp;Hubungi</span>
		        </div>
		    </div>
		    <div class="portlet-body">
		    	<div class="row">
		    		<div class="col-md-12">
		                <p><?=$this->config->item('halaman_kontak')?></p>
		                <!--<h4><strong>Kami menerima donasi melalui : </strong></h4>-->
		                <hr/>
		                <div class="row">
		                    <?php foreach($donasi->data as $key => $c): ?>
		                        <div class="col-md-6">
		                            <img src="<?=$c->gambar?>" style="width: 100px;">
		                            <p style="margin: 7px 0px;">
		                                Bank : <strong><?=$c->nama_bank?></strong><br/>
		                                Nomor Rekening : <strong><?=$c->nomor_rekening?></strong><br/>
		                                Atas Nama : <strong><?=$c->atas_nama?></strong><br/>
		                            </p>
		                        </div>
		                    <?php endforeach; ?>
		                </div>
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>
</div>