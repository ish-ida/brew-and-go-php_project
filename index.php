<?php
    require "Autoload.php";

  $items = [  
        new Item("Iced Mocchaccino", 150),
        new Item("Espresso", 120),
        new Item("Cappuccino", 130),
        new Item("Latte", 140),
        new Item("Black Americano", 160)
    ];

    $cart = new Cart();
    $billing = new Billing();

    function menu() {
        echo "\n=============================\n";
        echo "   ORDER & BILLING SYSTEM\n";
        echo "=============================\n";
        echo "1. View Items\n";
        echo "2. Purchase Item\n";
        echo "3. View Cart\n";
        echo "4. Checkout\n";
        echo "5. Exit\n";
        echo "Choose an option: ";
    }

    while (true) {
        menu();
    $choice = trim(fgets(STDIN));

    try {
        if($choice == 1){ // view
            echo "\n======= AVAILABLE ITEMS =======\n";
            foreach($items as $i => $itm){
                echo ($i+1).". {$itm->info()}\n";
            }
        }

        else if($choice == 2){ // purchase
            echo "Enter item number: ";
            $num = trim(fgets(STDIN)) - 1;

            if(!isset($items[$num])){
                throw new Exception("Item does not exist.");
            }

            echo "Enter quantity: ";
            $qty = trim(fgets(STDIN));

            if(!$items[$num]->reduceStock($qty)){
                throw new Exception("Not enough stock.");
            }

            $cart->add($items[$num], $qty);
            echo "Added to cart!\n";
        }

        else if($choice == 3){ // view cart
            echo "\n=========== CART ===========\n";
            if($cart->isEmpty()){
                echo "Cart is empty.\n";
            } else {
                foreach($cart->getItems() as $ci){
                    echo $ci->getItem()->getName()
                       ." x ".$ci->getQty()
                       ." = ₱".$ci->total()."\n";
                }
                echo "TOTAL: ₱".$cart->subtotal()."\n";
            }
        }

        else if($choice == 4){ // checkout
            echo "Enter cash amount: ";
            $cash = trim(fgets(STDIN));

            $result = $billing->checkout($cart, $cash);

            echo "\nCHECKOUT SUMMARY\n";
            echo "Subtotal: ₱".$result["subtotal"]."\n";
            echo "Tax (12%): ₱".$result["tax"]."\n";
            echo "TOTAL: ₱".$result["total"]."\n";
            echo "Change: ₱".$result["change"]."\n";
            echo "Thank you for your purchase!\n";
        }

        else if($choice == 5){
            exit("Thank You Ma'am/Sir, Come Again!\n");
        }

        else {
            echo "Invalid option.\n";
        }
    }

    catch(InsufficientCashException $e){
        echo "Error: ".$e->getMessage()."\n";
    }
    catch(Exception $e){
        echo "Error: ".$e->getMessage()."\n";
    }
    finally {
        echo "Press Enter to continue...";
        fgets(STDIN);
      }
    }
?>
