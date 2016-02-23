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

class UsersController extends AppController
{
	public $helpers = ['Form'];
	
	public function initialize()
    {
		//print_R($this->request->params);die;
        parent::initialize();
		
		// check admin session
		if(!$this->CheckAdminSession() && !in_array($this->request->action,array('login','forgotPassword')))
		{
			return $this->redirect(['controller' => 'users', 'action' => 'login']);
			exit();
		}
		else if($this->CheckAdminSession() && ($this->request->action == 'login' || $this->request->action=="forgotPassword"))
		{
			return $this->redirect(['controller' => 'users', 'action' => 'dashboard']);
		} 
		//GET LOCALE VALUE
		// $session = $this->request->session();
		// $setRequestedLanguageLocale  = $session->read('setRequestedLanguageLocale'); 
		// I18n::locale($setRequestedLanguageLocale);
		
	}
	
	/**
	* Function to check admin session
	*/
	function checkAdminSession()
	{
		$session = $this->request->session();
		$AdminData  = $session->read('Admin');
		
		if(isset($AdminData['id']) && isset($AdminData['username']))
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	
	/**
	* Function of admin login
	*/
	function login()
	{
		$this->viewBuilder()->layout('admin_login');
		
		// Loaded Admin Model
		$AdminsModel = TableRegistry::get('Admins');
		$AdminData = $AdminsModel->newEntity();

		if (isset($this->request->data) && !empty($this->request->data))
		{
			
			if($this->request->data['username']!="" && $this->request->data['password']!="")
		    {   $session = $this->request->session();
				$username = trim($this->request->data['username']);
				$password = md5(trim($this->request->data['password']));
				$getValidAdminData = $AdminsModel->find('all',
										['conditions' => ['Admins.username' => $username,'Admins.password' => $password]]
									);

				if($getValidAdminData->count()>0)
				{
					$getAdminData =  $getValidAdminData->first();
					$AdminData->id = $getAdminData->id;
					$AdminData->last_login = date('Y-m-d h:i:s');
				 
					$AdminsModel->save($AdminData);
				 
					$session->write('Admin.id', $getAdminData->id);
					$session->write('Admin.email', $getAdminData->email);
					$session->write('Admin.username', $getAdminData->username);
					$session->write('Admin.full_name', $getAdminData->full_name);
					$session->write('Admin.admin_img', $getAdminData->admin_img);
					$session->write('Admin.type', $getAdminData->type);
					$session->write('Admin.last_login', $getAdminData->last_login);
					$session->write('Admin.join_date', $getAdminData->date_added);

					return $this->redirect(['controller' => 'Users', 'action' => 'users-listing']);
				}
		    }
		     
            $this->set('error',AUTHENTICATION_FAILED);		 
			
		} 
	}
	/**Function for dashboard
	*/
	function dashboard(){
		
		$this->viewBuilder()->layout('admin_dashboard');

		$session = $this->request->session();
		// $currentLang = $session->read('requestedLanguage');
		// if(!isset($currentLang) && empty($currentLang)){

			// $this->setYourStore("en","Users","dashboard");
		// }
	  
		$UsersModel = TableRegistry::get('Users');
		$AdminsModel = TableRegistry::get('Admins');

		$userdata = $UsersModel->find('all');
		$usercount = $userdata->count();

		$admindata = $AdminsModel->find('all');
		$AllAdmins = $admindata->all(); 
		$this->set('admins_info',$AllAdmins);
		
		$activeuser = $UsersModel->find('all',['conditions'=>['Users.status'=>1]]);
		$activeuser = $activeuser->count();
		
		$deactiveuser = $UsersModel->find('all',['conditions'=>['Users.status'=>0]]);
		$deactiveuser = $deactiveuser->count();


		$usersdetail = ['total_user'=>$usercount,'active_user'=>$activeuser,'deactive_user'=>$deactiveuser];
		$this->set('UsersDetail',$usersdetail);
		
		$ContactRequest = TableRegistry::get('ContactRequests');
		$AllContactRequest = $ContactRequest->find('all');
		$contactRequestcount = $AllContactRequest->count();

		$total_reply = $ContactRequest->find('all',['conditions'=>['ContactRequests.reply_status'=>1]]);
		$total_reply = $total_reply->count();

		$no_reply = $ContactRequest->find('all',['conditions'=>['ContactRequests.reply_status'=>0]]);
		$no_reply = $no_reply->count();
		
		$contactRequestDetail = ['total_contact_request'=>$contactRequestcount,'reply'=>$total_reply,'no_reply'=>$no_reply];

		$this->set('ContactRequestDetail',$contactRequestDetail);
		
		$CmsPages = TableRegistry::get('CmsPages');
		$AllCmsPages = $CmsPages->find('all');
		
		$countCmsPages = $AllCmsPages->count();

		$activeCmsPages = $CmsPages->find('all',['conditions'=>['CmsPages.status'=>1]]);
		$activeCmsPages = $activeCmsPages->count();

		$deactiveCmsPages = $CmsPages->find('all',['conditions'=>['CmsPages.status'=>0]]);
		$deactiveCmsPages = $deactiveCmsPages->count();
		
		$cmsPagesDetail = ['total_cms_pages'=>$countCmsPages,'active'=>$activeCmsPages,'deactive'=>$deactiveCmsPages];

		$this->set('CmsPagesDetail',$cmsPagesDetail);
	}
	
	/** Function for edit admin details
	*/
	function adminEdit(){
		$this->viewBuilder()->layout('admin_dashboard');
		//Loaded Model
		$AdminsModel = TableRegistry::get('Admins');
		$SiteModel = TableRegistry::get('SiteConfigurations');

		$session = $this->request->session();
		$Adminid  = $session->read('Admin.id');
	   
		if(isset($this->request->data) && !empty($this->request->data)){
			
			$AdminData= $AdminsModel->newEntity($this->request->data['Admins'],['validate'=>true]);
			$admininfo = (object)$this->request->data['Admins'];
			
			$SiteConfigData = $SiteModel->newEntity($this->request->data['SiteConfigurations'],['validate'=>true]);	
			
			$siteinfo = (object)$this->request->data['SiteConfigurations'];
			//CODE FOR MULTILIGUAL START
			  $session = $this->request->session();
			  // $AdminsModel->_locale = $session->read('requestedLanguage');
			  // $SiteModel->_locale = $session->read('requestedLanguage');
			  // $AdminData->_locale = $session->read('requestedLanguage');
			//CODE FOR MULTILIGUAL END
			 //Upload admin image
			if($_FILES['admin_img']['name']!=''){
				$adminimg = $this->admin_upload_file('profilePic',$_FILES['admin_img']);
				$adminimg = explode(':',$adminimg);
				if($adminimg[0]=='error'){
					$this->displayErrorMessage($adminimg[1]);
					$this->redirect($this->referer());
				}else{
					$AdminData->admin_img = $adminimg[1];
				}				
			}else{
				 unset($_FILES['admin_img']);
			}
			//Upload site logo
			if($_FILES['site_logo']['name']!=''){
				$siteLogo = $this->admin_upload_file('logo',$_FILES['site_logo']);
				$siteLogo = explode(':',$siteLogo);
				if($siteLogo[0]=='error'){
					$this->displayErrorMessage($siteLogo[1]);
					$this->redirect($this->referer());
				}else{
					$Sitelogo = $siteLogo[1];
					$SiteConfigData->site_logo = $Sitelogo;
				}				
			}else{
			   unset($_FILES['site_logo']);
			}
			//Upload site favicon
			if($_FILES['site_favicon']['name']!=''){
				$favicon = $this->admin_upload_file('favicon',$_FILES['site_favicon']);
				$favicon = explode(':',$favicon);
				if($favicon[0]=='error'){
					$this->displayErrorMessage($favicon[1]);
					$this->redirect($this->referer());
				}else{
				  $SiteConfigData->site_favicon = $favicon[1];
				}				
			}else{
				unset($_FILES['site_favicon']);
			}

			$AdminData->id = $Adminid;
			

			if (!$AdminData->errors() && !$SiteConfigData->errors()){
				
							
				if($AdminsModel->save($AdminData)){
					$page = $AdminsModel->get($Adminid);
				 
				  $SiteConfigurations = $SiteModel->find('all');
			      $SiteConfigurations = $SiteConfigurations->first();
			      $SiteConfigData->id = $SiteConfigurations->id;
				} 
				if($SiteModel->save($SiteConfigData)){
					$SiteConfigurations = $SiteModel->find('all');
					$SiteConfigurations = $SiteConfigurations->first();

					$session->write('Admin.username', $page->username);
					$session->write('Admin.full_name', $page->full_name);
					$session->write('Admin.admin_img', $page->admin_img);

					$this->displaySuccessMessage('Admin settings has been updated successfully');
				}
				return $this->redirect(['controller' => 'users', 'action' => 'admin-edit']);
				
		   }else{
			
			   $AdminsModel = $AdminsModel->get($Adminid);
			   $admininfo->admin_img = $AdminsModel->admin_img; 
			   
			   $SiteModel = $SiteModel->find('all');
			   $SiteConfigurations = $SiteModel->first();
			   $siteinfo->site_logo = $SiteConfigurations->site_logo;
			   $siteinfo->site_favicon = $SiteConfigurations->site_favicon;
			   
			   $this->set('admininfo',$admininfo);
		       $this->set('siteinfo',$siteinfo);
		
			   
			   $obj_merged = (object) array_merge((array) $AdminData->errors(), (array) $SiteConfigData->errors());
			   
			   $this->set([
				'errors' => $obj_merged, 
				'_serialize' => ['errors']]);
				return;
		   }
		}else{
			$admininfo = $AdminsModel->get($Adminid);
			$SiteModel = $SiteModel->find('all');
			$SiteConfigurations = $SiteModel->first();
			
			$this->set('admininfo',$admininfo);
		    $this->set('siteinfo',$SiteConfigurations);
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
		  // $AdminsModel->_locale = $session->read('requestedLanguage');
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
		$this->viewBuilder()->layout('admin_login');
		// Loaded Admin Model
		$AdminsModel = TableRegistry::get('Admins');
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		 // $AdminsModel->_locale = $session->read('requestedLanguage');
		//CODE FOR MULTILIGUAL END
		$AdminData = $AdminsModel->newEntity();

		if(isset($this->request->data['email']) && !empty($this->request->data['email'])){
			$data=$this->request->data;	
			$user = $AdminsModel->find('all',['conditions' => ['Admins.email' => $data['email']]]);
			$getAdminData =  $user->first();
			
			if(empty($getAdminData)){
			   $this->set("error","Email id not register with us, try again");
			}else{
				$new_password = $this->RandomStringGenerator(8);
				$update_password = md5($new_password);
				$AdminData->id = $getAdminData->id;
				$AdminData->password = $update_password;
				//save adnin data		
				if($AdminsModel->save($AdminData)){
					$replace = array('{user}','{new_password}');
					$with = array($getAdminData->username,$new_password);
					$this->send_email('',$replace,$with,'admin_forgot_password',$getAdminData->email);
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
		$session->delete('Admin');
		$session->delete('requestedLanguage');
		$session->delete('setRequestedLanguageLocale');
		return $this->redirect(['controller' => 'users', 'action' => 'login']);
	}
	/**Function for add new user
	*/
	function addNewUser(){
		$this->viewBuilder()->layout('admin_dashboard');
		//Load Users model
		$UsersModel = TableRegistry::get("Users");
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  //$UsersModel->_locale = $session->read('setRequestedLanguageLocale');
		//CODE FOR MULTILIGUAL END
		if(isset($this->request->data) && !empty($this->request->data)) {
			
			$this->request->data['Users']['password']= md5($this->request->data['Users']['org_password']);
			$this->request->data['Users']['type']='investment';
			$userData = $UsersModel->newEntity($this->request->data['Users'],['validate' => true, 'associated' => ['UserDetails','UserExecutiveSummaries']]);
			if (!$userData->errors()){
				//Upload user image
				if($_FILES['image']['name']!=''){
					$userImg = $this->admin_upload_file('profilePic',$_FILES['image']);
					$userImg = explode(':',$userImg);
					if($userImg[0]=='error'){
					   $this->displayErrorMessage($userImg[1]);
					   $this->redirect($this->referer());
					}else{
					   $userData->image = $userImg[1];
					}
					
					//$courses = $this->Courses->patchEntity($this->request->data(), ['associations' => ['CoursesStudents']]);
					
					
				}else{
				   unset($_FILES['image']);
				}
				//Save user data

				if($UsersModel->save($userData)){
					$this->displaySuccessMessage("New user have been added Successfully");
				return $this->redirect(['controller' => 'users', 'action' => 'users-listing']);
				}	
			}else{
				//Set errors
				$this->set([
				'errors' => $userData->errors(), 
				'_serialize' => ['errors']]);
	
				$this->set('userInfo',(object)$this->request->data['Users']);
				return;
			}
		}
	}
	/**Function for edit user
	*/
	function editUser($id = NULL){
		$this->viewBuilder()->layout('admin_dashboard');
		$id=convert_uudecode(base64_decode($id));
		$UsersModel = TableRegistry::get("Users");
		
	    //CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  //$UsersModel->_locale = $session->read('setRequestedLanguageLocale');
		//CODE FOR MULTILIGUAL END
		if(isset($this->request->data) && !empty($this->request->data)) {
			$this->request->data['Users']['password']= md5($this->request->data['Users']['org_password']);
			$userData = $UsersModel->newEntity($this->request->data['Users'],['validate' => true, 'associated' => ['UserDetails']]);
			$userData->id = $userId = convert_uudecode(base64_decode($this->request->data['userId']));
			if (!$userData->errors()){
				
				//Upload user image
				if($_FILES['image']['name']!=''){
					
					$userImg = $this->admin_upload_file('profilePic',$_FILES['image']);
					$userImg = explode(':',$userImg);
					if($userImg[0]=='error'){
						$this->displayErrorMessage($userImg[1]);
						$this->redirect($this->referer());
					}else{
						$userData->image = $userImg[1];
					}
					
					/*saving in other table
					$articlesTable = TableRegistry::get('Users');
					$author = $articlesTable->Authors->findByUserName('mark')->first();

					$article = $articlesTable->newEntity();
					$article->title = 'An article by mark';
					$article->author = $author;

					if ($articlesTable->save($article)) {
						// The foreign key value was set automatically.
						echo $article->author_id;
					}
					/*saving in other table*/
					
				}else{
				   unset($_FILES['image']);
				}
				//Update user data
				if($UsersModel->save($userData)){
					$this->displaySuccessMessage("Records have been updated successfully");
					return $this->redirect(['action'=>'users-listing','controller'=>'users']);
				}
			}else{
				$userInfo = $UsersModel->get($userId, [ 'contain' => ['UserDetails','UserMembers','Useraddsummaries','UserFundingMaterials']]);
				$this->set('userInfo',$userInfo);
				$this->set([
				'errors' => $userData->errors(), 
				'_serialize' => ['errors']]);
				return;
			}
		}else{
			$userInfo = $UsersModel->get($id, [ 'contain' => ['UserDetails','UserMembers','UserExecutiveSummaries','UserFundingMaterials']]);
			$this->set('userInfo',$userInfo);
		}
	}	
	/**Function for users list
	*/	
	function usersListing(){
		$this->viewBuilder()->layout('admin_dashboard');
		
		$this->loadComponent('Paginator');
		$this->set('modelName','Users');
		$UsersModel = TableRegistry::get("Users");
		//CODE FOR MULTILIGUAL START
		  $session = $this->request->session();
		  //$UsersModel->_locale = $session->read('setRequestedLanguageLocale');
		//CODE FOR MULTILIGUAL END
		//for searching 
		if(!empty($_GET['data']) && isset($_GET['data'])){
	
			
			$data = $_GET['data'];
			$users_info = $this->Paginator->paginate($UsersModel,[
			'conditions' => [
			'Users.id LIKE' => '%'.$data['Users']['id'].'%',
			'Users.type' => 'investment'],
			'limit' => 10,
			'order' => [
			'Users.id' => 'asc']]);
		}else{

			 $users_info = $this->Paginator->paginate($UsersModel,[ 'limit' => 200,
			'conditions' => [
			'Users.type != ' => 'valuerater'],
			'order' => [
			'Users.id' => 'asc']]);
		}
		$this->set('users_info',$users_info);
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
		  //$loadModel->_locale = $session->read('requestedLanguage');
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
		  //$loadModel->_locale = $session->read('requestedLanguage');
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
	/** @harmeet
	* Function adddig exicutive smmary
	*/
	public function addSummary($userId) {
		$this->viewBuilder()->layout('admin_dashboard');
	    $userIdDecoded=convert_uudecode(base64_decode($userId));
		$AddSummaryModel = TableRegistry::get("UserExecutiveSummaries");
		if(isset($this->request->data) && !empty($this->request->data)) {
			$this->request->data['UserAddSummaries']['user_id'] = $userIdDecoded;			
			$summaryData = $AddSummaryModel->newEntity($this->request->data['UserAddSummaries'],['validate' => true]);
           // echo $summaryData; die();		
	 	if($AddSummaryModel->save($summaryData)){
					$this->displaySuccessMessage("New team member have been added Successfully");
					return $this->redirect(['controller' => 'users', 'action' => 'addSummary', $userId]);
					
				}				
			else{
				//Set errors
				$this->set([
				'errors' => $summaryData->errors(), 
				'_serialize' => ['errors']]);
				return;
			}
		}
		
		$main_arr = array('user_id'=>$userId);
		$this->set('main_arr',$main_arr);
}
     function shareInvestments($id = NULL){
		    $this->viewBuilder()->layout('admin_dashboard');
			$id=convert_uudecode(base64_decode($id));
		//Load Users mod$session = $this->request->session();
							
	      	$UsersModel = TableRegistry::get("Users");
		//CODE FOR MULTILIGUAL START
		     $session = $this->request->session();
		  //$UsersModel->_locale = $session->read('setRequestedLanguageLocale');
		//CODE FOR MULTILIGUAL END
		    if(isset($this->request->data) && !empty($this->request->data)) {
				$pass=$this->RandomStringGenerator($length = 10);
				$this->request->data['Users']['password']=md5($pass);
				$this->request->data['Users']['org_password']=$pass;
				$this->request->data['Users']['type']='valuerater';
                $email = $this->request->data['Users']['email'];
								
			    $userData = $UsersModel->newEntity($this->request->data['Users'],['validate' => true, 'associated' => ['UserDetails','UserExecutiveSummaries']]);  
				
				$query = $UsersModel->find('all')->where(['Users.email' => $email])->toArray();
				
			if (!$userData->errors()){
				
				$uid=$session->read('success');

                if(count($query))
               {
	           	$this->displaySuccessMessage("Email is already exists");
               }
				else
				{
					if($UsersModel->save($userData)){
						$this->displaySuccessMessage("New user have been added Successfully");
						return $this->redirect(['controller' => 'users', 'action' => 'users-listing']);
					}	
				}

			}else{
				//Set errors
				$this->set([
				'errors' => $userData->errors(), 
				'_serialize' => ['errors']]);
	
				$this->set('userInfo',(object)$this->request->data['Users']);
				return;
			}
		}
	}
	

	/* public function shareInvestments() {
		$this->viewBuilder()->layout('admin_dashboard');
	    $userIdDecoded=convert_uudecode(base64_decode());
		$AddSummaryModel = TableRegistry::get("Users");
		if(isset($this->request->data) && !empty($this->request->data)) {
			$this->request->data['Users']['user_id'] = $userIdDecoded;			
			$summaryData = $AddSummaryModel->newEntity($this->request->data['Users'],['validate' => true]);
           // echo $summaryData; die();		
	 	if($AddSummaryModel->save($summaryData)){
					$this->displaySuccessMessage("New team member have been added Successfully");
					return $this->redirect(['controller' => 'users', 'action' => 'addSummary', $userId]);
					
				}				
			else{
				//Set errors
				$this->set([
				'errors' => $summaryData->errors(), 
				'_serialize' => ['errors']]);
				return;
			}
		}
		
		$main_arr = array('user_id'=>$userId);
		$this->set('main_arr',$main_arr);
}	 */
	/* @vik 
	* Create team member
	*/	
	function createTeamMember($userId){
		$this->viewBuilder()->layout('admin_dashboard');
		$userIdDecoded=convert_uudecode(base64_decode($userId));
		
		//Load UserMembers model
		$teamMemberModel = TableRegistry::get("UserMembers");
		
		if(isset($this->request->data) && !empty($this->request->data)) {
			$this->request->data['UserMembers']['user_id'] = $userIdDecoded;
			$memberData = $teamMemberModel->newEntity($this->request->data['UserMembers'],['validate' => true]);
			if (!$memberData->errors()){
				
				//Upload member image
				if($_FILES['image']['name']!=''){
					
					$userImg = $this->admin_upload_file('profilePic',$_FILES['image']);
					$userImg = explode(':',$userImg);
					if($userImg[0]=='error'){
						$this->displayErrorMessage($userImg[1]);
						$this->redirect($this->referer());
					}else{
						$memberData->image = $userImg[1];
					}
					
				}else{
				   unset($_FILES['image']);
				}
				
				if($teamMemberModel->save($memberData)){
					$this->displaySuccessMessage("New team member have been added Successfully");
					return $this->redirect(['controller' => 'users', 'action' => 'addsummary', $userId]);
				}	
			}else{
				//Set errors
				$this->set([
				'errors' => $memberData->errors(), 
				'_serialize' => ['errors']]);
				return;
			}
		}
		$main_arr = array('user_id'=>$userId);
		$this->set('main_arr',$main_arr);
	}
	
	/* harmeet
	* Edit team member
	*/
	function editsummary($userId, $memberId){
		
		$this->viewBuilder()->layout('admin_dashboard');
		$userIdDecoded=convert_uudecode(base64_decode($userId));
		//Load UserMembers model
		$AddSummaryModel = TableRegistry::get("UserExecutiveSummaries");
		if(isset($this->request->data) && !empty($this->request->data)) {

			$summaryData = $AddSummaryModel->newEntity($this->request->data['UserExecutiveSummaries'],['validate' => true]);
			$summaryData->id = $memberId;
			
			if (!$summaryData->errors()){
				//Upload member image
				/* if($_FILES['image']['name']!=''){
					
					$userImg = $this->admin_upload_file('profilePic',$_FILES['image']);
					$userImg = explode(':',$userImg);
					if($userImg[0]=='error'){
						$this->displayErrorMessage($userImg[1]);
						$this->redirect($this->referer());
					}else{
						$memberData->image = $userImg[1];
					}
					
				}else{
				   unset($_FILES['image']);
				} */
				
				//Update member data
				if($AddSummaryModel->save($summaryData)){
					$this->displaySuccessMessage("Member has been updated successfully");
					return $this->redirect(['controller' => 'users', 'action' => 'addSummary', $userId]);
				}
			}else{

				$this->set([
				'errors' => $summaryData->errors(), 
				'_serialize' => ['errors']]);
				//return;
			}
		}
		$memberInfo = $AddSummaryModel->get($memberId);
		//echo $memberInfo; die(); 
		$main_arr = array('user_id'=>$userId, 'member_id'=>$memberId, 'member_info'=>$memberInfo);
		$this->set('main_arr',$main_arr);	
		
	}
	function editTeamMember($userId, $memberId){
		
		$this->viewBuilder()->layout('admin_dashboard');
		$userIdDecoded=convert_uudecode(base64_decode($userId));
		//Load UserMembers model
		$teamMemberModel = TableRegistry::get("UserMembers");
		if(isset($this->request->data) && !empty($this->request->data)) {

			$memberData = $teamMemberModel->newEntity($this->request->data['UserMembers'],['validate' => true]);
			$memberData->id = $memberId;
			
			if (!$memberData->errors()){
				//Upload member image
				if($_FILES['image']['name']!=''){
					
					$userImg = $this->admin_upload_file('profilePic',$_FILES['image']);
					$userImg = explode(':',$userImg);
					if($userImg[0]=='error'){
						$this->displayErrorMessage($userImg[1]);
						$this->redirect($this->referer());
					}else{
						$memberData->image = $userImg[1];
					}
					
				}else{
				   unset($_FILES['image']);
				}
				
				//Update member data
				if($teamMemberModel->save($memberData)){
					$this->displaySuccessMessage("Member has been updated successfully");
					return $this->redirect(['controller' => 'users', 'action' => 'edit-user', $userId]);
				}
			}else{

				$this->set([
				'errors' => $memberData->errors(), 
				'_serialize' => ['errors']]);
				//return;
			}
		}
		$memberInfo = $teamMemberModel->get($memberId);
		$main_arr = array('user_id'=>$userId, 'member_id'=>$memberId, 'member_info'=>$memberInfo);
		$this->set('main_arr',$main_arr);	
		
	}
	
	/* @vik 
	* Executive Summary
	*/
	function executiveSummary($userId){
		
		$this->viewBuilder()->layout('admin_dashboard');
		$userIdDecoded=convert_uudecode(base64_decode($userId));
		//Load UserExecutiveSummary model
		$executiveSummaryModel = TableRegistry::get("UserExecutiveSummaries");
		if(isset($this->request->data) && !empty($this->request->data)) {
			
			$executiveSummaryData = $executiveSummaryModel->newEntity($this->request->data['Users']['user_executive_summary'],['validate' => true]);
			$executiveSummaryData->user_id = $userIdDecoded;

			if (!$executiveSummaryData->errors()){
				
				//Update member data
				if($executiveSummaryModel->save($executiveSummaryData)){
					$this->displaySuccessMessage("Member has been updated successfully");
					return $this->redirect(['controller' => 'users', 'action' => 'edit-user', $userId]);
				}
				
			}else{

				$this->set([
				'errors' => $executiveSummaryData->errors(), 
				'_serialize' => ['errors']]);
				//return;
			}
		}
		$memberInfo = $executiveSummaryModel->get($memberId);
		$main_arr = array('user_id'=>$userId);
		$this->set('main_arr',$main_arr);	
	}
	
	/*
	* @vik upload new document
	*/
	function createDoc($userId){
				
		$this->viewBuilder()->layout('admin_dashboard');
		$userIdDecoded=convert_uudecode(base64_decode($userId));
		//Load UserFundingMaterials model
		$fundingMaterialModel = TableRegistry::get("UserFundingMaterials");

		if(isset($this->request->data) && !empty($this->request->data)) {

			$this->request->data['UserFundingMaterials']['user_id'] = $userIdDecoded;
			$docData = $fundingMaterialModel->newEntity($this->request->data['UserFundingMaterials'],['validate' => true]);

			if (!$docData->errors()){
				
				//Upload Document
				if($_FILES['doc']['name']!=''){
					
					$userImg = $this->admin_upload_file('document',$_FILES['doc']);
					$userImg = explode(':',$userImg);
					if($userImg[0]=='error'){
						$this->displayErrorMessage($userImg[1]);
						$this->redirect($this->referer());
					}else{
						$docData->document_path = $userImg[1];
					}
					
				}else{
				   unset($_FILES['doc']);
				}
				
				if($fundingMaterialModel->save($docData)){
					$this->displaySuccessMessage("Document added Successfully");
					return $this->redirect(['controller' => 'users', 'action' => 'edit-user', $userId]);
				}	
			}else{
				//Set errors
				$this->set([
				'errors' => $docData->errors(), 
				'_serialize' => ['errors']]);
				return;
			}
		}
		
		$main_arr = array('user_id'=>$userId);
		$this->set('main_arr',$main_arr);
		
	}


	/**
	* Edit Document
	*/
	function editDoc($userId, $docId){
				
		$this->viewBuilder()->layout('admin_dashboard');
		$userIdDecoded=convert_uudecode(base64_decode($userId));
		//Load UserFundingMaterials model
		$fundingMaterialModel = TableRegistry::get("UserFundingMaterials");
		if(isset($this->request->data) && !empty($this->request->data)) {

		$docData = $fundingMaterialModel->newEntity($this->request->data['UserFundingMaterials'],['validate' => true]);
			$docData->id = $docId;
			
			if (!$docData->errors()){
				//Upload  doc
				if($_FILES['doc']['name']!=''){
					
					$userImg = $this->admin_upload_file('document',$_FILES['doc']);
					$userImg = explode(':',$userImg);
					if($userImg[0]=='error'){
						$this->displayErrorMessage($userImg[1]);
						$this->redirect($this->referer());
					}else{
						$docData->document_path = $userImg[1];
					}
					
				}else{
				   unset($_FILES['doc']);
				}
				
				//Update member data
				if($fundingMaterialModel->save($docData)){
					$this->displaySuccessMessage("Document has been updated successfully");
					return $this->redirect(['controller' => 'users', 'action' => 'edit-user', $userId]);
				}
			}else{

				$this->set([
				'errors' => $memberData->errors(), 
				'_serialize' => ['errors']]);
				//return;
			}
		}
		$docInfo = $fundingMaterialModel->get($docId);
		$main_arr = array('user_id'=>$userId, 'doc_id'=>$docId, 'doc_info'=>$docInfo);
		$this->set('main_arr',$main_arr);	
	
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
		  //$EmailsModel->_locale = $session->read('requestedLanguage');
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
		  //$CmsPagesModel->_locale = $session->read('requestedLanguage');
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
		  //$CmsPagesModel->_locale = $session->read('requestedLanguage');
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
		  //$EmailTemplateModel->_locale = $session->read('requestedLanguage');
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
					  //$emailTemplateModel->_locale = $session->read('setRequestedLanguageLocale');
					  //$emailTemplateData->_locale = $session->read('setRequestedLanguageLocale');
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
		  //$ContactRequestModel->_locale = $session->read('requestedLanguage');
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
		  //$ContactRequestModel->_locale = $session->read('requestedLanguage');
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
		  //$ContactRequestModel->_locale = $session->read('requestedLanguage');
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

	
}
?>