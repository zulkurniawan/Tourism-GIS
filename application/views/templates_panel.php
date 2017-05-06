<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?=$meta_title?> :: User Panel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
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

        <script src="<?=base_url()?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <!-- <script src="<?=base_url()?>/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script> -->
        <!-- <script src="<?=base_url()?>/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->

        <link rel="shortcut icon" href="favicon.ico" /> 
    </head>

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo  page-md">
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <div class="page-top">
            <!--<div class="page-logo">
                    <a href="<?=site_url()?>">
                        <img src="<?=base_url()?>/assets/layouts/layout4/img/logo-light.png" alt="logo" class="logo-default" /> 
                    </a>
                </div> -->
                    <div class="top-menu">
                        
                        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                        
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username"> <?=$nama_user?> </span>&nbsp;&nbsp;
                                    <img alt="" class="img-rounded" src="<?=load_foto_user($foto_user)?>" /> 
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <br/><li>
                                        <a href="<?=site_url('panel/profil')?>">
                                            <i class="icon-user"></i> Profil Saya
                                        </a>
                                    </li><br/>
                                    <li>
                                        <a href="<?=site_url('API/auth/logout')?>">
                                            <i class="icon-logout"></i> Logout 
                                        </a>
                                    </li><br/>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item start <?=@$page_active == 'dashboard' ? 'active' : ''?>">
                            <a href="<?=site_url('panel/dashboard')?>" class="nav-link">
                                <i class="icon-wrench"></i>
                                <span class="title">Control Panel</span>
                            </a>
                        </li>
                        <!--<li class="nav-item <?=@$page_active == 'profil' ? 'active' : ''?>">
                            <a href="<?=site_url('panel/profil')?>" class="nav-link">
                                <i class="icon-user"></i>
                                <span class="title">Profil Saya</span>
                            </a>
                        </li>
                        <?php if($login_level == 'Kontributor'){ ?>
                            <li class="nav-item <?=@$page_active == 'poin' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/poin')?>" class="nav-link">
                                    <i class="icon-pie-chart"></i>
                                    <span class="title">Poin Reward</span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item <?=@$page_active == 'poin' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/poin/top')?>" class="nav-link">
                                    <i class="icon-users"></i>
                                    <span class="title">Top Kontributor</span>
                                </a>
                            </li>
                        <?php } ?>-->
                        <li class="nav-item start ">
                            <a href="<?=site_url()?>" class="nav-link">
                                <i class="icon-globe"></i>
                                <span class="title">Peta Wisata</span>
                            </a>
                        </li>
                        <!--<li class="nav-item start ">
                            <a href="<?=site_url('API/auth/logout')?>" class="nav-link">
                                <i class="icon-logout"></i>
                                <span class="title">Logout</span>
                            </a>
                        </li>-->
                        <?php if($login_level == 'Administrator' || $login_level == 'Partners'){ ?>
                            <li class="heading"><h3 class="uppercase">Statistik</h3></li>
                            <li class="nav-item <?=@$page_active == 'statistik_objek' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/statistik_objek')?>" class="nav-link ">
                                    <i class="icon-bar-chart"></i>
                                    <span class="title">Lokasi Wisata</span>
                                </a>
                            </li>
                            <li class="nav-item <?=@$page_active == 'statistik_akomodasi' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/statistik_akomodasi')?>" class="nav-link ">
                                    <i class="icon-bar-chart"></i>
                                    <span class="title">Bisnis Akomodasi</span>
                                </a>
                            </li>
                            <li class="nav-item <?=@$page_active == 'statistik_web' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/statistik_web')?>" class="nav-link ">
                                    <i class="icon-bar-chart"></i>
                                    <span class="title">Pemirsa Peta</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($login_level == 'Administrator' || $login_level == 'Kontributor'){ ?>
                            <li class="heading"><h3 class="uppercase">Kontributor</h3></li>
                            <li class="nav-item <?=@$page_active == 'galeri' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/galeri')?>" class="nav-link ">
                                    <i class="icon-camera"></i>
                                    <span class="title">Upload Foto</span>
                                </a>
                            </li>
                            <li class="nav-item <?=@$page_active == 'artikel' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/artikel')?>" class="nav-link ">
                                    <i class="icon-list"></i>
                                    <span class="title">Tulis Artikel</span>
                                </a>
                            </li>
                            <li class="nav-item <?=@$page_active == 'objek' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/objek')?>" class="nav-link ">
                                    <i class="icon-pointer"></i>
                                    <span class="title">Info Lokasi</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($login_level == 'Administrator' || $login_level == 'Partners'){ ?>
                            <li class="heading"><h3 class="uppercase">Partners</h3></li>
                            <li class="nav-item <?=@$sub_page_active == 'akomodasi_objek' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/akomodasi_objek')?>" class="nav-link ">
                                    <i class="icon-pointer"></i>
                                    <span class="title">Informasi Bisnis</span>
                                </a>
                            </li>
                            <li class="nav-item <?=@$sub_page_active == 'akomodasi_artikel' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/akomodasi_artikel')?>" class="nav-link ">
                                    <i class="icon-list"></i>
                                    <span class="title">Artikel Produk</span>
                                </a>
                            </li>
                            <li class="nav-item <?=@$sub_page_active == 'akomodasi_galeri' ? 'active' : ''?>">
                                <a href="<?=site_url('panel/akomodasi_galeri')?>" class="nav-link ">
                                    <i class="icon-camera"></i>
                                    <span class="title">Foto Produk</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($login_level == 'Administrator'){ ?>
                            <li class="heading"><h3 class="uppercase">Administrator</h3></li>
                            <li class="nav-item <?=@$page_active == 'kategori' ? 'active' : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-tag"></i>
                                    <span class="title">Kategori</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item <?=@$sub_page_active == 'kategori_wisata' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/kategori')?>" class="nav-link">
                                            <i class="icon-tag"></i>
                                            <span class="title">Objek Wisata</span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?=@$sub_page_active == 'kategori_akomodasi' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/akomodasi_kategori')?>" class="nav-link">
                                            <i class="icon-tag"></i>
                                            <span class="title">Objek Akomodasi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item <?=@$page_active == 'donasi' ? 'active' : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-badge"></i>
                                    <span class="title">Donasi</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item <?=@$sub_page_active == 'donasi_bank' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/donasi_bank')?>" class="nav-link">
                                            <i class="icon-briefcase"></i>
                                            <span class="title">Bank</span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?=@$sub_page_active == 'donasi_rekening' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/donasi_rekening')?>" class="nav-link">
                                            <i class="icon-credit-card"></i>
                                            <span class="title">Rekening</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?=@$page_active == 'user' ? 'active' : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-users"></i>
                                    <span class="title">Manajemen User</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item <?=@$sub_page_active == 'index' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/user')?>" class="nav-link">
                                            <i class="icon-users"></i>
                                            <span class="title">Administrator</span>
                                        </a>
                                    </li>         
                                    <li class="nav-item <?=@$sub_page_active == 'kontributor' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/user/kontributor')?>" class="nav-link">
                                            <i class="icon-users"></i>
                                            <span class="title">Kontributor</span>
                                        </a>
                                    </li>         
                                    <li class="nav-item <?=@$sub_page_active == 'partners' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/user/partners')?>" class="nav-link">
                                            <i class="icon-users"></i>
                                            <span class="title">Partners</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>        
                            <li class="nav-item <?=@$page_active == 'konfigurasi' ? 'active' : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-wrench"></i>
                                    <span class="title">Konfigurasi</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item <?=@$sub_page_active == 'mail_templates' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/mail_templates')?>" class="nav-link">
                                            <i class="icon-envelope-letter"></i>
                                            <span class="title">Template Email</span>
                                        </a>
                                    </li>                        
                                    <li class="nav-item <?=@$sub_page_active == 'sms_templates' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/sms_templates')?>" class="nav-link">
                                            <i class="icon-envelope"></i>
                                            <span class="title">Template SMS</span>
                                        </a>
                                    </li>                        
                                    <li class="nav-item <?=@$sub_page_active == 'konfigurasi' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/konfigurasi')?>" class="nav-link">
                                            <i class="icon-wrench"></i>
                                            <span class="title">Konfigurasi Lainnya</span>
                                        </a>
                                    </li> 
                                </ul>
                            </li>                       
                        <?php } ?>
                        
                        <li class="heading"><h3 class="uppercase">Akun</h3></li>
                            <li class="nav-item <?=@$page_active == 'kategori' ? 'active' : ''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-user"></i>
                                    <span class="title">Akun Saya</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item <?=@$sub_page_active == 'kategori_wisata' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/profil')?>" class="nav-link">
                                            <i class="icon-user"></i>
                                            <span class="title">Profil Saya</span>
                                        </a>
                                    </li>
                                <?php if($login_level == 'Kontributor'){ ?>
                                    <li class="nav-item <?=@$page_active == 'poin' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/poin')?>" class="nav-link">
                                            <i class="icon-pie-chart"></i>
                                            <span class="title">Poin Saya</span>
                                        </a>
                                    </li><hr/>
                                    <!-- <li class="nav-item <?=@$page_active == 'poin' ? 'active' : ''?>">
                                        <a href="<?=site_url('panel/poin/top')?>" class="nav-link">
                                            <i class="icon-users"></i>
                                            <span class="title">Kontributor Lainnya</span>
                                        </a>
                                    </li> -->
                                <?php } else { ?>
                                    
                                <?php } ?>
                                <li class="nav-item <?=@$sub_page_active == 'kategori_akomodasi' ? 'active' : ''?>">
                                    <a href="<?=site_url('API/auth/logout')?>" class="nav-link">
                                        <i class="icon-arrow-left"></i>
                                        <span class="title">Logout</span>
                                    </a>
                                </li>
                                </ul>
                                
                            </li>
                    </ul>
                </div>
            </div>
            <?php if(!empty($main_content)){ ?>
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <?php 
                            echo $msg;
                            $this->load->view($main_content);
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="page-footer">
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <script type="text/javascript">
            <?php if(empty($main_content)){ ?>
                $('.menu-toggler').click();
            <?php } ?>
        </script>
    </body>
</html>