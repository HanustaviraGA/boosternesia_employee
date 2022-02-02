<?php
    include 'koneksi.php';
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['pegawai'])){
        
    }else if(!isset($_SESSION['pegawai'])){
        header('Location: login.php');
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
  <link href="http://localhost:80/absensi" rel="home"/>
  <link href="http://localhost:80/absensi/absensi/index.php" rel="canonical"/>

  <!--Title-->
  <title>Boosternesia Employee Management</title>
  <meta name="description" content="Halaman Pengguna Boosternesia Employee Management, Aplikasi Sistem Absensi Online Berbasis Foto Selfie dan Auto Detect Lokasi. Absen Karyawan Kini Jadi Lebih Efisien. Sistem absensi dengan verifikasi foto selfie atau webcam, dilengkapi fitur deteksi lokasi pengguna yang akurat."/>
  <meta name="keywords" content="absensi online, aplikasi absensi, aplikasi absensi online, sistem absensi online, absensi online pemerintah, absensi online perusahaan"/>

  <!--OG-->
  <meta content="website" property="og:type"/>
  <meta content="Boosternesia Employee Management" property="og:title"/>
  <meta content="Aplikasi Sistem Absensi Online Berbasis Foto Selfie dan Auto Detect Lokasi. Absen Karyawan Kini Jadi Lebih Efisien. Sistem absensi dengan verifikasi foto selfie atau webcam, dilengkapi fitur deteksi lokasi pengguna yang akurat." property="og:description"/>
  <meta content="http://localhost:80/absensi/absensi/index" property="og:url"/>
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
  <meta content="http://localhost:80/absensi/absensi/index" property="twitter:url"/>
  <meta content="Boosternesia Employee Management" property="twitter:title"/>
  <meta content="Aplikasi Sistem Absensi Online Berbasis Foto Selfie dan Auto Detect Lokasi. Absen Karyawan Kini Jadi Lebih Efisien. Sistem absensi dengan verifikasi foto selfie atau webcam, dilengkapi fitur deteksi lokasi pengguna yang akurat." property="twitter:description"/>
  <meta content="content/logo/absensionline.jpg" property="twitter:image"/>

  <!--Webapp-->
  <link href="http://localhost:80/absensi/manifest.json" rel="manifest"/>
  <meta content="http://localhost:80/absensi" name="msapplication-starturl"/>
  <meta content="http://localhost:80/absensi" name="start_url"/>
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
  <link href="http://localhost:80/absensi/favicon.png" rel="apple-touch-icon"/>
  <link href="http://localhost:80/absensi/favicon.png" rel="shortcut icon" type="image/x-icon"/>
  <link href="content/logo/boosternesia4.png" rel="icon" sizes="32x32"/>
  <meta content="content/logo/boosternesia4.png" name="msapplication-TileImage"/>
  <link href="content/logo/boosternesia4.png" rel="apple-touch-icon"/>
  <link href="content/logo/boosternesia4.png" rel="icon" sizes="48x48"/>
  <link href="content/logo/boosternesia4.png" rel="icon" sizes="72x72"/>
  <link href="content/logo/boosternesia4.png" rel="icon" sizes="96x96"/>
  <link href="content/logo/boosternesia4.png" rel="icon" sizes="168x168"/>
  <link href="content/logo/boosternesia4.png" rel="icon" sizes="192x192"/>
  <link href="content/logo/boosternesia4.png" rel="icon" sizes="512x512"/>

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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap.css">
</head>

<body>
<div class="loading"><div class="spinner-border text-primary" role="status"></div></div>
  <!-- loader -->
    <div id="loader">
        <img src="assets/img/Preloader.gif" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->
<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <img src="content/headerweb.png" alt="logo" class="logo">
        </div>
        <div class="right">
            <div class="headerButton" data-toggle="dropdown" id="dropdownMenuLink" aria-haspopup="true">
                <img src="assets/img/<?= $_SESSION['img'];?>" alt="image" class="imaged w40">
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">                <a class="dropdown-item" onclick="location.href='profil.php';" href="profil.php"><ion-icon size="small" name="person-outline"></ion-icon>Profil</a>
                <a class="dropdown-item" onclick="location.href='controller.php?aksi=logout';" href="controller.php?aksi=logout"><ion-icon size="small" name="log-out-outline"></ion-icon>Keluar</a>
              </div>
            </div>
        </div>
    </div>
    <?php
        include 'assets/layout/sidebar.php'
    ?>
    <!-- App Capsule -->
    <div id="appCapsule">
        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <!--<div class="balance">
                    <div class="left">
                        <span class="title"> Selamat Malam</span>
                        <h4>Badrul Juki</h4>
                    </div>
                    <div class="right">
                        <span class="title">13 Des 2022 </span>
                        <h4><span class="clock"></span></h4>
                    </div>

                </div>-->
                <!-- * Balance -->
                <?php
                    $datetime = date_default_timezone_set('Asia/Jakarta'); 
                    $date = date("Y-m-d");
                    $time = date("H:i:s");
                    $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                    $tanggal_hari = (int)date('d', strtotime($date));
                    $bulan_hari = $month[((int)date('m', strtotime($date))) - 1];
                    $tahun_hari = (int)date('Y', strtotime($date));
                ?>
                <div class="text-center"><h3><span id="time"></span></h3></div>
                <div class="wallet-footer text-center">
                    <div class="webcam-capture-body text-center">
                        
                    </div>
                </div>
                <!-- * Wallet Footer -->
                
            </div>
        </div>
        <!-- Card -->
            <div class="section mt-2">
                    <div class="section-title">Data Absensi</div>
                    <div class="card">
                        <div class="table-responsive">
                            <table id="table_id" class="display">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Kode</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>13 Desember 2022</td>
                                        <td>A131222</td>
                                        <td>14.30</td>
                                        <td>19.00</td>
                                        <td><button class="btn btn-primary btn-lg btn-block" id="swal_upload">IN</button></td>
                                    </tr>
                                    <tr>
                                        <td>12 Desember 2022</td>
                                        <td>A131222</td>
                                        <td>13.30</td>
                                        <td>18.00</td>
                                        <td><button class="btn btn-primary btn-lg btn-block" id="swal_upload">IN</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>
    <!-- * App Capsule -->

    <?php 
        include 'assets/layout/footbar.php';
    ?>
<!-- * App Bottom Menu -->
<!-- ///////////// Js Files ////////////////////  -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">ID Pelaporan</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_id_pelaporan">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Ticket</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_ticket">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Nama Lengkap</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_nama">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">NIK</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_nik">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Unit Layanan</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_tujuan">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Keperluan</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_keperluan">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Keterangan</span>
                        <input type="text" style="width:350px; height:auto;" class="form-control" id="m_keterangan">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Lampiran</span>
                            <a href = "../berkas/" target="_blank" id="m_lampiran">
                        </a>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Tanggal Pelaporan</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_tanggal_pelaporan">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Kabupaten / Kota</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_kabupaten_kota">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Kecamatan</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_kecamatan">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Kelurahan / Desa</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_kelurahan_desa">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" style="width:150px;">Status</span>
                        <input type="text" style="width:350px;" class="form-control" id="m_status">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
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
<script type="text/javascript">
var timestamp = '<?=date("H:i:s");?>';
function updateTime(){
  $('#time').html(Date(timestamp));
  timestamp++;
}
$(function(){
  setInterval(updateTime, 1000);
});
</script>
<script>
    $('#swal_upload').click(function() {
        $('#detailModal').modal('show');
})
</script>
<script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
} );
    // Disable search and ordering by default
    $.extend( $.fn.dataTable.defaults, {
        searching: false
    } );
    
    // For this specific table we are going to enable ordering
    // (searching is still disabled)
    $('#table_id').DataTable( {
        ordering: true
    } );
</script>
  <!-- </body></html> -->
  </body>
</html>
