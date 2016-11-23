<?php

namespace App\Http\Controllers\Api;

use App\Lib\Api\Passport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:api');
	}
	
	/**
	 * users
	 * @method GET
	 */
	public function get($client_id)
	{
		return \Response::json(['id' => $client_id], 200);
		
// 		$User = User::find(2);
		
		if( !$User )
			return \Response::json(['Bad Request!'], 400);
		else 
// 			return $User->toJson();
			return \Response::json($User->toArray(), 200);
	}
	
	/**
	 * users
	 * @method POST
	 */
	public function post($id)
	{
		dd('post');
	}
	
	/**
	 * users
	 * @method PUT
	 */
	public function put()
	{
		dd('put');
	}
	
	/**
	 * users
	 * @method DELETE
	 */
	public function delete()
	{
		dd('delete');
	}
	
}
