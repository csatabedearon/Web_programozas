<?php


class CartItem
{
    private Product $product;
    private int $quantity;

    // TODO Generate constructor with all properties of the class
    // TODO Generate getters and setters of properties

    public function __construct(Product $Product,int $quantity)
    {
        $this->product=$Product;
        $this->quantity=$quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function increaseQuantity()
    {
        //TODO $quantity must be increased by one.
        // Bonus: $quantity must not become more than whatever is Product::$availableQuantity
        if ($this->quantity < $this->product->getAvailableQuantity()) {
            $this->quantity++;
        } else {
            throw new \Exception("Max capacity reached!");
        }
    }

    public function decreaseQuantity()
    {
        //TODO $quantity must be increased by one.
        // Bonus: Quantity must not become less than 1
        if ($this->quantity >= 2) {
            $this->quantity--;
        } else {
            throw new \Exception("No more product.");
        }
    }
}