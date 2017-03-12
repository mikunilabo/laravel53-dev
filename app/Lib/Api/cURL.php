<?php

namespace App\Lib\Api;

/**
 * cURLライブラリ...
 * 
 * @author Shinohara
 */
class cURL
{
    /**
     * curlインスタンス
     * 
     */
    private $ch;
    
    /**
     * 送信するパラメータ
     * 
     */
    private $parameter = array();
    
    /**
     * 送信方法
     * 
     */
    private $method = 'GET';
    
    /**
     * JSON形式で送るか?
     *
     */
    private $isJson = false;
    
    /**
     * クエリビルドするかどうか
     */
    private $isBuildQuery = true;
    
    /**
     * 接続先
     * 
     */
    private $url;

    /**
     * ユーザーエージェント
     *
     */
    private $user_agent;
    
    /**
     * BASIC認証情報
     *
     */
    private $userpwd;
    
    /**
     * curl_exec時に返り値を受け取るか？
     * 
     */
    private $return_transfer = true;
    
    /**
     * SSLの検証を行うか？
     * 
     */
    private $ssl_verifypeer = true;
    
    /**
     * curl_exec実行時のエラーメッセージ
     * 
     */
    private $error_message;
    
    /**
     * コンストラクタ...
     */
    public function __construct()
    {
    }
    
    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setIsJson($isJson)
    {
        $this->isJson = $isJson;
    }
    
    public function getIsJson()
    {
        return $this->isJson;
    }
    
    public function setIsBuildQuery($isBuildQuery)
    {
        $this->isBuildQuery = $isBuildQuery;
    }
    
    public function getIsBuildQuery()
    {
        return $this->isBuildQuery;
    }
    
    public function setUserAgent($user_agent)
    {
        $this->user_agent = $user_agent;
    }
    
    public function setHeader($header)
    {
        $this->header = $header;
    }
    
    public function setUserPwd($user, $pwd)
    {
        $this->userpwd = $user. ':'. $pwd;
    }
    
    public function setMethod($method) 
    {
        $this->method = $method;
    }
    
    public function setReturnTransfer($return_transfer) 
    {
        $this->return_transfer = $return_transfer;
    }
    
    public function setParameterFromArray($parameter)
    {
        $this->parameter = $parameter;
    }
    
    public function setParameter($key, $value)
    {
        $this->parameter[$key] = $value;
    }
    
    public function getParameter($key)
    {
        return $this->parameter[$key];
    }
    
    public function setSslVerifypeer($ssl_verifypeer)
    {
        $this->ssl_verifypeer = $ssl_verifypeer;
    }
    
    public function exec()
    {
        try {
            $this->init();
            
            if(isset($this->user_agent))
                curl_setopt($this->ch, CURLOPT_USERAGENT, $this->user_agent);
            
            if(isset($this->userpwd))
                curl_setopt($this->ch, CURLOPT_USERPWD, $this->userpwd);
            
            if(isset($this->header))
                curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->header);
                
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, $this->return_transfer);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer);
                
            switch($this->method) {
                
                case 'POST':
                    if($this->isJson === true)
                        $this->parameter = json_encode($this->parameter);
                    elseif($this->isBuildQuery === true)
                        $this->parameter = http_build_query($this->parameter);
                    
                    curl_setopt($this->ch, CURLOPT_POST, true);
                    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->parameter);
                    break;
                    
                case 'PUT':
                    if($this->isJson === true)
                        $this->parameter = json_encode($this->parameter);
                    elseif($this->isBuildQuery === true)
                        $this->parameter = http_build_query($this->parameter);
                    
                    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST , 'PUT');
                    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->parameter);
                    break;
                    
                case 'PATCH':
                    if($this->isJson === true)
                        $this->parameter = json_encode($this->parameter);
                    elseif($this->isBuildQuery === true)
                        $this->parameter = http_build_query($this->parameter);
                            
                    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST , 'PATCH');
                    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->parameter);
                    break;
                    
                case 'DELETE':
                    if($this->isJson === true)
                        $this->parameter = json_encode($this->parameter);
                    elseif($this->isBuildQuery === true)
                        $this->parameter = http_build_query($this->parameter);
                            
                    curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST , 'DELETE');// DELETEの場合はHTTPメソッド名を直接指定する必要があるかもしれない...
                    curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->parameter);
                    break;
                
                case 'GET':
                    curl_setopt($this->ch, CURLOPT_HTTPGET, true);
                    $this->setUrl($this->url . '?' . http_build_query($this->parameter)); 
                    break;
                
                default:
                    curl_setopt($this->ch, CURLOPT_HTTPGET, true);
                    $this->setUrl($this->url . '?' . http_build_query($this->parameter)); 
            }
            
            curl_setopt($this->ch, CURLOPT_URL, $this->url);
            
            return curl_exec($this->ch);
            
        } catch (\Exception $e) {
            $this->error_message = $e->getMessage();
        }
        
        return null;
    }
    
    public function getErrorMessage() 
    {
        return $this->error_message;
    }
    
    public function getInfo() 
    {
        return curl_getinfo($this->ch);
    }
    
    public function init() 
    {
        $this->ch = curl_init();
    }
    
    public function close() 
    {
        curl_close($this->ch);
        
    }
    
    public function reset() 
    {
        curl_reset($this->ch);
    }
}
