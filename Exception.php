<?php

class BasketException extends Exception
{

}

class ThisProductIsNotInBasket extends BasketException
{
    protected $message = 'This product is not in the basket';
}