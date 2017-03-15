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
		            <i class="fa fa-building"></i>
		            <span class="caption-subject bold uppercase">&nbsp;&nbsp;Tentang</span>
		        </div>
		    </div>
		    <div class="portlet-body">
		    	<div class="row">
		    		<div class="col-md-12">
		                <p><?=$this->config->item('halaman_tentang')?></p>
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>
</div>