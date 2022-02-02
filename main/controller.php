<?php
    session_start();
    session_regenerate_id(true);
    include 'koneksi.php';

    // PHPMailer Include
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require_once "assets/library/PHPMailer.php";
    require_once "assets/library/Exception.php";
    require_once "assets/library/OAuth.php";
    require_once "assets/library/POP3.php";
    require_once "assets/library/SMTP.php";

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
                    $db_pegawai = $koneksi->prepare("SELECT * FROM pegawai INNER JOIN header_pegawai ON pegawai.no_id = header_pegawai.no_id WHERE pegawai.no_id = ?");
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
                        $_SESSION['email'] = $pegawai['email'];
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
            
            // PHPMailer Kirim Email verifikasi
            $mail = new PHPMailer;
        
            //Enable SMTP debugging. 
            //$mail->SMTPDebug = 3;                               
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();            
            //Set SMTP host name                          
            $mail->Host = $_ENV['MAIL_HOST']; //host mail server
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;                          
            //Provide username and password     
            $mail->Username = $_ENV['MAIL_USERNAME'];   //nama-email smtp          
            $mail->Password = $_ENV['MAIL_PASSWORD'];           //password email smtp
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tls";                           
            //Set TCP port to connect to 
            $mail->Port = $_ENV['MAIL_PORT'];                                   
        
            $mail->From = "boosternesia@gmail.com"; //email pengirim
            $mail->FromName = "Boosternesia IT Department"; //nama pengirim
        
            $mail->addAddress($email, $nama); //email penerima
        
            $mail->isHTML(true);
        
            $mail->Subject = 'Verifikasi Email Anda'; //subject
            //isi email
            $mail->Body    = "
            <html>
            <head>
                <title></title>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                <style type='text/css'>
                    @media screen {
                        @font-face {
                            font-family: 'Lato';
                            font-style: normal;
                            font-weight: 400;
                            src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                        }

                        @font-face {
                            font-family: 'Lato';
                            font-style: normal;
                            font-weight: 700;
                            src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
                        }

                        @font-face {
                            font-family: 'Lato';
                            font-style: italic;
                            font-weight: 400;
                            src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
                        }

                        @font-face {
                            font-family: 'Lato';
                            font-style: italic;
                            font-weight: 700;
                            src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
                        }
                    }

                    /* CLIENT-SPECIFIC STYLES */
                    body,
                    table,
                    td,
                    a {
                        -webkit-text-size-adjust: 100%;
                        -ms-text-size-adjust: 100%;
                    }

                    table,
                    td {
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                    }

                    img {
                        -ms-interpolation-mode: bicubic;
                    }

                    /* RESET STYLES */
                    img {
                        border: 0;
                        height: auto;
                        line-height: 100%;
                        outline: none;
                        text-decoration: none;
                    }

                    table {
                        border-collapse: collapse !important;
                    }

                    body {
                        height: 100% !important;
                        margin: 0 !important;
                        padding: 0 !important;
                        width: 100% !important;
                    }

                    /* iOS BLUE LINKS */
                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                    }

                    /* MOBILE STYLES */
                    @media screen and (max-width:600px) {
                        h1 {
                            font-size: 32px !important;
                            line-height: 32px !important;
                        }
                    }

                    /* ANDROID CENTER FIX */
                    div[style*='margin: 16px 0;'] {
                        margin: 0 !important;
                    }
                </style>
            </head>

            <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
                <!-- HIDDEN PREHEADER TEXT -->
                <div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'> Data anda telah terekam pada sistem. </div>
                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <!-- LOGO -->
                    <tr>
                        <td bgcolor='#FFA73B' align='center'>
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                                <tr>
                                    <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#FFA73B' align='center' style='padding: 0px 10px 0px 10px;'>
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                                <tr>
                                    <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                        <h1 style='font-size: 48px; font-weight: 400; margin: 2;'>Selamat Datang !</h1> <img src=' https://img.icons8.com/clouds/100/000000/handshake.png' width='125' height='120' style='display: block; border: 0px;' />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                                <tr>
                                    <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                        <p style='margin: 0;'>Nomor ID anda adalah $no_id, silahkan masukkan nomor ID anda untuk memverifikasi akun anda dengan klik tombol di bawah ini.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor='#ffffff' align='left'>
                                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                            <tr>
                                                <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 60px 30px;'>
                                                    <table border='0' cellspacing='0' cellpadding='0'>
                                                        <tr>
                                                            <td align='center' style='border-radius: 3px;' bgcolor='#FFA73B'><a href='https://boosternesia.com/pegawai/register.php?aksi=verifikasi&no_id=$hash_id' target='_blank' style='font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;'>Konfirmasi</a></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr> <!-- COPY -->
                                <tr>
                                    <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                        <p style='margin: 0;'>Jika terdapat kendala, silahkan balas email ini, dan kami akan segera membantu Anda</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                        <p style='margin: 0;'>Salam<br>Boosternesia IT Department</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                                <tr>
                                    <td bgcolor='#FFECD1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                        <h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>Kontak Whatsapp</h2>
                                        <p style='margin: 0;'><a href='https://wa.me/6282243114494' target='_blank' style='color: #FFA73B;'>Klik Disini</a></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>

            </html>";
            $mail->AltBody = "Boosternesia"; //body email (optional)
            
            if($status_pegawai == true && $status_header_pegawai == true && $mail->send()){
                header("location: register.php?pesan=sukses");
            }else{
                header("location: register.php?pesan=gagal");
            }
            break;
        case 'verifikasi':
            $no_id = mysqli_real_escape_string($koneksi, $_POST['no_id']);
            $input_noid = base64_encode(mysqli_real_escape_string($koneksi, $_POST['input_noid']));
            $query = $koneksi->prepare("SELECT * FROM header_pegawai WHERE no_id = ?");
            $query->bind_param('s', $no_id);
            $query->execute();
            $query_res = $query->get_result();
            if($query_res->num_rows > 0){
                $pegawai = $query_res->fetch_assoc();
                $cek_id = $pegawai['no_id'];
                $cek_status = $pegawai['status'];
                if($input_noid = $cek_id && $cek_status = 'Pending'){
                    $query_id = $koneksi->prepare("UPDATE header_pegawai SET status = ? WHERE no_id = ?");
                    $aktif = 'Aktif';
                    $query_id->bind_param('ss', $aktif, $no_id);
                    $status_query_id = $query_id->execute();
                    if($status_query_id == true){
                        header("location: login.php?pesan=sukses");
                    }else{
                        header("location: register.php?aksi=verifikasi&no_id=$no_id&pesan=gagal");
                    }
                }else if($input_noid = $cek_id && $cek_status = 'Aktif'){
                    header("location: register.php?aksi=verifikasi&no_id=$no_id&pesan=sudah_aktif");
                }else if($input_noid != $cek_id){
                    header("location: register.php?aksi=verifikasi&no_id=$no_id&pesan=kode_invalid");
                }
            }else{
                echo $no_id;
            }
            break;        
    }
    
?>