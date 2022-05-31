<?php

namespace App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{
    private $stack;

    public function __construct(RequestStack $stack)
    {

        $this->stack = $stack;
    }

    public function add($id)
    {
        /*Ancienne méthode :

        $this->session->set('cart', [
            [
                'id' => $id,
                'quantity' => 1
            ]
        ]);
        */

        $session = $this->stack->getSession();
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);

     /*   $cart = $session->set('cart', [
            [
                'id' => $id,
                'quantity' => 1
            ]
        ]); */


    }

    public function get()
    {
        $methodget = $this->stack->getSession();
        return $methodget->get('cart');
    }

    public function remove()
    {
        $methodget = $this->stack->getSession();
        return $methodget->remove('cart');
    }
}