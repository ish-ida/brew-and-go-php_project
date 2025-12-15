<?php
require "Autoload.php";
session_start();



// Initialize items and cart in session
if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = [
        new Item("Iced Mochaccino", 150, "Iced Specials"),
        new Item("Espresso", 120, "Espresso"),
        new Item("Cappuccino", 130, "Hot Classic"),
        new Item("Latte", 140, "Iced Specials"),
        new Item("Black Americano", 160, "Hot Classic"),
        new Item("Strawberry Milkshake", 180, "Milkshake"),
        new Item("Chocolate Milkshake", 170, "Milkshake"),
        new Item("Vanilla Frappe", 190, "Frapped"),
        new Item("Blueberry Frappe", 190, "Frapped"),
    ];
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}

if (!isset($_SESSION['billing'])) {
    $_SESSION['billing'] = new Billing();
}

$items = $_SESSION['items'];
$cart = $_SESSION['cart'];
$billing = $_SESSION['billing'];

// Handle actions
$error = '';
$success = '';

$selectedCategory = $_GET['category'] ?? 'All Items';

// Filter items by category
if ($selectedCategory !== 'All Items') {
    $filteredItems = array_filter($items, function($item) use ($selectedCategory) {
        return $item->getCategory() === $selectedCategory;
    });
    $filteredItems = array_values($filteredItems); // Re-index the array
} else {
    $filteredItems = $items;
}

// Replace $items with filtered items for display
$items = $filteredItems;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Add to cart
        if (isset($_POST['add_to_cart'])) {
            $itemIndex = $_POST['item_index'];
            $qty = $_POST['quantity'] ?? 1;
            
            if (!isset($items[$itemIndex])) {
                throw new Exception("Item does not exist.");
            }
            
            if (!$items[$itemIndex]->reduceStock($qty)) {
                throw new Exception("Not enough stock.");
            }
            
            $cart->add($items[$itemIndex], $qty);
            $success = "Item added to cart!";
        }

        // Remove from cart
if (isset($_POST['remove_from_cart'])) {
    $cartIndex = $_POST['cart_index'];
    
    $removedCartItem = $cart->removeItem($cartIndex);
    
    if ($removedCartItem) {
        // Find the item in the items array and restore stock
        $itemName = $removedCartItem->getItem()->getName();
        foreach ($items as $item) {
            if ($item->getName() === $itemName) {
                $item->restoreStock($removedCartItem->getQty());
                break;
            }
        }
        $success = "Item removed from cart and stock restored!";
    } else {
        $error = "Failed to remove item.";
    }
}

    // Update cart quantity
if (isset($_POST['update_cart_quantity'])) {
    $cartIndex = $_POST['cart_index'];
    $newQty = $_POST['new_quantity'];
    
    $updateResult = $cart->updateQuantity($cartIndex, $newQty);
    
    if ($updateResult) {
        $oldQty = $updateResult['old'];
        $newQty = $updateResult['new'];
        $item = $updateResult['item'];
        
        // Calculate stock difference
        $difference = $newQty - $oldQty;
        
        // Find the item in items array and adjust stock
        foreach ($items as $i) {
            if ($i->getName() === $item->getName()) {
                if ($difference > 0) {
                    // Increasing quantity - reduce stock
                    if (!$i->reduceStock($difference)) {
                        throw new Exception("Not enough stock available.");
                    }
                } else if ($difference < 0) {
                    // Decreasing quantity - restore stock
                    $i->restoreStock(abs($difference));
                }
                break;
            }
        }
        
        $success = "Cart quantity updated!";
    } else {
        $error = "Failed to update quantity.";
    }
}


        
        // Checkout
        if (isset($_POST['checkout'])) {
            $cash = $_POST['cash'];
            
            $result = $billing->checkout($cart, $cash);
            
            // Save receipt to file
            $receiptData = date('Y-m-d H:i:s') . "\n";
            $receiptData .= "Subtotal: ₱" . $result['subtotal'] . "\n";
            $receiptData .= "Tax (12%): ₱" . $result['tax'] . "\n";
            $receiptData .= "Total: ₱" . $result['total'] . "\n";
            $receiptData .= "Cash: ₱" . $cash . "\n";
            $receiptData .= "Change: ₱" . $result['change'] . "\n";
            $receiptData .= "----------------------------\n\n";
            
            file_put_contents('receipts.txt', $receiptData, FILE_APPEND);
            
            $_SESSION['checkout_result'] = $result;
            header('Location: index.php?page=success');
            exit;
        }
        
    } catch (InsufficientCashException $e) {
        $error = $e->getMessage();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Routing
$page = $_GET['page'] ?? 'home';

include 'header.php';

switch ($page) {
     case 'menu':
        include 'menu.php';
        break;

    case 'cart':
        include 'cartpage.php';
        break;
    case 'checkout':
        include 'checkout.php';
        break;
    case 'success':
        include 'success.php';
        break;
    default:
        include 'hero.php';
        break;
}

include 'footer.php';
?>