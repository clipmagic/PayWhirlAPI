<?php
/**
 * PayWhirl API PHP Library
 *
 * Use this library to interface with PayWhirl's API
 * https://api.paywhirl.com
 *
 *  Example Usage:
 *  =========================
 *  $payWhirl = new \PayWhirl\PayWhirl($api_key,$api_secret);
 *  $customer = $payWhirl->getCustomer($customer_id);
 *
 */

namespace PayWhirl;

class PayWhirl{


 	// @var string The PayWhirl API key and secret to be used for requests.
    protected $_api_key;
    protected $_api_secret;

    // @var string The base URL for the PayWhirl API.
    protected $_api_base = 'https://api.paywhirl.com';

    /**
     * Prepare to make request
     * @param string $api_key    Your Paywhirl API Key
     * @param string $api_secret Your PayWhirl API Secret
     */
    function __construct($api_key,$api_secret,$api_base=false){
  		//set API key and secret
    	$this->_api_key = $api_key;
    	$this->_api_secret = $api_secret;

        if($api_base){
            $this->_api_base = $api_base;
        }
        
    }

    /**
     * Get a list of customers
     * @return Customer Array of Objects
     */
    public function getCustomers($data){
        return $this->get('/customers',$data);
    }

    /**
     * Get a customer
     * @param  int $id Customer ID
     * @return Customer Object
     */
    public function getCustomer($id){
        return $this->get('/customer/'.$id);
    }

     /**
     * Create a customer
     * @param  int $data Customer data
     * @return Customer Object
     */
    public function createCustomer($data){
        return  $this->post('/create/customer',$data);
 
    }

    /**
     * Create a customer
     * @param  int $data Customer data
     * @return Customer Object
     */
    public function updateCustomer($data){
        return $this->post('/update/customer',$data);
    }

    /**
     * Update a customer's answer toa profile questions
     * @param  int $data Answer data
     * @return Answer Object
     */
    public function updateAnswer($data){
        return $this->post('/update/answer',$data);
    }


    /**
     * Get a list of profile questions
     * @return Questions Array of Objects
     */
    public function getQuestions($data){
        return $this->get('/questions',$data);
    }

    /**
     * Get a answers to a customer's questions
     * @return Answer Array of Objects
     */
    public function getAnswers($data){
        return $this->get('/answers',$data);
    }

    /**
     * Get a list of plans
     * @return Plan Array of Objects
     */
    public function getPlans($data){
        return $this->get('/plans',$data);
    }

    /**
     * Get a plan
     * @param  int $id Plan ID
     * @return Plan Object
     */
    public function getPlan($id){
        return $this->get('/plan/'.$id);
    }

    /**
     * Create a plan
     * @param  int $data Plan data
     * @return Plan Object
     */
    public function createPlan($data){
        return $this->post('/create/plan',$data);
    }

    /**
     * Update a plan
     * @param  int $data Plan data
     * @return Plan Object
     */
    public function updatePlan($data){
        return $this->post('/update/plan',$data);
    }


    /**
     * Get a list of subscriptions for a customer
     * @param  int $id Customer ID
     * @return Subscription List Object
     */
    public function getSubscriptions($id){
        return $this->get('/subscriptions/'.$id);
    }

    /**
     * Get a subscription
     * @param  int $id Subscription ID
     * @return Subscription Object
     */
    public function getSubscription($id){
        return $this->get('/subscription/'.$id);
    }

     /**
     * Get a list of active subscribers
     * @param  array $data Array of options
     * @return Subscribers List
     */
    public function getSubscribers($data){
        return $this->get('/subscribers',$data);
    }


    /**
     * Subscribe a customer to a plan
     * @param  int $id Subscription ID
     * @return Subscription Object
     */
    public function subscribeCustomer($customer_id,$plan_id,$trial_end=false){
        $data = array(
            'customer_id' => $customer_id,
            'plan_id' => $plan_id
        );
        if($trial_end){
            $data['trial_end'] = $trial_end;
        }
        return $this->post('/subscribe/customer',$data);
    }

     /**
     * Subscribe a customer to a plan
     * @param  int $id Subscription ID
     * @return Subscription Object
     */
    public function updateSubscription($subscription_id,$plan_id){
        $data = array(
            'subscription_id' => $subscription_id,
            'plan_id' => $plan_id
        );
        return $this->post('/update/subscription',$data);
    }

