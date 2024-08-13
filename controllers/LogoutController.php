<?php
session_destroy();
session_unset();
header("Location: ../views/login.php");
exit;


// <?php
// // Mengakhiri semua sesi yang sedang berjalan
// session_destroy();

// // Menghapus semua variabel sesi yang disimpan
// session_unset();

// // Mengarahkan pengguna ke halaman login
// header("Location: ../views/login.php");

// // Menghentikan eksekusi skrip untuk memastikan tidak ada kode yang dijalankan setelah pengalihan
// exit;
// 
