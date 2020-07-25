<?php

class CartCalculation
{

    /*
 * @var Product[] $products
    */
    public function getTotalCost(array $products) : float
    {
        $totalCost = 0;

        foreach ($products as $product) {
            $totalCost += $product->getProductSum();
        }

        return $totalCost;
    }

    public function tax(array $product) : float
    {
       return $this->getTotalCost($product) * (10 / 100);
    }

    public function toPay(array $product) : float
    {
        return $this->getTotalCost($product) - $this->tax($product);
    }

}