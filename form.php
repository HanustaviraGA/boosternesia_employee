<?php
    if(isset($_POST['daftar'])){
        if(isset($_POST['submit'])){
            $nama = $_POST['nama'];
            $telepon = $_POST['telepon'];
            $email = $_POST['email'];
            $kelas = $_POST['kelas'];
            header("Location: https://api.whatsapp.com/send?phone=6282283717800&text=Form%20Pendaftaran%20Kelas%20Boosternesia%0D%0ANama%20Lengkap%20%3A%20$nama%0D%0ANomor%20Telepon%20%3A%20$telepon%0D%0AEmail%20%3A%20$email%0D%0AKelas%20%3A%20$kelas%0D%0ASaya%20ingin%20mendaftarkan%20diri%20saya%20sebagai%20bagian%20dari%20Boosternesia%20dengan%20informasi%20tersebut.%20Terima%20kasih");
        }        
    }else if(isset($_POST['kontak'])){
        if(isset($_POST['submit'])){
            $nama = $_POST['nama'];
            $telepon = $_POST['telepon'];
            $email = $_POST['email'];
            $perihal = $_POST['perihal'];
            $isi = $_POST['isi'];
            header("Location: https://api.whatsapp.com/send?phone=6282143871785&text=Form%20Kontak%20Perusahaan%20Boosternesia%0D%0ANama%20Lengkap%20%3A%20$nama%0D%0ANomor%20Telepon%20%3A%20$telepon%0D%0AEmail%20%3A%20$email%0D%0APerihal%20%3A%20$perihal%0D%0AIsi%20%3A%20$isi%0D%0ADemikian%20isi%20dari%20kontak%20kami%2C%20atas%20perhatian%20yang%20diberikan%20kami%20ucapkan%20terima%20kasih.");
        }       
    }
                                           
?>