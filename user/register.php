<?php
session_start();
require_once '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if phone already exists
    $check = $conn->query("SELECT id FROM users WHERE phone='$phone'");
    if ($check->num_rows > 0) {
        $error = "Nomor telepon sudah terdaftar.";
    } else {
        $sql = "INSERT INTO users (name, phone, address, password) VALUES ('$name', '$phone', '$address', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Terjadi kesalahan: " . $conn->error;
        }
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<h2>Registrasi Pengguna</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST" action="">
    <label>Nama Lengkap:</label><br />
    <input type="text" name="name" required /><br />
    <label>Nomor Telepon:</label><br />
    <input type="text" name="phone" required /><br />
    <label>Alamat:</label><br />
    <textarea name="address" required></textarea><br />
    <label>Password:</label><br />
    <input type="password" name="password" required /><br /><br />
    <input type="submit" value="Daftar" />
</form>

<?php include '../includes/footer.php'; ?>