     /**
     * Unsubscribe a Customer
     * @param  int $id Subscription ID
     * @return Subscription Object
     */
    public function unsubscribeCustomer($subscription_id){
        $data = array(
            'subscription_id' => $subscription_id,
        );
        return $this->post('/unsubscribe/customer',$data);
    }


    /**
     * Get a invoice
     * @param  int $id Invoice ID
     * @return Invoice Object
     */
    public function getInvoice($id){
        return $this->get('/invoice/'.$id);
    }

    /**
     * Get a list of upcoming invoices for a customer
     * @param  int $id Customer ID
     * @return Invoices Object
     */
    public function getInvoices($id){
        return $this->get('/invoices/'.$id);
    }

    /**
     * Get a list of payment gateways
     * @return Gateways Collection
     */
    public function getGateways(){
        return $this->get('/gateways');
    }


    /**
     * Get a payment gateway
     * @param  int $id Gateway ID
     * @return Gateway Object
     */
    public function getGateway($id){
        return $this->get('/gateway/'.$id);
    }

     /**
     * Create an invoice with a single charge
     * @param  array $data  data
     * @return Plan Object
     */
    public function createCharge($data){
        return $this->post('/create/charge',$data);
    }

    /**
     * Get a charge
     * @param  int $id Charge ID
     * @return Charge Object
     */
    public function getCharge($id){
        return $this->get('/charge/'.$id);
    }

    /**
     * Get a card
     * @param  int $id Card ID
     * @return Gateway Object
     */
    public function getCard($id){
        return $this->get('/card/'.$id);
    }

    /**
     * Get a customer's cards
     * @param  int $id Customer ID
     * @return Card List Object
     */
    public function getCards($id){
      return $this->get('/cards/'.$id);
    }

    /**
     * Create a card
     * @param  array $data Card Data
     * @return Card Object
     */
    public function createCard($data){
        return $this->post('/create/card',$data);
    }

    /**
     * Delete a card
     * @param  int $id Card ID
     * @return boolean
     */
    public function deleteCard($id){
        $data['id'] = $id;
        return $this->post('/delete/card',$data);
    }


    /**
     * Get a promo code
     * @param  int $id Promo Code ID
     * @return Promo Code Object
     */
    public function getPromo($id){
        return $this->get('/promo/'.$id);
    }

    /**
     * Get an email template
     * @param  int $id Email Template ID
     * @return Email Template Object
     */
    public function getEmailTemplate($id){
        return $this->get('/email/'.$id);
    }

    /**
     * Get authenticated account's information
     * @return PayWhirl account object
     */
    public function getAccount(){
        return $this->get('/account');
    }

     /**
     * Get authenticated account's stats
     * @return PayWhirl account object
     */
    public function getStats(){
        return $this->get('/stats');
    }

    /**
     * Get a shipping rule
     * @param  int $id Shipping Rule ID
     * @return Shipping Rule Object
     */
    public function getShippingRule($id){
        return $this->get('/shipping/'.$id);
    }

    /**
     * Get a tax rule
     * @param  int $id Tax Rule ID
     * @return Tax Rule Object
     */
    public function getTaxRule($id){
        return $this->get('/tax/'.$id);
    }

     /**
     * Get MultiAuth token
     * @param  array $data Options
     * @return boolean
     */
    public function getMultiAuthToken($data){
        return $this->post('/multiauth',$data);
    }

    /**
    * Send POST request
    */
    public function post($endpoint,$params=array()){

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_HTTPHEADER,array('api_key: '.$this->_api_key ,'api_secret: '.$this->_api_secret));
        curl_setopt($ch, CURLOPT_URL,$this->_api_base.$endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

         curl_setopt($ch, CURLOPT_POSTFIELDS, 
         http_build_query($params));
        // receive server response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);

        curl_close ($ch);
        return json_decode($server_output);
    }
     /**
    * Send GET request
    */
    public function get($endpoint,$params=array()){
        $ch = curl_init(); 
        curl_setopt($ch,CURLOPT_HTTPHEADER,array('api_key: '.$this->_api_key ,'api_secret: '.$this->_api_secret));
        $query = http_build_query($params);
        curl_setopt($ch,CURLOPT_URL,$this->_api_base.$endpoint.'?'.$query);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $output=curl_exec($ch);

        curl_close($ch);
        return json_decode($output);
    }



}