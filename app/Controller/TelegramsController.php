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
	public $uses = array('Update','Option','User');

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	
    
    public function index(){
         $line = readline("Command: ");
        $updates=$this->Update->find('all');
        readline_add_history($line);
        print_r(readline_info());
        
        $this->set(compact('updates'));
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
<p>Click <a href='{$basePath}spins/confirm_email/{$ref_id}'>here</a> to verify your E-mail or copy and paste the URL below into your browser to confirm your E-mail</p>
<p>{$basePath}spins/confirm_email/{$ref_id}</p>
HTML;

                    $subject='Email verification';
                    $this->sendMail($email,$subject,$message);
                    $this->Session->setFlash('Registration was successful. You need to confirm your e-mail to proceed. Please check your e-mail for further instructions. Be sure to check spam/junk folder if our e-mail is not  in inbox!','myflash',['params'=>['class' => 'flashsuccess message']]);
                    return $this->redirect(array('controller'=>'spins','action' => 'register'));
                }
                    $this->Session->setFlash('The user could not be saved. Please, try again. If the problem persists, please contact an FRG team member.','myflash',['params'=>['class' => 'flasherror message']]);
        
            } else{
                $this->Session->setFlash('We could not verify that you are human.','myflash',['params'=>['class' => 'flasherror message']]);
                
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
<p>Click <a href='{$basePath}spins/confirm_email/{$ref_id}'>here</a> to verify your E-mail or copy and paste the URL below into your browser to confirm your E-mail</p>
<p>{$basePath}spins/confirm_email/{$ref_id}</p>
HTML;
        $subject='Email verification';
        $this->sendMail($email,$subject,$message);
        $this->Session->setFlash('E-mail Resent. Please check your e-mail for further instructions. Be sure to check spam/junk folder if our e-mail is not  in inbox!','myflash',['params'=>['class' => 'flashsuccess message']]);
        return $this->redirect(array('controller'=>'spins','action' => 'login'));
        }else{
            $this->Session->setFlash('E-mail does not exist in our database!','myflash',['params'=>['class' => 'flasherror message']]);
        return $this->redirect(array('controller'=>'spins','action' => 'login'));
        }
        }else{
            $this->Session->setFlash('Invalid URL!','myflash',['params'=>['class' => 'flasherror message']]);
        return $this->redirect(array('controller'=>'spins','action' => 'login'));
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
            ->setFrom([G_UN => 'BitcoinSpinner Support'])
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
    
    public function fetch_order_book($exchange_name = NULL, $signal_symbol = NULL, $base_symbol = NULL){
         require APP . 'Vendor' . DS. 'ccxt'. DS. 'ccxt'. DS. 'ccxt.php';
        //https://www.cryptopia.co.nz/api/GetMarketOrders
        //$cryptopia_url = "https://www.cryptopia.co.nz/api/GetMarketOrders/".$signal_symbol."_".$base_symbol;
		//$response = file_get_contents($cryptopia_url);
		//$response = json_decode($response, true);
        //$buy_array = $response['Data']['Buy'];
        //$sell_array = $response['Data']['Sell'];
        //$this->set(compact('response','buy_array','sell_array'));
       // $buy_array);
        //$this->debug_print_2($sell_array);
        $exchange = '\\ccxt\\' . $exchange_name;
        $exchange = new $exchange ();
        $limit = 100;
        $this->debug_print_2($exchange->fetch_l2_order_book ($signal_symbol.'/'.$base_symbol, $limit));
    }
    
    private function debug_print_2($var1 =NULL){
        echo "<pre>";
        var_dump($var1);
        echo "</pre>";
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
}
