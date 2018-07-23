<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TelegramsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Update','Option','User','Exchange','Pump');

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	
    
    public function index(){
         //$line = readline("Command: ");
        //$updates=$this->Update->find('all');
       // readline_add_history($line);
        //print_r(readline_info());
        
        //$this->set(compact('updates'));
    }
    
    public function logout() {
        $this->autoRender = false;
        $this->Auth->logout();
        $this->redirect(array('controller' => 'telegrams', 'action' => 'login'));
        
	}
    
    public function register() {
        if(!empty($this->Auth->User('id'))){
            return $this->redirect(['controller'=>'telegrams','action'=>'dashboard']);
        }
        
        //$this->set();
        if ($this->request->is('post') && !empty($this->request->data)) {
             
            $exUser=$this->User->find('first',array('conditions'=>array('User.username'=>$this->request->data['User']['username'])));
            if(!empty($exUser)){
                 $this->Session->setFlash('Email is taken!','myflash',['params'=>['class' => 'flasherror message']]);
                return $this->redirect(array('controller'=>'telegrams','action' => 'register'));
            }
            if($this->request->data['User']['password'] != $this->request->data['cnfrm_password']){
                 $this->Session->setFlash('Passwords didnt match!','myflash',['params'=>['class' => 'flasherror message']]);
                return $this->redirect(array('controller'=>'telegrams','action' => 'register'));
            }
            if(!empty($_POST['g-recaptcha-response'])){
                $captcha = $this->recaptcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            }else{$captcha=true;}
            
            if($captcha){
            
                $this->User->create();
                $this->request->data['User']['usertype_id']=2;
                $this->request->data['User']['email_confirmed']=0;
                require_once(APP . 'Vendor' . DS. 'genpwd'. DS. 'genpwd.php');
                $this->request->data['User']['ref_id'] = genpwd();
            
                if ($this->User->save($this->request->data['User'])) {
                    $email=$this->request->data['User']['username'];
                    $ref_id=$this->request->data['User']['ref_id'];
                    $basePath = SITEPATH;
                    $message = <<<HTML
<p>Hi {$email}.</p>
<p>Click <a href='{$basePath}telegrams/confirm_email/{$ref_id}'>here</a> to verify your E-mail or copy and paste the URL below into your browser to confirm your E-mail</p>
<p>{$basePath}telegrams/confirm_email/{$ref_id}</p>
HTML;

                    $subject='Email verification';
                    $this->sendMail($email,$subject,$message);
                    $this->Session->setFlash('Registration was successful. You need to confirm your e-mail to proceed. Please check your e-mail for further instructions. Be sure to check spam/junk folder if our e-mail is not  in inbox!','myflash',['params'=>['class' => 'flashsuccess message']]);
                    return $this->redirect(array('controller'=>'telegrams','action' => 'register'));
                }
                    $this->Session->setFlash('The user could not be saved. Please, try again. If the problem persists, please contact an FRG team member.','myflash',['params'=>['class' => 'flasherror message']]);
        
            } else{
                $this->Session->setFlash('We could not verify that you are human.','myflash',['params'=>['class' => 'flasherror message']]);
                
            } 
        }
        
	}
    
    function confirm_email($ref_id=NULL) {
        $this->autoRender = false;
          if(isset($ref_id)){
              $userDetails=$this->User->find('first',array('conditions'=>array('User.ref_id'=>$ref_id)));
              if(!empty($userDetails)){
                  if($userDetails['User']['email_confirmed']==1){
                      $this->Session->setFlash('Your e-mail address has been confirmed, proceed to login.','myflash',['params'=>['class' => 'flasherror message']]);
                      
                    return $this->redirect(array('controller'=>'telegrams','action' => 'login'));
                  }
                  $this->User->updateAll(
                        array('User.email_confirmed' => 1),
                        array('User.id' => $userDetails['User']['id'])
                    );
                  $this->Session->setFlash("Your e-mail address has been confirmed, proceed to login.",'myflash',['params'=>['class' => 'flashsuccess message']]);
                  
                    return $this->redirect(array('controller'=>'telegrams','action' => 'login'));
              }else{
                  $this->Session->setFlash('Invalid confirmation link. It may have been expired. Please try again.','myflash',['params'=>['class' => 'flasherror message']]);
                  
                return $this->redirect(array('controller'=>'telegrams','action' => 'login'));
              }
                
          }else{
              $this->Session->setFlash('Invalid confirmation link. It may have been expired. Please try again.','myflash',['params'=>['class' => 'flasherror message']]);
                return $this->redirect(array('controller'=>'telegrams','action' => 'login'));
          }
        
    }
    
    public function login() {
        
       
        if(!empty($this->Auth->User('id'))){
            return $this->redirect(['controller'=>'telegrams','action'=>'dashboard']);
        }
        if ($this->request->is('post') && !empty($this->request->data)) {
            if(!empty($_POST['g-recaptcha-response'])){
                $captcha = $this->recaptcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            }else{$captcha=true;}
            if($captcha){
                if ($this->Auth->login()){
                    if($this->Auth->User('email_confirmed')==0){
                        $email = $this->Auth->User('username');
                        $this->Auth->logout();
                        $this->Session->setFlash('You have not confirmed your e-mail address. Check your e-mail for further instructions.','myflash',['params'=>['class' => 'flasherror message','resend'=>1,'email'=>$email]]);
                        return $this->redirect(['controller'=>'telegrams','action'=>'login']);
                    }
                    return $this->redirect(['controller'=>'telegrams','action'=>'dashboard']);
                }else{
                     $this->Session->setFlash('Invalid username or password, try again.','myflash',['params'=>['class' => 'flasherror message']]);
                    return $this->redirect(['controller'=>'telegrams','action'=>'login']);
            
                }
            }
                        
        }
	}
    
    public function resend_email_verification($email=NULL){
        $this->autoRender = false;
        if(!empty($email)){
            
        $user = $this->User->find('first',array('conditions'=>array('User.username'=>$email)));
        if(!empty($user)){
        $email= $user['User']['username'];
        $ref_id= $user['User']['ref_id'];
        $basePath = SITEPATH;
        $message = <<<HTML
<p>Hi {$email}.</p>
<p>Click <a href='{$basePath}telegrams/confirm_email/{$ref_id}'>here</a> to verify your E-mail or copy and paste the URL below into your browser to confirm your E-mail</p>
<p>{$basePath}telegrams/confirm_email/{$ref_id}</p>
HTML;
        $subject='Email verification';
        $this->sendMail($email,$subject,$message);
        $this->Session->setFlash('E-mail Resent. Please check your e-mail for further instructions. Be sure to check spam/junk folder if our e-mail is not  in inbox!','myflash',['params'=>['class' => 'flashsuccess message']]);
        return $this->redirect(array('controller'=>'telegrams','action' => 'login'));
        }else{
            $this->Session->setFlash('E-mail does not exist in our database!','myflash',['params'=>['class' => 'flasherror message']]);
        return $this->redirect(array('controller'=>'telegrams','action' => 'login'));
        }
        }else{
            $this->Session->setFlash('Invalid URL!','myflash',['params'=>['class' => 'flasherror message']]);
        return $this->redirect(array('controller'=>'telegrams','action' => 'login'));
        }
    }
    
    protected function recaptcha($response = NULL, $remoteadr=NULL){ 
        $this->autoRender = false;
        if(isset($response)){
            $captcha = $response;

            $postdata = http_build_query(
                array(
                    'secret'   => RC_SECRET,
                    'response' => $captcha,
                    'remoteip' => $remoteadr
                )
            );

            $options = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $context = stream_context_create($options);
            $result  = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context));

            return $result->success;
        }else{
            return false;
        }
    }
    
    protected function sendMail($recipient=NULL,$subject=NULL,$message=NULL,$name=''){ 
        // print_r(openssl_get_cert_locations());
        require APP . 'Vendor' . DS. 'autoload.php';
        
        $toEmailAddress = $recipient;
        $content = $message;

        $transporter = new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
        $transporter
            ->setUsername(G_UN)
            ->setPassword(G_PWD);

        $mailer = new Swift_Mailer($transporter);

        $message = new Swift_Message($subject);
        $message
            ->setFrom([G_UN => 'BitcoinThief Support'])
            ->setTo($toEmailAddress)
            ->setBody($content, 'text/html');

        $mailer->send($message);
         
    }
    
    public function madeline(){
        require APP . 'Vendor' . DS. 'autoload.php';
        $settings = [];
        $settings['app_info'] = [];
        $settings['app_info']['api_id'] = T_API_ID;
        $settings['app_info']['api_hash'] =  T_API_HASH;
        $MadelineProto = new \danog\MadelineProto\API('bot.madeline', $settings);
        $MadelineProto->settings = $settings;
        $MadelineProto->phone_login('+2347065212806');
        // $authorization = $MadelineProto->complete_phone_login(readline('Enter the phone code: '));
//        if ($authorization['_'] === 'account.password') {
//            $authorization = $MadelineProto->complete_2fa_login(readline('Please enter your password (hint '.$authorization['hint'].'): '));
//        }
        //$MadelineProto->start();
        //$MadelineProto->setWebhook('https://bitcointhief.app/receiver');
        //$MadelineProto->loop();
    } 
    
    
    public function complete_login(){
        $this->autoRender = false;
        require APP . 'Vendor' . DS. 'autoload.php';
        $settings = [];
        $settings['app_info'] = [];
        $settings['app_info']['api_id'] = T_API_ID;
        $settings['app_info']['api_hash'] =  T_API_HASH;
        $MadelineProto = new \danog\MadelineProto\API('bot.madeline', $settings);
        $MadelineProto->settings = $settings;
        $authorization = $MadelineProto->complete_phone_login('57321');
        $MadelineProto->setWebhook('https://bitcointhief.app/receiver');
        $MadelineProto->loop();
    }
    
     public function t_logout(){
        $this->autoRender = false;
        require APP . 'Vendor' . DS. 'autoload.php';
        $MadelineProto = new \danog\MadelineProto\API('bot.madeline');
        $MadelineProto->logout();
    }
    
    
    
    protected function fetch_order_book($exchange_name = NULL, $signal_symbol = NULL, $exchange = NULL ,$base_symbol = "BTC"){
        $this->autoRender = false;
        // require APP . 'Vendor' . DS. 'ccxt'. DS. 'ccxt'. DS. 'ccxt.php';
        //https://www.cryptopia.co.nz/api/GetMarketOrders
        //$cryptopia_url = "https://www.cryptopia.co.nz/api/GetMarketOrders/".$signal_symbol."_".$base_symbol;
		//$response = file_get_contents($cryptopia_url);
		//$response = json_decode($response, true);
        //$buy_array = $response['Data']['Buy'];
        //$sell_array = $response['Data']['Sell'];
        //$this->set(compact('response','buy_array','sell_array'));
       // $buy_array);
        //$this->debug_print_2($sell_array);
        //$exchange = '\\ccxt\\' . $exchange_name;
        //$exchange = new $exchange ();
        $limit = 200;
        try {
            $result = $exchange->fetch_l2_order_book ($signal_symbol.'/'.$base_symbol, $limit);
            return $result;
        } catch (Exception $e) {
                //$this->Session->setFlash($e->getMessage (),'myflash',['params'=>['class' => 'flasherror message']]);
            $this->log("User ID = Unknown; Error= ".$e->getMessage (), 'cryptopia_log');
        }
        
    }
    
    private function debug_print_2($var1 =NULL){
        echo "<pre>";
        var_dump($var1);
        echo "</pre>";
    }
    
    public function dashboard(){
        $user_id = $this->Auth->User('id');
        $this->Pump->contain(array('Option' => array('Exchange')));
        $active_pumps = $this->Pump->find('all',array('conditions'=>array('Pump.user_id'=>$user_id, 'OR'=>array('Pump.active'=>[1,2]))));
        $this->Pump->contain(array('Option' => array('Exchange')));
        $history_pumps = $this->Pump->find('all',array('conditions'=>array('Pump.user_id'=>$user_id, 'Pump.active'=>0)));
        $this->Pump->contain(array('Option' => array('Exchange')));
        $panic_pumps = $this->Pump->find('all',array('conditions'=>array('Pump.user_id'=>$user_id, 'Pump.active'=>4)));
        $this->Pump->contain(array('Option' => array('Exchange')));
        $cancelled_pumps = $this->Pump->find('all',array('conditions'=>array('Pump.user_id'=>$user_id, 'Pump.active'=>3)));
        //$this->debug_print_2($active_pumps );
        $options = $this->Option->find('all',array('conditions'=>array('Option.user_id'=>$user_id)));
        //$pumps = $this->Pump->find('all',array('conditions'=>array('Option.user_id'=>$user_id)));
        if ($this->request->is('post') && !empty($this->request->data)) {
            //$this->Option->find('all');
            $account_id = $this->request->data['account_id'];
            $signal_symbol = $this->request->data['signal'];
            $account = $this->Option->find('first',array('conditions'=>array('Option.id'=>$account_id)));
            //$this->debug_print_2($account);
            if(!empty($this->request->data['btc_amount'])){
                $btc_amount = $this->request->data['btc_amount'];
            }else{
                
                if(!empty($account['Option']['commit_amount'])){
                   $btc_amount = $account['Option']['commit_amount'];
                }else{
                    $this->Session->setFlash('No BTC amount specified!','myflash',['params'=>['class' => 'flasherror message']]);
                     return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
                }
            }

            $exchange_name = $account['Exchange']['exchange_name'];
            $api_key = $account['Option']['api_key'];
            $api_secret = $account['Option']['api_secret'];
            $this->pump_order($exchange_name,$signal_symbol,"buy",$user_id,$account_id,$btc_amount,$api_key,$api_secret);
        }
        $this->set(compact('options','active_pumps','history_pumps','panic_pumps','cancelled_pumps'));

    }
    
     public function account(){
         $user_id = $this->Auth->User('id');
         $exchanges = $this->Exchange->find('all');
         $options = $this->Option->find('all',array('conditions'=>array('Option.user_id'=>$user_id)));
         foreach($options as $key=>$option){
             $options[$key]["Option"]["balance"] = $this->fetch_balance($option,$user_id);
         }
        if ($this->request->is('post') && !empty($this->request->data)) {
            if(empty($this->request->data['Option']['exchange_id'])){
                $this->Session->setFlash('You must Select an exchange','myflash',['params'=>['class' => 'flasherror message']]);
                return $this->redirect(array('controller'=>'telegrams','action' => 'account'));
            }
            $this->request->data['Option']['user_id']=$user_id;
            $this->Option->create();
            if($this->Option->save($this->request->data['Option'])){
                $this->Session->setFlash('API details saved!','myflash',['params'=>['class' => 'flashsuccess message']]);
                return $this->redirect(array('controller'=>'telegrams','action' => 'account'));
            }
            $this->Session->setFlash('Something went wrong!','myflash',['params'=>['class' => 'flasherror message']]);
                return $this->redirect(array('controller'=>'telegrams','action' => 'account'));
        }
         $this->set(compact('exchanges','options'));
    }
    
    

    protected function pump_order($exchange_name = NULL, $signal_symbol = NULL, $order_type = NULL, $user_id = NULL, $account_id = NULL, $quantity = NULL, $api_key = NULL, $api_secret = NULL, $exchange = NULL, $price = NULL , $existing_order = NULL , $base_symbol = "BTC"){
        //$this->autoRender = false;
        if(!isset($exchange)){
            date_default_timezone_set ('UTC');
            require APP . 'Vendor' . DS. 'ccxt'. DS. 'ccxt'. DS. 'ccxt.php';
            $exchange = '\\ccxt\\' . $exchange_name;
            $exchange = new $exchange ();
        }
        $order_book = $this->fetch_order_book($exchange_name,$signal_symbol,$exchange,$base_symbol);
        $count_bids = count ($order_book['bids']);
        $count_asks = count ($order_book['asks']);
        $count_bids = $count_bids - 1;
        $count_asks = $count_asks - 1;
        
        
        //assign api key
        $exchange->apiKey = $api_key;
        $exchange->secret = $api_secret;
        
        
        
        //var_dump($count_asks,$count_bids,$exchange->has);
        
        if($order_type == "buy"){
            $order_price = $order_book['asks'][1][0];
            $order_price = $order_price/10;
            $quantity = $quantity/$order_price;  
            $tpair = $signal_symbol.'/'.$base_symbol;
            try{

                $main_order =$exchange->create_order ($tpair, 'limit', 'buy', $quantity,  $order_price);
                //save order id and pair in active database
                $pump_array = [];
                $pump_array['active'] = 1;
                $pump_array['buy_order_id'] =  $main_order['id'];
                $pump_array['pair'] = $tpair;
                $pump_array['signal_symb'] = $signal_symbol;
                $pump_array['user_id'] = $user_id;
                $pump_array['account_id'] = $account_id;
                $pump_array['quantity'] = $quantity;
                $pump_array['price'] = $order_price;

                $this->Pump->create();
                if($this->Pump->save($pump_array)){
                    $this->Session->setFlash('Order Placed!','myflash',['params'=>['class' => 'flashsuccess message']]);
                    return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
                }

            }catch(Exception $e){
                 $this->Session->setFlash($e->getMessage (),'myflash',['params'=>['class' => 'flasherror message']]);
                //return to dashboard
                return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
            }
        }elseif($order_type == "sell"){
            $order_price = $order_book['bids'][10][0];
            if(isset($price)){
                $order_price =$price ; 
            }

            //execute sell order
            try{
                $main_order =$exchange->create_order ($existing_order['pair'], 'limit', 'sell', $quantity,  $order_price);
                //save order id and pair in active database
                $existing_order['sell_order_id'] = $main_order['id'];
                //$this->Pump->save($existing_order);
                return $existing_order;
            }catch(Exception $e){
                 //$this->Session->setFlash($e->getMessage (),'myflash',['params'=>['class' => 'flasherror message']]);
                //return to dashboard
                 $this->log("User ID = ".$user_id." Error= ".$e->getMessage (), 'cryptopia_log');
            }
        }
        
    }
    

    
    
    public function order_checker(){
        //get open orders
        $this->autoRender = false;
        date_default_timezone_set ('UTC');
        require APP . 'Vendor' . DS. 'ccxt'. DS. 'ccxt'. DS. 'ccxt.php';
        $this->Pump->contain(array('Option' => array('Exchange')));
        $pumps = $this->Pump->find('all',array('conditions'=>array('OR'=>array('Pump.active'=>[1,2]))));
        //$this->debug_print_2($pumps);
        foreach($pumps as  $pump){
            $exchange_name = $pump['Option']['Exchange']['exchange_name'];
            $exchange = '\\ccxt\\' . $exchange_name;
            $exchange = new $exchange ();
            $api_key =  $pump['Option']['api_key'];
            $api_secret = $pump['Option']['api_secret'];
            $signal_symbol = $pump['Pump']['signal_symb'];
            $order_status  = $pump['Pump']['active'];
            $quantity = $pump['Pump']['quantity'];
            $existing_order = $pump['Pump'];
            $exchange->apiKey = $api_key;
            $exchange->secret = $api_secret;
            $user_id = $pump['Pump']['user_id'];
            try {
                $open_orders = $exchange->fetchOpenOrders();
                
            } catch (Exception $e) {
                //$this->Session->setFlash($e->getMessage (),'myflash',['params'=>['class' => 'flasherror message']]);
                $this->log("User ID = ".$user_id." Error= ".$e->getMessage (), 'cryptopia_log');
                continue;
            }
            //$this->debug_print_2($open_orders);
            if($order_status == 1){
                if(!in_array($pump['Pump']['buy_order_id'], array_column($open_orders, 'id'))) { 
                    $factor = $pump['Option']['profit_level'] / 100;
                    $factor = $factor + 1;
                    $price = $pump['Pump']['price'] * $factor;
                    $updated_order = $this->pump_order($exchange_name,$signal_symbol,"sell",NULL,NULL,$quantity,$api_key,$api_secret,$exchange,$price,$existing_order);
                    $updated_order['active'] = 2;
                    $this->Pump->save($updated_order);
                }
            }elseif($order_status == 2){
                if(!in_array($pump['Pump']['sell_order_id'], array_column($open_orders, 'id'))) { 
                    //echo "FOUND";
                    $pump['Pump']['active'] = 0;
                    $this->Pump->save($pump['Pump']);
                }
                
            }
            unset($exchange);
        }

        //$exchange = '\\ccxt\\' . $exchange_name;
        //$exchange = new $exchange ();
    }
    
    public function panic($pump_id = NULL){
        //get open orders
        $this->autoRender = false;
        $user_id = $this->Auth->User('id');
        date_default_timezone_set ('UTC');
        require APP . 'Vendor' . DS. 'ccxt'. DS. 'ccxt'. DS. 'ccxt.php';
        $this->Pump->contain(array('Option' => array('Exchange')));
        $pump = $this->Pump->find('first',array('conditions'=>array('Pump.id'=>$pump_id)));
        //$this->debug_print_2($pumps);
        $exchange_name = $pump['Option']['Exchange']['exchange_name'];
        $exchange = '\\ccxt\\' . $exchange_name;
        $exchange = new $exchange ();
        $api_key =  $pump['Option']['api_key'];
        $api_secret = $pump['Option']['api_secret'];
        $signal_symbol = $pump['Pump']['signal_symb'];
        $order_status  = $pump['Pump']['active'];
        $existing_order = $pump['Pump'];
        $quantity = $pump['Pump']['quantity'];
        $exchange->apiKey = $api_key;
        $exchange->secret = $api_secret;
        try {
             $open_orders = $exchange->fetchOpenOrders();
        } catch (Exception $e) {
            $this->Session->setFlash($e->getMessage (),'myflash',['params'=>['class' => 'flasherror message']]);
            return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
            //$this->log("User ID = Unknown; Error= ".$e->getMessage (), 'cryptopia_log');
        }
           
            //$this->debug_print_2($open_orders);
        if($order_status == 1){
            if(in_array($pump['Pump']['buy_order_id'], array_column($open_orders, 'id'))) { 
                //echo "FOUND";
                 try {
                        $exchange->cancel_order ($pump['Pump']['buy_order_id']);
                     $quantity = $this->compare_balance($exchange, $pump['Pump']['signal_symb']);
                     if($quantity > 0){
                         $updated_order = $this->pump_order($exchange_name,$signal_symbol,"sell",NULL,NULL,$quantity,$api_key,$api_secret,$exchange,NULL,$existing_order);
                         $updated_order['active'] = 4;
                         $this->Pump->save($updated_order);
                     }else{
                         $pump['Pump']['active'] = 3;
                        $this->Pump->save($pump['Pump']);
                     } 
                     $this->Session->setFlash('Panic Implemented!','myflash',['params'=>['class' => 'flashsucces message']]);
                    return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
                    } catch (Exception $e) {
                        $this->Session->setFlash($e->getMessage (),'myflash',['params'=>['class' => 'flasherror message']]);
                        return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
                        //$this->log("User ID = Unknown; Error= ".$e->getMessage (), 'cryptopia_log');
                    }
                
            }else{
                //sell immediately
                $updated_order = $this->pump_order($exchange_name,$signal_symbol,"sell",NULL,NULL,$quantity,$api_key,$api_secret,$exchange,NULL,$existing_order);
                $updated_order['active'] = 4;
                $this->Pump->save($updated_order);
                $this->Session->setFlash('Panic Implemented!','myflash',['params'=>['class' => 'flashsucces message']]);
                    return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
            }
        }elseif($order_status == 2){
            if(in_array($pump['Pump']['sell_order_id'], array_column($open_orders, 'id'))) { 
                //echo "FOUND";
                //cancel sell order;
                 try {
                     $exchange->cancel_order ($pump['Pump']['sell_order_id']);
                     //confirm balance;
                $quantity = $this->compare_balance($exchange, $pump['Pump']['signal_symb']);
                //sell immediately
                     if($quantity >0){
                         $updated_order = $this->pump_order($exchange_name,$signal_symbol,"sell",NULL,NULL,$quantity,$api_key,$api_secret,$exchange,NULL,$existing_order);
                         $updated_order['active'] = 4;
                        $this->Pump->save($updated_order);
                     }else{
                          $pump['Pump']['active'] = 0;
                        $this->Pump->save($pump['Pump']);
                     }
                     $this->Session->setFlash('Panic Implemented!','myflash',['params'=>['class' => 'flashsucces message']]);
                    return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
                 
                
                } catch (Exception $e) {
                    $this->Session->setFlash($e->getMessage (),'myflash',['params'=>['class' => 'flasherror message']]);
                    return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
                    //$this->log("User ID = Unknown; Error= ".$e->getMessage (), 'cryptopia_log');
                }

                
            }else{
                //do nothing
                $pump['Pump']['active'] = 0;
                $this->Pump->save($pump['Pump']);
                $this->Session->setFlash('Pump complete, too late to Panic!','myflash',['params'=>['class' => 'flashsucces message']]);
                return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
            }

        }
            //unset($exchange);

       
        //$exchange = '\\ccxt\\' . $exchange_name;
        //$exchange = new $exchange ();
    }

     protected function compare_balance($exchange = NULL, $symbol = NULL){
         //$this->autoRender = false;
        try {
            $balance_data = $exchange->fetch_balance ();
            $balance = $balance_data[$symbol]["free"];
            return $balance;

        } catch (Exception $e) {
            $this->Session->setFlash($e->getMessage (),'myflash',['params'=>['class' => 'flasherror message']]);
            return $this->redirect(array('controller'=>'telegrams','action' => 'dashboard'));
        }
        
    }
    

     protected function fetch_balance($option = NULL, $user_id = NULL, $base_symbol = "BTC"){
         //$this->autoRender = false;
        $api_key= $option['Option']['api_key'];
        $api_secret = $option['Option']['api_secret'];
        $exchange_name = $option['Exchange']['exchange_name'];
        $modified = $option['Option']['modified'];
        $modified = new DateTime($modified);
        $now = new DateTime('now');
         $days= $modified->diff(new DateTime('now'));
         $days=$days->format('%R%a');
        $current_balance = $option['Option']['available_balance'];
         
         if(isset ($current_balance) && $days<1){
              $btc_balance = $current_balance;
         }else{
            date_default_timezone_set ('UTC');
            require APP . 'Vendor' . DS. 'ccxt'. DS. 'ccxt'. DS. 'ccxt.php';
            $exchange = '\\ccxt\\' . $exchange_name;
            $exchange = new $exchange ();

            //assign api key
            $exchange->apiKey = $api_key;
            $exchange->secret = $api_secret;
             try {
                     $balance_data = $exchange->fetch_balance ();
                $btc_balance = $balance_data["BTC"]["free"];
                 $option['Option']['available_balance']=$btc_balance;
                 unset($option['Option']['modified']);
                 $this->Option->save($option['Option']);
                 return $btc_balance;
                } catch (Exception $e) {
                    $this->Option->delete($option['Option']['id']);
                 
                    $this->Session->setFlash($e->getMessage (),'myflash',['params'=>['class' => 'flasherror message']]);
                 return $this->redirect(array('controller'=>'telegrams','action' => 'account'));
                    
                }
           
             
             
         }


        
        //$this->debug_print_2($days);
         
       
        
    }
    
    
    
   
    
    public function text_ccxt(){
        require APP . 'Vendor' . DS. 'ccxt'. DS. 'ccxt'. DS. 'ccxt.php';
        var_dump (\ccxt\Exchange::$exchanges); 
        
        
    }
    
    public function save_options(){
        $this->autoRender = false;
        //require APP . 'Vendor' . DS. 'autoload.php';
//        $update_array = [];
//            $update_array['Option'] = [];           
//            $update_array['Option']['api_key'] = "fffffff";
//            $update_array['Option']['api_secret'] = "fffffff";
//            $update_array['Option']['user_id'] = 1;
//            $update_array['Option']['exchange_id'] = 1;
        $options = $this->Option->find("all");
         var_dump ( $options);
//            $this->Option->create();
//        
//           if ($this->Option->save($update_array)) {
//                  var_dump ( $update_array['Option']['exchange_id']);
//            }
        //var_dump ($ciphertext);
    }
    public function receiver(){
        $this->autoRender = false;
        //if ($this->request->is('post') && !empty($this->request->data)) {
            
            $update_array = [];
            $update_array['Update'] = [];
            $received = file_get_contents("php://input");
            $received = json_decode($received, true);
            if($received['_'] === "updateNewChannelMessage"  && $received['message']['to_id']['channel_id']=="1049295266"){
                $update_array['Update']['message'] =$received['message']['message'];
            }
            $update_array['Update']['message'] =$received['message']['message'];
            //$update_array['Update']['channel_post'] = $this->request->data['channel_post'];   
            //$this->Update->create();
           // if ($this->Update->save($update_array['Update'])) {
                   
            //}
        //}
    }
    
    public function resetpassword () {

        
        if ($this->request->is('post') && !empty($this->request->data)) {
            if(!empty($_POST['g-recaptcha-response'])){
            $captcha = $this->recaptcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            }else{$captcha=true;}
            if($captcha){
            $email=$this->request->data['email'];
            $userDetails = $this->User->find('first',array('conditions'=>array('User.username'=>$email)));
            if(!empty($userDetails)){
                $user_id = $userDetails['User']['id'];
                require_once(APP . 'Vendor' . DS. 'genpwd'. DS. 'genpwd.php');
                $resetkey= genpwd(30);
                $db = $this->User->getDataSource();
                    $resetkey1 = $db->value($resetkey, 'string');
                     $this->User->updateAll(
                        array('User.reset_password' => $resetkey1),
                        array('User.id' => $user_id)
                    );
                $subject = "Reset Password";
                $basePath = SITEPATH;
                $message = <<<HTML
<p>Hi,</p>
<p>Click <a href='{$basePath}telegrams/new_password/{$user_id}/{$resetkey}'>here</a> to reset your password.</p>
<p>Or copy and paste the URL below into your browser window.</p>
<p>{$basePath}telegrams/new_password/{$user_id}/{$resetkey}</p>
HTML;

                $this->sendMail($email, $subject, $message);
                $this->Session->setFlash("We've sent an e-mail with instructions on how to reset your password. Be sure to check spam/junk folder if our e-mail is not  in inbox!",'myflash',['params'=>['class' => 'flashsuccess message']]);
                return $this->redirect(['controller'=>'telegrams','action'=>'resetpassword']);
                
            }else{
                
                $this->Session->setFlash('Oops! The e-mail address you supplied is not registered.','myflash',['params'=>['class' => 'flasherror message']]);
            }
        }else{
                $this->Session->setFlash('Oops! We could not verify that you are human.','myflash',['params'=>['class' => 'flasherror message']]);
                return $this->redirect(['controller'=>'telegrams','action'=>'resetpassword']);
            } }
        
        //$this->set(compact('days','result'));
	}
}
