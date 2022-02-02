<?php
    include 'koneksi.php';
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['pegawai'])){
        header('Location: index.php');
    }else if(!isset($_SESSION['pegawai'])){
        
    }
?>

<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">
<head>

  <!--Viewport -->
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>

  <!--Canonical-->
  <meta content="all" name="robots"/>
  <link href="pegawai" rel="home"/>
  <link href="pegawai/absensi/index.php" rel="canonical"/>

  <!--Title-->
  <title>Boosternesia Employee Management</title>
  <meta name="description" content="Halaman Pengguna Boosternesia Employee Management, Aplikasi Sistem Absensi Online Berbasis Foto Selfie dan Auto Detect Lokasi. Absen Karyawan Kini Jadi Lebih Efisien. Sistem absensi dengan verifikasi foto selfie atau webcam, dilengkapi fitur deteksi lokasi pengguna yang akurat."/>
  <meta name="keywords" content="absensi online, aplikasi absensi, aplikasi absensi online, sistem absensi online, absensi online pemerintah, absensi online perusahaan"/>

  <!--OG-->
  <meta content="website" property="og:type"/>
  <meta content="Boosternesia Employee Management" property="og:title"/>
  <meta content="Aplikasi Sistem Absensi Online Berbasis Foto Selfie dan Auto Detect Lokasi. Absen Karyawan Kini Jadi Lebih Efisien. Sistem absensi dengan verifikasi foto selfie atau webcam, dilengkapi fitur deteksi lokasi pengguna yang akurat." property="og:description"/>
  <meta content="absensi/index" property="og:url"/>
  <meta content="Boosternesia Employee Management" property="og:site_name"/>
  <meta content="Boosternesia Employee Management" property="og:headline"/>
  <meta content="content/logo/absensionline.jpg" property="og:image"/>
  <meta content="1920" property="og:image:width"/>
  <meta content="1080" property="og:image:height"/>
  <meta content="id_ID" property="og:locale"/>
  <meta content="en_US" property="og:locale:alternate"/>
  <meta content="true" property="og:rich_attachment"/>
  <meta content="true" property="pinterest-rich-pin"/>
  <meta content="" property="fb:app_id"/>
  <meta content="" property="fb:pages"/>
  <meta content="" property="fb:admins"/>
  <meta content="" property="fb:profile_id"/>
  <meta content="Boosternesia Employee Management" property="article:author"/>
  <meta content="summary_large_image" name="twitter:card"/>
  <meta content="@mycodingxd" name="twitter:site"/>
  <meta content="@mycodingxd" name="twitter:creator"/>
  <meta content="pegawai/absensi/index" property="twitter:url"/>
  <meta content="Boosternesia Employee Management" property="twitter:title"/>
  <meta content="Aplikasi Sistem Absensi Online Berbasis Foto Selfie dan Auto Detect Lokasi. Absen Karyawan Kini Jadi Lebih Efisien. Sistem absensi dengan verifikasi foto selfie atau webcam, dilengkapi fitur deteksi lokasi pengguna yang akurat." property="twitter:description"/>
  <meta content="pegawai/content/logo/absensionline.jpg" property="twitter:image"/>

  <!--Webapp-->
  <link href="pegawai/manifest.json" rel="manifest"/>
  <meta content="pegawai" name="msapplication-starturl"/>
  <meta content="pegawai" name="start_url"/>
  <meta content="Boosternesia Employee Management" name="application-name"/>
  <meta content="Boosternesia Employee Management" name="apple-mobile-web-app-title"/>
  <meta content="Boosternesia Employee Management" name="msapplication-tooltip"/>
  <meta content="#00B4FF" name="theme_color"/>
  <meta content="#00B4FF" name="theme-color"/>
  <meta content="#FFFFFF" name="background_color"/>
  <meta content="#00B4FF" name="msapplication-navbutton-color"/>
  <meta content="#00B4FF" name="msapplication-TileColor"/>
  <meta content="#00B4FF" name="apple-mobile-web-app-status-bar-style"/>
  <meta content="true" name="mssmarttagspreventparsing"/>
  <meta content="yes" name="apple-mobile-web-app-capable"/>
  <meta content="yes" name="mobile-web-app-capable"/>
  <meta content="yes" name="apple-touch-fullscreen"/>
  <link href="assets/favicon.png" rel="apple-touch-icon"/>
  <link href="assets/favicon.png" rel="shortcut icon" type="image/x-icon"/>
  <link href="content/logo/absensionline32.png" rel="icon" sizes="32x32"/>
  <meta content="content/logo/absensionline144.png" name="msapplication-TileImage"/>
  <link href="content/logo/absensionline180.png" rel="apple-touch-icon"/>
  <link href="content/logo/absensionline48.png" rel="icon" sizes="48x48"/>
  <link href="content/logo/absensionline72.png" rel="icon" sizes="72x72"/>
  <link href="content/logo/absensionline96.png" rel="icon" sizes="96x96"/>
  <link href="content/logo/absensionline168.png" rel="icon" sizes="168x168"/>
  <link href="content/logo/absensionline192.png" rel="icon" sizes="192x192"/>
  <link href="content/logo/absensionline512.png" rel="icon" sizes="512x512"/>

  <!--Author-->
  <meta content="Boosternesia Employee Management" name="author" />
  <meta content="401XD Group" name="publisher"/>

  <!--verification-->
  <meta name="yandex-verification" content=""/>
  <meta name="p:domain_verify" content=""/>
  <meta name="msvalidate.01" content=""/>
  <meta name="google-site-verification" content="" />
  <meta name="dmca-site-verification" content=""/>
  <meta name="facebook-domain-verification" content=""/>

  <!--Location-->
  <meta content="ID" name="geo.region"/>
  <meta content="Indonesia" name="geo.country"/>
  <meta content="Indonesia" name="geo.placename"/>
  <meta content="x;x" name="geo.position"/>
  <meta content="x,x" name="ICBM"/>

  <!--resource-->
  <link href="//fonts.googleapis.com" rel="preconnect dns-prefetch"/>
  <link href="//api.github.com" rel="preconnect dns-prefetch"/>
  <link href="//api.mapbox.com" rel="preconnect dns-prefetch"/>
  <link href="//cdnjs.cloudflare.com" rel="preconnect dns-prefetch"/>
  <link href="//unpkg.com" rel="preconnect dns-prefetch"/>
  <link href="//kit.fontawesome.com" rel="preconnect dns-prefetch"/>

  <!--CSS-->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/sw-custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Jquery -->
  <script src="assets/js/lib/jquery-3.4.1.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

