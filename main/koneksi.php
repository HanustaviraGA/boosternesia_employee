<?php

    $envs = parse_ini_file('.env');

    foreach ($envs as $key => $value) {
        $_ENV[$key] = $value;
    }
    
    $host = $_ENV['DB_HOST'];
	$user = $_ENV['DB_USERNAME'];
	$pass = $_ENV['DB_PASSWORD'];
	$db = $_ENV['DB_DATABASE'];

	$koneksi = mysqli_connect($host, $user, $pass, $db);

	if(!$koneksi) {
		die("Koneksi gagal : " . mysqli_connect_error());
	}
?>