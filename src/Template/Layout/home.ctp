<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo SITE_TITLE; ?> | </title>
	
	<?=	 $this->Html->css(['Home/bootstrap.min.css','Home/carousel.css','Home/styles.css','Home/font-awesome.min.css','Home/font-awesome.css']); ?>
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    
  </head>
  <body>  	
  
<?php echo $this->element('homeElements/header'); ?>
<?php echo $this->fetch('content'); ?>
<?php echo $this->element('homeElements/footer'); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<?php echo $this->Html->script(['Home/bootstrap.min.js', ]); ?>
	<?php //echo $this->Html->script(['Home/bootstrap.js', 'Home/bootstrap.min.js', 'Home/npm.js']); ?>
    <!--script src="js/docs.min.js"></script-->
	<script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--script src="js/ie10-viewport-bug-workaround.js"></script-->
  </body>
</html>
<?php 
  $session = $this->request->session();
  $userData  = $session->read('User');
?>
<script type="text/javascript">
// Template/Layout/home.ctp
// Code for adding rating to exicutive summaries 
$(document).ready(function(){
  var userId = "<?php echo $userData['id']; ?>";
 
  var executiveId;
  $('.ratingmodal').click(function(e){
    executiveId = $(this).attr('exeicutive-id');
   
    var exeData = {executive_id:executiveId, user_id:userId};
    
    $.ajax({
      url : "<?php echo HTTP_ROOT; ?>/home/get-executive-summary-rating",
      method : 'POST',
      data : exeData,
      success : function (result) {
        var resultData = $.parseJSON(result);
        if (resultData.message == 'Rating Found') {

          $('#executiverating-rating').val(resultData.executiveData[0].rating);
          $('#executiverating-note').val(resultData.executiveData[0].note);

        }
      }

    });
  });
  $('#submitRating').click(function(e){

    var rating = $('#executiverating-rating').val();
    var note = $('#executiverating-note').val();
    var data = {executive_id:executiveId, user_id:userId, rating:rating, note:note};

    $.ajax({
      url : "<?php echo HTTP_ROOT; ?>/home/executive-summary-rating",
      method : 'POST',
      data : data,
      success : function(result) {   
        var resultData = $.parseJSON(result);
         
         if (resultData.message == 'Rating Saved Successfully') 
         {
              $('#rating').html(resultData.message);
              setTimeout(
              function() 
              {
                $('#exeicutiveRating').modal('hide');
              $('#rating').html('');
              $('#executiverating-rating').val(1);
              $('#executiverating-note').val('');

    //do something special
              }, 3000)
              
         }

        
      }
    });
  });
});
</script>