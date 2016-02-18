<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

	public function initialize(array $config)
    { 
        // $this->addBehavior('Translate', ['fields' => ['name','phone','email','country','city','state','address','zip'],
            // 'translationTable' => 'UsersI18n'
		// ]);
		
		/*  $this->belongsTo('UserDetails', [
            'className' => 'UserDetails',
            'foreignKey' => 'user_id',
			
        ]); */
		//$this->hasOne('UserDetails');
		//$this->belongsTo('UserDetails');
		$this->hasOne('UserDetails', ['dependent' => true]);
		$this->hasMany('UserExecutiveSummaries', ['dependent' => true]);
		$this->hasMany('UserMembers', ['dependent' => true]);
		$this->hasMany('UserFundingMaterials', ['dependent' => true]);
    }
	
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name', 'Name field is required.')
			->notEmpty('phone', 'Phone number field is required.')
            ->notEmpty('email', 'Email field is required.')
			
			->notEmpty('country', 'Country field is required.')
			->notEmpty('city', 'City field is required.')
			->notEmpty('state', 'State field is required.')
			->notEmpty('address', 'Address field is required.')
			->notEmpty('zip', 'Zip field is required.')
			
		 	->add('email', 'validFormat', [
			   'rule' => 'email',
			   'message' => 'E-mail must be valid'
			   ]);
			
        return $validator;
    }
	public function validationUpdate($validator)
    {
        $validator
		    ->notEmpty('name', 'Name field is required.')
			->notEmpty('phone', 'Phone number field is required.')
            ->notEmpty('email', 'Email field is required.')
			
			->notEmpty('country', 'Country field is required.')
			->notEmpty('city', 'City field is required.')
			->notEmpty('state', 'State field is required.')
			->notEmpty('address', 'Address field is required.')
			->notEmpty('zip', 'Zip field is required.')
			
			 
		    ->add('email', 'validFormat', [
			   'rule' => 'email',
			   'message' => 'E-mail must be valid'
			   ]);
           
        return $validator;
    }
	public $validate = array(
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Invalid email address',
                'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'email' => array(
                'rule'    => 'isUnique',
                'message' => 'Email already registered'
            ) 
);
}
?>