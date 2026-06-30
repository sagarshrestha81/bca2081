<?php
require_once '../includes/main.php';

// Validate the ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: /bca2081/project/index.php');
    exit;
}

// Fetch product
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    header('Location: /bca2081/project/index.php');
    exit;
}

// Stock status
if ($product['stock'] <= 0)       { $stockLabel = 'Out of Stock'; $stockClass = 'out-stock-badge'; }
elseif ($product['stock'] <= 10)  { $stockLabel = 'Only ' . $product['stock'] . ' left!'; $stockClass = 'low-stock-badge'; }
else                              { $stockLabel = 'In Stock';   $stockClass = 'in-stock-badge'; }

$categoryClass = strtolower(str_replace([' ', '&'], ['-', ''], $product['category']));

// Fetch related products (same category, exclude current)
$relatedStmt = $conn->prepare("SELECT * FROM products WHERE category = ? AND id != ? LIMIT 4");
$relatedStmt->bind_param('si', $product['category'], $id);
$relatedStmt->execute();
$relatedResult = $relatedStmt->get_result();
$related = [];
while ($r = $relatedResult->fetch_assoc()) { $related[] = $r; }
$relatedStmt->close();
?>

<div class="detail-page">
    <div class="container-xl">

        <!-- Back Link -->
        <a href="/bca2081/project/index.php" class="back-link">
            &#8592; Back to Shop
        </a>

        <!-- Product Layout: 2 columns -->
        <div class="row g-4 align-items-start">

            <!-- Left: Image -->
            <div class="col-md-5">
                <div class="detail-img-wrapper">
                    <img src="<?= htmlspecialchars($product['image']) ?>"
                         alt="<?= htmlspecialchars($product['name']) ?>"
                         id="detail-main-img"
                         onerror="this.src='/bca2081/project/assets/img/products/placeholder.png'">
                </div>
            </div>

            <!-- Right: Info -->
            <div class="col-md-7">
                <div class="detail-info">

                    <!-- Category -->
                    <span class="detail-category-badge">
                        <?= htmlspecialchars($product['category']) ?>
                    </span>

                    <!-- Name -->
                    <h1 class="detail-name"><?= htmlspecialchars($product['name']) ?></h1>

                    <!-- Price + Stock -->
                    <div class="detail-price-block">
                        <div>
                            <div style="font-size:0.78rem; color: var(--clr-text-muted); margin-bottom: 2px;">Price</div>
                            <div class="detail-price">
                                <span class="detail-price-currency">Rs.</span><?= number_format($product['price'], 2) ?>
                            </div>
                        </div>
                        <span class="detail-stock-badge <?= $stockClass ?>"><?= $stockLabel ?></span>
                    </div>

                    <!-- Description -->
                    <p class="detail-description">
                        <?= nl2br(htmlspecialchars($product['description'])) ?>
                    </p>

                    <hr class="detail-divider">

                    <!-- Meta -->
                    <div class="detail-meta">
                        <div class="detail-meta-row">
                            <span class="detail-meta-label">Category</span>
                            <span class="detail-meta-value"><?= htmlspecialchars($product['category']) ?></span>
                        </div>
                        <div class="detail-meta-row">
                            <span class="detail-meta-label">Stock</span>
                            <span class="detail-meta-value"><?= (int)$product['stock'] ?> units available</span>
                        </div>
                        <div class="detail-meta-row">
                            <span class="detail-meta-label">Product ID</span>
                            <span class="detail-meta-value">#<?= str_pad($product['id'], 4, '0', STR_PAD_LEFT) ?></span>
                        </div>
                        <div class="detail-meta-row">
                            <span class="detail-meta-label">Added</span>
                            <span class="detail-meta-value"><?= date('d M Y', strtotime($product['created_at'])) ?></span>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <label style="font-weight:600; font-size:0.9rem; white-space:nowrap;">Quantity:</label>
                        <div class="d-flex align-items-center" style="border: 2px solid var(--clr-border); border-radius: var(--radius-sm); overflow:hidden;">
                            <button onclick="changeQty(-1)" style="border:none; background:var(--clr-bg); padding: 8px 14px; font-size:1.1rem; cursor:pointer; font-family:var(--font);">&#8722;</button>
                            <input type="number" id="qty" value="1" min="1"
                                   max="<?= (int)$product['stock'] ?>"
                                   style="width:50px; text-align:center; border:none; padding: 8px 0; font-family:var(--font); font-size:0.95rem; font-weight:600; outline:none;">
                            <button onclick="changeQty(1)" style="border:none; background:var(--clr-bg); padding: 8px 14px; font-size:1.1rem; cursor:pointer; font-family:var(--font);">&#43;</button>
                        </div>
                        <?php if ($product['stock'] > 0): ?>
                        <span style="font-size:0.8rem; color: var(--clr-text-muted);">Max: <?= (int)$product['stock'] ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Action Buttons -->
                    <?php if ($product['stock'] > 0): ?>
                    <button class="btn-add-cart" id="add-to-cart-btn"
                            onclick="addToCart(<?= $product['id'] ?>)">
                        🛒 Add to Cart
                    </button>
                    <?php else: ?>
                    <button class="btn-add-cart" disabled style="opacity:0.5; cursor:not-allowed;">
                        Out of Stock
                    </button>
                    <?php endif; ?>

                    <button class="btn-wishlist-detail" id="wishlist-btn">
                        ♡ Add to Wishlist
                    </button>

                </div><!-- /detail-info -->
            </div>
        </div>

        <?php if (!empty($related)): ?>
        <!-- ══ RELATED PRODUCTS ════════════════════════════ -->
        <div style="margin-top: 4rem;">
            <div class="section-header" style="text-align:left; margin-bottom:1.5rem;">
                <span class="section-tag">Related Items</span>
                <h2 class="section-title" style="font-size:1.5rem;">More in <?= htmlspecialchars($product['category']) ?></h2>
            </div>
            <div class="product-grid">
                <?php foreach ($related as $rel):
                    if ($rel['stock'] <= 0)      { $rStockLabel = 'Out of Stock'; $rStockClass = 'out-stock'; }
                    elseif ($rel['stock'] <= 10) { $rStockLabel = 'Only ' . $rel['stock'] . ' left!'; $rStockClass = 'low-stock'; }
                    else                         { $rStockLabel = 'In Stock'; $rStockClass = 'in-stock'; }
                    $rCatClass = strtolower(str_replace([' ', '&'], ['-', ''], $rel['category']));
                ?>
                <div class="product-card">
                    <div class="product-card-img-wrapper">
                        <img src="<?= htmlspecialchars($rel['image']) ?>"
                             alt="<?= htmlspecialchars($rel['name']) ?>"
                             loading="lazy"
                             onerror="this.src='/bca2081/project/assets/img/products/placeholder.png'">
                        <span class="product-card-badge <?= $rCatClass ?>"><?= htmlspecialchars($rel['category']) ?></span>
                        <button class="wishlist-btn">&#9825;</button>
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-card-name"><?= htmlspecialchars($rel['name']) ?></h3>
                        <div class="product-card-price">
                            <span class="currency">Rs.</span><?= number_format($rel['price'], 2) ?>
                        </div>
                        <p class="product-card-stock <?= $rStockClass ?>"><?= $rStockLabel ?></p>
                        <a href="/bca2081/project/product/detail.php?id=<?= $rel['id'] ?>"
                           class="btn-view-detail">View Details &rarr;</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div><!-- /container -->
