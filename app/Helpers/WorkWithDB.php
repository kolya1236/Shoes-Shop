<?php
//app/Helpers/Getters.php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;

 
class WorkWithDB {


	/**
     * Get all shoes in one category
     *
     * @param integer $id
     * @return Builder
     */
    public static function ConnectToDB($db)
    {
    	return DB::table($db);
    }


    /**
     * Update user rights
     *
     * @param integer $id
     * @param tinyint(1) $rights
     * @return Void
     */
    public static function UpdateUserRights($id, $rights)
    {
    	$db = WorkWithDB::ConnectToDB('users');
    	$db->where("id", $id)->update(["admin"=>$rights]);
    }

    /**
     * Update shoes
     *
     * @param integer $id
     * @param array $data
     * @return Void
     */
    public static function UpdateOneShoes($id, $data)
    {
    	$db = WorkWithDB::ConnectToDB('shoes');
    	$db->where("id", $id)->update($data);
    }

    /**
     * Make different unsets and checks
     *
     * @param Request $request
     * @return array
     */
    public static function PrepareToUpdate($request)
    {
    	$data = [];
		foreach ($request->all() as $key => $value) {
			$data[$key] = $value;
		};
		unset($data["_token"]);
		unset($data["_method"]);
		if ($data["price"]<=0) {
			unset($data["price"]);
		};
		if (sizeof($data["name"])<=5) {
			unset($data["name"]);
		};
		return $data;
    }

    /**
     * Delete user with requested id
     *
     * @param integer $id
     * @return Void
     */
    public static function DeleteUser($id)
    {
    	$db = WorkWithDB::ConnectToDB("users");
		$db->where("id",$id)->delete();
    }

}
?>