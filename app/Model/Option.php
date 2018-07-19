<?php
App::uses('AppModel', 'Model');
//App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class Option extends AppModel {
     var $name = 'Option';
    
   /* public $hasMany = array(
         'Exchange' => array(
            'className' => 'Exchange',
            'foreignKey' => 'exchange_id',
            ),
    );*/
    public $belongsTo = array(
         'Exchange' => array(
            'className' => 'Exchange',
            'foreignKey' => 'exchange_id',
            ),
    );
//    public $validate = array(
//        'username' => array(
//            'rule' => 'email',
//            'required' => true,
//            'allowEmpty' => false,
//            'message' => 'Invalid email'
//            ), 
//    );
//    
    public function beforeSave($options = array()) {
       if (isset($this->data[$this->alias]['api_key'])) {
            $key = Configure::read('Security.encryptKeyme');
            //$passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['api_key'] = Security::encrypt($this->data[$this->alias]['api_key'], $key);
        }
        if (isset($this->data[$this->alias]['api_secret'])) {
            $key = Configure::read('Security.encryptKeyme');
           //$passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['api_secret'] = Security::encrypt($this->data[$this->alias]['api_secret'], $key);
        }
        return true;
   }
    
    public function afterFind($results, $primary = false) {
        $ekey = Configure::read('Security.encryptKeyme');
        foreach ($results as $key => $val) {
            if (isset($val['Option']['api_key'])) {
                $results[$key]['Option']['api_key'] = Security::decrypt($val['Option']['api_key'], $ekey);
                $results[$key]['Option']['api_secret'] = Security::decrypt($val['Option']['api_secret'], $ekey);
            }
        }
        return $results;
    }
     
}
?>
