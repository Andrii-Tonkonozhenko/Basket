<?php

require 'Product.php';
require 'Exception.php';

class Basket
{
    private $products = [];

    private function tax(): float
    {
        return $this->setTotalCost() * (10 / 100);
    }

    private function setTotalCost(): float
    {
        $totalCost = 0;
        foreach ($this->products as $product) {
            $totalCost += $product['product']->getPrice() * $product['qty'];
        }
        return $totalCost;
    }

    private function productSum(): float
    {
        foreach ($this->products as $product) {
            return $product['product']->getPrice() * $product['qty'];
        }
    }

    private function toPay(): float
    {
        return $this->setTotalCost() - $this->tax();
    }

    public function addProductToBasket(Product $product, int $qty): void
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

    public function removeProductInBasket(int $id): void
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
            echo $product['product']->getTitle() . ' x' . $product['qty'] . ' ' . $this->productSum() . '$' . '</br>';
        }

        echo '</br>' . 'Total cost: ' . $this->setTotalCost() . '$' . '</br>';
        echo 'Tax: ' . $this->tax() . '$' . '</br>';
        echo 'To pay: ' . $this->ToPay() . '$' . '</br>';
    }

}

$basket = new Basket();

$milk = new Product(1, 'Milk', 1.4);
$bread = new Product(2, 'Bread', 2.4);
$meat = new Product(3, 'Meat', 15.5);
try {
    $basket->addProductToBasket($milk, 2);
    $basket->addProductToBasket($bread, 5);
    $basket->addProductToBasket($meat, 2);
    $basket->updateQty(1, 7);
    $basket->removeProductInBasket(3);

    $basket->check();
} catch (BasketException $e) {
    die($e->getMessage());
}
