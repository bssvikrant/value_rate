<!DOCTYPE html>
<?php $languageSession = $this->request->session(); ?>
<html xml:lang="<?php echo $languageSession->read('requestedLanguage'); ?>" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta property="og:locale" content="<?php echo $languageSession->read('setRequestedLanguageLocale'); ?>" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo SITE_TITLE;?> </title>

    <!-- Bootstrap core CSS -->

	<?php echo $this->Html->css(['Admin/bootstrap.min.css','Admin/fonts/css/font-awesome.min.css','Admin/animate.min.css','Admin/custom.css','Admin/icheck/flat/green.css']); ?>
	
	<?php echo $this->Html->script(['Admin/jquery.min.js','Admin/bootstrap.min.js','Admin/nicescroll/jquery.nicescroll.min.js','Admin/icheck/icheck.min.js','Admin/custom.js','Admin/moment.min2.js','Admin/datepicker/daterangepicker.js','Admin/validator/validator.js','Admin/skycons/skycons.js']); ?>

</head>


<body class="nav-md">

    <div class="container body">
        <div class="main_container">
		
             <?= $this->element('adminElements/left_sidebar_lte'); ?>
			 <?= $this->element('adminElements/dashboard_header'); ?>
			 
		 <div class="right_col" role="main">
			 <?= $this->fetch('content');?>
			 <?= $this->element('adminElements/dashboard_footer'); ?>
		 </div>	 
			
			 
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

	<!-- skycons -->
	 <script>
        var icons = new Skycons({
                "color": "#73879C"
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);

        icons.play();
    </script>
	<style>
		th.column-title a {
			color: #fff !important;
		}
	</style>
</body>

</html>

