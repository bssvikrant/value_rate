<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        FAQ
                        <small>View</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo HTTP_ROOT ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a href="<?php echo HTTP_ROOT."admin/CmsPages/faqs"; ?>">FAQ</a></li>
                        <li class="active">View</li>
                    </ol>
					
					<div style="border:none; margin-top:20px;" class="content-box content-box-header">
					
						<button class="btn btn-primary btn-sm" onClick="javascript:history.go(-1)" style="float:right;margin-bottom:10px;">Back</button>
						<div class="box-body table-responsive">			
							<table class="table table-bordered table-hover dataTable"> 
								<tbody>
									<!--<tr>							
										<th width="10%;">Id</th> 
										<td width="30%;"><?php echo $getFaqInfo['Faq']['id']; ?></td> 
									</tr>-->
									<tr> 
										<th width="10%;">Question</th> 
										<td width="30%;"><?php echo $getFaqInfo['Faq']['que']; ?></td> 
									</tr>
									<tr>
										<th width="10%;">Answer</th>
										<td width="30%;"><?php echo $getFaqInfo['Faq']['ans']; ?></td>
									</tr>
							   </tbody>
							</table>
							<div class="clear"></div>
						</div>
            		</div>
					
					
                </section>

                <!-- Main content -->
                <section class="content">
                 

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<style>
th
{
	font-weight:bold;
}
</style>

