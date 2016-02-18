<?php @$successVal = $this->request->session()->read("success"); 
if($successVal !=""){ ?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
						 <button class="close show-success-msg" aria-label="Close" data-dismiss="alert" type="button">
						 <strong>Success!</strong>
					<?php echo  @$this->request->session()->read("success");
					 @$this->request->session()->write("success","");
					?>
			</div>
			
<?php }
?>