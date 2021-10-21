<?php
include "hash.php";
include "connect.php";
$nim = @$_REQUEST['nim'];
$password = @$_REQUEST['password'];

$url = 'https://sso.umkt.ac.id/api/login-cek/';
$data = array('username' => $nim, 'password' => strval(hash_password($password)));
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = json_decode(file_get_contents($url, false, $context));
$sql = sprintf("SELECT nim FROM user where nim = '%s';",$nim);

$hasil = $conn->query($sql);
$nama = $result->rows->nama;
$nim = $result->rows->uid;
$email = $result->rows->mail;
$prodi = $result->rows->homebase;
$query = 'INSERT INTO user (nama,email,nim,prodi) values ("'.$nama.'","'.$email.'","'.$nim.'","'.$prodi.'");';
if (($result->status) == true){
	if ($hasil->num_rows > 0){
        $row = mysqli_fetch_assoc($hasil)['nim'];
        if($row == $nim){
            echo "login sukses";
        }else{
            echo 'login gagal';
        }
    }else{
        echo 'data masuk dbase';
        echo $query;
        $conn->query($query);
    }
}else{
	echo "data tidak ditemukan";
}
echo $nama,$nim,$prodi;
?>
