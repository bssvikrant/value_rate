<?php //echo "<pre>";print_r($userInfo); echo "</pre>";
if($dataCheck=='datafound'){ 
?>

    <!--[Inner Content Area Start]-->
    <section class="inner-cont-2">
        <!--inner banner start-->
        <div class="inner-banner">
            <div class="container">
                <div class="new-business-area">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="business-img">
                                <img src="<?php echo HTTP_ROOT.'img/uploads/'.($userInfo['image'] != ''?$userInfo['image']:'prof_photo.png'); ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="ban-business-txt">
                                <h1><?php echo $userInfo['user_detail']['company_name']; ?></h1>
                                <p><?php echo $userInfo['user_detail']['brief_des']; ?> </p>
                                <div class="loc-area">
                                    <ul>
                                        <li><img src="<?php echo HTTP_ROOT ?>img/Home/loc-icon-1.png" alt=""> <?php echo $userInfo['country']; ?></li>
                                        <li><img src="<?php echo HTTP_ROOT ?>img/Home/loc-icon-2.png" alt=""> <?php echo $userInfo['user_detail']['industry']; ?></li>
                                        <li><img src="<?php echo HTTP_ROOT ?>img/Home/loc-icon-3.png" alt=""> <?php echo $userInfo['user_detail']['date_found']; ?></li>
                                    </ul>
                                </div>

                                <div class="ban-social-area">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="web-box">
                                                <img src="<?php echo HTTP_ROOT ?>img/Home/earth-icon.png" alt=""> <?php echo $userInfo['user_detail']['website']; ?>
                                            </div>
                                            <div class="ban-s-box">
                                                <ul>
													<?php if($userInfo['user_detail']['facebook_url']) { ?>
														<li>
															<a class="ban-fb" title="Facebook" href="<?php echo $userInfo['user_detail']['facebook_url']; ?>"></a>
														</li>
													<?php } ?>
													<?php if($userInfo['user_detail']['linkedin_url']) { ?>
														<li>
															<a class="ban-twitter" title="Twitter" href="<?php echo $userInfo['user_detail']['linkedin_url']; ?>"></a>
														</li>

													<?php } ?>
													<?php if($userInfo['user_detail']['twitter_url']) { ?>
														<li>
															<a class="ban-linkedin" title="LinkedIn" href="<?php echo $userInfo['user_detail']['twitter_url']; ?>"> </a>
														</li>
													<?php } ?>
													<?php if($userInfo['user_detail']['google_url']) { ?>
														<li>
															<a class="ban-gplus" title="Google Plus" href="<?php echo $userInfo['user_detail']['google_url']; ?>"></a>
														</li>
													<?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/inner banner end-->
        <!--Mid Content Start-->
        <section class="mid-cont">
            <!--tab area-->
            <div class="top-tab-area">
                <div class="container">
                    <div class="page-tab">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="tab" href="#home">Overview</a>
                            </li>
                            <li><a data-toggle="tab" href="#menu1"> Executive Summary </a>
                            </li>
                            <li><a data-toggle="tab" href="#menu2">Funding Materials</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <!--/tab area-->
            <!--profile mid area Start-->
            <section class="profile-mid">
                <div class="container">
                    <div class="pmid-area">
                        <!--Mid Profile Left-->
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="tab-content">
								<?php include('inc_overview.ctp'); ?>
								<?php include('inc_exe_sum.ctp'); ?>
								<?php include('inc_fund_mat.ctp'); ?>
                            </div>
                        </div>

                        <!--/Mid Profile Left-->
					<?php echo $this->element('homeElements/rightSidebar'); ?>
                    <?php include('inc.modal.addrating.php'); ?>
                    <?php include('inv.modal.addrating.php'); ?>
                </div>
                </div>

            </section>


            <!--profile mid area End-->
        </section>
        <!--Mid Content End-->

    </section>
    <!--[Inner Content Area End]-->
	<?php }else{  echo '<section class="profile-mid"><div class="container"><h1 class="text-center">No User Data Found</h1></div></div><br><br>'; } ?>
