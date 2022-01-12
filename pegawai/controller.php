<?php
    session_start();
    session_regenerate_id(true);
    include 'koneksi.php';

    $data = $_REQUEST;

    switch($data['aksi']){
        case 'login':
            $email = mysqli_real_escape_string($koneksi, $_POST['email']);
            $password = mysqli_real_escape_string($koneksi, $_POST['password']);

            $data = $koneksi->prepare("SELECT * FROM header_pegawai WHERE email = ?");
            $data->bind_param('s', $email);
            $data->execute();
            $data_res = $data->get_result();
            if($data_res->num_rows > 0){
                $id = $data_res->fetch_assoc();
                $password_db = $id['password'];
                $verify = password_verify($password, $password_db);
                if($verify){
                    $no_id = $id['no_id'];
                    $db_pegawai = $koneksi->prepare("SELECT * FROM pegawai WHERE no_id = ?");
                    $db_pegawai->bind_param('s', $no_id);
                    $db_pegawai->execute();
                    $db_pegawai_res = $db_pegawai->get_result();
                    if($db_pegawai_res->num_rows > 0){
                        $pegawai = $db_pegawai_res->fetch_assoc();
                        $_SESSION['no_id'] = $pegawai['no_id'];
                        $_SESSION['kode'] = $pegawai['kode'];
                        $_SESSION['nama_lengkap'] = $pegawai['nama_lengkap'];
                        $_SESSION['tanggal_bergabung'] = $pegawai['tanggal_bergabung'];
                        $_SESSION['tempat_lahir'] = $pegawai['tempat_lahir'];
                        $_SESSION['2ch'] = $pegawai['2ch'];
                        $_SESSION['jabatan'] = $pegawai['jabatan'];
                        $_SESSION['asal_abdi'] = $pegawai['asal_abdi'];
                        $_SESSION['dort'] = $pegawai['dort'];
                        $_SESSION['link_no_wa'] = $pegawai['link_no_wa'];
                        $_SESSION['img'] = $id['img'];
                        $_SESSION['status_akun'] = $id['status'];
                        $_SESSION['pegawai'] = 'Pegawai';
                        header("location: index.php?pesan=sukses");
                    }else{
                        echo "Table Unsynchronized";
                    }
                }else{
                    echo "Wrong Password";
                }
            }else{
                echo "Email Not Found";
            }
            break;
        case 'logout':
            unset($_SESSION['pegawai']);
            session_unset();
            session_destroy();
            header("location: login.php");
            break;
        case 'register':
            $email = mysqli_real_escape_string($koneksi, $_POST['email']);
            $password = mysqli_real_escape_string($koneksi, $_POST['password']);
            
            // Sembunyikan password
            $hash_pw = password_hash($password, PASSWORD_DEFAULT);
            $kode = mysqli_real_escape_string($koneksi, $_POST['kode']);
            $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);

            // Setting tanggal bergabung
            $tanggal_bergabung = mysqli_real_escape_string($koneksi, $_POST['tanggal_bergabung']);
            $ambil_bulan_bergabung = date('m', strtotime($tanggal_bergabung));
            $ambil_tahun_bergabung = date('Y', strtotime($tanggal_bergabung));
            $ambil_tahun_bergabung_akhir = substr($ambil_tahun_bergabung, 2, 2);

            $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);

            // Setting tanggal lahir
            $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
            $ambil_hari_lahir = date('d', strtotime($tanggal_lahir));
            $ambil_tahun_lahir = date('Y', strtotime($tanggal_lahir));
            $ambil_tahun_lahir_akhir = substr($ambil_tahun_lahir, 2, 2);

            // Sembunyikan tempat tanggal lahir
            $hash_tempat = base64_encode($tempat_lahir);
            $hash_tanggal_lahir = base64_encode($tanggal_lahir);
            
            // Ambil ch dari dua huruf depan
            $t_ch = substr($nama, 0, 2);
            
            $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
            $asal_abdi = mysqli_real_escape_string($koneksi, $_POST['asal_abdi']);
            $dort = mysqli_real_escape_string($koneksi, $_POST['dort']);
            
            // Settingan link wa
            $wa = mysqli_real_escape_string($koneksi, $_POST['link_wa']);
            if(substr($wa, 0, 1) == '0'){
                $ubah_wa = substr($wa, 1);
                $wa = '62'.$ubah_wa;
            }
            $link_wa = 'https://wa.me/'.$wa.'';
            
            // No Id
            $no_id = $dort.$asal_abdi.'-'.$jabatan.'-'.$ambil_hari_lahir.$ambil_tahun_lahir_akhir.$ambil_bulan_bergabung.$ambil_tahun_bergabung_akhir;
            
            // Sembunyikan ID
            $hash_id = base64_encode($no_id); 

            // File upload
            if(isset($_FILES["files"]) && !empty($_FILES["files"]["name"])){
                foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                    $file_name = $key.$_FILES['files']['name'][$key];
                    $file_size =$_FILES['files']['size'][$key];
                    $file_tmp =$_FILES['files']['tmp_name'][$key];
                    $file_type=$_FILES['files']['type'][$key];
                    $original_filename = $_FILES['files']['name'][$key];
                    $ext = strtolower(pathinfo($_FILES["files"]["name"][$key], PATHINFO_EXTENSION));
                    if(in_array( $ext, array('jpg', 'jpeg', 'png', 'bmp'))) {
                        $new_filename = uniqid().'.'.$ext;
                        move_uploaded_file($file_tmp,'assets/img/'.$new_filename);
                    }
                }
            }
            // Masukkan Tabel Pegawai
            $pegawai = $koneksi->prepare("INSERT INTO pegawai (no_id, kode, nama_lengkap, 
            tanggal_bergabung, tempat_lahir, tanggal_lahir, 2ch, jabatan, asal_abdi, dort, 
            link_no_wa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $pegawai->bind_param('sssssssssss', $hash_id, $kode, $nama, $tanggal_bergabung, $hash_tempat, $hash_tanggal_lahir,
            $t_ch, $jabatan, $asal_abdi, $dort, $link_wa);
            $status_pegawai = $pegawai->execute();
            // Masukkan Tabel Header pegawai - Ada gambar
            $header_pegawai = $koneksi->prepare("INSERT INTO header_pegawai (no_id, email, password, img, status) 
            VALUES(?, ?, ?, ?, ?)");
            $pending = 'Pending';
            $header_pegawai->bind_param('sssss', $hash_id, $email, $hash_pw, $new_filename, $pending);
            $status_header_pegawai = $header_pegawai->execute();
            if($status_pegawai == true && $status_header_pegawai == true){
                header("location: register.php?pesan=sukses");
            }else{
                header("location: register.php?pesan=gagal");
            }
            break;        
    }
    
?>