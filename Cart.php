<?php
    class Cart {
        private $items = [];

        public function add($item, $qty) {
            $this->items[] = new CartItem($item, $qty);
        }

        public function getItems() {
            return $this->items;
        }

        public function subtotal() {
            $sum = 0;

            foreach($this->items as $ci) {
                $sum += $ci->total();
            }
            return $sum;
        }

        public function isEmpty() {
            return empty($this->items);
        }

        public function clear() {
            $this->items = [];
        }
    }
?>