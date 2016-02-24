Mid Profile Right-->
<?php 
// investment percentage
$per = 0;
if($userInfo['user_detail']['i_goal']){ $per += 20; }
if($userInfo['user_detail']['i_type']){ $per += 20; }
if($userInfo['user_detail']['i_pre_money']){ $per += 20; }
if($userInfo['user_detail']['i_post_money']){ $per += 20; }
if($userInfo['user_detail']['i_expected_returns']){ $per += 20; }
?>
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="aside-right">
			<button class="btn btn-info btn-sm ratingmodal" data-target="#investmentRating" data-toggle="modal"  type="button">Add investment rating</button>
			<div class="business-ratting">

				<div class="businress-area">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<img class="img-responsive" alt="business-ratting" src="<?php echo HTTP_ROOT ?>img/Home/business-ratting.png">
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

							<h3> <span>Business Rating</span> </h3>
							<h3>Valuerate Score : 10 </h3>
						</div>
					</div>
				</div>
			</div>

			<div class="business-ratting">
				<div class="businress-area">
					<div class="row btn-area">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h2>Wish to find out more </h2>
							<a href="#" title="Join as Investor">Request More Info</a>
							<a href="#" title="Join as Investor" class="browse-investor-add">Add to Shortlist</a>
							<a href="#" title="Join as Investor" class="browse-investor">Invite other investors</a>
						</div>
					</div>
				</div>
			</div>

			<div class="investment-block">
				<div class="investment-detail investment-border">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3> INVESTMENT DETAILS</h3>
						</div>
					</div>
				</div>
				<div class="investment-detail">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h4>Progress</h4>
							<div class="progress">
								<div style="width: <?php echo $per; ?>%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar">
									<span class="sr-only">60% Complete</span>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="investment-detail investment-border">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
							<p> Investment Goal</p>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-6">
							<p><span>
								<?php echo($userInfo['user_detail']['i_goal']?$userInfo['user_detail']['i_goal']:"N/A"); ?>
							</span>
							</p>
						</div>

					</div>
				</div>
				<div class="investment-detail investment-border">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
							<p> Investment Type</p>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
							<p><span>
								<?php echo($userInfo['user_detail']['i_type']?$userInfo['user_detail']['i_type']:"N/A"); ?>
							</span>
							</p>
						</div>

					</div>
				</div>
				<div class="investment-detail investment-border">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
							<p> Pre-money Valuation</p>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
							<p><span>
								<?php echo($userInfo['user_detail']['i_pre_money']?$userInfo['user_detail']['i_pre_money']:"N/A"); ?>
							</span>
							</p>
						</div>

					</div>
				</div>
				<div class="investment-detail investment-border">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
							<p> Post-money Valuation</p>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
							<p><span>
								<?php echo($userInfo['user_detail']['i_post_money']?$userInfo['user_detail']['i_post_money']:"N/A"); ?>
							</span>
							</p>
						</div>

					</div>
				</div>
				<div class="investment-detail">
					<div class="row">
						<div class="col-lg-6 col-md-7 col-sm-6 col-xs-6">
							<p> Expected returns</p>
						</div>
						<div class="col-lg-6 col-md-5 col-sm-6 col-xs-6">
							<p><span>
								<?php echo($userInfo['user_detail']['i_expected_returns']?$userInfo['user_detail']['i_expected_returns']:"N/A"); ?>
							</span>
							</p>
						</div>

					</div>
				</div>
			</div>
			<div class="investment-block blue-colr">
				<div class="investment-detail investment-border-1">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3>Contact information</h3>
						</div>

					</div>
				</div>
				<div class="investment-detail investment-border-1">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
							<p> Phone</p>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
							<p><span><?php echo($userInfo['phone']); ?></span>
							</p>
						</div>

					</div>
				</div>


				<div class="investment-detail">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<p> Email</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<p><span><?php echo($userInfo['email']); ?></span>
							</p>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
                    <!--/Mid Profile Right