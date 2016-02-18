<?php echo $this->element('adminElements/main_editor');?>
<script type="text/javascript">
$(document).ready(function() {

	$('#editEmailTemplate').validate();
});
</script>
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Email Template
                        <small>Email Template Edit</small>
                    </h1>
                    <ol class="breadcrumb">
						<li><a href="<?php echo HTTP_ROOT.'admin/Users/dashboard'; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li><a href="<?php echo HTTP_ROOT.'admin/cms_pages/email_templates'; ?>"><i class="fa fa-envelope"></i> Email Templates</a></li>
						<li class="active">Edit Email Template</li>
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
                                    <h3 class="box-title">Edit Template</h3>
                                </div><!-- /.box-header -->
									<form role="form" class="forms" id="editEmailTemplate" method="post" action="<?php echo HTTP_ROOT;?>admin/cms_pages/email_template_edit">
										<input type="hidden" name="data[EmailTemplate][id]" value="<?php echo $emailTemp['EmailTemplate']['id']; ?>" />
										
                                    <div class="box-body">
                                      
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input  class="form-control required"  name="data[EmailTemplate][title]" type="text" id="title" value="<?php echo $emailTemp['EmailTemplate']['title']?>" >
                                        </div>
										
										<div class="form-group">
                                            <label for="subject">Subject</label>
                                          <input id="subject" class="form-control required" name="data[EmailTemplate][subject]" type="text" value="<?php echo $emailTemp['EmailTemplate']['subject']?>" />
                                        </div>
                                       
									   <div class="form-group">
                                            <label for="shortcode">Short Codes (Note: Don't change short codes in description)</label>
                                          <input id="shortcode" class="form-control required" disabled readonly="readonly" type="text" value="<?php echo $emailTemp['EmailTemplate']['allowed_vars']?>" />
                                        </div>
                                       <div class="form-group">
                                            <label for="from">From</label>
                                          <input  id= "from" class="form-control required" name="data[EmailTemplate][from]" type="text" value="<?php echo $emailTemp['EmailTemplate']['from']?>" />
                                        </div>
										<div class="form-group">
                                            <label for="Description">Description</label>
                                          <textarea id="elm1" class="tinymce" rows="15" cols="80" style="width:100%" name="data[EmailTemplate][description]"><?php echo $emailTemp['EmailTemplate']['description']; ?></textarea>
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


	