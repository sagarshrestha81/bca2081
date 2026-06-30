    </main>

    <!-- ══ SITE FOOTER ══════════════════════════════════════ -->
    <footer class="site-footer">
        <div class="container-xl">
            <div class="row g-4 mb-3">

                <!-- Brand -->
                <div class="col-md-4">
                    <a href="/bca2081/project/index.php" class="brand-name text-decoration-none d-block mb-3">
                        🛒 Sabaiko Bazar
                    </a>
                    <p style="font-size: 0.9rem; line-height: 1.7;">
                        Your trusted online marketplace for groceries, electronics, fashion, and home essentials — all in one place.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-2 offset-md-1">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="/bca2081/project/index.php">Home</a></li>
                        <li><a href="/bca2081/project/index.php#products">Products</a></li>
                        <li><a href="#">Deals</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="col-md-2">
                    <h6>Categories</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="#">🥦 Groceries</a></li>
                        <li><a href="#">⚡ Electronics</a></li>
                        <li><a href="#">👗 Fashion</a></li>
                        <li><a href="#">🏠 Home &amp; Living</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-3">
                    <h6>Contact</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2" style="font-size:0.9rem;">
                        <li>📍 Kathmandu, Nepal</li>
                        <li>📞 +977 9800000000</li>
                        <li>✉️ hello@sabaikobazar.com</li>
                    </ul>
                </div>

            </div>

            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> Sabaiko Bazar. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts (absolute paths) -->
    <script src="/bca2081/project/assets/js/lib/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js" integrity="sha512-6BTOlkauINO65nLhXhthZMtepgJSghyimIalb+crKRPhvhmsCdnIuGcVbR5/aQY2A+260iC1OPy1oCdB6pSSwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // ── Hero Slider init ──────────────────────────────
        const heroEl = document.getElementById('hero-slider');
        if (heroEl) {
            new Splide(heroEl, {
                type       : 'loop',
                autoplay   : true,
                interval   : 5000,
                pauseOnHover: true,
                speed      : 800,
                arrows     : true,
                pagination : true,
                easing     : 'cubic-bezier(0.4, 0, 0.2, 1)',
            }).mount();
        }

        // ── Category filter ───────────────────────────────
        const filterBtns = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.product-card[data-category]');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const filter = this.dataset.filter;
                cards.forEach(card => {
                    if (filter === 'all' || card.dataset.category === filter) {
                        card.style.display = '';
                        card.style.animation = 'fadeInUp 0.4s ease forwards';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>

    <style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    </style>

    <script src="/bca2081/project/assets/js/main2.js?version=2" defer></script>
</body>
</html>