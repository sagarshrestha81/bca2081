<?php
require_once './includes/main.php';

// Fetch all products — graceful fallback if table doesn't exist yet
$products = [];
$dbReady  = false;
try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        $dbReady = true;
    }
} catch (mysqli_sql_exception $e) {
    // Table not yet created — show setup notice below
    $dbReady = false;
}
?>

<!-- ══ HERO BANNER SLIDER ══════════════════════════════════ -->
<section class="hero-slider-section splide" id="hero-slider"
    aria-label="Sabaiko Bazar Featured Deals">
    <div class="splide__track">
        <ul class="splide__list">

            <!-- Slide 1 — Groceries -->
            <li class="splide__slide">
                <div class="banner-slide">
                    <img src="/bca2081/project/assets/img/banner/banner1.png"
                         alt="Fresh Groceries at Sabaiko Bazar"
                         loading="eager">
                    <div class="banner-overlay">
                        <div class="banner-content">
                            <span class="banner-tag">Fresh Arrivals</span>
                            <h1>Farm Fresh<br>Every Day</h1>
                            <p>Handpicked organic produce delivered straight from local farms to your doorstep.</p>
                            <div>
                                <a href="#products" class="btn-banner">
                                    Shop Now &#8594;
                                </a>
                                <a href="#products" class="btn-banner btn-banner-outline">
                                    View Offers
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <!-- Slide 2 — Electronics -->
            <li class="splide__slide">
                <div class="banner-slide">
                    <img src="/bca2081/project/assets/img/banner/banner2.png"
                         alt="Electronics and Gadgets at Sabaiko Bazar"
                         loading="lazy">
                    <div class="banner-overlay">
                        <div class="banner-content">
                            <span class="banner-tag">Electronics</span>
                            <h1>Next-Gen<br>Gadgets Await</h1>
                            <p>Explore the latest smartphones, laptops, and smart accessories at unbeatable prices.</p>
                            <div>
                                <a href="#products" class="btn-banner">
                                    Shop Now &#8594;
                                </a>
                                <a href="#products" class="btn-banner btn-banner-outline">
                                    View Deals
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <!-- Slide 3 — Fashion -->
            <li class="splide__slide">
                <div class="banner-slide">
                    <img src="/bca2081/project/assets/img/banner/banner3.png"
                         alt="Fashion Collection at Sabaiko Bazar"
                         loading="lazy">
                    <div class="banner-overlay" style="background: linear-gradient(90deg, rgba(100,20,80,0.80) 0%, rgba(100,20,80,0.4) 50%, transparent 100%);">
                        <div class="banner-content">
                            <span class="banner-tag">New Collection</span>
                            <h1>Style That<br>Speaks for You</h1>
                            <p>Discover trending fashion, accessories, and bags curated for every occasion.</p>
                            <div>
                                <a href="#products" class="btn-banner">
                                    Shop Now &#8594;
                                </a>
                                <a href="#products" class="btn-banner btn-banner-outline">
                                    Explore
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</section>

<!-- ══ PROMO STRIP ═════════════════════════════════════════ -->
<div class="promo-strip">
    <div class="container-xl">
        <div class="promo-strip-inner">
            <div class="promo-item">
                <span class="promo-icon">🚚</span>
                <span>Free Delivery on orders above Rs. 1000</span>
            </div>
            <div class="promo-item">
                <span class="promo-icon">🔒</span>
                <span>Secure &amp; Trusted Payments</span>
            </div>
            <div class="promo-item">
                <span class="promo-icon">↩️</span>
                <span>Easy 7-Day Returns</span>
            </div>
            <div class="promo-item">
                <span class="promo-icon">💬</span>
                <span>24/7 Customer Support</span>
            </div>
        </div>
    </div>
</div>

<!-- ══ PRODUCTS SECTION ════════════════════════════════════ -->
<section class="products-section" id="products">
    <div class="container-xl">

        <!-- Section Header -->
        <div class="section-header">
            <span class="section-tag">Our Products</span>
            <h2 class="section-title">Explore Our Collection</h2>
            <p class="section-subtitle">Quality products across every category, delivered to your door</p>
        </div>

        <!-- Category Filters -->
        <div class="category-filters" id="category-filters">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="Groceries">🥦 Groceries</button>
            <button class="filter-btn" data-filter="Electronics">⚡ Electronics</button>
            <button class="filter-btn" data-filter="Fashion">👗 Fashion</button>
            <button class="filter-btn" data-filter="Home & Living">🏠 Home &amp; Living</button>
        </div>

        <!-- Product Grid -->
        <?php if (!empty($products)): ?>
        <div class="product-grid" id="product-grid">
            <?php foreach ($products as $product): ?>
                <?php
                    $categoryClass = strtolower(str_replace([' ', '&'], ['-', ''], $product['category']));
                    if ($product['stock'] <= 0)       { $stockLabel = 'Out of Stock'; $stockClass = 'out-stock'; }
                    elseif ($product['stock'] <= 10)  { $stockLabel = 'Only ' . $product['stock'] . ' left!'; $stockClass = 'low-stock'; }
                    else                              { $stockLabel = 'In Stock';   $stockClass = 'in-stock'; }
                ?>
                <div class="product-card" data-category="<?= htmlspecialchars($product['category']) ?>">
                    <div class="product-card-img-wrapper">
                        <img src="<?= htmlspecialchars($product['image']) ?>"
                             alt="<?= htmlspecialchars($product['name']) ?>"
                             loading="lazy"
                             onerror="this.src='/bca2081/project/assets/img/products/placeholder.png'">
                        <span class="product-card-badge <?= $categoryClass ?>">
                            <?= htmlspecialchars($product['category']) ?>
                        </span>
                        <button class="wishlist-btn" title="Add to Wishlist">&#9825;</button>
                    </div>
                    <div class="product-card-body">
                        <h3 class="product-card-name"><?= htmlspecialchars($product['name']) ?></h3>
                        <div class="product-card-price">
                            <span class="currency">Rs.</span><?= number_format($product['price'], 2) ?>
                        </div>
                        <p class="product-card-stock <?= $stockClass ?>"><?= $stockLabel ?></p>
                        <a href="/bca2081/project/product/detail.php?id=<?= $product['id'] ?>"
                           class="btn-view-detail">
                            View Details &rarr;
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="no-products">
            <div class="no-products-icon"><?= $dbReady ? '🛒' : '⚙️' ?></div>
            <?php if (!$dbReady): ?>
                <h3>Database Not Set Up Yet</h3>
                <p>The <strong>products</strong> table doesn't exist. Run the migration first, then seed.</p>
                <div style="display:flex;gap:12px;justify-content:center;margin-top:16px;flex-wrap:wrap;">
                    <a href="/bca2081/project/database/migration.php"
                       style="display:inline-block;padding:10px 24px;background:#457b9d;color:white;border-radius:8px;text-decoration:none;font-weight:700;">
                        ⚙️ Run Migration
                    </a>
                    <a href="/bca2081/project/database/seeder_products.php"
                       style="display:inline-block;padding:10px 24px;background:#e63946;color:white;border-radius:8px;text-decoration:none;font-weight:700;">
                        🌱 Seed 10 Products
                    </a>
                </div>
            <?php else: ?>
                <h3>No Products Yet</h3>
                <p>Run the <a href="/bca2081/project/database/seeder_products.php">product seeder</a> to add 10 sample products.</p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once './includes/footer.php'; ?>