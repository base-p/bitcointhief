<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
     public $components = array(
         //'DebugKit.Toolbar',
         'Cookie','Session',
         'Flash',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'telegrams',
                'action' => 'dashboard'
            ),
            'logoutRedirect' => array(
                'controller' => 'telegrams',
                'action' => 'login'
            ),
            'loginAction' => array(
                'controller' => 'telegrams',
                'action' => 'login',
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'fields'=>['username'=>'username',
                    'password'=>'password']
                )
            ),
        )
    );
  
    
    public function beforeFilter() {
       // parent::beforeFilter();  
       $this->Cookie->name = 'userdet';
       $this->Cookie->time = 3600; // or '1 hour'
        $this->Cookie->key = Configure::read('Security.cookieKey');
//       $this->Cookie->httpOnly = true;
       $this->Cookie->type('aes');
        $this->Auth->allow('index','resetpassword','logout','register','login','admin_index','regadmin','confirm_email','checkEmail','recaptcha','sendMail','get_rates','faq','confirm2fa','new_password','save_options','order_checker','resend_email_verification','fetch_order_book','pump_order');
    }
}
