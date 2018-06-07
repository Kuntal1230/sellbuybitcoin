<?php


namespace Gupta\Blockchain;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Gupta\Blockchain\Exceptions\BlockchainException;
use Auth;
use Illuminate\Support\Str;

class Blockchain
{
	/**
     * An Instance of Client
     * @var Client
     */
    protected $client;
	
	/**
	* issued by blockchain
	* @var string
	*/
	protected $api_key;

	/**
	* issued by blockchain
	* @var string
	*/
	protected $guid;

	/**
	* issued by blockchain
	* @var string
	*/
	protected $password;
	
	/**
	* This is the miners fee
	* @var float
	*/
	protected $default_fee;
	
	/**
	* This is the base url for blockchain
	*/
	protected $base_url = 'https://blockchain.info/';
	/**
	* This is the localhost url for blockchain
	*/
	protected $local_url = 'http://127.0.0.1:3000';
	/**
	* This is the users transaction charge
	* @var float
	*/
	protected $trans_fee;

	/**
     *  Response from requests made to blockchain
     * @var mixed
     */
    protected $response;
	
	/**
	* 1BTC = 100000000;
	* @var  integer
	*/
	const SATOSHI = 100000000;

 	public function __construct() {
 		$this->setAPIKey();
		$this->setGuid();
		$this->setPassword(); 		
 		$this->setDefaultFee();
 		$this->setTransactionFee();
 		$this->setClientRequestOptions();
	 } 
	 /**
 	* get guid from config file called blockchain.php
 	*/
	 private function setGuid(){
		$this->guid = config('blockchain.blockchain_guid');
	 }

	 /**
 	* get password from config file called blockchain.php
 	*/
	 private function setPassword(){
		$this->password = config('blockchain.blockchain_password');
	 }

 	/**
 	* get api key from config file called blockchain.php
 	*/
 	private function setAPIKey() {
 		$this->api_key = config('blockchain.blockchain_api');
 	}
 	/**
 	* get default fee from config file called blockchain.php
 	*/
 	private function setDefaultFee() {
 		$this->default_fee = config('blockchain.defaultBTCFee');
 	}
 	/**
 	* get users transaction fee from config file called blockchain.php
 	*/
 	private function setTransactionFee() {
 		$this->trans_fee = config('blockchain.transactionBTCFee');
 	}

 	/**
     * Set options for making the Client request
     */
    private function setClientRequestOptions()
    {
        // $authBearer = 'Bearer '. $this->secretKey;

        $this->client = new Client(
            [
                'base_uri' => $this->base_url,
                // 'headers' => [
                //     // 'Authorization' => $authBearer,
                //     'Content-Type'  => 'application/json',
                //     'Accept'        => 'application/json'
                // ]
            ]
        );
    }
    /**
     * @param string $relative_url
     * @param string $method
     * @param array $body
     * @return 
     * @throws 
     */
    private function setResponse($relative_url, $method, $body = [])
    {	
    	if(count($body) == 0) {
    		$this->response = $this->client->request($method, $relative_url);
    	}else{
    		$this->response = $this->client->request($method, $relative_url, ["query" => $body]);
    	}
        return $this;
    }
    /**
    * @return This returns an array of currencies
    */
 	public function getRates() {
 		$response = $this->setResponse('/ticker', 'GET')->getResponse();
 		return $response;
 	}
 	/**
 	* @param string currency = usd
 	* @param integer 500
    * @return integer btc value
    * @throws BlochainException
    */
 	public function convertCurrencyToBTC(string $cur, int $value) {
 		if(strlen($cur) >3){
 			throw new BlockchainException;
 		}
 		$body = array(
 			'currency' => strtoupper($cur),
 			'value' => $value,
 		);
 		$response = $this->setResponse('/tobtc', 'GET', $body)->getResponse();
 		return $response;
 	}
 	
 	/**
 	* @return array
 	*/
 	public function getStats() {
 		$response = $this->setResponse('/stats', 'GET')->getResponse();
 		return $response;
 	}
 	/**
 	* This creates a wallet for the user
 	* @return array
 	* @param string randomly generated password
 	* @throws Exceptions
	 */
	 
