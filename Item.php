<?php
abstract class BaseProduct {
    protected $name;
    protected $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function info();

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function __toString() {
        return $this->info();
    }
}

    class Item extends BaseProduct {
        protected $stock = 100;
        protected $category;

        public function __construct($name, $price, $category = "All Items") { // Add category parameter
        parent::__construct($name, $price);
        $this->category = $category; // Set category
    }

    // Add this getter method
    public function getCategory() {
        return $this->category;
    }

        public function __get($prop) {
            return $this->$prop ?? null;
        }

        public function info() {
            return "{$this->name} - ₱{$this->price}";
        }

        public function reduceStock($qty) {
            if ($qty <= $this->stock) {
                $this->stock -= $qty;
                return true;
            }
            return false;
        }

        public function restoreStock($qty) {
    $this->stock += $qty;
    return true;
}
    }

?>