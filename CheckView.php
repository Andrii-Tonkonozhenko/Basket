<?php

interface CheckView
{
    public function render ($data): void;
}

class HtmlCheckPrinter implements CheckView
{
    public function render( $data): void
    {
        echo '-----Check-----' . '</br>';
        echo $data['time'] . '</br>';
        echo '-----Products-----' . '</br>';

        /**
         * @var CartProduct $product
         */
        foreach ($data['product'] as $product) {
            echo $product->getTitle() . ' x'. $product->getQty() . ' ' . $product->getProductSum() . '$' . '</br>';
        }

        echo '</br>' . 'Total cost: ' . $data['total_cost'] . '$' . '</br>';
        echo 'Tax: ' . $data['tax'] . '$' . '</br>';
        echo 'To pay: ' . $data['to_pay'] . '$' . '</br>';
    }

}

class ConsoleCheckPrinter implements CheckView
{
    public function render($data): void
    {
        echo '-----Check-----' . "\n";
        echo $data['time'] . "\n";
        echo '-----Products-----' . "\n";

        /**
         * @var CartProduct $product
         */
        foreach ($data['product'] as $product) {
            echo $product->getTitle() . ' x'. $product->getQty() . ' ' . $product->getProductSum() . '$' . "\n";
        }

        echo '</br>' . 'Total cost: ' . $data['total_cost'] . '$' . "\n";
        echo 'Tax: ' . $data['tax'] . '$' . "\n";
        echo 'To pay: ' . $data['to_pay'] . '$' . "\n";
    }
}

