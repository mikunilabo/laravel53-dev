<?php

namespace App\Http\Controllers;

use App\Lib\Api\cURL;
use App\Lib\Api\Passport;
use Illuminate\Http\Request;

class PassportTestController extends Controller
{
	private $passport;
	private $method;
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		
		$this->passport = new Passport();
		$this->passport->postToken();
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		dd('here');
	}
	
	/**
	 * api/clientsのテスト
	 */
	public function getClients()
	{
		$clientId = 2;
		$url = route('api.clients.get', $clientId);
		$this->method = 'GET';
		
		$header = [
				'X-Requested-With: XMLHttpRequest',
				"Authorization: Bearer {$this->passport->getAccessToken()}",
				'Content-type: application/json',
		];
		
		$param = [
				//
		];
		
		$result = $this->call($param, $header, $url);
		return dd($result);
	}
	
	/**
	 * api/clientsのテスト
	 */
	public function putClients()
	{
		dd('put');
	}
	
	/**
	 * Testのためここに配置
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
// 		dd($ch);
		$response = $ch->exec();
		echo $response;exit;
// 		dd($response);
		$ch->close();
		
		return json_decode($response);
	}
}
