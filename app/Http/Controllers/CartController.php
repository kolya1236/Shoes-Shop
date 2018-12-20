<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Cookie;
use App\Shoes;
use App\Helpers\Getters;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
     * Return cart with items, get quantity
     *
     * @return view
     */
    public function index()
    {
        $quantity = Getters::GetQuantity();
    	return view('cart', ["items"=>cart()->items(), "quantity"=>$quantity]);
    }


    /**
     * Add product in cart 
     * 
     *
     * @param  integer  $id
     * @return redirect
     */
    public function add($id)
    {
    	Shoes::addToCart((int)$id);
        return redirect(url()->previous());
    }


    /**
     * Decrement one product in cart
     * 
     *
     * @param  integer  $id
     * @return redirect
     */
    public function decrement($id)
    {
        cart()->decrementQuantityAt((int)$id);
        return redirect('/cart');
    }


    /**
     * Remove products from cart 
     * 
     *
     * @param  integer  $id
     * @return redirect
     */
    public function remove($id)
    {
        cart()->removeAt((int)$id);
        return redirect('/cart');
    }


    /**
     * Clear cart
     * 
     *
     * @return redirect
     */
    public function buy()
    {
        cart()->clear();
        return redirect('/cart');
    }
}
