<!-- <div class="col-md-4 login">
	<div class="portlet light bordered form-login">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="icon-user"></i>
	            <span class="caption-subject bold">Login</span>
	        </div>
	    </div>
		<form id="form-pendaftaran" class="form-horizontal" method="POST" action="<?=site_url('API/auth/login')?>" enctype="multipart/form-data">
			<div class="form-body">
                    <div class="form-group form-md-line-input form-md-floating-label">
                        <input type="text" autocomplete="off" class="form-control" name="email">
                        <label>Email / No Hp</label>
                        <span class="help-block">Gunakan no hp jika sudah terverifikasi</span>
                    </div>
                    <div class="form-group form-md-line-input form-md-floating-label">
                        <input type="password" autocomplete="off" class="form-control" name="password">
                        <label>Password</label>
                    </div>
                    <div class="form-group form-md-line-input" style="padding-top: 10px; margin: 0px;">
                        <div class="md-checkbox-list" style="margin: 0px;">
                            <div class="md-checkbox">
                                <input type="checkbox" id="checkbox1111" class="md-check" name="remember_me" value="1">
                                <label for="checkbox1111">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> Simpan login
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="form-login-result"></div>
                <div class="form-actions text-right">
                    <button type="submit" class="btn blue">
                        <i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Login
                    </button>
                    <button type="button" class="btn gray" data-dismiss="modal">
                        <i class="fa fa-times"></i>&nbsp;&nbsp;&nbsp;Batal
                    </button>
                </div>
		</form>		    	
	</div>
</div> -->

<div class="form-login">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form id="form-pendaftaran" class="form-horizontal" method="POST" action="<?=site_url('user/register_submit/')?>" enctype="multipart/form-data">
                    <?=@$msg?>
                        <div class="form-group form-md-line-input">
                        <label class="col-md-4 control-label label-daftar"><b>Daftar sebagai :</b></label>
                        <div class="col-md-12">
                            <select class="form-control" name="regas" id="regas" onchange="get_regas_aggrement_text(this.value)">
                                    <option value="Kontributor" <?=@$data->regas == 'Kontributor' ? 'selected="selected"' : ''?>>Kontributor Pariwisata</option>
                                    <option value="Partners" <?=@$data->regas == 'Partners' ? 'selected="selected"' : ''?>>Partners Akomodasi</option>
                            </select>                           
                            <div class="form-control-focus"> </div>
                            <span class="help-block">Silahkan baca syarat & ketentuan.</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a class="btn red hidden-md hidden-lg btn-block" data-toggle="modal" href="#ketentuan_perjanjian_modal" style="margin-bottom: 5px;"> Syarat & Ketentuan </a>
                        </div>
                        <div class="form-group form-md-line-input">
                            <!-- <label class="col-md-4 control-label" for="nama">Nama Kontributor *</label> -->
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Nama Kontributor" name="nama" value="<?=@$data->nama?>">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <!-- <label class="col-md-4 control-label"><b>Email *</b></label> -->
                            <div class="col-md-12">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="<?=@$data->email?>">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <!-- <label class="col-md-4 control-label"><b>Password *</b></label> -->
                            <div class="col-md-12">
                                <input type="password" placeholder="Password" class="form-control" name="password" value="">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <!-- <label class="col-md-4 control-label"><b>Konfirmasi Password *</b></label> -->
                            <div class="col-md-12">
                                <input type="password" placeholder="Konfirmasi Password" class="form-control" name="cpassword" value="">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <!-- <label class="col-md-4 control-label"><b>No. Ponsel Pribadi *</b></label> -->
                            <div class="col-md-12">
                                <input type="text" placeholder="No. Ponsel Pribadi" class="form-control" name="no_hp" value="<?=@$data->no_hp?>">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        
                        <!--<hr/>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-4 control-label" for="organisasi">Organisasi</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="organisasi" value="<?=@$data->organisasi?>">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-4 control-label" for="alamat">Alamat</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="alamat" value="<?=@$data->alamat?>">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-4 control-label" for="tentang">Sekilas Tentang Anda</label>
                            <div class="col-md-7">
                                <textarea class="form-control" name="tentang" rows="5" onkeyup="countChar(this)"><?=@$data->tentang?></textarea>
                                <div class="form-control-focus"> </div>
                                <span class="help-block" id="charNum">Sisa <?=empty($data->singkat) ? '250' : 250 - strlen($data->singkat)?> Karakter</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-4 control-label" for="userfiles">Foto</label>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="userfiles">
                                <div class="form-control-focus"> </div>
                                <span>File harus berjenis JPG / PNG<br/>Maksimal Ukuran : 2 MB</span>
                            </div>
                        </div>
                        <hr/>-->
                        <div class="form-group form-md-line-input">
                            <div class="col-md-12 col-xs-12">
                                <button type="submit" class="btn btn-info btn-block">
                                    <i class="fa fa-check"></i>DAFTAR
                                </button>
                            </div>
                        </div>
                        <!--<hr/>-->
                    </form>     

        </div>
        
    <div id="login">   
      <h1>Login</h1>
      
      <form id="form-login" method="post">
          
            <div class="field-wrap">
                <!-- <label>
                  Email / No Hp<span class="req">*</span>
                </label> -->
                <input type="email" placeholder="Email / No HP" name="email" required autocomplete="off"/>
            </div>
      
            <div class="field-wrap">
                <!-- <label>
                    Password<span class="req">*</span>
                </label> -->
                <input type="password" placeholder="Password" name="password" required autocomplete="off"/>
            </div>

            <div id="form-login-result"></div>

            <div class="input-group">
                <span class="input-group-addon" style="text-align: left;">
                    <input type="checkbox" id="checkbox1111" name="remember_me" value="1">
                    Simpan Login
                </span>
                
            </div>


            <!-- <input type="checkbox" id="checkbox1111" class="md-check" name="remember_me" value="1"> -->


           <!--  <div class="field-wrap">
                <div class="md-checkbox-list" style="margin: 0px;">
                    <div class="md-checkbox">
                        <input type="checkbox" id="checkbox1111" class="md-check" name="remember_me" value="1">
                        <label for="checkbox1111">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span> Simpan login
                        </label>
                    </div>
                </div>
            </div> -->

            <button type="submit" class="button button-block"/>Log In</button>
      
      </form>

    </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->