<?php @$errrVal = $this->request->session()->read("error"); 
if($errrVal !=""){ ?>
			
						 <button class="close show-errors" aria-label="Close" data-dismiss="alert" type="button">
						 <strong>ERROR!</strong>
					<?php echo  @$this->request->session()->read("error");
					 @$this->request->session()->write("error","");
					?>
			
<?php }
?>