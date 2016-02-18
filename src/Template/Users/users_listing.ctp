<?php

	//$adminId=$this->Session->read('Admin.id');
	//$adminType=$this->Session->read('Admin.type');
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
									document.myform.action =ajax_url+'admin/Users/all_manage/Users';
									document.myform.submit();
								}
							}
							else if($('#act').val()==2)
							{
								var result = confirm("Do you want to show records?");
								if(result) {
									document.myform.action =ajax_url+'admin/Users/all_manage/Users';
									document.myform.submit();
								}
							}
							else if($('#act').val()==3)
							{
								var result = confirm("Do you want to hide records?");
								if(result) {
									document.myform.action =ajax_url+'admin/Users/all_manage/Users';
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
<div class="">
 
	
	<div class="row">
	              
	              <?= $this->element("adminElements/success_msg"); ?>
				   
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2> Investment Listing</h2>
					 <a style="float:right" href="<?php echo HTTP_ROOT.'users/add-new-user'; ?>"><button class="btn btn-success addUser" type="button">Add New Invetment</button></a>
					<!--<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
						<li class="dropdown">
							<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-wrench"></i></a>
							<ul role="menu" class="dropdown-menu">
								<li><a href="#">Settings 1</a>
								</li>
								<li><a href="#">Settings 2</a>
								</li>
							</ul>
						</li>
						<li><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul>-->
					<div class="clearfix"></div>
				</div>

				<div class="x_content">
                    
                   
					<div class="clearfix"></div>
					
					<!--<p>Click on <code>check boxes</code> from table for bulk actions options on row select</p>-->
                   
					<table id="example" class="table table-striped responsive-utilities jambo_table">
						<thead>
							<tr class="headings">
								<th>
									 <!--<input type="checkbox" class="tableflat">-->
									 Sr.No.
								</th>
								<th class="column-title"><?php echo $this->Paginator->sort('Users.name', 'Name')?> </th>
								<th class="column-title"><?php echo $this->Paginator->sort('Users.email', 'Email')?></th>
								<th class="column-title"><?php echo $this->Paginator->sort('Users.phone', 'Phone')?></th>
								<th class="column-title"><?php echo $this->Paginator->sort('Users.date_added', 'Added Date')?></th>
								<th class="column-title"><?php echo $this->Paginator->sort('Users.status', 'Status')?></th>
								<th class="column-title no-link last"><span class="nobr">Share investments</span>
								<th class="column-title no-link last"><span class="nobr">View</span>
								<th class="column-title no-link last"><span class="nobr">Action</span>
								</th>
								
							</tr>
						</thead>

						<tbody>
						 <?php if(sizeof($users_info) > 0) {
						    $i=1;
						 ?>
							<?php foreach($users_info as $user_info) { 
							//echo $user_info->title;
								if($i%2==0){$class="even pointer";}else{$class="odd pointer";}
							?>
							<tr class="<?php echo $class; ?>">
								<td class="a-center "></td>
								<td class=" "><?php echo $user_info->name; ?></td>
								<td class=" "><?php 
											echo $user_info->email;
								?></td>
								<td class=" "><?php 
											echo $user_info->phone;
								?></td>
								<td class=" "><?php echo date("F j, Y",strtotime($user_info->date_added)); ?></td>
								 <td><?php echo $user_info->status == 1?'Active':'Inactive';	?></td>
								 <td>
									<a title="share investments" href="<?php echo HTTP_ROOT."users/share_investments/".base64_encode(convert_uuencode($user_info->id));?>"  target="_blank" >Share investments</a>
								 </td>
								 <td>
									<a title="View Profile" href="<?php echo HTTP_ROOT."public-profile/".base64_encode(convert_uuencode($user_info->id));?>"  target="_blank" >View Profile</a>
								 </td>
								<?php $target = ['0'=>'1','1'=>'0'];?>
								<td class=" last">
								   <a title="<?php echo($user_info->status == 0?'Activate status':'Deactivate Status') ?>" href="<?php echo HTTP_ROOT."users/update-status-row/".'Users'.'/'.base64_encode(convert_uuencode($user_info->id)).'/'.$target[$user_info->status];?>" ><span class="fa fa-fw fa-check-square<?php echo($user_info->status ==0?'-o':'') ?>"></span></a>
								 
								  <a title="Edit" href="<?php echo HTTP_ROOT."users/edit-user/".base64_encode(convert_uuencode($user_info->id));?>"><span><i class="fa fa-pencil-square"></i></span></a>
								   
								   <a title="Delete" href="<?php echo HTTP_ROOT."users/delete-row/".'Users'.'/'.base64_encode(convert_uuencode($user_info->id));?>" onclick="if(!confirm('Are you sure to delete this Investment?')){return false;}" ><span class="fa fa-fw fa-trash-o"></span></a>
								</td>
							</tr>
							<?php $i++; 
							} 
							} else { ?>
								<tr class="even pointer">
									<td class="noRecords" colspan="7" style=" text-align:center;"> No records found </td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<?php // echo $this->element('adminElements/new_paginator'); ?>	
			</div>
			<div id="pager" style="float:left; width:97%; padding-left:7px;">
			</div>
		</div>
	</div>
</div>	

<!-- Datatables -->
		<?php echo $this->Html->script(['datatables/js/jquery.dataTables.js','datatables/tools/js/dataTables.tableTools.js']); ?>
		
       
        <script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
					"fnRowCallback" : function(nRow, aData, iDisplayIndex){
						$("td:first", nRow).html(iDisplayIndex +1);
					   return nRow;
					},
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
					],
                    'iDisplayLength': 12,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                        "sSwfPath": "<?php echo HTTP_ROOT.'webroot/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'; ?>"
                    }
                });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });
        </script>