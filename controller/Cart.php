<?php 

namespace controller;

class Cart extends Controller 
{
    public function get_cart()
    {
        $this->view("cart/cart");
    }
}