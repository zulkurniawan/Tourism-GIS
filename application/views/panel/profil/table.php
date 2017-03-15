<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-users"></i>
                    <span class="caption-subject bold uppercase">Profil</span>
                </div>
            </div>
            <div class="portlet-body form">
                <?php if(!empty($data->no_hp) && $data->verifikasi_no_hp == 'N'){ ?>
                    <div class="alert alert-danger">
                        Segera verifikasi nomor handphone sebagai syarat penukaran poin.
                        <a data-toggle="modal" data-dismiss="modal" href="#modal-verifikasi-no-handphone">Verifikasi sekarang</a>.
                    </div>
                    <hr/>
                <?php } ?>
            	<div class="row">
            		<div class="col-md-5">
                        <center>
                            <img src="<?=load_foto_user($data->foto)?>" width="75%" class="thumbnails">
                        </center>
                        <hr/>
            			<?=!empty($data->tentang) ? '<p>' . $data->tentang . '</p><hr/>' : ''?>
                        <div class="btn-group btn-group-justified">
                            <a href="<?=site_url('panel/profil/upload_foto')?>" class="btn blue-sharp">
                                <i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp;<?=$data->level == 'Kontributor' ? 'Upload Foto' : ($data->level == 'Partners' ? 'Upload Logo' : 'Upload Foto')?>
                            </a>
                            <a href="<?=site_url('panel/profil/form')?>" class="btn blue-sharp">
                                <i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;Ubah Profil
                            </a>
                        </div>
                        <hr/>
                        <?php if($data->level == 'Kontributor'){ ?>
                            <div class="dashboard-stat default">
                                <div class="visual">
                                    <i class="fa fa-database"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?=$poin?>"><?=@$poin?></span>
                                    </div>
                                    <div class="desc"> Total Poin Reward</div>
                                </div>
                                <a class="more" href="<?=site_url('panel/poin')?>"> Lihat Log Poin Reward
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                            <hr/>
                        <?php } ?>
            		</div>
            		<div class="col-md-7">
            			<form>
							<div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                <div class="form-control form-control-static">
                                    <?=$data->nama?>                                   
                                </div>
                                <label><?=$data->level == 'Kontributor' ? 'Nama' : ($data->level == 'Partners' ? 'Nama Pemilik' : 'Nama')?></label>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                <div class="form-control form-control-static"><?=$data->email?></div>
                                <label>Email</label>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                <div class="form-control form-control-static">
                                    <?php 
                                        if(empty($data->no_hp))
                                        {
                                            echo '-';
                                        }
                                        else
                                        {
                                            echo $data->no_hp;
                                            echo "&nbsp;&nbsp;&nbsp;";
                                            echo label_user_verified($data, '', $data->waktu_post_kode);
                                        }
                                    ?>
                                </div>
                                <label>No Handphone</label>
                            </div>
                            <hr/>
							<div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                <div class="form-control form-control-static"><?=empty($data->organisasi) ? ' - ' : $data->organisasi?></div>
                                <label><?=$data->level == 'Kontributor' ? 'Organisasi / Komunitas' : ($data->level == 'Partners' ? 'Nama Bisnis' : 'Organisasi / Komunitas')?></label>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                <div class="form-control form-control-static"><?=empty($data->alamat) ? ' - ' : $data->alamat?></div>
                                <label><?=$data->level == 'Kontributor' ? 'Alamat' : ($data->level == 'Partners' ? 'Alamat Usaha' : 'Alamat')?></label>
                            </div>
                            <hr/>
							<div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                <div class="form-control form-control-static"><?=$data->level?></div>
                                <label>Level</label>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                <div class="form-control form-control-static"><?=date('H:i:s d-m-Y', strtotime($data->tgl_daftar))?></div>
                                <label>Tanggal Daftar</label>
                            </div>
							<div class="form-group form-md-line-input form-md-floating-label" style="margin: 0px 0px 15px;">
                                <div class="form-control form-control-static"><?=date('H:i:s d-m-Y', strtotime($data->terakhir_login))?></div>
                                <label>Terakhir Login</label>
                            </div>
            			</form>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>

