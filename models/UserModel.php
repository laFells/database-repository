<?php
require_once '../config/connection.php';

class UserModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = openConnection();
    }

    public function register($name, $gender, $date_of_birth, $email, $phone_number, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, gender, date_of_birth, email, phone_number, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $name, $gender, $date_of_birth, $email, $phone_number, $hashed_password);

        if ($stmt->execute()) {
            header("Location: ../views/count.php");
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function login($email)
    {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return null;
        }
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return null;
        }
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

// 

// <?php
// // Mengimpor file connection.php yang berisi fungsi untuk membuka koneksi ke database
// require_once '../config/connection.php';

// class UserModel
// {
//     // Deklarasi variabel private untuk menyimpan koneksi database
//     private $conn;

//     // Constructor yang dijalankan saat instance dari UserModel dibuat
//     public function __construct()
//     {
//         // Membuka koneksi ke database dan menyimpannya ke dalam variabel $conn
//         $this->conn = openConnection();
//     }

//     // Fungsi untuk mendaftarkan pengguna baru ke dalam database
//     public function register($name, $gender, $date_of_birth, $email, $phone_number, $password)
//     {
//         // Menghash password menggunakan algoritma BCRYPT untuk keamanan
//         $hashed_password = password_hash($password, PASSWORD_BCRYPT);

//         // Menyusun pernyataan SQL untuk memasukkan data pengguna baru ke dalam tabel `users`
//         $sql = "INSERT INTO users (name, gender, date_of_birth, email, phone_number, password) VALUES (?, ?, ?, ?, ?, ?)";

//         // Mempersiapkan pernyataan SQL untuk mencegah SQL injection
//         $stmt = $this->conn->prepare($sql);

//         // Mengikat parameter ke pernyataan SQL
//         $stmt->bind_param("ssssss", $name, $gender, $date_of_birth, $email, $phone_number, $hashed_password);

//         // Menjalankan pernyataan SQL
//         if ($stmt->execute()) {
//             // Jika berhasil, pengguna diarahkan ke halaman `count.php`
//             header("Location: ../views/count.php");
//         } else {
//             // Jika terjadi kesalahan, menampilkan pesan kesalahan
//             echo "Error: " . $sql . "<br>" . $this->conn->error;
//         }
//     }

//     // Fungsi untuk melakukan login dan mengambil data pengguna berdasarkan email
//     public function login($email)
//     {
//         // Menyusun pernyataan SQL untuk memilih pengguna berdasarkan email
//         $sql = "SELECT * FROM users WHERE email=?";

//         // Mempersiapkan pernyataan SQL
//         $stmt = $this->conn->prepare($sql);

//         // Mengikat parameter email ke pernyataan SQL
//         $stmt->bind_param("s", $email);

//         // Menjalankan pernyataan SQL
//         $stmt->execute();

//         // Mendapatkan hasil query
//         $result = $stmt->get_result();

//         // Memeriksa apakah ada satu pengguna yang cocok dengan email yang diberikan
//         if ($result->num_rows == 1) {
//             // Jika ditemukan, mengembalikan data pengguna sebagai array asosiatif
//             $user = $result->fetch_assoc();
//             return $user;
//         } else {
//             // Jika tidak ditemukan, mengembalikan null
//             return null;
//         }
//     }

//     // Fungsi untuk mengambil data pengguna berdasarkan ID
//     public function getUserById($id)
//     {
//         // Menyusun pernyataan SQL untuk memilih pengguna berdasarkan ID
//         $sql = "SELECT * FROM users WHERE id=?";

//         // Mempersiapkan pernyataan SQL
//         $stmt = $this->conn->prepare($sql);

//         // Mengikat parameter ID ke pernyataan SQL
//         $stmt->bind_param("i", $id);

//         // Menjalankan pernyataan SQL
//         $stmt->execute();

//         // Mendapatkan hasil query
//         $result = $stmt->get_result();

//         // Memeriksa apakah ada satu pengguna yang cocok dengan ID yang diberikan
//         if ($result->num_rows == 1) {
//             // Jika ditemukan, mengembalikan data pengguna sebagai array asosiatif
//             $user = $result->fetch_assoc();
//             return $user;
//         } else {
//             // Jika tidak ditemukan, mengembalikan null
//             return null;
//         }
//     }

//     // Fungsi untuk menutup koneksi ke database
//     public function closeConnection()
//     {
//         // Menutup koneksi database
//         $this->conn->close();
//     }
// }
// 
