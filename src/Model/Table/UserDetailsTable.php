<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserDetailsTable extends Table
{

	public function initialize(array $config)
    { 
		//$this->belongsTo('Users');
    }
	public function validationDefault(Validator $validator)
    {
        $validator
           ->notEmpty('company_name', 'Company Name is required.')
            ->notEmpty('website', 'Website Url is required.')
            ->notEmpty('company_summary', 'Company Summary is required.')
            ->notEmpty('date_found', 'Date Found is required.')
            ->notEmpty('brief_des', 'Brief Description is required.');
        return $validator;
    }
	

}
?>