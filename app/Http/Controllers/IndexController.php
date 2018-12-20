<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Getters;

class IndexController extends Controller
{
	/**
     * Return index view, get shoes, get quantity, get
     * categories
     *
     * @return view
     */
    public function index()
    {
    	$quantity = Getters::GetQuantity();
    	$shoes = Getters::GetShoes();
    	$categories = Getters::GetCategories();
    	return view('index', ['shoes'=>$shoes, 'categories'=>$categories, "quantity"=>$quantity]);
    }



    /**
     * Return index view, get shoes in category, 
     * get quantity, get categories
     *
     * @param string $category
     * @return view
     */
    public function filter($category)
    {
    	$quantity = Getters::GetQuantity();
    	$shoes = Getters::GetShoesInCategory($category);
    	$categories = Getters::GetCategories();

    	return view('index', ['shoes'=>$shoes, 'categories'=>$categories, 'quantity'=>$quantity]);
    }
}
