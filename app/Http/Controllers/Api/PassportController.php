<?php

namespace App\Http\Controllers\Api;

use App\Lib\Api\Passport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PassportController extends Controller
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
	 * 不明
	 * 
	 * oauth/tokens
	 * @method GET
	 */
	public function getTokens()
	{
		$Passport = new Passport();
		dd( $Passport->getTokens() );;
	}
	
	/**
	 * パスワード認証（アクセストークン発行）
	 * oauth/token
	 * @method POST
	 */
	public function postToken()
	{
		$Passport = new Passport();
		dd( $Passport->postToken() );
	}
	
	/**
	 * 認証済み全クライアントを返す
	 * oauth/clients
	 * @method GET
	 */
	public function getClients()
	{
		$Passport = new Passport();
		dd( $Passport->getClients() );
	}
	
	/**
	 * Codeを使用した認可
	 * oauth/clients
	 * @method POST
	 */
	public function postClients()
	{
		$Passport = new Passport();
		dd( $Passport->postClients() );
	}
	
}
