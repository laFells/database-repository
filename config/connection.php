<?php

function openConnection()
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "php_login_system";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
// Fungsi `openConnection()` dalam kode PHP yang diberikan digunakan untuk membuka koneksi ke basis data MySQL. Berikut adalah langkah-langkah yang dilakukan oleh fungsi tersebut:

// 1. **Deklarasi Variabel Koneksi**: 
// - `hostname` (nama host) ditetapkan sebagai "localhost", yang menunjukkan bahwa basis data berada di mesin lokal.
// - `username` ditetapkan sebagai "root", yang merupakan nama pengguna default untuk MySQL.
// - `password` ditetapkan sebagai string kosong, yang berarti tidak ada kata sandi yang digunakan untuk akun ini (biasanya untuk lingkungan pengembangan lokal).
// - `database` ditetapkan sebagai "php_login_system", yang merupakan nama basis data yang akan dihubungkan.

// 2. **Membuat Koneksi**:
// - Fungsi `new mysqli()` digunakan untuk membuat objek koneksi ke basis data MySQL dengan parameter `hostname`, `username`, `password`, dan `database`.

// 3. **Memeriksa Koneksi**:
// - Jika koneksi gagal (`$conn->connect_error`), maka skrip akan dihentikan dan pesan kesalahan akan ditampilkan dengan menggunakan `die()`.

// 4. **Mengembalikan Objek Koneksi**:
// - Jika koneksi berhasil, fungsi ini akan mengembalikan objek `$conn`, yang dapat digunakan untuk berinteraksi dengan basis data.

// **Kesimpulan**: 
// Fungsi `openConnection()` bertanggung jawab untuk membuat dan mengembalikan koneksi yang aman ke basis data MySQL. Jika koneksi gagal, fungsi akan menghentikan eksekusi dan menampilkan pesan kesalahan, sedangkan jika berhasil, koneksi tersebut akan siap digunakan untuk operasi basis data lebih lanjut.
