<?php

class CartException extends Exception
{

}

class ThisProductIsNotInCart extends CartException
{
    protected $message = 'This product is not in the basket';
}