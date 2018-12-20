<?php
//app/Helpers/Getters.php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use app\Helpers\WorkWithDB;
 
class Getters {

    /**
     * Get only one shoes
     *
     * @param integer $id
     * @return Collection
     */
    public static function GetOneShoes($id)
    {
    	$db = WorkWithDB::ConnectToDB('shoes');
    	return $db->where("id", $id)->get();
    }

	/**
     * Get all users
     *
     * @return Collection
     */
    public static function GetUsers()
    {
    	$db = WorkWithDB::ConnectToDB('users');
    	return $db->select('id','name','email','admin')->get();
    }

	/**
     * Get all shoes
     *
     * @return Collection
     */
    public static function GetShoes()
	{	
		$db = WorkWithDB::ConnectToDB('shoes');

		return $db->get();
	}


	/**
     * Get all categories
     *
     * @return Collection
     */
	public static function GetCategories()
	{	
		$db = WorkWithDB::ConnectToDB('categories');

		return $db->pluck('category');
	}


	/**
     * Get all shoes in one category
     *
     * @param string $category
     * @return Collection
     */
	public static function GetShoesInCategory($category)
	{
		// create connections to databases
		$dbCategories = WorkWithDB::ConnectToDB('categories');
		$dbShoes = WorkWithDB::ConnectToDB('shoes');
		$dbShoes_Categories = WorkWithDB::ConnectToDB('shoes_categories');


		// get category id
		$category_id = $dbCategories->where('category',$category)->pluck('id');

		// get shoes id by category
		$shoes_id = $dbShoes_Categories->where('categories_id',$category_id)->pluck('shoes_id');

		// get shoes
		$shoes = $dbShoes->whereIn('id',$shoes_id)->get();
		return $shoes;
	}


	/**
     * Count all items in cart and return quantity
     *
     * @return integer
     */
	public static function GetQuantity()
	{
		$quantity = 0;
    	foreach (cart()->items() as $value) {
    		$quantity += $value["quantity"];
    	};
    	return $quantity;
	}
}
?>