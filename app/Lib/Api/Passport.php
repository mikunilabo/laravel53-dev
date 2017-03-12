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
//                 'X-CSRF-TOKEN: '. csrf_token(),// APIは除外済み(/oauth/*~)
//                 "Authorization: Bearer {$this->accessToken}",
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
        
        if( !empty($result->access_token) )
        {
            $this->accessToken  = $result->access_token;
            $this->refreshToken = $result->refresh_token;
            $this->expiresIn    = $result->expires_in;
        }
        
        return $result;
    }
    
    /**
     * 認証済みクライアントを返す
     * oauth/clients
     * @method POST
     */
    public function getClients()
    {
//         $this->postToken();
        
        $url = url('oauth/clients');
        $this->method = 'GET';
        
        $header = [
                'X-Requested-With: XMLHttpRequest',
//                 "Authorization: Bearer {$this->accessToken}",
                'Content-type: application/json',
        ];
        
        $param = [
                "name"          => "Code Grant Client",
                "redirect"      => 'http://192.168.33.15/auth/callback',
        ];
        
        return $this->call($param, $header, $url);
    }
    
    /**
     * クライアント作成
     * ( Codeを使用した認可 )
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
//                 'X-CSRF-TOKEN: '. csrf_token(),// APIは除外済み(/oauth/*~)
//                 "Authorization: Bearer {$this->accessToken}",
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
//         $ch->setUserPwd($this->clientId, $this->clientSecret);
        $ch->setHeader($header);
        $ch->setParameterFromArray($param);
        $ch->setSslVerifypeer(false);
        $response = $ch->exec();
//         dd($response);
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
//                 'X-CSRF-TOKEN: '. csrf_token(),// APIは除外済み(/oauth/*~)
//                 "Authorization: Bearer {$this->accessToken}",
        ];
        
        // Personal Access Client
//         $param = [
//                 "client_id"     => 1,
//                 "client_secret" => 'drxqbYYMjNP7g1oCeS3a5if0d0x3ykpvj4QFNzaA',
//                 "username"      => "redbull.816.com@gmail.com",
//                 "password"      => 'kuniyasu1983',
//                 "grant_type"    => "password",
//                 "scope"         =>  "*",
//         ];
        
        // Password Grant Client
        $param = [
                "client_id"     => 2,
                "client_secret" => 'dBqslMZWYQxrO2lWMqcoOMyAoYQdv67dcBWsu2du',
                "username"      => "redbull.816.com@gmail.com",
                "password"      => 'kuniyasu1983',
                "grant_type"    => "password",
                "scope"         =>  "*",
        ];
        
        // Code Grant Client
//         $param = [
//                 "client_id"     => 3,
//                 "client_secret" => 'qHTnzVh6QYDZfkGRC6h221Nxbt9HIL9U3UqUnAvC',
//                 "username"      => "redbull.816.com@gmail.com",
//                 "password"      => 'kuniyasu1983',
//                 "grant_type"    => "password",
//                 "scope"         =>  "*",
//         ];
        
        $result = $this->call($param, $header, $url);
        
        if( empty($result->access_token) ) return dd($result);;
        
        return $result;
    }
    
    /**
     * Setter...
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }
    
    /**
     * Getter...
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
    
}
