<?php

interface OutputType
{
    public function render($type): void;
}

class HtmlCheckPrinter implements OutputType
{
    public function render($data): void
    {
        echo '-----Check-----' . '</br>';
        echo 'Date: ' . (date("dS of F  h:I:s A ")) . '</br>';
        echo '-----Products-----' . '</br>';

        foreach ($data['product'] as $products){
            echo $products['title'] . ' x'. $products['qty'] . ' ' . $products['product_sum'] . '$' . '</br>';
        }

        echo '</br>' . 'Total cost: ' . $data['total_cost'] . '$' . '</br>';
        echo 'Tax: ' . $data['tax'] . '$' . '</br>';
        echo 'To pay: ' . $data['to_pay'] . '$' . '</br>';
    }
}

class ConsoleCheckPrinter implements OutputType
{
    public function render($data): void
    {
        echo '-----Check-----' . "\n";
        echo 'Date: ' . (date("dS of F  h:I:s A ")) . "\n";
        echo '-----Products-----' . "\n";

        foreach ($data['product'] as $products){
            echo $products['title'] . ' x'. $products['qty'] . ' ' . $products['product_sum'] . '$' . "\n";
        }

        echo '</br>' . 'Total cost: ' . $data['total_cost'] . '$' . "\n";
        echo 'Tax: ' . $data['tax'] . '$' . "\n";
        echo 'To pay: ' . $data['to_pay'] . '$' . "\n";
    }
}

