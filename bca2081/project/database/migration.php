<?php
require_once "./connection.php";

// ── Step 1: Ensure the database exists ─────────────────────────────
$conn_no_db = new mysqli($host, $username, $password);

if ($conn_no_db->connect_error) {
    die("Connection failed: " . $conn_no_db->connect_error);
}
echo "<br>✓ Server connected";

$sql = "CREATE DATABASE IF NOT EXISTS $db";
$result = $conn_no_db->query($sql);
echo $result ? "<br>✓ Database '$db' ensured" : "<br>✗ Database error: " . $conn_no_db->error;
$conn_no_db->close();

// ── Step 2: Connect to the database ────────────────────────────────
$connDb = new mysqli($host, $username, $password, $db);
if ($connDb->connect_error) {
    die("<br>✗ DB Connection failed: " . $connDb->connect_error);
}
echo "<br>✓ Database '$db' connected";

// ── Step 3: Users table ─────────────────────────────────────────────
$sqlUsers = "CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255) NOT NULL,
    email      VARCHAR(255) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$connDb->query($sqlUsers)
    ? print("<br>✓ Table 'users' ensured")
    : print("<br>✗ Users table error: " . $connDb->error);

// ── Step 4: Products table ──────────────────────────────────────────
$sqlProducts = "CREATE TABLE IF NOT EXISTS products (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) NOT NULL,
    description TEXT,
    price       DECIMAL(10,2) NOT NULL,
    image       VARCHAR(255) DEFAULT 'placeholder.png',
    category    VARCHAR(100),
    stock       INT DEFAULT 0,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$connDb->query($sqlProducts)
    ? print("<br>✓ Table 'products' ensured")
    : print("<br>✗ Products table error: " . $connDb->error);

$connDb->close();

echo "<br><br><strong style='color:green;'>✅ Migration complete!</strong>";
echo "<br><a href='seeder_products.php' style='display:inline-block;margin-top:12px;padding:8px 20px;background:#e63946;color:white;border-radius:6px;text-decoration:none;font-weight:600;'>→ Run Product Seeder (10 products)</a>";
echo "<br><a href='../index.php' style='display:inline-block;margin-top:8px;padding:8px 20px;background:#457b9d;color:white;border-radius:6px;text-decoration:none;font-weight:600;'>→ Go to Homepage</a>";
?>
