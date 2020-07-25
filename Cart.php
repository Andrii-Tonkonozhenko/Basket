<?php

require 'Product.php';
require 'CartProduct.php';
require 'CartCalculation.php';
require 'CheckView.php';
require 'Exception.php';

class Cart
{
    private $products = [];
    private $cartCalculation;
    private $checkView;


    public function __construct(CheckView $checkView, CartCalculation $cartCalculation)
    {
        $this->checkView = $checkView;
        $this->cartCalculation = $cartCalculation;
    }

    public function addProduct(CartProduct $product): void
    {
        $this->products[$product->getId()] = $product;
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

        //не вдалося запихнути так як ти хотів, не виходить, абор не правильний синтаксис або логіка.
        foreach ($this->products as $product) {
            $checkView['product'][] = [
                'title' => $product->getTitle(),
                'qty' => $product->getQty(),
                'product_sum' => $product->getProductSum()
            ];
        }

        $checkView['total_cost'] = $this->cartCalculation->getTotalCost($this->products);
        $checkView['tax'] = $this->cartCalculation->tax($this->products);
        $checkView['to_pay'] = $this->cartCalculation->toPay($this->products);

        $this->checkView->render($checkView);
    }
}

$checkView = new HtmlCheckPrinter();
$cartCalculation = new CartCalculation();
$cart = new Cart($checkView, $cartCalculation);

$milk = new Product(1, 'Milk', 1.4);
$bread = new Product(2, 'Bread', 2.4);
$meat = new Product(3, 'Meat', 15.5);

$milkProduct = new CartProduct($milk, 2);
$breadProduct = new CartProduct($bread, 3);
$meatProduct = new CartProduct($meat,2);

try {
    $cart->addProduct($milkProduct);
    $cart->addProduct($breadProduct);
    $cart->addProduct($meatProduct);
    $milkProduct->updateQty(4);
    $cart->removeProduct(3);
    $cart->check();
} catch (CartException $e) {
    die($e->getMessage());
}

