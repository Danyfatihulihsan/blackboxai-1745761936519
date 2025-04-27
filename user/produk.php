<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once '../config/config.php';

// Fetch products
$result = $conn->query("SELECT * FROM products");
$products = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<h2>Daftar Produk Air Isi Ulang</h2>

<?php if (count($products) > 0): ?>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <strong><?php echo htmlspecialchars($product['name']); ?></strong><br />
                <?php echo htmlspecialchars($product['description']); ?><br />
                Harga: Rp <?php echo number_format($product['price'], 0, ',', '.'); ?><br />
                <a href="pemesanan.php?product_id=<?php echo $product['id']; ?>">Pesan Sekarang</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Belum ada produk tersedia.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
