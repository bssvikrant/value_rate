<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
 
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */


class CmsPagesController extends AppController
{

  
	
	public $helpers = ['Form'];
	public $paginate = [
        'limit' => 25,
        'order' => [
            'Userss.email' => 'asc'
        ]
    ];
	
	//$this->loadComponent('Resize');
	public function initialize()
    {
        parent::initialize();
		$this->loadComponent('Paginator');
		/*if($this->request->prefix=='admin')
		{
			if(!$this->CheckAdminSession())
			{
				$this->redirect(array('controller'=>'Users','action' => 'login','admin' => true));
				exit();
			}
		}
		if (function_exists('ini_set')) 
		{
			ini_set('html_errors', false);
			ini_set('implicit_flush', true);
			ini_set('max_execution_time', 1000);
			ini_set('memory_limit', '-1');
		} */
       
    }
	/*function beforeFilter()
	{
		parent::beforeFilter();
		if($this->request->prefix=='admin')
		{
			if(!$this->CheckAdminSession())
			{
				$this->redirect(array('controller'=>'Users','action' => 'login','admin' => true));
				exit();
			}
		}
		if (function_exists('ini_set')) 
		{
			ini_set('html_errors', false);
			ini_set('implicit_flush', true);
			ini_set('max_execution_time', 1000);
			ini_set('memory_limit', '-1');
		} 
	}*/
	
