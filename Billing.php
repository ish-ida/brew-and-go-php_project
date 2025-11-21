<?php
    class Billing {
        public function checkout($cart, $cash) {
            if ($cart->isEmpty()) {
                throw new Exception("Cart is empty.");
            }

            $subtotal = $cart->subtotal();
            $tax = $subtotal * 0.12;
            $total = $subtotal + $tax;

            if ($cash < $total) {
                throw new InsufficientCashException("Insufficient cash provided.");
            }

            $change = $cash - $total;
            $cart->clear();

            return [
                "subtotal" => $subtotal,
                "tax" => $tax,
                "total" => $total,
                "change" => $change
            ];
        }
    }
?>