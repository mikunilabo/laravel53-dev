<?php

namespace App\Http\Controllers\Api;

use App\Lib\Api\Passport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;

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
	public function get(Request $request, $client_id)
	{
// 		$Client = Client::find($client_id);
// 		dd( $Client->tokens()->get() );
		
		// アクセストークンの認証ユーザが返されてる？
		$User = $request->user();
		
		dd($User);
		
		if( $User->id !== intval($client_id) )
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
