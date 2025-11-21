<?php
   class CartItem {
       private $item;
       private $qty;

       public function __construct($item, $qty) {
           $this->item = $item;
           $this->qty = $qty;
       }

       public function getItem() {
           return $this->item;
       }

       public function getQty() {
           return $this->qty;
       }

       public function total() {
           return $this->item->getPrice() * $this->qty;
       }
   }


?>