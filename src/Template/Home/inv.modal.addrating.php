  <!-- Modal -->
  <div class="modal fade" id="investmentRating" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Investment Rating </h4>
        </div>
        <div id="rating">
        </div>
        <div class="modal-body">
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
			<?php 

				echo $this->Form->input('investmentRating.diligence',[
				'label' => false,
				'type'=>'select',
				'options'=>array('regulatory'=>'Regulatory Environment','legal'=>'Legal Environment','financial'=>'Financial Strength','commercial'=>'Commercial Opportunity','technical'=>'Technical Foundation','people'=>'People'),
				'placeholder'=>'Rating',
				'class'=>'form-control']);
				?>

				
				<!--span aria-hidden="true" class="fa fa-picture-o form-control-feedback left"></span-->
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
			<?php 

				echo $this->Form->input('investmentRating.rating',[
				'label' => false,
				'type'=>'select',
				'options'=>array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),
				'placeholder'=>'Rating',
				'class'=>'form-control']);
				?>
				
				
				<!--span aria-hidden="true" class="fa fa-picture-o form-control-feedback left"></span-->
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
			<?php 
				echo $this->Form->input('investmentRating.note',[
				'label' => false,
				'class'=>'form-control',
				'placeholder'=>'Note',
				'type'=>'textarea']);
				?>
				<!--span aria-hidden="true" class="fa fa-globe form-control-feedback right"></span-->
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
			<button type="button" placeholder="Button" class="form-control" id="submitRatingInvester">Submit Rating</button>
				<!--span aria-hidden="true" class="fa fa-globe form-control-feedback right"></span-->
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<!-- src/Template/Home/inc.modal.addrating.php --> 