	/**
	*	Function for Email template
	*/
	function EmailTemplates()
	{
		$this->viewBuilder()->layout('admin_dashboard');
	    // Loading model
		    	   
		$EmailTemplates = TableRegistry::get('EmailTemplate');
			    echo "<pre>";print_r($EmailTemplates);die;
		   // $templateTable = $EmailTemplates->newEntity();
		  $EmailTemplates = $EmailTemplates->find();
			 echo "<pre>";print_r($EmailTemplates);die;
			 
			$this->set('modelName','EmailTemplate');
		// set MessageTemplate Model
		//$this->set('modelName', 'EmailTemplate');
		//$conditions = array('EmailTemplate.status'=>1);
		
		//for searching 
		/*if(!empty($_GET['data']) && isset($_GET['data']))
		{
			$data = $_GET['data'];
			if(isset($data['EmailTemplate']['title']) && !empty($data['EmailTemplate']['title']))
			{
				$conditions = array_merge($conditions, array('EmailTemplate.title LIKE' => '%'.$data['EmailTemplate']['title'].'%'));		
			}
			if(isset($data['EmailTemplate']['subject']) && !empty($data['EmailTemplate']['subject']))
			{
				$conditions = array_merge($conditions, array('EmailTemplate.subject LIKE' => '%'.$data['EmailTemplate']['subject'].'%'));		
			}
			$this->paginate=array('limit'=>10, 'order'=>'EmailTemplate.id Asc','conditions' => $conditions);
			$emailTemplates = $this->paginate('EmailTemplate');
		}
		else
		{*/
			/*$this->paginate=array('limit'=>10, 'order'=>'EmailTemplate.id Asc','conditions' => $conditions);
			$emailTemplates = $this->paginate('EmailTemplate');*/
	  /* if(!empty($_GET['data']) && isset($_GET['data']))
	   {
			$data = $_GET['data'];
			$emailTemplates = $this->Paginator->paginate($emailTemplates,[
			   'conditions' => [
					'emailTemplates.subject LIKE' => '%'.$data['emailTemplates']['subject'].'%',
			   ],
			   'limit' => 10,
			   'order' => [
					'emailTemplates.id' => 'asc'
				]
			]);
		}
		else
		{*/
			/*$cmsPages = $this->Paginator->paginate($CmsPages,[ 'limit' => 200,
			   'order' => [
					'CmsPages.pagename' => 'asc'
				]
			]);*/
			$emailTemplates = $this->Paginator->paginate($emailTemplates,[ 'limit' => 10,
			   'order' => [
					'EmailTemplate.id' => 'asc'
				]
			]);
	    //}
		$this->set('emailTemplates',$emailTemplates);
	}
	/**
	*	Function for email template edit
	*/
	function admin_email_template_edit($id = null)
	{	
		$id=convert_uudecode(base64_decode($id));
		$this->layout = "admin_dashboard";
		
		// Loading model
		$this->loadModel('EmailTemplate');
		
		$this->EmailTemplate->id = $id;
		$this->set('emailTemp', $this->EmailTemplate->read());
		$error = '';
		if (!empty($this->data)) 
		{
			if(trim($this->data['EmailTemplate']['description'])!="")
			{
				if ($this->EmailTemplate->save($this->data)) 
				{
					$this->Session->write('success','Template has been updated');
					$this->redirect(array('action'=>'email_templates','controller'=>'cms_pages','admin' => true));
				}
			}
			else
			{
					$this->Session->write('error','Template was not updated.');
					$this->redirect(array('action'=>'email_templates','controller'=>'cms_pages','admin' => true));
			}
		}
	}
    /**
	* Admin function for faq listing
	*/
	function admin_faqs()
	{
		$this->layout = "admin_dashboard";
		//echo "ok";die;
		// load model FAQ
		$this->loadModel('Faq');
		
		// load set model name
		$this->set('modelName', 'Faq');
		$conditions = array();
		if(!empty($_GET['data']) && isset($_GET['data']))
		{
			$data = $_GET['data'];
			if(isset($data['Faq']['que']) && !empty($data['Faq']['que']))
			{
				$conditions = array_merge($conditions, array('Faq.que LIKE' => '%'.$data['Faq']['que'].'%'));		
			}
			/*if(isset($data['Faq']['type']) && !empty($data['Faq']['type']))
			{
				$conditions = array_merge($conditions, array('Faq.type' => $data['Faq']['type']));		
			}*/
			if(isset($data['Faq']['ans']) && $data['Faq']['ans']!='')
			{
				$conditions = array_merge($conditions, array('Faq.ans LIKE' => '%'.$data['Faq']['ans'].'%'));		
			}

			$this->paginate=array('limit'=>10, 'order'=>'Faq.date_added Asc','conditions' => $conditions);
			$faqs = $this->paginate('Faq');
		}
		else
		{
			$this->paginate = array('conditions' => $conditions, 'limit' => 10, 'order' => 'Faq.date_added ASC');
			$faqs = $this->paginate('Faq');
		}
		$this->set('faqs', $faqs);
	}
	
	/** 
	* Function for add FAQ
	*/
	function admin_add_faq()
	{
		$this->layout="admin_dashboard";
		
		// load model FAQ
		$this->loadModel('Faq');
		
		if(!empty($this->data))
		{   
		    $data = $this->data;
			$data['Faq']['ans'] = nl2br($data['Faq']['ans']);
			$data['Faq']['date_added'] = date('Y-m-d H:i:s');
			if($this->Faq->save($data))
			{
				$this->Session->write('success', "FAQ has been added successfully");
				$this->redirect(array('controller'=>'cms_pages','action'=>'faqs','admin'=>true));
			}
		}
	}
		
	/** 
	* Function for view FAQ
	*/		
	function admin_faq_view($faqId = NULL)
	{
		$this->layout="admin_dashboard";
		$faqId = convert_uudecode(base64_decode($faqId));
		
		// load model FAQ
		$this->loadModel('Faq');
		
		$getFaqInfo = $this->Faq->find('first', array(
			'conditions' => array(
				'Faq.id' => $faqId
			),
			'fields' => array(
				'que',
				'ans',
				
			)
		));
		$this->set('getFaqInfo', $getFaqInfo);
	}
	
