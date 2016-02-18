<script type="text/javascript">
$(document).ready(function(){

	$('#editAdminform').validate();
});
</script>
  <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard 
                        <small>Add <?php echo(@$page['Admin']['type'] == 1 ? 'SUB ' : '' ); ?>FAQ Detail</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo HTTP_ROOT.'admin/Faq/dashboard'; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="active">Add <?php echo(@$page['Admin']['type'] == 1 ? 'SUB ' : '' ); ?>Admin Detail</li>
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
                                    <h3 class="box-title">Add Detail</h3>
                                </div><!-- /.box-header -->
								
								<form role="form" class="forms" id="editAdminform" method="post" action="<?php echo HTTP_ROOT;?>admin/cms_pages/add_faq" enctype="multipart/form-data">
									<div class="box-body">
                                       
										
										<div class="form-group">
										     <label for="quetion">Question</label>
										    <input type="text" class="form-control required" id="quetion" name="data[Faq][que]" value="" >
										</div>
										<div class="form-group">
										    <label for="answer">Answer</label>
											<textarea class="form-control required" id="answer" name="data[Faq][ans]" value=""></textarea>
										  
										</div>	
										<!--<div class="form-group">
                                            <label for="category">FAQ Category</label>
											<select class="form-control required" id="category" name="data[Faq][cat]"  value="">
											   <option value="" selected disabled >Select Category</option>
											   <option value="1" ></option>
									           <option value="2" ></option>
									           <option value="3" ></option>
											</select>
                                        </div>  -->
									   
												 
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

<div class="clear"></div>
<style>
#error_msg
{
	float:none;
	width:20%;
	position:relative;
	top:10px;
	left:10px;
}
</style>
