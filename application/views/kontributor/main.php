<div class="container">
	<div class="row" style="margin-top: 20px;">
		<div class="col-md-10 col-md-offset-1">
			<div class="">
			    <div class="portlet-title">
			    	<a href="<?=site_url()?>" class="btn btn-sm grey">
			    		<i class="fa fa-home"></i> Beranda
			    	</a>
			    	<a data-toggle="modal" href="#bagikan_halaman" class="btn btn-sm btn-info pull-right">
			    		<i class="fa fa-share-alt"></i> Bagikan
			    	</a>
					<hr/>
			        <div class="caption" style="margin-bottom: 20px;">
			            <i class="fa fa-user"></i>
			            <span class="caption-subject bold uppercase">&nbsp;&nbsp;Kontributor</span>
			        </div>
			    </div>
			    <div class="portlet-body">
			    	<div class="row">
			    		<div class="col-md-12">
			                <?php if($data->status == '200'){ ?>
			                    <?php foreach($data->data as $key => $c): ?>
			                        <div class="row portlet light profil-card wow fadeInUp">
			                            <div class="col-md-4 text-center" style="margin-bottom: 10px;">
			                                <?php if(!empty($c->foto)){ ?>
			                                    <img src="<?php echo $c->foto ?>" class="thumbnails" width="50%">
			                                <?php } else { ?>
			                                    <img src="<?=base_url('assets/user.png')?>" width="60%" class="thumbnails">
			                                <?php } ?>
			                                <!--<br/><?=label_user_verified($c, 'margin: 10px 15%; width:70%; float: left;')?>-->
			                            </div>
			                            <div class="col-md-8">
			                                <ul class="list-group" style="margin-bottom: 0px;">
			                                    <li class="list-group-item">
			                                    Nama <span style="float:right; font-weight: bold"><?=$c->nama?></span></li>
			                                    <!--<li class="list-group-item">Alamat <br/><span style="float:right; font-weight: bold"><?=$c->alamat?></span></li>-->
			                                    <li class="list-group-item">Identitas <?=label_user_verified($c, 'float: right;')?></li>
			                                    <li class="list-group-item">
                                        			<a href="<?=$c->profil?>" class="btn btn-block btn-success btn-xs">
                                           		 	   <i class="fa fa-user"></i>&nbsp;&nbsp;Lihat profil
                                        			</a>
                                    			    </li>
			                                    <!--<li class="list-group-item">Organisasi <span style="float:right; font-weight: bold"><?=$c->organisasi?></span></li>
			                                    <?php if(!empty($c->tentang)){ ?>
			                                        <li class="list-group-item hidden-lg hidden-md">
			                                            <?=$c->tentang?>
			                                        </li>
			                                    <?php } ?>-->
			                                </ul>
			                            </div>
			                        </div>
			                        <!--<?php if(!empty($c->tentang)){ ?>
			                            <div class="row hidden-xs hidden-sm">
			                                <div class="col-md-12">
			                                    <h4>Tentang</h4>
			                                    <p style="margin: 0px;"><?=$c->tentang?></p>
			                                </div>
			                            </div>
			                        <?php } ?>-->
			                    <?php endforeach; ?>
			                <?php } else { ?>
			                    <?=war_msg('Data kontributor sedang diperbaharui.')?>
			                <?php } ?>		    		
			    		</div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</div>