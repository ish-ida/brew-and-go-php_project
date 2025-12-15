<?php if ($cart->isEmpty()): ?>
    <div class="empty-cart">
        <i class="fas fa-shopping-cart"></i>
        <h3>Your cart is empty</h3>
        <p>Please add items to your cart before checkout.</p>
        <a href="index.php?page=menu" class="btn btn-primary">Browse Menu</a>
    </div>
<?php else: ?>
    <div class="checkout-container">
        <h2 class="page-title">Checkout</h2>

        <div class="checkout-content">
            <div class="checkout-items">
                <h3>Order Items</h3>
                <?php foreach ($cart->getItems() as $cartItem): ?>
                    <div class="checkout-item">
                        <span class="item-name">
                            <?= htmlspecialchars($cartItem->getItem()->getName()) ?>
                            <small>x<?= $cartItem->getQty() ?></small>
                        </span>
                        <span class="item-price">₱<?= number_format($cartItem->total(), 2) ?></span>
                    </div>
                <?php endforeach; ?>
                
                <div class="checkout-totals">
                    <div class="total-row">
                        <span>Subtotal:</span>
                        <span>₱<?= number_format($cart->subtotal(), 2) ?></span>
                    </div>
                    <div class="total-row">
                        <span>Tax (12%):</span>
                        <span>₱<?= number_format($cart->subtotal() * 0.12, 2) ?></span>
                    </div>
                    <div class="total-row final">
                        <span>Total Amount:</span>
                        <span>₱<?= number_format($cart->subtotal() * 1.12, 2) ?></span>
                    </div>
                </div>
            </div>

            <div class="checkout-payment">
                <h3>Payment Details</h3>
                <form method="POST" class="payment-form">
                    <div class="form-group">
                        <label for="cash">Cash Amount (₱)</label>
                        <input 
                            type="number" 
                            id="cash" 
                            name="cash" 
                            step="0.01" 
                            min="<?= $cart->subtotal() * 1.12 ?>" 
                            placeholder="Enter cash amount"
                            required
                        >
                        <small>Minimum: ₱<?= number_format($cart->subtotal() * 1.12, 2) ?></small>
                    </div>

                    <div class="form-actions">
                        <a href="index.php?page=cart" class="btn btn-secondary">Back to Cart</a>
                        <button type="submit" name="checkout" class="btn btn-primary">
                            <i class="fas fa-check"></i> Complete Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>