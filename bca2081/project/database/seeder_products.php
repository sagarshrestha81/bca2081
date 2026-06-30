<?php
require_once "./connection.php";

// ── Auto-create the products table if it doesn't exist ─────────────
$conn->query("CREATE TABLE IF NOT EXISTS products (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) NOT NULL,
    description TEXT,
    price       DECIMAL(10,2) NOT NULL,
    image       VARCHAR(255) DEFAULT 'placeholder.png',
    category    VARCHAR(100),
    stock       INT DEFAULT 0,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$products = [
    // ── Groceries (3) ──────────────────────────────────────────────
    [
        'name'        => 'Fresh Organic Apples',
        'description' => 'Hand-picked organic apples from local farms. Sweet, crispy, and full of natural goodness. Perfect for snacking, juicing, or baking.',
        'price'       => 350.00,
        'image'       => 'https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?w=600&auto=format&fit=crop',
        'category'    => 'Groceries',
        'stock'       => 100,
    ],
    [
        'name'        => 'Basmati Rice (5kg)',
        'description' => 'Long-grain premium Basmati rice, aged for rich aroma and perfect texture. Ideal for biryanis, pulao, and everyday meals.',
        'price'       => 750.00,
        'image'       => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop',
        'category'    => 'Groceries',
        'stock'       => 200,
    ],
    [
        'name'        => 'Cold-Pressed Mustard Oil (1L)',
        'description' => 'Pure cold-pressed mustard oil extracted from the finest mustard seeds. Rich in omega-3 fatty acids, ideal for cooking and skin care.',
        'price'       => 320.00,
        'image'       => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=600&auto=format&fit=crop',
        'category'    => 'Groceries',
        'stock'       => 150,
    ],

    // ── Electronics (3) ────────────────────────────────────────────
    [
        'name'        => 'Wireless Noise-Cancelling Headphones',
        'description' => 'Premium over-ear headphones with 30-hour battery life, active noise cancellation, and Hi-Fi stereo sound. Foldable, lightweight design.',
        'price'       => 4999.00,
        'image'       => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&auto=format&fit=crop',
        'category'    => 'Electronics',
        'stock'       => 25,
    ],
    [
        'name'        => 'Mechanical Gaming Keyboard',
        'description' => 'TKL mechanical keyboard with RGB backlight, Blue switches for tactile feedback, anti-ghosting technology, and durable aluminum frame.',
        'price'       => 3299.00,
        'image'       => 'https://images.unsplash.com/photo-1595044426077-d36d9236d44a?w=600&auto=format&fit=crop',
        'category'    => 'Electronics',
        'stock'       => 15,
    ],
    [
        'name'        => 'Smart LED Desk Lamp',
        'description' => 'Touch-control LED desk lamp with 5 color temperatures and 5 brightness levels. USB charging port included. Energy-efficient and eye-care design.',
        'price'       => 899.00,
        'image'       => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=600&auto=format&fit=crop',
        'category'    => 'Electronics',
        'stock'       => 40,
    ],

    // ── Fashion (2) ────────────────────────────────────────────────
    [
        'name'        => "Men's Classic Slim-Fit Shirt",
        'description' => 'Crafted from premium cotton blend, this slim-fit dress shirt features a modern collar and is perfect for both office and casual wear.',
        'price'       => 1299.00,
        'image'       => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=600&auto=format&fit=crop',
        'category'    => 'Fashion',
        'stock'       => 50,
    ],
    [
        'name'        => 'Leather Crossbody Bag',
        'description' => 'Genuine leather crossbody bag with multiple compartments, adjustable strap, and gold-tone hardware. Stylish and functional for everyday use.',
        'price'       => 2499.00,
        'image'       => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600&auto=format&fit=crop',
        'category'    => 'Fashion',
        'stock'       => 30,
    ],

    // ── Home & Living (2) ──────────────────────────────────────────
    [
        'name'        => 'Non-Stick Cookware Set (5-piece)',
        'description' => 'Premium 5-piece non-stick cookware set including frying pan, saucepan, and stockpot. PFOA-free coating, compatible with all stovetops including induction.',
        'price'       => 3799.00,
        'image'       => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&auto=format&fit=crop',
        'category'    => 'Home & Living',
        'stock'       => 20,
    ],
    [
        'name'        => 'Aromatherapy Diffuser & Essential Oil Set',
        'description' => 'Ultrasonic cool-mist aroma diffuser with 7-colour LED mood lighting. Comes with 6 pure essential oils (lavender, eucalyptus, peppermint, and more).',
        'price'       => 1850.00,
        'image'       => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=600&auto=format&fit=crop',
        'category'    => 'Home & Living',
        'stock'       => 35,
    ],
];

// Clear existing products for fresh seed
$conn->query("DELETE FROM products");
$conn->query("ALTER TABLE products AUTO_INCREMENT = 1");

$stmt = $conn->prepare(
    "INSERT INTO products (name, description, price, image, category, stock) VALUES (?, ?, ?, ?, ?, ?)"
);

if (!$stmt) {
    die("<br>❌ Prepare failed: " . $conn->error);
}

$seeded = 0;
foreach ($products as $p) {
    $stmt->bind_param('ssdssi', $p['name'], $p['description'], $p['price'], $p['image'], $p['category'], $p['stock']);
    if ($stmt->execute()) {
        $seeded++;
        echo "<br>✓ Inserted: " . htmlspecialchars($p['name']) . " <small style='color:#888;'>(" . htmlspecialchars($p['category']) . ")</small>";
    } else {
        echo "<br>✗ Failed:   " . htmlspecialchars($p['name']) . " — " . $stmt->error;
    }
}

$stmt->close();
$conn->close();

echo "<br><br><strong style='color:green;'>✅ Seeded $seeded/" . count($products) . " products successfully!</strong>";
echo "<br><a href='../index.php' style='display:inline-block;margin-top:12px;padding:8px 20px;background:#e63946;color:white;border-radius:6px;text-decoration:none;font-weight:600;'>→ Go to Homepage</a>";
?>