 	public function createWallet($name, $email) {
 		//generate password
		$password = $this->password;
		//generate guid
		$guid = $this->guid;
 		//make api calls
        $params = array(
            'password' => $password,
			'api_code' => config('app.blockchain_api'),			
			'email' => $email,			
			'label' => $name,
			
			// 'email'=>'kuntal1230@gmail.com',
			// 'label' => 'gupta1230',
        );
        try {
        	$local_url = $this->local_url;
            $url = "$local_url/merchant/$guid/accounts/create?".http_build_query($params);
            $json_data = file_get_contents($url);
            $json_feed = json_decode($json_data, true);
            return $json_feed;
        } catch (\ErrorException $e) {
            throw new BlockchainException('Connection lost. Please try again');
        }
	 }
	 
	 public function getXpub()
	 {
		 //generate password
		$password = $this->password;
		//generate guid
		$guid = $this->guid;

		$params = array(
            'password' => $password,
		);
		$local_url = $this->local_url;
		$url = "$local_url/merchant/$guid/accounts/xpubs?".
            http_build_query($params);
        $json_data = file_get_contents($url);
		$json_feed = json_decode($json_data);
		return $json_feed;
	 }

	 public function getSingleAccount($xpubs)
	 {
		//generate password
		$password = $this->password;
		//generate guid
		$guid = $this->guid;

		$params = array(
            'password' => $password,
		);
		$local_url = $this->local_url;
		$url = "$local_url/merchant/$guid/accounts/$xpubs?".
            http_build_query($params);
        $json_data = file_get_contents($url);
		$json_feed = json_decode($json_data);
		return $json_feed;
	 }
 	/**
	  * /merchant/:guid/accounts/:xpub_or_index
	  * /merchant/:guid/accounts/xpubs
	  * /merchant/:guid/accounts/create
 	* @param string password 
 	* @param string integer
 	* @return integer in bitcoin
 	*/
 	public function getWalletBalance() {
		//generate password
		$password = $this->password;
		//generate guid
		$guid = $this->guid;

 		$params = array(
            'password' => $password,
        );
 		$local_url = $this->local_url;
        $url = "$local_url/merchant/$guid/balance?".
            http_build_query($params);
        $json_data = file_get_contents($url);
        $json_feed = json_decode($json_data);
        if($json_feed->balance == 0) {
            return $json_feed->balance;
		}
		// return $json_feed->balance;
        return bcdiv($json_feed->balance, '$this::SATOSHI', 8);
 	}
 	/**
 	* @param float amount
 	* @param string guid
 	* @param string password
 	* @param string to_address
 	* @param optional string from_address
 	* @return array of the result
 	*/
 	public function makeOutgoingPayment($amount,$to_address, $from_address) {
		 //generate password
		$password = $this->password;
		//generate guid
		$guid = $this->guid;
 		 //convert btc amount to satoshi by multiplying by 100000000
        $amount_satoshi = bcmul($this::SATOSHI, $amount, 8);
         //make api calls
        $params = array(
            'password' => $password,
            'to' => $to_address,
            'amount' => $amount_satoshi,
            'from' => $from_address
        );
        $local_url = $this->local_url;
        $url = "$local_url/merchant/$guid/payment?".http_build_query($params);
        $json_data = file_get_contents($url);
        $json_feed = json_decode($json_data, true);
    	return $json_feed;
 	}
 	/**
 	* @param string guid
 	* @param string password
 	* @return array of results
 	*/
 	public function listAddress() {

		 //generate password
		$password = $this->password;
		//generate guid
		$guid = $this->guid;

 		$local_url = $this->local_url;
 		$params = array(
            'password' => $password,
            // 'second_password ' => our second Blockchain Wallet password if double encryption is enabled,
        );
 		$url = "$local_url/merchant/$guid/accounts?".http_build_query($params);
        $json_data = file_get_contents($url);
        $json_feed = json_decode($json_data, true);
    	return $json_feed;
	 }
	//  http://localhost:3000/merchant/$guid/list?password=$main_password
 	/**
 	* generating a new address
 	* @param string password
 	* @param string guid
 	* @param string optional label
 	* @return array results
 	*/
 	public function createNewAddress($label = '') {
		 //generate password
		$password = $this->password;
		//generate guid
		$guid = $this->guid;

		 $local_url = $this->local_url;
		 
 		$params = array(
            'password' => $password,
            // 'second_password ' => our second Blockchain Wallet password if double encryption is enabled,
           	'label' => $label,
        );
 		$url = "$local_url/merchant/$guid/new_address?".http_build_query($params);
        $json_data = file_get_contents($url);
        $json_feed = json_decode($json_data, true);
    	return $json_feed;
 	}

 	/**
     * Get the whole response from a get operation
     * @return array
     */
    private function getResponse()
    {
        return json_decode($this->response->getBody(), true);
    }
}
