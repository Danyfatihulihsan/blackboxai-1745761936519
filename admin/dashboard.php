<?php
session_start();
require_once '../config/config.php';

// For simplicity, no admin authentication implemented here
// Fetch all orders with user and product info
$sql = "SELECT orders.id, users.name AS user_name, products.name AS product_name, orders.quantity, orders.payment_method, orders.status, orders.order_date
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN products ON orders.product_id = products.id
        ORDER BY orders.order_date DESC";
$result = $conn->query($sql);
$orders = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<h2>Dashboard Admin - Daftar Pesanan</h2>

<?php if (count($orders) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Nama Pengguna</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Metode Pembayaran</th>
                <th>Status</th>
                <th>Tanggal Pesan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                <td><?php echo $order['quantity']; ?></td>
                <td><?php echo $order['payment_method']; ?></td>
                <td><?php echo $order['status']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><a href="konfirmasi_pembayaran.php?order_id=<?php echo $order['id']; ?>">Konfirmasi</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Tidak ada pesanan.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
