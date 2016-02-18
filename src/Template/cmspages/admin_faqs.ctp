<?php
		$adminId=$this->session->read('Admin.id');
	$adminType=$this->session->read('Admin.type');
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
							var check = confirm("Do you really want to delete record ?"); 
							if(check==true)
							{
								document.myform.action =ajax_url+'admin/cms_pages/all_manage/Faq';
								document.myform.submit();
							}
							else
							{
								$('#act').val('');
							}
						}
						else if($('#act').val()==2)
						{
							var result = confirm("Do you want to activate records?");
							if(result) {
								document.myform.action =ajax_url+'admin/cms_pages/all_manage/Faq';
								document.myform.submit();
							}
							else
							{
								$('#act').val('');
							}
						}
						else if($('#act').val()==3)
						{
							var result = confirm("Do you want to deactivate records?");
							if(result) {
								document.myform.action =ajax_url+'admin/cms_pages/all_manage/Faq';
								document.myform.submit();
							}
							else
							{
								$('#act').val('');
							}
						}
					}
					else
					{
						alert('Please select atleast one record.');
						$('#act').val('');
						return false;
					}
				}
		});	
});
</script>
<?php 
	  $opt = $this->request->url;
      $url = base64_encode($opt);
?>
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Faq</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo HTTP_ROOT."admin/cms_pages/dashboard" ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="active">Faq</li>
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
							<div class="box filterBox">
                                <div class="box-header">
                                    <h3 class="box-title">Search</h3>
                                    <div class="box-tools pull-right">
                                        <button title="" data-toggle="tooltip" data-widget="collapse" class="btn btn-default btn-sm" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                       
                                    </div>
                                </div>
                                <div class="box-body" style="display: block;float:left;width:95%;">
                                    <form method="get" name="filters" action="<?php echo HTTP_ROOT;?>admin/cms_pages/faqs">
										<!--<div class="filter">
										    <label class="searchLabel">FAQ Id</label>
											<input class="form-control searchInput" type="text" name="data[Faq][id]" value="<?php if(isset($_GET['data']['Faq']['id']) && $_GET['data']['Faq']['id']!=""){ echo $_GET['data']['Faq']['id']; } ?>" />
										</div>-->
										<div class="filter">
										    <label class="searchLabel">Question</label>
											<input class="form-control searchInput" type="text" name="data[Faq][que]" value="<?php if(isset($_GET['data']['Faq']['que']) && $_GET['data']['Faq']['que']!=""){ echo $_GET['data']['Faq']['que']; } ?>" />
										</div>
										<div class="filter">
										    <label class="searchLabel">Answer</label>
											<input class="form-control searchInput" type="text" name="data[Faq][ans]" value="<?php if(isset($_GET['data']['Faq']['ans']) && $_GET['data']['Faq']['ans']!=""){ echo $_GET['data']['Faq']['ans']; } ?>" />
										</div>
										<!--<div class="filter">
										    <label class="searchLabel">FAQ Category</label>
											<select  class="form-control searchInput FAQLength"  name="data[Faq][cat]" value="">
											   <option value="" selected >All</option>
											   <option value="1" ></option>
									           <option value="2" > </option>
									           <option value="3" ></option>
											</select>                     
										</div>-->
										<div class="filter">
											<button type="submit" class="btn btn-primary btn-sm filterbutton faqfilter">Filter</button>
										</div>
									</form>
                                </div><!-- /.box-body -->
                               
                            </div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-xs-12">
							<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">FAQ List</h3>   
										<div class="addNew">
											<a href="<?php echo HTTP_ROOT.'admin/cms_pages/add_faq'; ?>"><button type="submit" class="btn btn-primary btn-sm filterbutton">Add New FAQ</button></a>						
										</div>						
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								 <form name="myform" class="pager-form" method="post">
                                    <table  class="table table-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
												<?php $arrow = @$this->params['named']['direction'];
													  $sortBy = @$this->params['named']['sort'];
													  $sortByLabel = end((explode('.',$sortBy))); 		

												?>
												 <?php if($adminType==1){?><!--<th><input type="checkbox" id="checkAll" ></th>--><?php } ?>
                                              
                                               <th class="<?php echo $arrow== 'asc' && $sortByLabel=='id' ? 'sorting_asc' : (@$this->params['named']['direction'] == 'desc' && $sortByLabel=='id' ? 'sorting_desc' : 'sorting') ?>"><?php echo $this->Paginator->sort('Faq.id', 'Id')?></th>
											   
												<th class="<?php echo $arrow == 'asc' && $sortByLabel=='que'? 'sorting_asc' : (@$this->params['named']['direction'] == 'desc' && $sortByLabel=='que'? 'sorting_desc' : 'sorting') ?>"><?php echo $this->Paginator->sort('Faq.que', 'Question')?></th>
												
												<th class="<?php echo $arrow == 'asc' && $sortByLabel=='ans'? 'sorting_asc' : (@$this->params['named']['direction'] == 'desc' && $sortByLabel=='ans'? 'sorting_desc' : 'sorting') ?>"><?php echo $this->Paginator->sort('Faq.ans', 'Answer')?></th>
												
												<th class="<?php echo $arrow == 'asc' && $sortByLabel=='date_added'? 'sorting_asc' : (@$this->params['named']['direction'] == 'desc' && $sortByLabel=='date_added'? 'sorting_desc' : 'sorting') ?>"><?php echo $this->Paginator->sort('Faq.date_added', 'Added Date')?></th>

											<!--	<th class="<?php echo $arrow == 'asc' && $sortByLabel=='cat'? 'sorting_asc' : (@$this->params['named']['direction'] == 'desc' && $sortByLabel=='cat'? 'sorting_desc' : 'sorting') ?>"><?php echo $this->Paginator->sort('Faq.cat', 'FAQ Category')?></th>-->
		                                        
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php if(sizeof($faqs) > 0) {?>
                                    <?php foreach($faqs as $showfaqs) { ?>
                                        <tr>
                                                 
                                            <td><?php echo $showfaqs['Faq']['id'] ?></td> 
						                    <td><?php echo $showfaqs['Faq']['que']; ?></td> 
											<td><?php echo $showfaqs['Faq']['ans'];	?></td>
											<td><?php echo $showfaqs['Faq']['date_added'];	?></td>
											<!--<td><?php echo $showfaqs['Faq']['cat'];?></td>-->
											
											<td>
                                            	<?php $myAr = array('0'=>'','1'=>'');
												 $target = array('0'=>'1','1'=>'0');
												?>
                                                <?php  ?><a title="View Model" href="<?php echo HTTP_ROOT."admin/cms_pages/faq_view/".base64_encode(convert_uuencode($showfaqs['Faq']['id']));?>" class="btn btn-app first">
                                                    <span class="fa fa-fw fa-search"></span>
                                                </a>
												<?php  ?>
                                                <a title="Edit Order" href="<?php echo HTTP_ROOT."admin/cms_pages/faq_edit/".base64_encode(convert_uuencode($showfaqs['Faq']['id']));?>" class="btn btn-app">
                                                    <span class="fa fa-fw fa-pencil"></span>
                                                </a>
                                                
                                                <?php if($adminType==0 && $adminId==1){?>
                                                <a title="Delete" href="<?php echo HTTP_ROOT."admin/Faq/delete/".'Faq'.'/'.base64_encode(convert_uuencode($showfaqs['Faq']['id']))?>" onclick="if(!confirm('Are you sure to delete this FAQ?')){return false;}" class="btn btn-app">
                                                    <span class="fa fa-fw fa-trash-o"></span>
                                                </a>
                                                <?php } ?>	
											</td>
											
										</tr> 
                                    <?php } } else { ?>
                                        <tr><td class="noRecords" colspan="7" style=" text-align:center;"> No records found </td></tr>
                                    <?php } ?>				
                                           
                                        </tbody>
                                       
                                    </table>
									<!--<div class="row">
										<?php if($adminType=='0' && $adminId=='1'){ ?>
										<div id="actions" style="float: left; width: 96%; margin: 10px;">
											<label style="float: left; width: auto; margin: 0 5px;" class="desc" for="firstname">Perform action</label>				
											 <select id="act" class="field select required" name="act">
												<option value="">Choose option</option>
												<option value="1" >Delete Selected</option>
											 </select>
										</div>
										<?php } ?> 
									</div>-->
									</form>
									<div class="row">
										<?php echo $this->element('adminElements/new_paginator'); ?>	
									</div>
									 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                           
                        </div>
                    </div>
					
                </section><!-- /.content -->
            </aside><!-- /.right-side -->