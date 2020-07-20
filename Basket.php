<?php

require 'Product.php';
require 'Exception.php';

class Basket
{
    private $products = [];

    private function tax(): float
    {
        return $this->getTotalCost() * (10 / 100);
    }

    private function getTotalCost(): float
    {
        $totalCost = 0;
        foreach ($this->products as $product) {
            $totalCost += $product['product']->getPrice() * $product['qty'];
        }
        return $totalCost;
    }

    private function getProductSum(int $id): float
    {
        foreach ($this->products as $product) {
            if ($product['product']->getId() === $id) {
                return $product['product']->getPrice() * $product['qty'];
            }
        }
    }

    private function toPay(): float
    {
        return $this->getTotalCost() - $this->tax();
    }

    public function addProduct(Product $product, int $qty): void
    {
        $this->products[$product->getId()] = ['product' => $product, 'qty' => $qty];
    }

    public function updateQty(int $id, int $newQty): void
    {
        if (!isset($this->products[$id])) {
            throw new ThisProductIsNotInBasket();
        }
        $this->products[$id]['qty'] = $newQty;
    }

    public function removeProduct (int $id): void
    {
        if (!isset($this->products[$id])) {
            throw new ThisProductIsNotInBasket();
        }
        unset($this->products[$id]);
    }

    public function check()
    {
        echo '-----Check-----' . '</br>';
        echo 'Date: ' . (date("dS of F  h:I:s A ")) . '</br>';
        echo '-----Products-----' . '</br>';

        foreach ($this->products as $product) {
            echo $product['product']->getTitle() . ' x' . $product['qty'] . ' ' . $this->getProductSum($product['product']->getId()) . '$' . '</br>';
        }

        echo '</br>' . 'Total cost: ' . $this->getTotalCost() . '$' . '</br>';
        echo 'Tax: ' . $this->tax() . '$' . '</br>';
        echo 'To pay: ' . $this->ToPay() . '$' . '</br>';
    }

}

$basket = new Basket();

$milk = new Product(1, 'Milk', 1.4);
$bread = new Product(2, 'Bread', 2.4);
$meat = new Product(3, 'Meat', 15.5);
try {
    $basket->addProduct($milk, 2);
    $basket->addProduct($bread, 5);
    $basket->addProduct($meat, 2);
    $basket->updateQty(1, 6);
    $basket->removeProduct(3);

    $basket->check();
} catch (BasketException $e) {
    die($e->getMessage());
}
