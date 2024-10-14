<?php


class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    // TODO Generate getters and setters of properties

    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Product $product
     * @param int $quantity
     * @return CartItem
     */
    public function addProduct(Product $product, int $quantity): CartItem
    {
        //TODO Implement method
        foreach ($this->items as $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                $newQuantity = min($item->getQuantity() + $quantity, $product->getAvailableQuantity());
                $item->setQuantity($newQuantity);
                return $item;
            }
        }
        $newQuantity = min($quantity, $product->getAvailableQuantity());
        $cartItem = new CartItem($product, $newQuantity);
        $this->items[] = $cartItem;

        return $cartItem;
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        //TODO Implement method
        foreach ($this->items as $index => $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                unset($this->items[$index]);
                $this->items = array_values($this->items);
                return;
            }
        }
    }

    /**
     * This returns total number of products added in cart
     *
     * @return int
     */
    public function getTotalQuantity(): int
    {
        //TODO Implement method
        $totalQuantity = 0;
        foreach ($this->items as $item) {
            $totalQuantity += $item->getQuantity();
        }
        return $totalQuantity;
    }

    /**
     * This returns total price of products added in cart
     *
     * @return float
     */
    public function getTotalSum(): float
    {
        //TODO Implement method
        $totalSum = 0.0;
        foreach ($this->items as $item) {
            $totalSum += $item->getProduct()->getPrice() * $item->getQuantity();
        }
        return $totalSum;
    }
}