<script type="text/javascript">
$(document).ready(function() {
	$('#editmemberform').validate();
});
</script>
 <!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			FAQ
			<small>Edit FAQ Detail</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo HTTP_ROOT.'admin/Faq/dashboard'; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="<?php echo HTTP_ROOT.'admin/Faq/faqs'; ?>"><i class="fa fa-dashboard"></i> FAQ</a></li>
			<li class="active">Edit FAQ Detail</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<?php if($this->Session->check('success')){ ?>
			<div class="alert alert-success alert-dismissable">
							<i class="fa fa-check"></i>
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							<b>Success!</b> <?php echo $this->Session->read('success');?>
			</div>
			<?php CakeSession::delete('success'); ?>
		<?php } ?>
		<?php if($this->Session->check('error')){ ?>
			<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i>
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<b>Error message!</b> <?php echo $this->Session->read('error');?>
			</div>	
			
			<?php CakeSession::delete('error'); ?>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Edit FAQ Detail</h3>
					</div><!-- /.box-header -->
					
					<form role="form" class="forms" id="editmemberform" method="post" action="<?php echo HTTP_ROOT.'admin/Cms_Pages/faq_edit/'.$this->params['pass'][0];?>" enctype="multipart/form-data">
					          
					     <input type="hidden" name="data[Faq][id]" value="<?php echo @$faqInfo['Faq']['id'] ? $faqInfo['Faq']['id'] : $_POST['data']['Faq']['id']; ?>" />
							
				        <div class="box-body">
						    <div class="form-group">
								<label for="Question">Question</label>
								<input id="Question" class="form-control required" name="data[Faq][que]" type="text" value="<?php echo @$faqInfo['Faq']['que'] ? $faqInfo['Faq']['que'] : (@$_POST['data']['Faq']['que'] ? $_POST['data']['Faq']['que'] : '')?>" />
							</div>
							<div class="form-group">
									<label for="answer">Answer</label>
								   <textarea  id="answer" class="form-control required" name="data[Faq][ans]" value="<?php echo @$faqInfo['Faq']['ans'] ? $faqInfo['Faq']['ans'] : (@$_POST['data']['Faq']['ans'] ? $_POST['data']['Faq']['ans'] : '')?>"  ><?php echo $faqInfo['Faq']['ans']; ?></textarea>	
									
									
							</div>
                            <!--<div class="form-group">
									<label for="answer">Category</label>
									<?php   $category=@$faqInfo['Faq']['cat'] ; ?>
								    <select id="answer" class="form-control required" name="data[Faq][cat]" >
									    <option value="1" <?php if($category==1){echo "selected";} ?>></option>
									    <option value="2" <?php if($category==2){echo "selected";} ?>></option>
									    <option value="3" <?php if($category==3){echo "selected";} ?>></option>
									</select>
							</div>		-->						
						
                          
						</div><!-- /.box-body -->
                        <div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="button" class="btn btn-primary" onclick="history.go(-1)">Cancel</button>
						</div>
					</form>
				</div><!-- /.box -->	
			</div>
		</div>
		
	</section><!-- /.content -->
</aside><!-- /.right-side -->
