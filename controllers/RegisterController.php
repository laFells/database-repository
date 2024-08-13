<?php

session_start();

require_once '../models/UserModel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "Konfirmasi password tidak sesuai";
        exit;
    }

    $userModel = new UserModel();

    $userModel->register($name, $gender, $date_of_birth, $email, $phone_number, $password);

    $_SESSION['id'] = $userModel->login($email)['id'];

    $userModel->closeConnection();

    header("Location: ../views/home.php");
    exit();
}


// <?php

// // Memulai sesi untuk menyimpan data pengguna yang akan digunakan di seluruh aplikasi
// session_start();

// // Memasukkan file UserModel.php yang berisi class UserModel untuk mengakses fungsi yang berkaitan dengan pengguna
// require_once '../models/UserModel.php';

// // Memeriksa apakah permintaan yang diterima adalah metode POST, memastikan bahwa data yang dikirim adalah data dari form
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // Mengambil data dari form yang dikirim melalui metode POST
//     $name = $_POST['name'];
//     $gender = $_POST['gender'];
//     $date_of_birth = $_POST['date_of_birth'];
//     $email = $_POST['email'];
//     $phone_number = $_POST['phone_number'];
//     $password = $_POST['password'];
//     $confirm_password = $_POST['confirm_password'];

//     // Memeriksa apakah password dan konfirmasi password sesuai
//     if ($password != $confirm_password) {
//         // Jika tidak sesuai, tampilkan pesan kesalahan dan hentikan eksekusi skrip
//         echo "Konfirmasi password tidak sesuai";
//         exit;
//     }

//     // Membuat instance dari UserModel untuk mengakses metode yang terkait dengan pengguna
//     $userModel = new UserModel();

//     // Memanggil metode register untuk menyimpan data pengguna baru ke database
//     $userModel->register($name, $gender, $date_of_birth, $email, $phone_number, $password);

//     // Melakukan login secara otomatis dengan mengambil ID pengguna yang baru terdaftar
//     $_SESSION['id'] = $userModel->login($email)['id'];

//     // Menutup koneksi database setelah operasi selesai
//     $userModel->closeConnection();

//     // Mengarahkan pengguna ke halaman home setelah berhasil mendaftar dan login
//     header("Location: ../views/home.php");
//     exit(); // Menghentikan eksekusi skrip setelah pengalihan
// }
// 
