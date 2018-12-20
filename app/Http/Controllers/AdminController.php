<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Helpers\Getters;
use App\Helpers\WorkWithDB;

class AdminController extends Controller
{

	/**
     * Check if user admin or not, generate new controller
     * instance.
     *
     * @return redirect OR response
     */
	public function __construct()
    {
    	$this->middleware('auth');
    	$this->middleware(function ($request, $next) {
	        if(0 == Auth::user()["admin"]){
	        	return redirect('/');
	        } else {
	        	// Continue work if no redirect happend
	        	return $next($request);
	        }
    	});
    }

    /**
     * Return edit view, get one shoes, get quantity 
     * 
     *
     * @param  integer  $id
     * @return view
     */
	public function edit($id)
	{
		$quantity = Getters::GetQuantity();
		$shoes = Getters::GetOneShoes($id);
		return view('edit',["single_shoes"=>$shoes, "quantity"=>$quantity]);
	}



	/**
     * Update one shoes 
     * 
     *
     * @param  Request $request
     * @return redirect
     */
	public function update(Request $request)
	{
		if ($request->hasFile('img')) {
			$filename = "pic".$request->input('id').".webp";
		    $request->img->move(public_path('img'), $filename);
		};

		$data = WorkWithDB::PrepareToUpdate($request);

		WorkWithDB::UpdateOneShoes($data["id"], $data);
		
		return redirect('/');
	}
    


    /**
     * Return admin view, get users, get quantity 
     * 
     *
     * @return view
     */
	public function admin()
	{
		$quantity = Getters::GetQuantity();
		$users = Getters::GetUsers();
		return view('admin', ["users"=>$users, "quantity"=>$quantity]);
	}


	/**
     * Change user rights
     * 
     *
     * @param  integer $id
     * @param  tinyint(1) $admin
     * @return redirect
     */
	public function changeRights($id, $admin)
	{	
		$users = Getters::GetUsers();
		$rights = [1,0];
		WorkWithDB::UpdateUserRights($id, $rights[(int)$admin]);
		return redirect()->route('admin', ['users' => $users]);
	}


	/**
     * Delete user
     * 
     *
     * @param  integer $id
     * @return redirect
     */
	public function delete($id)
	{	
		$users = Getters::GetUsers();
		WorkWithDB::DeleteUser($id);
		return redirect()->route('admin', ['users' => $users]);
	}
}
