<?php
	$adminId=$this->Session->read('Admin.id');
	$adminType=$this->Session->read('Admin.type');
?>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#act').change(function(){
						
					if($('#act').val()!="")
					{					
						if($('.selectCheck').is(':checked'))
						{
							if($('#act').val()==1)
							{
								var result = confirm("Do you want to Delete records?");
								if(result) {
									document.myform.action =ajax_url+'admin/Users/all_manage/CmsPage';
									document.myform.submit();
								}
							}
							else if($('#act').val()==2)
							{
								var result = confirm("Do you want to show records?");
								if(result) {
									document.myform.action =ajax_url+'admin/Users/all_manage/CmsPage';
									document.myform.submit();
								}
							}
							else if($('#act').val()==3)
							{
								var result = confirm("Do you want to hide records?");
								if(result) {
									document.myform.action =ajax_url+'admin/Users/all_manage/CmsPage';
									document.myform.submit();
								}
							}
						}
						else
						{
							alert('Please select atleast one record.');
							location.reload();
							return false;
						}
					}
				});
			});
		</script>
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Pages</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo HTTP_ROOT.'/admin/Users/dashboard'; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="active">Pages</li>
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
                        <div class="col-xs-12">
							<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Pages List</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table  class="table table-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
												<?php $arrow = @$this->params['named']['direction'];
													  $sortBy = @$this->params['named']['sort'];
													  $sortByLabel = end((explode('.',$sortBy))); 		

												?>
                                               <th class="<?php echo $arrow== 'asc' && $sortByLabel=='pagename' ? 'sorting_asc' : (@$this->params['named']['direction'] == 'desc' && $sortByLabel=='pagename' ? 'sorting_desc' : 'sorting') ?>"><?php echo $this->Paginator->sort('CmsPage.pagename', 'Page name')?></th>
												<th class="<?php echo $arrow == 'asc' && $sortByLabel=='pagecontent'? 'sorting_asc' : (@$this->params['named']['direction'] == 'desc' && $sortByLabel=='pagecontent'? 'sorting_desc' : 'sorting') ?>"><?php echo $this->Paginator->sort('CmsPage.pagecontent', 'Page content')?></th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
											 <?php if(sizeof($cmsPages) > 0) {?>
												<?php foreach($cmsPages as $pages) { ?>
													<tr>
														<td><?php echo $pages['CmsPage']['pagename']?></td>
														<td><?php 
															if(!empty($pages['CmsPage']['pagecontent']))
															{
																echo substr(strip_tags($pages['CmsPage']['pagecontent']),0,100);
															}
															else
															{
																echo $pages['CmsPage']['company_name'].'<br />'.$pages['CmsPage']['location'].'<br />'.$pages['CmsPage']['email'].'<br />'.$pages['CmsPage']['phone_no'];
															}
														?></td>  
													
														<td>
														<?php $target = array('0'=>'1', '1'=>'0'); ?>
															<a title="Edit" href="<?php echo HTTP_ROOT."admin/cms_pages/cmspages_edit/".base64_encode(convert_uuencode($pages['CmsPage']['id']))?>" class="btn btn-app first">
															<span class="fa fa-fw fa-pencil"></span>
														</a>
														</td>
													</tr> 
												<?php } } else { ?>
												<tr><td class="noRecords" colspan="5" style=" text-align:center;"> No records found </td></tr>
											<?php } ?>
                                        </tbody>
                                       
                                    </table>
									<div class="row">
										<?php echo $this->element('adminElements/new_paginator'); ?>	
									</div>
									 <div id="pager" style="float:left; width:97%; padding-left:7px;">
										
									</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                           
                        </div>
                    </div>
					
                </section><!-- /.content -->
            </aside><!-- /.right-side --> 
