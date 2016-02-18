<div class="item form-group">
<?php  
   if(isset($errors) && count($errors) > 0){
	    $newErrorArray=array();
		foreach($errors as $key => $value) {
			foreach($value as $newVal){
				$newErrorArray[] = $newVal;
			}
		}
		
		foreach($newErrorArray as $displayError){
			if(is_array($displayError)){
				echo '<button class="close show-errors" aria-label="Close" data-dismiss="alert" type="button">'.$displayError['_empty']."</button><br/>";
			}else{
				echo '<button class="close show-errors" aria-label="Close" data-dismiss="alert" type="button">'.$displayError."</button><br/>";	
			}
				
		}
	}
?>
</div>
<style>

button.close {
    padding: 3px 0px !important;
    cursor: pointer;
    background: transparent;
    font-weight: normal !important;
    font-size: 14px;
    border: 1px solid red;
    color: red !important;
    padding-left: 15px !important;
    opacity: 1 !important;
    width: 98%;
    float: left !important;
    margin-left: 10px;
}
</style>