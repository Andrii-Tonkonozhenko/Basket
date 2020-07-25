<?php

interface CheckView
{
    public function render($data): void;
}

class HtmlCheckPrinter implements CheckView
{
    public function render($data): void
    {
        // так і не поняв куда це.
        echo '-----Check-----' . '</br>'; //"сам додумаєшся, чому я це заскрінив" провіряй додумався
        echo 'Date: ' . (date("dS of F  h:I:s A ")) . '</br>';
        echo '-----Products-----' . '</br>';
        //не вдалося запихнути так як ти хотів, не виходить, абор не правильний синтаксис або логіка.
        foreach ($data['product'] as $products){
            echo $products['title'] . ' x'. $products['qty'] . ' ' . $products['product_sum'] . '$' . '</br>';
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

