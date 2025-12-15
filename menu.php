<div class="menu-container">
    <aside class="sidebar">
        <h3>Categories</h3>
        <ul class="category-list">
    <li><a href="index.php?page=menu&category=All Items" class="<?= $selectedCategory === 'All Items' ? 'active' : '' ?>">All Items</a></li>
    <li><a href="index.php?page=menu&category=Hot Classic" class="<?= $selectedCategory === 'Hot Classic' ? 'active' : '' ?>">Hot Classic</a></li>
    <li><a href="index.php?page=menu&category=Iced Specials" class="<?= $selectedCategory === 'Iced Specials' ? 'active' : '' ?>">Iced Specials</a></li>
    <li><a href="index.php?page=menu&category=Espresso" class="<?= $selectedCategory === 'Espresso' ? 'active' : '' ?>">Espresso</a></li>
    <li><a href="index.php?page=menu&category=Frapped" class="<?= $selectedCategory === 'Frapped' ? 'active' : '' ?>">Frapped</a></li>
    <li><a href="index.php?page=menu&category=Milkshake" class="<?= $selectedCategory === 'Milkshake' ? 'active' : '' ?>">Milkshake</a></li>
</ul>
    </aside>

    <div class="products-section">
        <h2 class="section-title">Our Menu</h2>
        
        <div class="products-grid">
            <?php foreach ($filteredItems as $index => $item): ?>
                <div class="product-card">
                    <div class="product-image">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><?= htmlspecialchars($item->getName()) ?></h3>
                        <p class="product-price">₱<?= number_format($item->getPrice(), 2) ?></p>
                        <p class="product-stock">Stock: <?= $item->stock ?> available</p>
                        <p class="product-description">
                            Enjoy our freshly brewed <?= htmlspecialchars($item->getName()) ?> 
                            made with premium ingredients.
                        </p>
                        
                        <form method="POST" class="add-to-cart-form">
                            <input type="hidden" name="item_index" value="<?= $index ?>">
                            <div class="quantity-selector">
                                <label>Qty:</label>
                                <input type="number" name="quantity" value="1" min="1" max="<?= $item->stock ?>" required>
                            </div>
                            <button type="submit" name="add_to_cart" class="btn btn-primary">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>