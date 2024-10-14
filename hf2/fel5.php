<?php

class ShoppingList
{
    private $items = [];

    public function addItem($name, $quantity, $unitPrice)
    {
        $this->items[] = [
            "nev" => $name,
            "mennyiseg" => $quantity,
            "egysegar" => $unitPrice
        ];
    }

    public function removeItem($name)
    {
        foreach ($this->items as $index => $item) {
            if ($item["nev"] === $name) {
                unset($this->items[$index]);
                $this->items = array_values($this->items);
                return true;
            }
        }
        return false;
    }

    public function printShoppingList()
    {
        foreach ($this->items as $item) {
            echo "Termék: " . $item["nev"] . ", Mennyiség: " . $item["mennyiseg"] . ", Egységár: " . $item["egysegar"] . " HUF\n";
        }
    }

    public function calculateTotalCost()
    {
        $totalCost = 0;
        foreach ($this->items as $item) {
            $totalCost += $item["mennyiseg"] * $item["egysegar"];
        }
        return $totalCost;
    }
}

$shoppingList = new ShoppingList();

$shoppingList->addItem("Kenyer", 2, 8.5);
$shoppingList->addItem("Viz", 1, 2.5);

$shoppingList->printShoppingList();

echo "Összköltség: " . $shoppingList->calculateTotalCost() . " HUF\n";

$shoppingList->removeItem("Viz");

$shoppingList->printShoppingList();
echo "Összköltség: " . $shoppingList->calculateTotalCost() . " HUF\n";
