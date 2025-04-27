<?php
session_start();
require_once '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT id, password, name FROM users WHERE phone='$phone'");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Nomor telepon tidak ditemukan.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<h2>Login Pengguna</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST" action="">
    <label>Nomor Telepon:</label><br />
    <input type="text" name="phone" required /><br />
    <label>Password:</label><br />
    <input type="password" name="password" required /><br /><br />
    <input type="submit" value="Login" />
</form>

<?php include '../includes/footer.php'; ?>
