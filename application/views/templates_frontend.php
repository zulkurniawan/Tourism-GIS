<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?=$meta_title?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="google-site-verification" content="tzDAhHVClAt3uFEzsAUFTmOj8vPkTt79UyKC5SWbUrs" />
        <meta content="<?=$meta_author?>" name="author" />
        <meta content="<?=$meta_description?>" name="description" />
        <meta content="<?=$meta_keywords?>" name="keywords" />

        <!-- <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
        <link href="<?=base_url()?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url()?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/layouts/layout4/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?=base_url()?>/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/custom_style.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 
        
        <link rel="stylesheet" href="<?=base_url()?>/assets/new/animate.css" />
        <link rel="stylesheet" href="<?=base_url()?>/assets/new/owlcarousel/owl.carousel.min.css" />
        
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css" /> -->


        <script src="<?=base_url()?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/jquery.lazyload.min.js" type="text/javascript"></script>
        
        <script src="<?=base_url()?>/assets/new/owlcarousel/owl.carousel.min.js"></script>
        <script src="<?=base_url()?>/assets/new/wow.min.js"></script>
        
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>-->
        <script>
          new WOW().init();
        </script>

        <!-- <script src="<?=base_url()?>/assets/jquery.lazyload.min.js" type="text/javascript"></script> -->
        <script src="<?=base_url()?>/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/clipboard.js/dist/clipboard.js" type="text/javascript"></script>
        <!-- <script src="<?=base_url()?>/assets/pages/scripts/ui-blockui.min.js" type="text/javascript"></script> -->
        <!-- <script src="<?=base_url()?>/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script> -->
        <!-- <script src="<?=base_url()?>/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
        <script src="https://maps.googleapis.com/maps/api/js?key=<?=$this->config->item('map_api')?>&language=id"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.appear/0.3.3/jquery.appear.min.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/unveil/1.3.0/jquery.unveil.min.js"></script>         -->

        <!-- Custom -->
        <script src="<?=base_url()?>/assets/global/scripts/custom.js" type="text/javascript"></script>

    </head>

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md page-footer-fixed">
        <div id="preloader" class="preloader-wrapper">
            <div class="preloader">
                <span></span>
                <span></span>
            </div>
        </div>

        <?php
            if(!empty($main_content))
            { 
                $this->load->view($main_content); 
            } 
        ?>      

        <nav class="navbar navbar-default navbar-fixed-bottom footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-xs-6">
                        <div class="navbar-header"> 
                            <a href="<?=site_url()?>" class="navbar-brand"><?=date('Y')?> © <?=$this->config->item('app_name')?>.</a> 
                        </div>                
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <ul class="nav navbar-nav navbar-right"> 
                            <?php if($login_status == 'ok'){ ?>
                                <li class="pull-right">
                                    <button onclick="go_logout();" class="btn btn-sm btn-danger btn-login-choose"> 
                                        <i class="fa fa-sign-out"></i> <span class="hidden-xs hidden-sm">Logout</span>
                                    </button>
                                </li> 
                                <li class="pull-right hidden-sm hidden-xs">
                                    <button onclick="go_dashboard();" class="btn btn-sm btn-info btn-login-choose"> 
                                        <i class="fa fa-sign-in"></i> <span class="hidden-xs hidden-sm">Masuk Panel</span>
                                    </button>
                                </li> 
                            <?php } else { ?>
                                <li class="pull-right">
                                    <button data-toggle="modal" href="#modal-pilih-login" class="btn btn-info btn-sm btn-login-choose">
                                        <i class="fa fa-users"></i> <span class="hidden-xs hidden-sm">Daftar / Login</span>
                                    </button> 
                                </li> 
                            <?php } ?>
                        </ul> 
                    </div>
                </div>
            </div>
        </nav>

        <?php if($login_status != 'ok'){ ?>
            <div class="modal fade" id="modal-login" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <form role="form" id="form-login">
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="icon-login"></i>&nbsp;&nbsp;&nbsp;Login</h4>
                            </div>
                            <div class="modal-body"> 
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" name="email">
                                        <label>Email / No Hp</label>
                                        <span class="help-block">Gunakan no hp jika sudah terverifikasi</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="password" class="form-control" name="password">
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
                            </div>
                            <!--<div class="modal-footer">
                                <a href="<?=site_url('API/auth/login_with_google')?>" class="btn btn-danger btn-block">
                                    <i class="fa fa-google-plus"></i> dengan Google+
                                </a>
                                <a href="<?=site_url('API/auth/login_with_fb')?>" class="btn btn-primary btn-block">
                                    <i class="fa fa-facebook"></i> dengan Facebook
                                </a>
                                <a href="<?=site_url('API/auth/login_with_ig')?>" class="btn purple-studio btn-block">
                                    <i class="fa fa-instagram"></i> dengan Instagram
                                </a>
                            </div>-->
                        </form>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $('#form-login').on('submit',function(){
                    $('#form-login-result').html('');
                    $.ajax({
                        url         : "<?=site_url('API/auth/login')?>",
                        method      : "POST",
                        dataType    : "json",
                        data        : $('#form-login').serialize(),
                        success     : function(result){
                            if(result.status == '201')
                            {
                                $('#form-login-result').html('<div class="alert alert-danger" role="alert"><strong>Kesalahan !</strong><br/>' + result.data + '</div>');
                            }
                            else
                            {
                                $('#form-login-result').html('<div class="alert alert-success" role="alert">' + result.data + '</div>');                    
                                window.location = "<?=site_url()?>";
                            }
                        },
                        error       : function(result){
                            $('#form-login-result').html('<?=err_msg('Gagal melakukan login.')?>');
                        }
                    })
                    return false;
                });
            </script>        

            <div class="modal fade" id="modal-pilih-login" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <form role="form" id="form-login">
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="icon-users"></i>&nbsp;&nbsp;&nbsp;Selamat Datang</h4>
                            </div>
                            <div class="modal-body"> 
                                <a data-toggle="modal"  data-dismiss="modal" href="#modal-login" class="btn btn-info btn-block"> 
                                    <i class="fa fa-sign-in"></i> Login 
                                </a> 
                                <a href="<?=site_url('user/register')?>" class="btn red btn-block"> 
                                    <i class="fa fa-user-plus"></i> Daftar 
                                </a> 
                                <!--
                                <a href="<?=site_url('user/verifikasi')?>" class="btn btn-info btn-block"> 
                                    <i class="fa fa-check"></i> Verifikasi Akun 
                                </a>
                                --> 
                                <hr style="margin: 10px 0px;/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn default btn-block" data-dismiss="modal">
                                    <i class="fa fa-times"></i>&nbsp;&nbsp;&nbsp;Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>        
        <?php } ?>


        <div class="modal fade" id="bagikan_halaman" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="text-right pull-right hidden-lg hidden-md">
                            <button class="btn btn-info" data-clipboard-target="#url_bagikan_halaman" id="btn-copy-url">
                                <i class="fa fa-clipboard"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Copy URL</span>
                            </button>
                            <button type="button" class="btn default" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <h4 class="modal-title">
                            <span class="hidden-xs hidden-sm">
                                <i class="fa fa-share-alt"></i>&nbsp;&nbsp;Bagikan Halaman
                            </span>&nbsp;
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div class="form-body">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" class="form-control edited" readonly="" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" id="url_bagikan_halaman">
                                    <label>URL</label>
                                </div>
                            </div>
                        </form>
                        <h5 class="url_sukses_copy"></h5>
                    </div>
                    <div class="modal-footer hidden-xs hidden-sm">
                        <button class="btn btn-info" data-clipboard-target="#url_bagikan_halaman" id="btn-copy-url">
                            <i class="fa fa-clipboard"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Copy URL</span>
                        </button>
                        <button type="button" class="btn grey" data-dismiss="modal">
                            <i class="fa fa-close"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp;Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $('#bagikan_halaman').on('hidden.bs.modal', function() {
                $('#bagikan_halaman .url_sukses_copy').html('');
            });

            function manual_show_modal_bagikan_halaman(url)
            {
                $('#bagikan_halaman #url_bagikan_halaman').val(url);
                $('#bagikan_halaman').modal();
            }

            var clipboard = new Clipboard('#btn-copy-url');

            clipboard.on('success', function(e) {
                $('#bagikan_halaman .url_sukses_copy').html('<b>Url berhasil disalin ke clipboard !.</b>');
            });

            <?php if(!empty($login_status)){ ?>
                function go_dashboard()
                {
                    window.location = "<?=site_url('panel/dashboard')?>";
                }

                function go_logout()
                {
                    window.location = "<?=site_url('API/auth/logout')?>";
                }
            <?php } ?>
        </script>

        <script>
            $('html').addClass('is-loading');
            $(window).load(function () {
                            $('#preloader').delay(350).fadeOut('slow');
                $('html').removeClass('is-loading');
            });

            $(document).ready(function() {

            });
        </script>

        <script>

            function lazyLoad(){
                var $images = $('.lazy_load');

                $images.each(function(){
                    var $img = $(this),
                        src = $img.attr('data-src');

                    $img
                        .on('load',imgLoaded($img[0]))
                        .attr('src',src);
                    });
                };

        </script>
        
       
        
    </body>
</html>