<?php
session_start();
?>

<nav>
    <ul>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="/user/index.php">Home</a></li>
            <li><a href="/user/produk.php">Produk</a></li>
            <li><a href="/user/pemesanan.php">Pemesanan</a></li>
            <li><a href="/user/about.php">About</a></li>
            <li><a href="/user/contact.php">Contact</a></li>
            <li><a href="/user/logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="/user/login.php">Login</a></li>
            <li><a href="/user/register.php">Register</a></li>
            <li><a href="/user/about.php">About</a></li>
            <li><a href="/user/contact.php">Contact</a></li>
        <?php endif; ?>
    </ul>
</nav>
