<script>
$(document).ready(function() {
	$('#csvform').validate();
	$('#submit').click(function() {
		if ($('#mycsv').val() != '')
		{
			$('#loader').css('display', 'block');		
		}
	});
});
</script>
<style>
#loader {
	display:none;	
}
</style>
<div id="sub-nav">
	<div class="page-title">
		<h1>SEND TEST EMAIL</h1>
		<span><a href="javascript:void(0)" title="Manage">Manage </a> > <a href="javascript:void(0)" title="Newsletters">Newsletters</a> > <a href="javascript:void(0);" title="Send Test Mail">Send Test Mail</a></span>
	</div>	   
</div>     
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php CakeSession::delete('success'); ?>
			<?php } ?>
            <?php if($this->Session->check('error')){ ?>
                <div class="response-msg error ui-corner-all">
                    <span>Error message</span>
                    <?php echo $this->Session->read('error');?>
                </div>
                <?php CakeSession::delete('error'); ?>
			<?php } ?>
			<div class="content-box content-box-header" style="border:none; clear:both">
                <div class="column-content-box">
                    <div class="ui-state-default ui-corner-top ui-box-header">
                    </div>
                    <div class="content-box-wrapper">
                        <form class="forms" id="csvform" method="post" action="<?php echo HTTP_ROOT;?>admin/cms_pages/send_test_email" enctype="multipart/form-data">
                        	<input type="hidden" name="data[Newsletter][id]" value="<?php echo $id;?>"/>
                            <fieldset>
                                <ul>
                                   <li>
                                        <label class="desc" for="firstname">SEND TEST EMAIL</label>
                                        <div style="width:250px; float:left"><input class="field file email required" name="data[Email][name]" type="text" style="width:120%" /></div>
                                    </li>
                                    <li>
                                        <input class="submit ui-state-default ui-corner-all float-left ui-button" type="submit" id="submit" value="Submit"/>
                                        <input class="submit ui-state-default ui-corner-all float-left ui-button" type="button" value="Cancel" style="margin-left:10px;" onclick="history.go(-1)"/>
                                    </li>
                                </ul>
                            </fieldset>
                        </form>
                    </div>
                 </div>
			</div>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>