<?php

class CartProduct
{
    private $product;
    private $qty;

    public function __construct(Product $product, int $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }

    public function getId() : int
    {
        return $this->product->getId();
    }

    public function getQty() : int
    {
        return $this->qty;
    }

    public function getTitle() : string
    {
        return $this->product->getTitle();
    }

    public function getProductSum() : float
    {
        return $this->product->getPrice() * $this->qty ;
    }

    public function updateQty(int $newQty) : void
    {
        $this->qty = $newQty;
    }



}