<?php if($data->verifikasi_no_hp == 'N'){ ?>
    <div class="modal fade" id="modal-verifikasi-no-handphone" role="basic" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form role="form" id="form-verifikasi" onsubmit="return post_kode_verifikasi_hp();">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="icon-check"></i>&nbsp;&nbsp;&nbsp;Verifikasi No Handphone
                        </h4>
                    </div>
                    <div class="modal-body"> 
                        <div class="form-body">
                            <button type="button" class="btn btn-block blue" id="btn_req_verifikasi_hp" onclick="req_kode_verifikasi_hp();">
                                Minta Kode
                            </button>
                            <div id="kode-verifikasi-result" style="margin: 5px 0px;"></div>
                            <hr style="">   
                            <div class="form-group form-md-line-input form-md-floating-label" style="margin-bottom: 0px;">
                                <div class="form-control form-control-static"> <?=$data->no_hp?> </div>
                                <label>No Handphone</label>
                            </div>                            
                            <p>Cek kotak masuk SMS sesaat lagi.</p>
                            <div class="form-group form-md-line-input form-md-floating-label" style="margin-bottom: 0px;">
                                <input type="text" class="form-control" id="kode_verifikasi">
                                <label>Tulis kode di sini</label>
                            </div>
                            <div id="post-kode-verifikasi-result" style="margin: 5px 0px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn blue">
                            <i class="fa fa-check"></i>&nbsp;Submit
                        </button>
                        <button type="button" class="btn grey" data-dismiss="modal">
                            <i class="fa fa-times"></i>&nbsp;Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function req_kode_verifikasi_hp()
        {
            $('#btn_req_verifikasi_hp').attr({'disabled' : 'disabled', 'class' : 'btn grey btn-block'});
            $.ajax({
                url         : "<?=site_url('API/auth/req_kode_verifikasi_hp')?>",
                method      : "POST",
                dataType    : "json",
                data        : "no_hp=<?=$data->no_hp?>",
                success     : function(result){
                    if(result.status == '201')
                    {                       
                        $('#btn_req_verifikasi_hp').removeAttr('disabled');
                        $('#btn_req_verifikasi_hp').attr({'class' : 'btn blue btn-block'});
                        $('#kode-verifikasi-result').html('<div class="alert alert-danger" role="alert"><strong>Kesalahan !</strong><br/>' + result.msg + '</div>');
                    }
                    else
                    {
                        var counter = result.counter;
                        var id;

                        id = setInterval(function(){
                            counter--;
                            if(counter < 0) 
                            {
                                $('#btn_req_verifikasi_hp').removeAttr('disabled');
                                $('#btn_req_verifikasi_hp').attr({'class' : 'btn blue btn-block'});
                                $('#kode-verifikasi-result').html('Belum menerima SMS? Silahkan ulangi lagi.');
                                clearInterval(id);
                            } 
                            else 
                            {
                                $('#kode-verifikasi-result').html('SMS berisi kode sedang dikirim ...');
                                //$('#kode-verifikasi-result').html(counter.toString() + ' Mengirim SMS Kode Verifikasi ...');
                            }
                        }, 1000);
                        // $('#kode-verifikasi-result').html('<div class="alert alert-success" role="alert"><strong>Kesalahan !</strong><br/>' + result.msg + '</div>');
                    }
                },
                error       : function(result){
                    $('#btn_req_verifikasi_hp').removeAttr('disabled');
                    $('#btn_req_verifikasi_hp').attr({'class' : 'btn blue btn-block'});
                    $('#kode-verifikasi-result').html('<div class="alert alert-danger" role="alert">Permintaan Kode Verifikasi gagal</div>');
                }
            })
            return false;
        }

        function post_kode_verifikasi_hp()
        {
            $.ajax({
                url         : "<?=site_url('API/auth/post_kode_verifikasi_hp')?>",
                method      : "POST",
                dataType    : "json",
                data        : "no_hp=<?=$data->no_hp?>&kode=" + $('#kode_verifikasi').val(),
                success     : function(result){
                    if(result.status == '201')
                    {                       
                        $('#post-kode-verifikasi-result').html('<div class="alert alert-danger" role="alert"><strong>Kesalahan !</strong><br/>' + result.msg + '</div>');
                    }
                    else
                    {
                        $('#post-kode-verifikasi-result').html('<div class="alert alert-success" role="alert"><strong>Sukses !</strong><br/>' + result.msg + '</div>');
                        window.location = "<?=site_url('panel/profil')?>";
                    }
                },
                error       : function(result){
                    $('#post-kode-verifikasi-result').html('<div class="alert alert-danger" role="alert"><strong>Kesalahan !</strong><br/>Submit kode verifikasi gagal!</strong></div>');
                }
            })
            return false;        
        }
    </script>
<?php } ?>