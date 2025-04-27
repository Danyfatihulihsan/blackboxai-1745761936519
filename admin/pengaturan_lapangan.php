<?php
session_start();
require_once '../config/config.php';

// For simplicity, no admin authentication implemented here

// Handle add product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = floatval($_POST['price']);

    $sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', $price)";
    if ($conn->query($sql) === TRUE) {
        $success = "Produk berhasil ditambahkan.";
    } else {
        $error = "Terjadi kesalahan: " . $conn->error;
    }
}

// Handle delete product
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM products WHERE id = $delete_id");
    header("Location: pengaturan_lapangan.php");
    exit();
}

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

<h2>Pengaturan Produk Air</h2>

<?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<h3>Tambah Produk Baru</h3>
<form method="POST" action="">
    <label>Nama Produk:</label><br />
    <input type="text" name="name" required /><br />
    <label>Deskripsi:</label><br />
    <textarea name="description" required></textarea><br />
    <label>Harga (Rp):</label><br />
    <input type="number" name="price" step="0.01" required /><br /><br />
    <input type="submit" name="add_product" value="Tambah Produk" />
</form>

<h3>Daftar Produk</h3>
<?php if (count($products) > 0): ?>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <strong><?php echo htmlspecialchars($product['name']); ?></strong> - Rp <?php echo number_format($product['price'], 0, ',', '.'); ?>
                <br /><?php echo htmlspecialchars($product['description']); ?>
                <br /><a href="pengaturan_lapangan.php?delete_id=<?php echo $product['id']; ?>" onclick="return confirm('Yakin ingin menghapus produk ini?');">Hapus</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Belum ada produk.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
