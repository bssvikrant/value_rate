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
//use Cake\I18n\I18n;
use Cake\Network\Email\Email;
use Cake\Routing\Router;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */

class HomeController extends AppController
{
	public $helpers = ['Form'];
	
	public function initialize()
    {	//echo base64_encode(convert_uuencode(76)); die;
		
		$session = $this->request->session();
		$userId = 	$session->read('User');
		$userId = $userId['id'];
        parent::initialize();
		
		// check user session
		
		if(!$this->CheckUserSession() && !in_array($this->request->action,array('login','forgotPassword','publicProfile')))
		{
			
			return $this->redirect(['controller' => 'Home', 'action' => 'login']);
			//exit();
		}
		else if($this->CheckUserSession() && ($this->request->action == 'login' || $this->request->action=="forgotPassword"))
		{
			return $this->redirect(['controller' => 'Home', 'action' => 'public-profile',$userId]);
		}
		//die("ola end");		
		//GET LOCALE VALUE
		/*$session = $this->request->session();
		$setRequestedLanguageLocale  = $session->read('setRequestedLanguageLocale'); 
		I18n::locale($setRequestedLanguageLocale);
		*/
	}
	
	/**
	* Function to check user session
	*/
	function CheckUserSession()
	{
		$session = $this->request->session();
		$UserData  = $session->read('User');
		
		if(isset($UserData['id']) && isset($UserData['email']))
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	/**
	* Function of user login
	*/
	function login()
	{
		$this->viewBuilder()->layout('home');
		
		// Loaded User Model
		$UsersModel = TableRegistry::get('Users');
		$sUserData = $UsersModel->newEntity();

		if (isset($this->request->data) && !empty($this->request->data))
		{
			
			if($this->request->data['email']!="" && $this->request->data['password']!="")
		    {   
				
				$session = $this->request->session();
				$email = trim($this->request->data['email']);
				$password = md5(trim($this->request->data['password']));
				$getValidUserData = $UsersModel->find('all')->where(['Users.email' => $email, 'Users.password' => $password, 'Users.status' => 1])->toArray();
				
				if(count($getValidUserData))
				{	$getValidUserData = $getValidUserData[0];
					$sUserData->id = $getValidUserData->id;
					$sUserData->last_login = date('Y-m-d h:i:s');
					$UsersModel->save($sUserData);
					
					$session->write('User.id', $getValidUserData->id);
					$session->write('User.name', $getValidUserData->name);
					$session->write('User.email', $getValidUserData->email);
					$session->write('User.date_added', $getValidUserData->date_added);
					$session->write('User.last_login', $getValidUserData->last_login);
					$session->write('User.status', $getValidUserData->status);
					$session->write('User.type', $getValidUserData->type);
					
					return $this->redirect(['controller' => 'Home', 'action' => 'public-profile']);
					//return $this->redirect(['controller' => 'Home', 'action' => 'public-profile',$getValidUserData->id]);
				}
		    }
		     
            $this->set('error',AUTHENTICATION_FAILED);		 	
		} 
	}
	/*
	*@vik public profile
	*/
	function publicProfile($userId=NULL){
		
		$this->viewBuilder()->layout('home');
		$session = $this->request->session();
		
		$userId = convert_uudecode(base64_decode($userId));
		if($userId==NULL){	
			$userId = 	$session->read('User');
			$userId = $userId['id'];
		}		
		  $userInfo='';
		if($userId){ 
			$UsersModel = TableRegistry::get('Users');
			$userCount = $UsersModel->find('all')->where(["id"=>$userId])->count();
			
			if($userCount){
				$userInfo = $UsersModel->get($userId, [ 'contain' => ['UserDetails','UserMembers','UserExecutiveSummaries','UserFundingMaterials']])->toArray();
				$this->set('userInfo',$userInfo);
				$this->set('dataCheck','datafound');
			    $this->set('investmentId',$userId);
			}else{
				$this->set('dataCheck','datanotfound');
			}
			
		}else{ 
			//$this->set('dataCheck','datanotfound');
			return $this->redirect(['controller' => 'Home', 'action' => 'login']);
		}
	}
	/**
	Function for admin change password
	*/
	function changePassword($id = NULL){
		$this->viewBuilder()->layout('admin_dashboard');

		// Loaded Admin Model
		$AdminsModel = TableRegistry::get('Admins');
		
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  $AdminsModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		$Adminid = convert_uudecode(base64_decode($id));
		
		if(isset($this->request->data) && !empty($this->request->data)){
			$AdminData = $AdminsModel->newEntity($this->request->data['Admin']);
			$data=$this->request->data;
			if($data['Admin']['password'] != $data['Admin']['confirm_password']){
				 $this->displayErrorMessage('Your password and confirmation password do not match.');
				$this->redirect($this->referer());
			}else{

				
				$AdminData->id =  $session->read('Admin.id');
				
				$AdminData->password = md5($data['Admin']['password']);
				
				if($AdminsModel->save($AdminData)){
					
					$replace = array('{name}','{password}');
					$with = array($session->read('Admin.full_name'),$data['Admin']['password']);
					$this->send_email('',$replace,$with,'admin_change_password',$session->read('Admin.email'));
					$this->displaySuccessMessage('Your password have been updated Successfully!.');
					$this->redirect($this->referer());
				}else{
					$this->displayErrorMessage('Error Found, Kindly try later!.');
					$this->redirect($this->referer());
				}
			}
		}
	}
	/**Function for forgot password
	*/
	function forgotPassword(){
		$this->viewBuilder()->layout('home');
		// Loaded Admin Model
		$usersModel = TableRegistry::get('Users');
		//CODE FOR MULTILIGUAL START
		  //$session = $this->request->session();
		  //$usersModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		$userData = $usersModel->newEntity();
		

		if(isset($this->request->data['email']) && !empty($this->request->data['email'])){
			$data=$this->request->data;	
			$user = $usersModel->find('all',['conditions' => ['Users.email' => $data['email']]]);
			$getUserData =  $user->first();

			if(empty($getUserData)){
			   $this->set("error","Email id not register with us, try again");
			}else{
				$new_password = $this->RandomStringGenerator(8);
				$update_password = md5($new_password);
				$userData->id = $getUserData->id;
				$userData->password = $update_password;
				$userData->org_password = $new_password;
				//save adnin data		
				if($usersModel->save($userData)){
					$replace = array('{fname}','{password}','{email}','{link}');
					$link = HTTP_ROOT."home/login";
					$with = array($getUserData->name,$new_password,$getUserData->email,$link);
					$this->send_email('',$replace,$with,'forgot_password',$getUserData->email);
					$this->set('success',"Password sent on your email id.");		 
				}
			}
		}else{
			 $this->set("error","Kindly enter email id");
		}
	}
	/**Function for logout
	*/
	function logout(){
		// Loaded Session Component
		$session = $this->request->session();
		$session->delete('User');
		return $this->redirect(['controller' => 'Home', 'action' => 'login']);
	}



	/**
	* Common Function for multiple selection
	*/
	function deleteRow($model=NULL,$id =NULL){
		// Loaded Admin Model
		$id=convert_uudecode(base64_decode($id));
		$loadModel = TableRegistry::get($model);
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  $loadModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		// Loaded Session Component
		$session = $this->request->session();
		$AdminData  = $session->read('Admin');

		//Not allowing sub admin to delete, type => 1 for sub admin
		$adminType = $session->read('Admin.type');
		if ($adminType == 1){
			$this->displayErrorMessage("You don't have the privilege to delete records. Only admin can perform this action.");
			$this->redirect($this->referer());
		}else{
			$record = $loadModel->get($id);
			$deleteResult = $loadModel->delete($record);
			$this->displaySuccessMessage("Record has been deleted successfully");
			$this->redirect($this->referer());
		}
	}
	/**
	* Function for status update
	*/
	function updateStatusRow($model=NULL,$id,$target)
	{ 
	  // Loaded Model
		$id=convert_uudecode(base64_decode($id));
		
		$loadModel = TableRegistry::get($model);
         //CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  $loadModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		$modelEntity = $loadModel->newEntity();

		$modelEntity->id = $id;
		$modelEntity->status = $target;
		//echo "<pre>";print_r($modelEntity);die;
		if($loadModel->save($modelEntity)){
			$this->displaySuccessMessage("Status has been updated successfully");
		}
		$this->redirect($this->referer());
	}
	
	/**
	* Function to generate random string
	*/
	function RandomStringGenerator($length = 10)
	{              
	  $string = "";
	  $pattern = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		for($i=0; $i<$length; $i++)
		{
			$string .= $pattern{rand(0,61)};
		}
		return $string;
	}
	
	/**
	* Common mail function
	*/	
	function send_email($process = "",$replace_fields=array(),$replace_with=array(),$email_template=null,$to=null,$extraTemplate = null)
	{
		// Loaded EmailTemplate Model
		$EmailsModel = TableRegistry::get('EmailTemplates');
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  $EmailsModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		$getTemplateData = $EmailsModel->find('all',['conditions' => ['EmailTemplates.alias' => $email_template]]);
		$template =  $getTemplateData->first();
		//pr($template); die;
		if ($extraTemplate != '')
		{
			$template_data = $extraTemplate;
		}
		else
		{
			$template_data=$template->description;		
		}
		
		$replace_fields = array_merge($replace_fields, array('{logo}'));
		$logoSrc = HTTP_ROOT.'img/Front/logo.jpg';
		
		$replace_with = array_merge($replace_with, array($logoSrc));
		$template_info=str_replace($replace_fields,$replace_with,$template_data);
   
		if($_SERVER['HTTP_HOST']=='localhost')
		{	
			pr($template_info); die;
		}
		$this->Email = new Email();
		try {
		
			ob_start();
            $res = $this->Email->from([$template->email_from => $template->email_name])
				  ->emailFormat('both')	
                  ->to([$to => $template->email_name])
                  ->subject($template->subject)                   
                  ->send($template_info);
			ob_end_clean();
        
		} catch (Exception $e) {

            echo 'Exception : ',  $e->getMessage(), "\n";

        }
	}
	
	/**
	* Function for Upload Image
	*/
	function admin_upload_file($type = NULL, $FileArr = array())
	{
	
		$this->loadComponent('Resize');
		
		$this->viewBuilder()->layout('');
		$this->autoRender=false;
		
		if($FileArr['name']!="")
		{
			if($type == 'logo')
			{
				$uploadFolder="uploads";	
				$logoWidth="285";
				$logoHeight="82";
				$logoSize="2097152";
				$logoKb = "2 MB";
			}
			else if($type == 'favicon')
			{
				$uploadFolder="uploads";	
				$logoWidth = "16";
				$logoHeight = "16";
				$logoSize="204800";
				$logoKb = '200 KB';
			}else if($type == 'profilePic')
			{
				$uploadFolder="uploads";	
				$logoWidth = "128";
				$logoHeight = "128";
				$logoSize="204800";
				$logoKb = '200 KB';
			}
			
			else if($type == 'audio' || $type == 'video')
			{
				$imgName = pathinfo($FileArr['name']);
				$file = $FileArr;
				$fileName = $FileArr['name'];
				$ext = trim(substr($fileName, strrpos($fileName,'.')));
				
				$explodeExt = explode('.',$fileName);
				$explodeExt =  end($explodeExt);
				if($type == 'audio')
				{
					$uploadFolder="files/audio";	
					$fileSize="5242880";
					$fileKb = "5 MB";
					$extCheckArr = array('mp3','ogg','wma');	
				}
				else
				{
					$uploadFolder="files/video";	
					$fileSize="10485760";
					$fileKb = '10 MB';
					$extCheckArr = array('mp4','ogg','wmv');	
				}
				
				
				if(in_array($explodeExt,$extCheckArr))
				{
					if($FileArr['size'] <= $fileSize)
					{
						$fileName = $this->RandomStringGenerator(15);
						$destination = realpath('../webroot/'.$uploadFolder).'/'.$fileName.$ext;
						$src = $FileArr['tmp_name'];
						
						
						
						if(move_uploaded_file($FileArr['tmp_name'],$destination))
						{
							$return = "success:".$fileName.$ext.":uploaded";
							return $return;
						}
					}
					else
					{
						$return = "error:File size should be less than $fileKb";
						return $return;
					}
				}
				else
				{
					$extCheckStr = implode(',',$extCheckArr);
					$return = "error:Only ".strtoupper($extCheckStr)." files are allowed!";
					return $return;
				}
			}else if($type == 'document') // @vik document upload
			{
				$imgName = pathinfo($FileArr['name']);
				$file = $FileArr;
				$fileName = $FileArr['name'];
				$ext = trim(substr($fileName, strrpos($fileName,'.')));
				
				$explodeExt = explode('.',$fileName);
				$explodeExt =  end($explodeExt);

				$uploadFolder="files/doc";	
				$fileSize="5242880";
				$fileKb = "5 MB";
				$extCheckArr = array('doc','odt','xls','xlsx','docx','pptx','csv');

				if(in_array($explodeExt,$extCheckArr))
				{ 
					if($FileArr['size'] <= $fileSize)
					{ 
						$fileName = $this->RandomStringGenerator(15);
						$destination = realpath('../webroot/'.$uploadFolder).'/'.$fileName.$ext;
						$src = $FileArr['tmp_name'];

						if(move_uploaded_file($FileArr['tmp_name'],$destination))
						{
							$return = "success:".$fileName.$ext.":uploaded";
							return $return;
						}
					}
					else
					{
						$return = "error:File size should be less than $fileKb";
						return $return;
					}
				}
				else
				{
					$extCheckStr = implode(',',$extCheckArr);
					$return = "error:Only ".strtoupper($extCheckStr)." files are allowed!";
					return $return;
				}
				
			}
			else
			{
				$uploadFolder="uploads";	
				$logoWidth = "16";
				$logoHeight = "16";
				$logoSize="204800";
				$logoKb = '200 KB';
			}
			
			
			
			$imgName = pathinfo($FileArr['name']);
			$file = $FileArr;
			$image = $FileArr['name'];
			$ext = trim(substr($image, strrpos($image,'.')));
			
			$explodeExt = explode('.',$image);
			$explodeExt =  end($explodeExt);
			
			
			if($explodeExt=='jpg' || $explodeExt=='jpeg' || $explodeExt=='png' || $explodeExt=='gif' || $explodeExt=='bmp')
			{

				if($FileArr['size'] <= $logoSize)
				{
					$image = $this->RandomStringGenerator(15);
					$destination = realpath('../webroot/img/'.$uploadFolder).'/'.$image.$ext;
					$src = $FileArr['tmp_name'];
					
					list( $width, $height, $source_type ) = getimagesize($src);	
					
					if($width == $logoWidth && $height == $logoHeight)
					{
						
						move_uploaded_file($FileArr['tmp_name'],$destination);
						$imgStatus = 1;
						
					}else{
						
						$this->Resize->resize($FileArr['tmp_name'],$destination,'as_define',$logoWidth,$logoHeight,0,0,0,0);
						$imgStatus = 2;
					}
					
					if($imgStatus == 1)
					{
						$return = "success:".$image.$ext.":uploaded";
						return $return;
					}else{
						$return = "success:".$image.$ext.":resize";
						return $return;
					}
				}else
				{
					$return = "error:File size should be less than $logoKb";
					return $return;
				}
			}else{
				$return = "error:Only JPG, PNG, BMP or GIF files are allowed!";
				return $return;
			}
		}else{
			$return = "error:Some error occured while saving to the database!";
			return $return;
		}
	}
	
	/**
	* Function for CMS pages
	*/ 
	function cmsPages()
    {
		$this->viewBuilder()->layout("admin_dashboard");
		
		// load CMSPAGE Model
		$CmsPagesModel = TableRegistry::get('CmsPages');
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  $CmsPagesModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		$this->loadComponent('Paginator');
		$this->set('modelName','CmsPages');
		//for searching 
		 if(!empty($_GET['data']) && isset($_GET['data']))
		 {
			$data = $_GET['data'];
			$cmsPages = $this->Paginator->paginate($CmsPagesModel,[
			   'conditions' => [
					'CmsPages.pagename LIKE' => '%'.$data['CmsPage']['pagename'].'%',
			   ],
			   'limit' => 10,
			   'order' => [
					'CmsPages.pagename' => 'asc'
				]
			]);
		 }
		else
		{
			$cmsPages = $this->Paginator->paginate($CmsPagesModel,[ 'limit' => 200,
			   'order' => [
					'CmsPages.pagename' => 'asc'
				]
			]);
		}
		
		$this->set('cmsPages',$cmsPages);
	}
    /** 
	* Function to edit cms pages
	*/ 
	function cmsPagesEdit($id=null)
	{
		$this->viewBuilder()->layout("admin_dashboard");
		$id = convert_uudecode(base64_decode($id));
	
		// load CMSPAGE model
	    $CmsPagesModel = TableRegistry::get('CmsPages');
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  $CmsPagesModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END

		if (isset($this->request->data) && !empty($this->request->data)) 
		{
		
			
			$cmsPageData = $CmsPagesModel->newEntity($this->request->data['CmsPages'],['validate' => true]);
			
			 $cmsPage = (object)$this->request->data['CmsPages'];
			
			
			if (!$cmsPageData->errors()){
				
				if ($CmsPagesModel->save($cmsPageData)) 
				{
					$this->displaySuccessMessage('CMS Page updated successfully');
					return $this->redirect(['action'=>'cms-pages','controller'=>'users']);
				}
			}else{
				$this->set('page',$cmsPage);
				$this->set([
				'errors' => $cmsPageData->errors(), 
				'_serialize' => ['errors']]);
				
				$this->displayErrorMessage('All fields are required');
				return $this->redirect($this->referer());
			}
        }else{
			$cmsPage = $CmsPagesModel->get($id);
			$this->set('page',$cmsPage);
		}
	}
	
	/**
	* Function for email templates
	*/ 
	function emailTemplates()
    {
		$this->viewBuilder()->layout("admin_dashboard");
		
		// load EmailTemplates Model
		$EmailTemplateModel = TableRegistry::get('EmailTemplates');
	
		//$EmailTemplateTable = $EmailTemplateModel->newEntity();
		$this->loadComponent('Paginator');
		$this->set('modelName','EmailTemplates');
		//for searching 
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  $EmailTemplateModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		 if(!empty($_GET['data']) && isset($_GET['data']))
		 {
			$data = $_GET['data'];
			$emailTemplates = $this->Paginator->paginate($EmailTemplateModel,[
			   'conditions' => [
					'EmailTemplates.title LIKE' => '%'.$data['EmailTemplates']['title'].'%',
			   ],
			   'limit' => 10,
			   'order' => [
					'EmailTemplates.title' => 'asc'
				]
			]);
		 }
		else
		{
			$emailTemplates = $this->Paginator->paginate($EmailTemplateModel,[ 'limit' => 200,
			   'order' => [
					'EmailTemplates.title' => 'asc'
				]
			]);
		}
		$this->set('emailTemplates',$emailTemplates);
	}
	/**Function for email template edit
	*/
	function emailTemplateEdit($id = null){
		
	    $id=convert_uudecode(base64_decode($id));
		
		$this->viewBuilder()->layout("admin_dashboard");
		
		// Loading model
		$emailTemplateModel = TableRegistry::get('EmailTemplates');

		if (isset($this->request->data) && !empty($this->request->data)) 
		{
			

			$emailTemplateData = $emailTemplateModel->newEntity($this->request->data['EmailTemplates'],['validate' => true]);
			
				$emailTemp = (object)$this->request->data['EmailTemplates'];
				 
				 if (!$emailTemplateData->errors()){
					//CODE FOR MULTILIGUAL START
					  $session = $this->request->session();
					  $emailTemplateModel->_locale = $session->read('setRequestedLanguageLocale');
					  $emailTemplateData->_locale = $session->read('setRequestedLanguageLocale');
					//CODE FOR MULTILIGUAL END
					if ( $emailTemplateModel->save($emailTemplateData)) 
					{
						$this->displaySuccessMessage('Template has been updated Successfully');
						return $this->redirect(['action'=>'email_templates','controller'=>'users']);
					}
				 }else{
					 $this->set('emailTemp',$emailTemp);
						$this->set([
						'errors' => $emailTemplateData->errors(), 
						'_serialize' => ['errors']]);
						
						$this->displayErrorMessage('All fields are required');
						return $this->redirect($this->referer());
				  }
		}else{
			$emailTemp = $emailTemplateModel->get($id);
		    $this->set(compact('emailTemp'));
		}
	}
	/**
	* Function for contact us
	*/ 
	function contactRequests()
    {
		$this->viewBuilder()->layout("admin_dashboard");
		
		// load EmailTemplates Model
		$ContactRequestModel = TableRegistry::get('ContactRequests');
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  $ContactRequestModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		$this->loadComponent('Paginator');
		$this->set('modelName','ContactRequests');
		//for searching 
		 if(!empty($this->request->data) && isset($this->request->data))
		 {
			$data = $this->request->data;
			$contactRequests = $this->Paginator->paginate($ContactRequestModel,[
			   'conditions' => [
					'ContactRequests.title LIKE' => '%'.$data['ContactRequests']['title'].'%',
			   ],
			   'limit' => 10,
			   'order' => [
					'ContactRequests.title' => 'asc'
				]
			]);
		 }
		else
		{
			$contactRequests = $this->Paginator->paginate($ContactRequestModel,[ 'limit' => 200,
			   'order' => [
					'ContactRequests.title' => 'asc'
				]
			]);
		}
		$this->set('contactRequests',$contactRequests);
		//pr($contactRequests);die;
	}
	/**
	*	Function for view contact request
	*/
	function contactView($requestId = NULL)
	{
		$this->viewBuilder()->layout("admin_dashboard");
		$requestId = convert_uudecode(base64_decode($requestId));
		//load ContactRequest model
		$ContactRequestModel = TableRegistry::get('ContactRequests');
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  $ContactRequestModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		$contactRequest = $ContactRequestModel->get($requestId);
		
	    $this->set('contactRequest', $contactRequest);
	}
	/**
	*	Function for contact reply
	*/
	function contactReply($requestId = NULL)
	{
	    $this->viewBuilder()->layout("admin_dashboard");
		$requestId = convert_uudecode(base64_decode($requestId));
		
		//load ContactRequest model
		$ContactRequestModel = TableRegistry::get('ContactRequests');
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  $ContactRequestModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		if (isset($this->request->data) && !empty($this->request->data))
		{
			$data = $this->request->data;
			$contacReauestData	= $ContactRequestModel->newEntity($this->request->data['ContactRequests']);
			$contacReauestData->reply_status = 1;
			
			if($ContactRequestModel->save($contacReauestData)){
			// sending email reply of contact request
			 $replace = array('{content}');
					$with = array($data['ContactRequests']['reply']);
					$this->send_email('',$replace,$with,'reply_contact',$data['ContactRequests']['email'],$data['ContactRequests']['reply']);
			  $this->displaySuccessMessage('Reply sent successfully');
			  return $this->redirect(['controller'=>'users','action' => 'contact-requests']);
			}
			
		}else{
			    $contactRequest = $ContactRequestModel->get($requestId);
				//load model
				$EmailTemplates = TableRegistry::get('EmailTemplates');
				 
				$contactReplyContent = $EmailTemplates->find("all",["conditions"=>["EmailTemplates.alias"=>"reply_contact"]]);
				  $contactReplyContent = $contactReplyContent->first();
				  
				$contactReplyContent->description = str_replace(array('{to_name}', '{content}'), array($contactRequest->name, 'Write your message here...'), $contactReplyContent->description);
				$this->set('contactReplyContent', $contactReplyContent);
				$this->set('contactRequest', $contactRequest);
		}
	}
	
	/** Function for display error message
	*/
	function displayErrorMessage($msg=null){
		$session = $this->request->session();
		$session->write('success','');
		$session->write('error',$msg);
	}
	/**Function for display success message
	*/
	function displaySuccessMessage($msg=null){
		$session = $this->request->session();  
		$session->write('error','');
		$session->write('success',$msg);
	}
		
	public function setYourStore($langCode=null,$controller='users',$action='dashboard'){
	
		//CODE FOR MULTILIGUAL WEBSITE
		//CHANGES REQUEST LANGUAGE SESSION AND LOCALE
		$languageSession = $this->request->session();
		if(isset($langCode) && $langCode !=""){
			
			//$this->request->params['language'] return en|fr|de|es|hu|it|ro|ru
			$requestedLanguage = $langCode;
			
			if($requestedLanguage=="en"){
			
				$setRequestedLanguageLocale = $requestedLanguage."_US";
			
			}else if($requestedLanguage=="sp"){
			
				$setRequestedLanguageLocale = "es_ES";
			
			}else{
			
				$setRequestedLanguageLocale = $requestedLanguage."_".strtoupper($requestedLanguage);
			}
			$languageSession->write('Config.language', $requestedLanguage);
			$languageSession->write('requestedLanguage', $requestedLanguage);
			$languageSession->write('setRequestedLanguageLocale', $setRequestedLanguageLocale);		
			
		}else{
			$setRequestedLanguageLocale = "en_US";
			$requestedLanguage="en";
			$languageSession->write('Config.language', $requestedLanguage);
			$languageSession->write('requestedLanguage', $requestedLanguage);
			$languageSession->write('setRequestedLanguageLocale', $setRequestedLanguageLocale);
		}
		
		I18n::locale($setRequestedLanguageLocale);
		if (strpos($action,'edit') != false) {
			return $this->redirect(['controller'=>$controller,'action' => 'dashboard' ]);
		}else{
		   return $this->redirect(['controller'=>$controller,'action' => $action]);
		}
	}
	
	/**
	* Function of User login
	*/
	public function userlogin()
	{
		$this->viewBuilder()->layout('frontend');
		
	}
	
	public function usersignup()
	{
		$this->viewBuilder()->layout('frontend');
		
	}

	/**
	* function for adding executive summary rating
	*/
	public function executiveSummaryRating() {

		$ExecutiveRatingsModel = TableRegistry::get('ExecutiveRatings');

		if (isset($this->request->data) && !empty($this->request->data)) {
			$findRating = $ExecutiveRatingsModel->find('all')
					->where(['executive_id' => $this->request->data['executive_id'], 'user_id' => $this->request->data['user_id']])
					->toArray();
			if(count($findRating)){
				$this->request->data['id'] = $findRating[0]->id;
			}
			
			$ratingData = $ExecutiveRatingsModel->newEntity($this->request->data);
			if ($ExecutiveRatingsModel->save($ratingData)) {

				echo json_encode(array('message'=>"Rating Saved Successfully"));

			} else {
				echo json_encode(array('message'=>"Something Went Wrong Try again later"));
			}
			die;
		}
	}
	public function InvestmentRating() {

		$InvestmentRatingsModel = TableRegistry::get('InvestmentRatings');

		if (isset($this->request->data) && !empty($this->request->data)) {
			/*$findRating = $InvestmentRatingsModel->find('all')
					->where(['executive_id' => $this->request->data['executive_id'], 'user_id' => $this->request->data['user_id']])
					->toArray();
			if(count($findRating)){
				$this->request->data['id'] = $findRating[0]->id;
			}*/
			
			$ratingData = $InvestmentRatingsModel->newEntity($this->request->data);
			 //print_r($ratingData); 
			if ($InvestmentRatingsModel->save($ratingData)) {

				echo json_encode(array('message'=>"Rating Saved Successfully"));

			} else {
				echo json_encode(array('message'=>"Something Went Wrong Try again later"));
			}
			die;
		}
	}



	/**
	* function for get executive summary rating
	*/
	public function getExecutiveSummaryRating() {

		$ExecutiveRatingsModel = TableRegistry::get('ExecutiveRatings');

		if (isset($this->request->data) && !empty($this->request->data)) {
			$findRating = $ExecutiveRatingsModel->find('all')
					->where(['executive_id' => $this->request->data['executive_id'], 'user_id' => $this->request->data['user_id']])
					->toArray();
			if(count($findRating)){
				echo json_encode(array('message'=>"Rating Found", 'executiveData'=>$findRating));
			} else {
				echo json_encode(array('message'=>"No Record Found"));
			}
			die;
		}
	}

	
}
?>