<?php

namespace App\Lib\Api;

use App\Lib\Api\cURL;

/**
 * Passportテストクラス
 * 
 * @author Kuniyasu Wada
 */
class Passport
{
	private $method;
	private $accessToken;
	private $refreshToken;
	private $expiresIn;
	
	/**
	 * コンストラクタ...
	 */
	public function __construct()
	{
		//
	}
	
	/**
	 * 不明
	 * 
	 * oauth/token
	 * @method POST
	 */
	public function getTokens()
	{
		$url = url('oauth/tokens');
		$this->method = 'GET';
		
		$header = [
				'Content-type: application/json',
				'X-Requested-With: XMLHttpRequest',
// 				'X-CSRF-TOKEN: '. csrf_token(),// APIは除外済み(/oauth/*~)
// 				"Authorization: Bearer {$this->accessToken}",
		];
		
		$param = [
				"client_id"     => 2,
				"client_secret" => "dBqslMZWYQxrO2lWMqcoOMyAoYQdv67dcBWsu2du",
				"username"      => "redbull.816.com@gmail.com",
				"password"      => 'kuniyasu1983',
				"grant_type"    => "password",
				"scope"         =>  "",
		];
		
		return $this->call($param, $header, $url);
	}
	
	/**
	 * パスワード認証（アクセストークン発行）
	 * oauth/token
	 * @method POST
	 */
	public function postToken()
	{
		$result = $this->authenticate();
		
		if( empty($result->access_token) ) \Response::json(['error' => 'BAD REQUEST'], 400);
		
		$this->accessToken  = $result->access_token;
		$this->refreshToken = $result->refresh_token;
		$this->expiresIn    = $result->expires_in;
	}
	
	/**
	 * Codeを使用した認可
	 * oauth/clients
	 * @method POST
	 */
	public function postClients()
	{
		$url = url('oauth/clients');
		$this->method = 'POST';
	
		$header = [
				'Content-type: application/json',
				'X-Requested-With: XMLHttpRequest',
// 				'X-CSRF-TOKEN: '. csrf_token(),// APIは除外済み(/oauth/*~)
// 				"Authorization: Bearer {$this->accessToken}",
		];
	
		$param = [
				"name"          => "Code Grant Client",
				"redirect"      => 'http://192.168.33.15/auth/callback',
		];
		
		return $this->call($param, $header, $url);
	}
	
	/**
	 * cURLライブラリで接続後、JSONをパースして返す
	 */
	private function call($param, $header, $url)
	{
		$ch = new cURL();
		$ch->init();
		$ch->setUrl($url);
		$ch->setIsJson(true);
		$ch->setMethod($this->method);
// 		$ch->setUserPwd($this->clientId, $this->clientSecret);
		$ch->setHeader($header);
		$ch->setParameterFromArray($param);
		$ch->setSslVerifypeer(false);
		$response = $ch->exec();
// 		dd($response);
		$ch->close();
		
		return json_decode($response);
	}
	
	/**
	 * authentication...
	 */
	private function authenticate()
	{
		// Set up request for access token
		$url = url('oauth/token');
		$this->method = 'POST';
		
		$header = [
				'Content-type: application/json',
				'X-Requested-With: XMLHttpRequest',
// 				'X-CSRF-TOKEN: '. csrf_token(),// APIは除外済み(/oauth/*~)
// 				"Authorization: Bearer {$this->accessToken}",
		];
		
		$param = [
				"client_id"     => 2,
				"client_secret" => "dBqslMZWYQxrO2lWMqcoOMyAoYQdv67dcBWsu2du",
				"username"      => "redbull.816.com@gmail.com",
				"password"      => 'kuniyasu1983',
				"grant_type"    => "password",
				"scope"         =>  "",
		];
		
		return $this->call($param, $header, $url);
	}
	
	/**
	 * Setter...
	 */
	public function setTest($test)
	{
		$this->test = $test;
		return $this;
	}
	
	/**
	 * Getter...
	 */
	public function getTest()
	{
		return $this->test;
	}
	
}
