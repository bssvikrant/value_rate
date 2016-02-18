<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserBlogsTable extends Table
{
	public function initialize(array $config)
    { 

    }
	
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('title', 'title field is required.')
			->notEmpty('blog', 'blog field is required.')           
            ->add('linkedin_url', 'valid', ['rule' => 'url', 'message' => 'Linked In Url must be valid']);
        return $validator;
    }
	

}
?>