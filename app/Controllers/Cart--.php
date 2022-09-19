<?php

namespace App\Controllers;

class Cart extends BaseController
{
    public function index()
    {
		$data = array(
			'title'	=> 'Cart',
		);
		
        return view('cart/view_cart', $cart);
    }

    //--------------------------------------------------------------------

}
