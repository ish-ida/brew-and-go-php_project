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

        public function removeItem($index) {
    if (isset($this->items[$index])) {
        $removedItem = $this->items[$index];
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Re-index array
        return $removedItem; // Return the removed item instead of true
    }
    return null;
}
        public function updateQuantity($index, $newQty) {
    if (isset($this->items[$index])) {
        $oldQty = $this->items[$index]->getQty();
        
        // Update the quantity directly
        $this->items[$index] = new CartItem(
            $this->items[$index]->getItem(), 
            $newQty
        );
        
        return [
            'old' => $oldQty,
            'new' => $newQty,
            'item' => $this->items[$index]->getItem()
        ];
    }
    return null;
}

    }

?>