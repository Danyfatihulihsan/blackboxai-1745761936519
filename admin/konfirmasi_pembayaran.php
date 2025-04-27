<?php
session_start();
require_once '../config/config.php';

if (!isset($_GET['order_id'])) {
    header("Location: dashboard.php");
    exit();
}

$order_id = intval($_GET['order_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $conn->real_escape_string($_POST['status']);
    $sql = "UPDATE orders SET status='$status' WHERE id=$order_id";
    if ($conn->query($sql) === TRUE) {
        $success = "Status pembayaran berhasil diperbarui.";
    } else {
        $error = "Terjadi kesalahan: " . $conn->error;
    }
}

// Fetch order details
$sql = "SELECT orders.id, users.name AS user_name, products.name AS product_name, orders.quantity, orders.payment_method, orders.status, orders.order_date
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN products ON orders.product_id = products.id
        WHERE orders.id = $order_id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    header("Location: dashboard.php");
    exit();
}
$order = $result->fetch_assoc();
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<h2>Konfirmasi Pembayaran Pesanan ID: <?php echo $order['id']; ?></h2>

<?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<p>Nama Pengguna: <?php echo htmlspecialchars($order['user_name']); ?></p>
<p>Produk: <?php echo htmlspecialchars($order['product_name']); ?></p>
<p>Jumlah: <?php echo $order['quantity']; ?></p>
<p>Metode Pembayaran: <?php echo $order['payment_method']; ?></p>
<p>Status Saat Ini: <?php echo $order['status']; ?></p>
<p>Tanggal Pesan: <?php echo $order['order_date']; ?></p>

<form method="POST" action="">
    <label>Ubah Status Pembayaran:</label><br />
    <select name="status" required>
        <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
        <option value="Confirmed" <?php if ($order['status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
        <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
    </select><br /><br />
    <input type="submit" value="Update Status" />
</form>

<?php include '../includes/footer.php'; ?>
