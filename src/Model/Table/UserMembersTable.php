<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserMembersTable extends Table
{

	public function initialize(array $config)
    { 

    }
	
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name', 'Name field is required.')
			->notEmpty('position', 'Position field is required.')
            ->notEmpty('linkedin_url', 'Linked In Url field is required.')
            ->notEmpty('experience', 'Experience field is required.')
            ->add('linkedin_url', 'valid', ['rule' => 'url', 'message' => 'Linked In Url must be valid']);
        return $validator;
    }
	

}
?>