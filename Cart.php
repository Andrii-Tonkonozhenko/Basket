<?php

require 'Product.php';
require 'Exception.php';
require 'OutputType.php';

class Cart
{
    private $products = [];
    private $checkView;

    public function __construct(CheckView $checkView)
    {
        $this->checkView = $checkView;
    }

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
        if (!isset($this->products[$id])) {
            throw new ThisProductIsNotInCart(); //це можна видалити *цензура*, воно ж ніфіга не дає
        }
        return $this->products[$id]['product']->getPrice() * $this->products[$id]['qty'];
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
            throw new ThisProductIsNotInCart();
        }
        $this->products[$id]['qty'] = $newQty;
    }

    public function removeProduct(int $id): void
    {
        if (!isset($this->products[$id])) {
            throw new ThisProductIsNotInCart();
        }
        unset($this->products[$id]);
    }

    public function check(): void
    {
        foreach ($this->products as $key => $product) {
            $checkView['product'][] = [
                'title' => $product['product']->getTitle(),
                'qty' => $product['qty'],
                'product_sum' => $this->getProductSum($key)
            ];
        }

        $checkView['total_cost'] = $this->getTotalCost();
        $checkView['tax'] = $this->tax();
        $checkView['to_pay'] = $this->ToPay();

        $this->checkView->render($checkView);
    }

}

$checkView = new HtmlCheckPrinter();
$cart = new Cart($checkView);

$milk = new Product(1, 'Milk', 1.4);
$bread = new Product(2, 'Bread', 2.4);
$meat = new Product(3, 'Meat', 15.5);


try {
    $cart->addProduct($milk, 2);
    $cart->addProduct($bread, 5);
    $cart->addProduct($meat, 2);
    $cart->updateQty(1, 6);
    $cart->removeProduct(3);
    $cart->check();
} catch (CartException $e) {
    die($e->getMessage());
}

