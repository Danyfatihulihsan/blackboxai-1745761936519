<?php
session_start();
require_once '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO messages (name, email, message, date) VALUES ('$name', '$email', '$message', '$date')";
    if ($conn->query($sql) === TRUE) {
        $success = "Pesan Anda telah terkirim. Terima kasih!";
    } else {
        $error = "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<h2>Kontak Kami</h2>

<p>Telepon: 021-12345678</p>
<p>Alamat: Jl. Contoh No. 123, Jakarta</p>

<?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST" action="">
    <label>Nama:</label><br />
    <input type="text" name="name" required /><br />
    <label>Email:</label><br />
    <input type="email" name="email" required /><br />
    <label>Pesan:</label><br />
    <textarea name="message" required></textarea><br /><br />
    <input type="submit" value="Kirim Pesan" />
</form>

<?php include '../includes/footer.php'; ?>
