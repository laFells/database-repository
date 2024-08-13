<?php
session_start();
require_once '../models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userModel = new UserModel();
    $user = $userModel->login($email);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['password'] = $user['password'];
            header("Location: ../views/home.php");
            exit();
        } else {
            $_SESSION['password_error'] = "Password yang Anda masukkan salah";
            header("Location: ../views/login.php");
            exit();
        }
    } else {
        $_SESSION['email_error'] = "Email tidak terdaftar";

        $userModel->closeConnection();

        header("Location: ../views/login.php");
        exit();
    }
}



// Kode PHP yang diberikan adalah bagian dari proses autentikasi pengguna (login) pada aplikasi berbasis web. Berikut adalah penjelasan dari setiap bagian:

// 1. **Memulai Sesi**:
// - `session_start();` digunakan untuk memulai sesi PHP, yang memungkinkan penyimpanan data pengguna yang berkelanjutan selama sesi berlangsung.

// 2. **Memuat Model Pengguna**:
// - `require_once '../models/UserModel.php';` digunakan untuk memasukkan file `UserModel.php`, yang kemungkinan berisi definisi kelas `UserModel` yang menangani operasi basis data terkait pengguna.

// 3. **Memeriksa Metode Request**:
// - `if ($_SERVER['REQUEST_METHOD'] == 'POST')` memeriksa apakah permintaan yang diterima adalah metode POST, yang umumnya digunakan saat mengirimkan formulir.

// 4. **Mengambil Data dari Formulir**:
// - `$email = $_POST['email'];` dan `$password = $_POST['password'];` mengambil nilai email dan kata sandi yang dimasukkan pengguna dari formulir login.

// 5. **Autentikasi Pengguna**:
// - Sebuah objek dari `UserModel` dibuat dengan `$userModel = new UserModel();`.
// - `$user = $userModel->login($email);` digunakan untuk mendapatkan data pengguna dari basis data berdasarkan email yang dimasukkan.

// 6. **Validasi Pengguna dan Kata Sandi**:
// - Jika pengguna ditemukan (`if ($user)`):
//   - `password_verify($password, $user['password'])` memverifikasi kata sandi yang dimasukkan dengan hash kata sandi yang tersimpan di basis data.
//   - Jika kata sandi cocok, data pengguna seperti `id` dan `password` disimpan dalam variabel sesi, dan pengguna diarahkan ke halaman beranda (`home.php`).
//   - Jika kata sandi tidak cocok, pesan kesalahan disimpan dalam sesi dan pengguna diarahkan kembali ke halaman login (`login.php`).

// 7. **Penanganan Pengguna Tidak Ditemukan**:
// - Jika pengguna tidak ditemukan (`else`):
//   - Pesan kesalahan email disimpan dalam sesi.
//   - Koneksi ke basis data ditutup dengan memanggil `$userModel->closeConnection();`.
//   - Pengguna kemudian diarahkan kembali ke halaman login.

// **Kesimpulan**: 
// Kode ini menangani proses login dengan memeriksa email dan kata sandi yang dimasukkan pengguna. Jika email ditemukan di basis data dan kata sandi cocok, pengguna berhasil masuk dan diarahkan ke halaman beranda. Jika email tidak terdaftar atau kata sandi salah, pengguna akan diarahkan kembali ke halaman login dengan pesan kesalahan yang sesuai. Sesi PHP digunakan untuk menyimpan data pengguna selama sesi berlangsung.