<?php 

    if(isset($_GET['pesan']) == 'sukses'){
        echo "<script type = 'text/javascript'>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Registrasi berhasil silahkan cek e-mail Anda',
            })
        </script>";
    }

?>
<div class="loading"><div class="spinner-border text-primary" role="status"></div></div>
  <!-- loader -->
    <div id="loader">
        <img src="assets/img/Preloader.gif" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->
    
 <!-- App Capsule -->
    <?php if(!isset($_GET['aksi']) == 'verifikasi') { ?>
        <div id="appCapsule">
            <div style="background:#222;border-radius:30px;margin:0 16px;padding:10px 15px" class="section text-center">
                <img src="content/headerweb.png" height="70">
                <h4 style="color:#FFFFFF;">Employee Registration Protocol</h4>
            </div>
            <div class="section mb-5 p-2">
                <form action="controller.php?aksi=register" method="POST" role="form" id="form-login" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-body pb-1">
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="email1">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukkan Kode" required>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="password1">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="email1">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" required>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="email1">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan Tanggal Lahir" required>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="email1">Jabatan</label>
                                    <select id="jabatan" name="jabatan" class="form-control custom-select">
                                        <option selection disabled>Jabatan</option>
                                        <?php 
                                            $query = $koneksi->prepare("SELECT * FROM jabatan");
                                            $query->execute();
                                            $query_res = $query->get_result();
                                        ?>
                                        <?php while($id = $query_res->fetch_array()){?>
                                            <option value="<?= $id['ref']?>"><?= $id['jabatan']?></option>
                                        <?php } ?>
                                    </select>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="email1">Asal Abdi</label>
                                    <select id="asal_abdi" name="asal_abdi" class="form-control custom-select">
                                        <option selection disabled>Asal Abdi</option>
                                        <?php 
                                            $query = $koneksi->prepare("SELECT * FROM asal_abdi");
                                            $query->execute();
                                            $query_res = $query->get_result();
                                        ?>
                                        <?php while($id = $query_res->fetch_array()){?>
                                            <option value="<?= $id['ref']?>"><?= $id['asal_abdi']?></option>
                                        <?php } ?>
                                    </select>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="email1">Tanggal Bergabung</label>
                                    <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" placeholder="Masukkan Tanggal Bergabung" required>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="email1">DORT</label>
                                    <select id="dort" name="dort" class="form-control custom-select">
                                        <option selection disabled>DORT</option>
                                        <?php 
                                            $query = $koneksi->prepare("SELECT * FROM dort");
                                            $query->execute();
                                            $query_res = $query->get_result();
                                        ?>
                                        <?php while($id = $query_res->fetch_array()){?>
                                            <option value="<?= $id['ref']?>"><?= $id['dort']?></option>
                                        <?php } ?>
                                    </select>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="email1">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="link_wa" name="link_wa" placeholder="Masukkan Nomor Telepon" required>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="password1">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan E-mail" required>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="password1">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="email1">Foto Profil</label>
                                    <input type="file" class="form-control" id="files[]" name="files[]" placeholder="Masukkan Foto Profil" required>
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-button-group transparent">
                    <button type="submit" id="submit" name="submit" class="btn btn-success btn-block">Register</button>
                    <a href="login.php" class="btn btn-success btn-block">Login</a>
                    </div>
                </form>
            </div>

        </div>
    <?php } else if(isset($_GET['aksi']) == 'verifikasi') { ?>
        <?php 
            $no_id = $_GET['no_id'];   
        ?>
        <div id="appCapsule">
        <div style="background:#222;border-radius:30px;margin:0 16px;padding:10px 15px" class="section text-center">
            <img src="content/headerweb.png" height="70">
            <h4 style="color:#FFFFFF;">Employee Registration Protocol</h4>
        </div>
        <div class="section mb-5 p-2">
            <form action="controller.php?aksi=verifikasi" method="POST" role="form" id="form-login" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">Nomor ID</label>
                                <input type="text" class="form-control" id="input_noid" name="input_noid" placeholder="Masukkan Kode" required>
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-button-group transparent">
                   <input type = "hidden" name="no_id" id="no_id" value="<?= $no_id ?>" required>
                   <button type="submit" id="submit" name="submit" class="btn btn-success btn-block">Verifikasi</button>
                </div>
            </form>
        </div>

    </div>
    <?php } ?>
    <!-- * App Capsule -->
<!-- ///////////// Js Files ////////////////////  -->

<!-- Bootstrap-->
<script src="assets/js/lib/popper.min.js"></script>
<script src="assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script src="https://kit.fontawesome.com/0ccb04165b.js" crossorigin="anonymous"></script>
<!-- Base Js File -->
<script src="assets/js/base.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/webcamjs/webcam.min.js"></script>
  </body>
</html>
