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
	public $uses = array('Update');

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
    
    public function madeline(){
        require APP . 'Vendor' . DS. 'autoload.php';
        $MadelineProto = new \danog\MadelineProto\API('bot.madeline');
        $MadelineProto->start();
        $MadelineProto->setWebhook('https://bitcointhief.app/receiver');
        $MadelineProto->loop();
    } 
    
    
    public function logout(){
        $this->autoRender = false;
        //require APP . 'Vendor' . DS. 'autoload.php';
        //$MadelineProto = new \danog\MadelineProto\API('bot.madeline');
       // $MadelineProto->logout();
    }
    
    
    
    public function receiver(){
        $this->autoRender = false;
        //if ($this->request->is('post') && !empty($this->request->data)) {
            
            $update_array = [];
            $update_array['Update'] = [];
            $update_array['Update']['message'] = file_get_contents("php://input");
            //$update_array['Update']['channel_post'] = $this->request->data['channel_post'];   
            $this->Update->create();
            if ($this->Update->save($update_array['Update'])) {
                   
            }
        //}
    }
}