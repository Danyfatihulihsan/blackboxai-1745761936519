<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../config/config.php';

if (!isset($_GET['product_id'])) {
    header("Location: produk.php");
    exit();
}

$product_id = intval($_GET['product_id']);
$product_result = $conn->query("SELECT * FROM products WHERE id = $product_id");
if ($product_result->num_rows != 1) {
    header("Location: produk.php");
    exit();
}
$product = $product_result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $quantity = intval($_POST['quantity']);
    $payment_method = $conn->real_escape_string($_POST['payment_method']);
    $order_date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO orders (user_id, product_id, quantity, payment_method, status, order_date) VALUES ($user_id, $product_id, $quantity, '$payment_method', 'Pending', '$order_date')";
    if ($conn->query($sql) === TRUE) {
        $success = "Pesanan berhasil dibuat. Terima kasih!";
    } else {
        $error = "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<h2>Pesan Produk: <?php echo htmlspecialchars($product['name']); ?></h2>

<?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST" action="">
    <label>Jumlah:</label><br />
    <input type="number" name="quantity" value="1" min="1" required /><br />
    <label>Metode Pembayaran:</label><br />
    <select name="payment_method" required>
        <option value="Debit">Debit</option>
        <option value="Cash">Cash</option>
        <option value="Transfer Bank">Transfer Bank</option>
    </select><br /><br />
    <input type="submit" value="Pesan" />
</form>

<?php include '../includes/footer.php'; ?>
