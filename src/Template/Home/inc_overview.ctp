                                <div id="home" class="tab-pane fade in active">
                                    <!--Overview Summery-->
									
                                    <div class="osum-area">
                                        <div class="heading-box">
                                            <p class="head-p">Overview Summary</p>
                                        </div>
                                        <p><?php echo $userInfo['user_detail']['company_summary']; ?></p>
                                    </div>
									
                                    <!--/Overview Summery-->
                                    <!--Video Highlight-->
									<?php if($userInfo['user_detail']['company_video']){ ?>
                                    <div class="video-hl">
                                        <div class="heading-box">
                                            <p class="head-p"><span>Video Highlight</span>
                                            </p>
                                        </div>
                                        <div class="video-box">
											<iframe width="100%" height="315" src="<?php echo $userInfo['user_detail']['company_video']; ?>" frameborder="0" allowfullscreen></iframe>
                                            <!--img src="<?php echo HTTP_ROOT ?>img/Home/video-img.png" alt=""-->
                                        </div>
                                    </div>
									<?php } ?>
                                    <!--/Video Highlight-->
									
									<?php if(count($userInfo['user_members'])){ ?>
                                    <div class="overview_mangement">
                                        <div class="tab-heading">
                                            <div class="row">
                                                <div class="col-ld-12 col-md-12 col-sm-12 col-xs-12">
                                                    <h3> Mangement Team </h3>
                                                </div>
                                            </div>
                                        </div>
										<?php foreach($userInfo['user_members'] as $members){ ?>
                                        <div class="mangement-area">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="business-logo">
													<img src="<?php echo HTTP_ROOT.'img/uploads/'.($members['image'] != ''?$members['image']:'prof_photo.png'); ?>" alt="business-logo" class="img-responsive">
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="text-wrap-busniess">
                                                    <h2><?php echo $members['name'].', '.$members['position']; ?> </h2>
													<?php if($members['linkedin_url']){ ?>
													<a href="<?php echo $members['linkedin_url']; ?>" >
														<div class="business-linked">
															<img src="<?php echo HTTP_ROOT ?>img/Home/linked_in_business.png" alt="linked-in-business" class="img-responsive">
														</div>
													</a>
													<?php } ?>
                                                </div>
												
                                                <p><?php echo $members['experience']; ?></p>
                                            </div>

                                        </div>
                                        </div>
										<?php } ?>

                                    </div>
                                    <!--[end of overview_management]-->
									<?php } ?>

                                </div>