<div class="cart-container">
    <h2 class="page-title">Shopping Cart</h2>

    <?php if ($cart->isEmpty()): ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <h3>Your cart is empty</h3>
            <p>Add some delicious coffee to your cart!</p>
            <a href="index.php?page=menu" class="btn btn-primary">Browse Menu</a>
        </div>
    <?php else: ?>
        <div class="cart-items">
    <?php foreach ($cart->getItems() as $index => $cartItem): ?>
        <div class="cart-item">
            <div class="item-image">
                <i class="fas fa-mug-hot"></i>
            </div>
            <div class="item-details">
                <h4><?= htmlspecialchars($cartItem->getItem()->getName()) ?></h4>
                <p class="item-price">₱<?= number_format($cartItem->getItem()->getPrice(), 2) ?> each</p>
            </div>
            <div class="item-quantity">
                <form method="POST" class="quantity-update-form">
                    <input type="hidden" name="cart_index" value="<?= $index ?>">
                    <input 
                        type="number" 
                        name="new_quantity" 
                        value="<?= $cartItem->getQty() ?>" 
                        min="1" 
                        max="100"
                        class="cart-quantity-input"
                    >
                    <button type="submit" name="update_cart_quantity" class="btn-update" title="Update Quantity">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </form>
            </div>
            <div class="item-total">
                <strong>₱<?= number_format($cartItem->total(), 2) ?></strong>
            </div>
            <div class="item-remove">
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="cart_index" value="<?= $index ?>">
                    <button type="submit" name="remove_from_cart" class="btn-remove">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

            <div class="cart-summary">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>₱<?= number_format($cart->subtotal(), 2) ?></span>
                </div>
                <div class="summary-row">
                    <span>Tax (12%):</span>
                    <span>₱<?= number_format($cart->subtotal() * 0.12, 2) ?></span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>₱<?= number_format($cart->subtotal() * 1.12, 2) ?></span>
                </div>
                
                <div class="cart-actions">
                    <a href="index.php?page=menu" class="btn btn-secondary">Continue Shopping</a>
                    <a href="index.php?page=checkout" class="btn btn-primary">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>