	/**
	* Function for Faq edit
	*/
	function admin_faq_edit($faqId = NULL)
	{
		$this->layout="admin_dashboard";
		$faqId = convert_uudecode(base64_decode($faqId));
		
		// load model FAQ
		$this->loadModel('Faq');
		$faqInfo = $this->Faq->find('first', array(
			'conditions' => array(
				'Faq.id' => $faqId
			)
		));
		$this->set('faqInfo', $faqInfo);
		
		if(!empty($this->data) && isset($this->data))
		{
			$data = $this->data;
			$data['Faq']['id'] = $data['Faq']['id'];
			$data['Faq']['ans'] = nl2br($data['Faq']['ans']);
			$this->Faq->save($data);
			$this->Session->write('success', 'FAQ has been successfully edited');
			$this->redirect(array('controller' => 'cms_pages', 'action' => 'faqs', 'admin' => true));
		}
	}
	/*
	* Admin function to manage Static Info
	*/
	function admin_static_info()
	{
		$this->layout = 'admin_dashboard';
		
		//load model
		$this->loadModel('StaticInfo');
		
		// set StaticInfo Model
		$this->set('modelName', 'StaticInfo');
				
		$this->paginate = array('order' => 'StaticInfo.id asc', 'limit' => 10);
		$infos = $this->paginate('StaticInfo');
		$this->set('infos', $infos);
	}
	
	/*
	* Admin function to edit Static Info
	*/
	
	function admin_static_edit($id = NULL)
	{
		$this->layout = 'admin_dashboard';
		$id = convert_uudecode(base64_decode($id));
		
		//load model
		$this->loadModel('StaticInfo');
		
		$infos = $this->StaticInfo->findById($id);
		$this->set('infos', $infos);
		if (isset($this->data) && !empty($this->data))
		{
			$data = $this->data;
			$data['StaticInfo']['id'] = $infos['StaticInfo']['id'];
			if ($this->StaticInfo->save($data))
			{
				$this->Session->write('success', "Staic Information has been updated successfully");
				$this->redirect(array('controller'=>'cms_pages','action'=>'static_info','admin'=>true));	
			}
		}
	}

	/**
	* Function for CMS pages
	*/ 
	function admin_cms_pages()
    {
		$this->layout="admin_dashboard";
		
		// load CMSPAGE Model
		$this->loadModel('CmsPage');
		
		// set CMSPAGE Model
		$this->set('modelName', 'CmsPage');
		
		$conditions = array();
		
		//for searching 
		 if(!empty($_GET['data']) && isset($_GET['data']))
		 {
			$data = $_GET['data'];
			if(isset($data['CmsPage']['pagename']) && !empty($data['CmsPage']['pagename']))
			{
				$conditions = array_merge($conditions, array('CmsPage.pagename LIKE' => '%'.$data['CmsPage']['pagename'].'%'));		
			}
			
			$this->paginate=array('limit'=>10, 'order'=>'CmsPage.pagename Asc','conditions' => $conditions);
			$cmsPages = $this->paginate('CmsPage');
		 }
		else
		{
			$this->paginate=array('limit'=>10, 'order'=>'CmsPage.pagename Asc');
			$cmsPages = $this->paginate('CmsPage');
		}
		$this->set('cmsPages',$cmsPages);
	}

	
	/** 
	* Function to edit cms pages
	*/ 
	function admin_cmspages_edit($id=null)
	{
		$this->layout = "admin_dashboard";
		$id = convert_uudecode(base64_decode($id));
		
		// load CMSPAGE model
		$this->loadModel('CmsPage');
		
		$this->CmsPage->id = $id;
		$this->set('page',$this->CmsPage->read());
		if (!empty($this->data)) 
		{
			  $data=$this->data;
			  //prx($data);
			  if ($this->CmsPage->save($this->data)) 
			  {
				 $this->Session->write('success','CMS Page updated successfully');
				 $this->redirect(array('action'=>'cms_pages','controller'=>'cms_pages','admin' => true));
			  }
        }
	}

}