</div><!-- /detail-page -->

<script>
function changeQty(delta) {
    const input = document.getElementById('qty');
    let val = parseInt(input.value) + delta;
    val = Math.max(1, Math.min(val, parseInt(input.max) || 99));
    input.value = val;
}

function addToCart(productId) {
    const qty = document.getElementById('qty').value;
    const btn = document.getElementById('add-to-cart-btn');
    btn.innerHTML = '✓ Added to Cart!';
    btn.style.background = 'var(--clr-success)';
    setTimeout(() => {
        btn.innerHTML = '🛒 Add to Cart';
        btn.style.background = '';
    }, 2000);

    // Wishlist toggle
    document.getElementById('wishlist-btn').addEventListener('click', function() {
        const isWished = this.innerHTML.includes('♥');
        this.innerHTML = isWished ? '♡ Add to Wishlist' : '♥ Added to Wishlist';
        this.style.color = isWished ? '' : 'var(--clr-primary)';
        this.style.borderColor = isWished ? '' : 'var(--clr-primary)';
    });
}

// Wishlist toggle
document.getElementById('wishlist-btn').addEventListener('click', function() {
    const isWished = this.innerHTML.includes('♥');
    this.innerHTML = isWished ? '♡ Add to Wishlist' : '♥ Added to Wishlist';
    this.style.color = isWished ? '' : 'var(--clr-primary)';
    this.style.borderColor = isWished ? '' : 'var(--clr-primary)';
});
</script>

<?php require_once '../includes/footer.php'; ?>
