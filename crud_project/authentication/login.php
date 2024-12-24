<?php
session_start();
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
    $password = mysqli_real_escape_string($koneksi, $_POST["password"]);

    $login = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username' AND password = '$password'" );

    $data = mysqli_fetch_array($login);

    if($data){
        echo "berhasil login";
        header("Location: ../index.php");
    }else{
        echo "login tidak berhasil";
        header("Location: login.php?error=invalid_credentials");
    }
}

?>