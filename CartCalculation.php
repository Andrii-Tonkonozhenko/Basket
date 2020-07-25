<?php

class CartCalculation
{
    public function getTotalCost($products) : float
    {
        $totalCost = 0;

        foreach ($products as $product) {
            $totalCost += $product->getProductSum();
        }

        return $totalCost;
    }

    public function tax($product) : float
    {
       return $this->getTotalCost($product) * (10 / 100);
    }

    public function toPay($product) : float
    {
        return $this->getTotalCost($product) - $this->tax($product);
    }

}