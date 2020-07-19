<?php

class Basket
{
    private $products = [];
    private $totalCost = 0;

    private function tax(): float
    {
        return $this->totalCost * (10 / 100);
    }

    private function setTotalSum($sum): void
    {
        $this->totalCost = $sum;
    }

    private function ProductSum($id): float
    {
        foreach ($this->products as $product) {
            if ($product['product']->getId() === $id) {
                $sum = $product['product']->getPrice() * $product['qty'];
                $this->setTotalSum($sum);
                var_dump($product['qty']);
                return $sum;
            }
        }
    }

    private function ToPay(): float
    {
        return $this->totalCost - $this->tax();
    }

    public function addProductToBasket(Product $product, int $qty): void
    {
        $this->products[$product->getId()] = ['product' => $product, 'qty' => $qty];
    }

    public function updateQty(Product $product, int $newQty): void
    {
        foreach ($this->products as $products) {
            if ($products['product']->getId() === $product->getId()) {
//                $this->products['qty'] = $newQty;
//                $this->products['qty'] = $products['qty'] = $newQty;
               $products['qty'] = $newQty;
            }
        }
    }

    public function check()
    {
        echo '-----Check-----' . '</br>';
        echo 'Date: ' . (date("dS of F  h:I:s A ")) . '</br>';
        echo '-----Products-----' . '</br>';

        foreach ($this->products as $product) {
            echo $product['product']->getTitle() . ' x' . $product['qty'] . ' ' . $this->ProductSum($product['product']->getId()) . '$' . '</br>';
        }

        echo '</br>' . 'Total cost: ' . $this->totalCost . '$' . '</br>';
        echo 'Tax: ' . $this->tax() . '$' . '</br>';
        echo 'To pay: ' . $this->ToPay() . '$' . '</br>';
    }

}

class Product
{
    public $id;
    private $title;
    private $price;

    public function __construct(int $id, string $title, float $price)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getId(): int
    {
        return $this->id;
    }
}

$basket = new Basket();

$milk = new Product(1, 'Milk', 1.4);
$bread = new Product(2, 'Bread', 2.4);
$meat = new Product(3, 'Meat', 15.5);

$basket->addProductToBasket($milk, 2);
$basket->addProductToBasket($bread, 5);
$basket->updateQty($milk, 7);

$basket->check();

