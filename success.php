<?php
$result = $_SESSION['checkout_result'] ?? null;

if (!$result) {
    header('Location: index.php?page=menu');
    exit;
}
?>

<div class="success-container">
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2>Payment Successful!</h2>
        <p>Thank you for your purchase!</p>

        <div class="receipt">
            <h3>Receipt</h3>
            <div class="receipt-row">
                <span>Subtotal:</span>
                <span>₱<?= number_format($result['subtotal'], 2) ?></span>
            </div>
            <div class="receipt-row">
                <span>Tax (12%):</span>
                <span>₱<?= number_format($result['tax'], 2) ?></span>
            </div>
            <div class="receipt-row total">
                <span>Total:</span>
                <span>₱<?= number_format($result['total'], 2) ?></span>
            </div>
            <div class="receipt-row change">
                <span>Change:</span>
                <span>₱<?= number_format($result['change'], 2) ?></span>
            </div>
        </div>

        <div class="success-actions">
            <a href="index.php?page=menu" class="btn btn-primary">
                <i class="fas fa-home"></i> Back to Menu
            </a>
        </div>
    </div>
</div>

<?php
// Clear the checkout result
unset($_SESSION['checkout_result']);
?>