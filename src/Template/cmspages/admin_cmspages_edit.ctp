<?php echo $this->element('adminElements/main_editor');?>
<script type="text/javascript">
$(document).ready(function() {

	$('#editCmsPageForm').validate();
});
</script>
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Pages
                        <small>Page Edit</small>
                    </h1>
                   <ol class="breadcrumb">
						<li><a href="<?php echo HTTP_ROOT.'admin/Users/dashboard'; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li><a href="<?php echo HTTP_ROOT.'admin/cms_pages/cms_pages'; ?>"><i class="fa fa-list-alt"></i> Pages</a></li>
						<li class="active">Edit Page</li>
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
                                    <h3 class="box-title">Edit Page</h3>
                                </div><!-- /.box-header -->
									<form class="forms" id="editCmsPageForm" method="post" action="<?php echo HTTP_ROOT;?>admin/cms_pages/cmspages_edit">
									<input type="hidden" name="data[CmsPage][id]" value="<?php echo $page['CmsPage']['id']; ?>" />
										
                                    <div class="box-body">
										<div class="form-group">
                                            <label for="title">Title</label>
												<input  class="form-control required" name="data[CmsPage][pagename]" type="text" value="<?php echo $page['CmsPage']['pagename'];?>" />
                                        </div>
										
										<?php if($page['CmsPage']['pageurl'] != 'contact-us'){ 
													 ?>
														<div class="form-group">
															<label for="description">Description</label>
																<textarea id="elm2" class="tinymce" rows="15" cols="80" style="width:100%" name="data[CmsPage][pagecontent]"><?php echo $page['CmsPage']['pagecontent']; ?></textarea>
														</div>
														
										<?php  }?>
										<?php if($page['CmsPage']['pageurl'] == 'contact-us'){ ?>
											<div class="form-group">
												<label for="title">Company Name</label>
													<input  class="form-control required" name="data[CmsPage][company_name]" type="text" value="<?php echo $page['CmsPage']['company_name'];?>" />
											</div>
											<div class="form-group">
												<label for="title">Phone</label>
													<input  class="form-control required" name="data[CmsPage][phone_no]" type="text" value="<?php echo $page['CmsPage']['phone_no'];?>" />
											</div>
											<div class="form-group">
												<label for="title">Email</label>
													<input  class="form-control required email" name="data[CmsPage][email]" type="text" value="<?php echo $page['CmsPage']['email'];?>" />
											</div>
											<div class="form-group">
												<label for="title">Location</label>
													<input  class="form-control required " name="data[CmsPage][location]" type="text" value="<?php echo $page['CmsPage']['location'];?>" />
											</div>
												
											
										<?php } ?>
                                        
										<div class="form-group">
												<label for="title"> Meta Title</label>
													<input  class="form-control required" name="data[CmsPage][meta_title]" type="text" value="<?php echo $page['CmsPage']['meta_title'];?>" />
										</div>
										
										<div class="form-group">
												<label for="title"> Meta Keyword</label>
													<input  class="form-control required" name="data[CmsPage][meta_keywords]" type="text" value="<?php echo $page['CmsPage']['meta_keywords'];?>" />
										</div>										
										
										<div class="form-group">
												<label for="title">Meta Description</label>
													<input  class="form-control required" name="data[CmsPage][meta_description]" type="text" value="<?php echo $page['CmsPage']['meta_description'];?>" />
										</div>	
										
									
                                      
										
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

