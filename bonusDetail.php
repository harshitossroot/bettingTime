<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$User = new User();
$Card = new Card();
$Common = new Common();

if(isset($_GET['detail']) && trim($_GET['detail'])){
	$reqID = base64_decode($_GET['detail']);
	$reqID = explode("+", trim($reqID));
	$reqName = str_replace('-', ' ', $reqID['0']);
	$result = $User->query("SELECT * FROM `tblBonusCards` WHERE `id` = '" . $reqID[1] . "'");
	if(isset($result) && is_array($result) && count($result) > 0){
		$_SESSION['value'] = $result;
	}
}

if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['_COMMENT_CAT']) && $_POST['_COMMENT_CAT'] == 'BONUS_COMMENT' ){
	if(!$User->checkLoginStatus()){
		//$Common->redirect('index.php');
		Message::addMessage("You are not logged in. Please login here to post your comment", ERR);
	}else{
		if($Card->addBonusComments($_POST, $reqID['1'])){
    		//C::redirect(C::link('bonusDetail.php', false, true));
			Message::addMessage("Your comment will be displayed after verify by admin.", SUCCS);
    	}
	}
}


?>
<?php require_once('includes/doc_head.php'); ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="image-bg">
				<div class="details-page">
					<div class="image-label">
						<p class="custom-text-rotate">
							<span style="font-size:12px;">가입코드</span><br>
							<span style="font-size:20px;"><?php echo $_SESSION['value']['0']['joinCode']; ?></span>
						</p>
					</div>
					<div class="ask-desktop-table">
						<table class="ask-top-table">
							<tr>
								<td>
									<div class="details-page-name">
										<span class="text-capitalize"><?php echo $_SESSION['value']['0']['bonusAmount']; ?> <?php echo $_SESSION['value']['0']['bonustype']; ?></span><br>
										<span><?php echo $_SESSION['value']['0']['sportsName']; ?></span><br>
										<span>up to <?php echo $_SESSION['value']['0']['bonusAmount']; ?> won (explanation line)</span>
									</div>
								</td>
								<td>
									<div class="details-page-joinCode">
										<span>가입코드</span><br>
										<span><?php echo $_SESSION['value']['0']['joinCode']; ?></span>
									</div>
									<div class="details-page-logo">
										<img src="<?php echo $_SESSION['value']['0']['bonusImage']; ?>" alt=""  style="border:4px solid #ccc;" />
									</div>
								</td>
							</tr>
						</table>
						<table class="ask-table">
							<h5 class="text-white margin-top-20">Bonus Info</h5>
							<tr>
								<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['sportsName']; ?></th>
								<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['bonusAmount']; ?></th>
								<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['wageringRequirements']; ?></th>
								<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['bonusCode']; ?></th>
								<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['bonustype']; ?></th>
							</tr>
							<tr>
								<td class="padding-top-0">Sports Name</td>
								<td class="padding-top-0">Bonus Amount</td>
								<td class="padding-top-0">Wager</td>
								<td class="padding-top-0">Bonus Code</td>
								<td class="padding-top-0">Type</td>
							</tr>
						</table>
					</div>
					<!-- info for mobile and tablet -->
					<div class="ask-mobile-table">
						<table class="ask-table">
							<tr>
								<td colspan="2">
									<div class="details-page-name">
										<span class="text-capitalize"><?php echo $_SESSION['value']['0']['bonusAmount']; ?> <?php echo $_SESSION['value']['0']['bonustype']; ?></span><br>
										<span><?php echo $_SESSION['value']['0']['sportsName']; ?></span><br>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="details-page-joinCode">
										<span>가입코드</span><br>
										<span><?php echo $_SESSION['value']['0']['joinCode']; ?></span>
									</div>
									<div class="details-page-logo">
										<img src="<?php echo $_SESSION['value']['0']['bonusImage']; ?>" alt=""  style="border:4px solid #ccc;" />
									</div>
								</td>
							</tr>
						</table>
						<table class="ask-table">
							<tr>
								<td class="text-yellow">Sports Name</td>
								<td><?php echo $_SESSION['value']['0']['sportsName']; ?></td>
							</tr>
							<tr>
								<td class="text-yellow">Bonus Amount</td>
								<td><?php echo $_SESSION['value']['0']['bonusAmount']; ?></td>
							</tr>
							<tr>
								<td class="text-yellow">Wager</td>
								<td><?php echo $_SESSION['value']['0']['wageringRequirements']; ?></td>
							</tr>
							<tr>
								<td class="text-yellow">Bonus Code</td>
								<td><?php echo $_SESSION['value']['0']['bonusCode']; ?></td>
							</tr>
							<tr>
								<td class="text-yellow">Type</td>
								<td><?php echo $_SESSION['value']['0']['bonustype']; ?></td>
							</tr>
						</table>
					</div>
					<!-- info for mobile and tablet end -->
				</div>
				<div class="col-sm-12 content-button">
					<div class="col-sm-4">
						<a href="http://<?php echo $_SESSION['value']['0']['link']; ?>" class="btn btn-ask-red btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-reply-all margin-right-5" aria-hidden="true"></i> Play Now</b></a>
					</div>
					<div class="col-sm-4">
						<a href="#addReview" class="btn btn-ask-green btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-pencil margin-right-5" aria-hidden="true"></i> write review</b></a>
					</div>
					<div class="col-sm-4">
						<a href="submitComplaint.php" class="btn btn-ask-grd-blue btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-gavel margin-right-5" aria-hidden="true"></i> file complain</b></a>
					</div>
				</div>
				<div class="content row fixed-top">
					<div class="col-sm-8 margin-top-10">
						<span class="font15 text-white text-uppercase"><b><?php echo $_SESSION['value']['0']['sportsName']; ?></b></span>
						<span class="font15 text-white text-uppercase"><b> &nbsp;&nbsp;/&nbsp;&nbsp; 가입코드 : <?php echo $_SESSION['value']['0']['joinCode']; ?></b></span>
					</div>
					<div class="col-sm-4">
						<a href="<?php echo $_SESSION['value']['0']['link']; ?>" class="btn btn-ask-red btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-reply-all margin-right-5" aria-hidden="true"></i> Play Now</b></a>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-9 col-md-9" id="show-pop-up">
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="heading text-white text-uppercase">Bonus Details </h3><!--  border-bottom-5 -->
							</div>
							<div class="ask-page-content-body-details"> 
								<!-- <h3 class="heading text-white">Bonus Details</h3> -->
								<div class="row content">
									<table class="ask-table text-bold">
										<?php
										$result = $User->query("SELECT * FROM `tblBonusCards` WHERE `id` = '" . $reqID[1] . "'");
										if(isset($result) && is_array($result) && count($result) > 0){
											$value = $result;
										?>
										<tr>
											<td style="width:30%"> 가입코드 :</td>
											<td><a href="" class="btn btn-ask-white" style="margin-left: 0px;"><?php echo $value['0']['joinCode']; ?></a></td>
										</tr>
										<tr>
											<td> Wagering requirements :</td>
											<td><a href=""><?php echo $value['0']['wageringRequirements']; ?></a></td>
										</tr>
										<tr>
											<td>Type :</td>
											<td><a href=""><?php echo $value['0']['bonustype']; ?></a></td>
										</tr>
										<tr>
											<td>Bonus Value :</td>
											<td><a href=""><?php echo $value['0']['bonusAmount']; ?></a></td>
										</tr>
										<tr>
											<td>Bonus Value :</td>
											<td><a href=""><?php echo $value['0']['bonusCode']; ?></a></td>
										</tr>
										<tr>
											<td> Cashable :</td>
											<td><a href="">Yes</a></td>
										</tr>
										<tr>
											<td>Maximum Bonus Amount :</td>
											<td><a href="">150%</a></td>
										</tr>
										<tr>
											<td>Minimum Deposit :</td>
											<td><a href="">$20 </a></td>
										</tr>
										<tr>
											<td>Maximum Cashout :</td>
											<td><a href=""> €200 </a></td>
										</tr>
										<tr>
											<td>Allowed Games :</td>
											<td><a href="">Starburst Slot</a></td>
										</tr>
										<?php
										}
										?>
										<?php
											$res = $value[0]['bonusOtherDetails'];
											$res = explode('+', $value[0]['bonusOtherDetails']);
											$label = json_decode($res['0']);
											$datas = json_decode($res['1']);
											foreach ($label as $index => $val) {
										?>
										<tr>
											<td> <?php echo $val; ?> :</td>
											<td><a href=""> <?php echo $datas[$index]; ?> </a></td>
										</tr>
										<?php
											}
										?>
									</table>
								</div>
							</div>
						</div>
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="heading text-white text-uppercase">Players Comments </h3><!--  border-bottom-5 -->
							</div>
							<div class="ask-page-content-body-details">
								<div class="col-lg-12 col-md-12 commentsContainer">
								<?php
								$result = $User->query("SELECT TBC.gdComments, TBC.badComments, TBC.rating, TBC.updatedOn, TU.userId FROM tblBonusComment as TBC, tblUser as TU  WHERE `TBC`.`isRecommanded` = 'Y' AND TBC.userId = TU.id AND TBC.bonusId = '" . $reqID[1] . "'");
								if(is_array($result) && count($result) > 0){
									$index = 0;
								?>
									<div class="margin-top-20 commentsFilterArea">
										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="ALL">All</a>
										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="GOOD">Good Comments</a>
										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="BAD">Bad Comments</a>
									</div>
								<?php
									foreach ($result as $key => $value) {
								?>
									<table class="ask-table commentFilterTbl" data-rate="<?php echo $value['rating'];?>" data-idx="<?php echo $index;?>">
										<tr>
											<td style="width:15%;" class="userIconsDisplay">
												<div class="content img-circle user-comment text-center">
													<?php $firstLt = $value['userId']; ?>
													<p class="text-uppercase" style="padding-top:10px;"><b><?php echo $firstLt[0];?></b></p>
												</div>
											</td>
											<td>
												<div class="content arrow-content">
													<h5 class="page-header comment-preview-header margin-top-0">
														<span class="text-yellow margin-right-5"><?php echo $value['userId']; ?></span>
														<?php $updateDate = explode(' ', $value['updatedOn']);?>
														<span class="text-white">(Reviewed on <?php echo $updateDate[0]; ?>)</span>
														<span class="rating padding3 font13 pull-right cmntRate">
					                                        <?php 
				                                    		if ($value['rating'] == 1) {
			                                    			?>
			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 2){
			                                    			?>
			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 3){
			                                    			?>
			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 4){
			                                    			?>
			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 5){
			                                    			?>
															<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i>
			                                    			<?php
					                                    		}
					                                    	?>
					                                    </span>
													</h5>
													<div class="comment-show">
														<table class="ask-table">
															<tr>
																<td style="width:10%;padding-left:20px;padding-bottom:10px;">
																	<i class="fa fa-thumbs-up text-green" aria-hidden="true"></i>
																</td>
																<td style="padding-bottom:10px;">
																	<span><?php echo $value['gdComments']; ?></span>
																</td>
															</tr>
															<tr>
																<td style="width:10%;padding-left:20px;padding-bottom:10px;">
																	<i class="fa fa-thumbs-down text-red" aria-hidden="true"></i>
																</td>
																<td style="padding-bottom:10px;">
																	<span><?php echo $value['badComments']; ?></span>
																</td>
															</tr>
														</table>
													</div>
												</div>			
											</td>
										</tr>
									</table>
								<?php
										$index++;
									}
								}else{
								?>
								<p class="text-yellow text-uppercase" style="padding-top:10px;">Be the first one to comment here</p>
								<?php
								}
								?>
								</div>
							</div>
						</div>
						<div class="ask-page-content" id="addReview">
							<div class="ask-page-content-header">
								<h3 class="heading text-white text-uppercase">Add Comments </h3><!--  border-bottom-5 -->
							</div>
							<div class="ask-page-content-body-details">
								<div class="col-lg-12 col-md-12">
									<form action="" method="post" enctype="multipart/form-data">
										<table class="ask-table" style="margin-bottom:-35px;">
											<tr>
												<td style="width:15%;">
													<div class="content img-circle user-comment text-center">
														<i class="fa fa-thumbs-up margin-top-15 text-green" aria-hidden="true"></i>
													</div>
												</td>
												<td>
													<div class="content arrow-content">
														<textarea name="likeComment" id="" cols="" rows="3" placeholder="what do you like"></textarea>
														<input type="hidden" name="_COMMENT_CAT" value="BONUS_COMMENT" />
													</div>			
												</td>
											</tr>
										</table>
										<table class="ask-table">
											<tr>
												<td style="width:15%;">
													<div class="content img-circle user-comment text-center">
														<i class="fa fa-thumbs-down margin-top-15 text-red" aria-hidden="true"></i>
													</div>
												</td>
												<td>
													<div class="content arrow-content">
														<textarea name="dislikeComment" id="" cols="" rows="3" placeholder="what do you dislike"></textarea>
													</div>			
												</td>
											</tr>
										</table>
										<div class="col-md-10 col-md-offset-2">
											<p class="text-white">Rate this Bonus Code</p>
											<div class="rating font13 text-white star-margin" style="margin-top:-7px;">
		                                        <div class="rateyo-readonly-widg" data-toggle="tooltip" title=""></div>
		                                        <div class="counter ratingCounter"></div>
		                                        <input type="hidden" id="commentRate" name="commentRate" value="" />
		                                    </div>
		                                    <p class="text-white"><input type="checkbox" name="checkPost" /><span style="margin-left:30px;">I declare that my review is based on my own experience and represents my genuine opinion of this casino. I'm not a casino employee and have not been offered any incentive or payment by the casino to write this review. I understand that AskGamblers has zero-tolerance policy on fake reviews. </span></p>
		                                    <div style="margin-top:20px;margin-bottom:10px;">
		                                    	<button type="submit" class="btn btn-ask-red" style="margin-left:0px;margin-top:0px;">Post Comment</button><a href="" class="text-yellow">View Posting Guidelines</a>
	                                    	</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Site Other Bonuses <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="bonus.php" class="text-white">View more</a></span></h3><!--  border-bottom-5 -->
								<p class="custom-text custom-p">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back, welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body ask-detail-page-card">
								<?php
								
								$result = $User->query("SELECT `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName` FROM `tblBonusCards` WHERE `sportsName` = '" . $_SESSION['value']['0']['sportsName'] . "' ORDER BY `updatedOn` desc LIMIT 3");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $data) {				
								?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">
									<div class="ask-cards">
										<div class="ask-item-bonus-card">
											<div class="front">
												<div class="cardHeader">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $data['bonusName']) . '+' . $data['id'] )), true);?>"><h5><?php echo $data['bonustype']; ?></h5></a>
													<span class="fa fa-info info" style="font-size:10px;"></span>
				                                </div>
				                                <div class="cardLogo" style="overflow:hidden;">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $data['bonusName']) . '+' . $data['id'] )), true);?>"><img src="<?php echo $data['bonusImage'];?>" class="img-responsive" style="height:87px;"  alt=""></a>
				                                    <div class="cardReview text-center text-black">
				                                    	<span class="bonus-name text-center text-uppercase <?php if(mb_strlen($data['sportsName'], 'UTF-8') > 9){ echo "font12";}?>"><?php echo $data['sportsName'];?></span>
					                                    <div class="rating padding3 font13 color" style="margin-top: 0px; margin-left: 2px;">
					                                        <?php 
				                                    		if ($data['rating'] == 1) {
			                                    			?>
			                                    			<i class="fa fa-star first" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 2){
			                                    			?>
			                                    			<i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 3){
			                                    			?>
			                                    			<i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 4){
			                                    			?>
			                                    			<i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 5){
			                                    			?>
															<i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i>
			                                    			<?php
					                                    		}
					                                    	?>
					                                    </div>
					                                    <div class="ask-code">
				                                        	<p class="custom-border1">가입코드</p> <br>
				                                        	<span class="custom-border" <?php if(mb_strlen($data['joinCode'], 'UTF-8') > 9){ echo 'style="font-size:12px;padding-left:3px;padding-right:3px;"';}?>><?php echo $data['joinCode']; ?></span>
					                                    </div>
					                                </div>
				                                </div>
				                                <div class="mainView" style="overflow:hidden;">
			                                        <div class="bonus">
			                                            <div class="bonusAmount">
			                                                <span class="text-center"><?php echo $data['bonusAmount']; ?></span>
			                                            </div>
			                                            <div class="bonusType">
			                                                <span class="text-center text-uppercase <?php if(mb_strlen($data['bonusName'], 'UTF-8') > '7'){ echo "font12";}?>"><?php echo $data['bonusName'];?></span>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="bonusCode text-center">
			                                        <span style="font-size:12px">BONUS CODE</span><br>
			                                        <span><b><?php echo $data['bonusCode']; ?></b></span>
			                                    </div>
				                                <div class="playNow custom-play-now" style="margin-top: 20px;">
													<a href="<?php echo $data['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="cardHeader">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $data['bonusName']) . '+' . $data['id'] )), true);?>"><h5 class="text-uppercase"><?php echo $data['bonustype']; ?></h5></a>
				                                    <span class="pull-right fa fa-close info"></span>
				                                </div>
				                                <div class="bonus-desc">
				                                	<ul class="information-list">
														<li>
															<div class="list-left">Bonus</div>
															<div class="list-right"><?php echo $data['bonusAmount']; ?></div>
														</li>
														<li>
															<div class="list-left">Sports</div>
															<div class="list-right"><?php echo $data['sportsName']; ?></div>
														</li>
														<li>
															<div class="list-left">W.R</div>
															<div class="list-right"><?php echo $data['wageringRequirements']; ?></div>
														</li>
														<li>
															<div class="list-left">Type</div>
															<div class="list-right"><?php echo $data['bonustype']; ?></div>
														</li>
													</ul>
				                                </div>
				                                
				                                <div class="getNow">
				                                	<div class="text-center" style="position:relative;bottom:10px;">
														<a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $data['bonusName']) . '+' . $data['id'] )), true);?>" class="readMore">Read More</a>
													</div>
				                                    <a href="<?php echo $data['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
				                                </div>
											</div><!-- back -->
									    </div><!-- ask-item-bonus-card -->
									</div>
								</div><!-- col-md-3 -->
								<?php
									}
								}
								?>
							</div>
						</div><!-- bonus code landing-->
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Top Bonus Codes <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="bonus.php" class="text-white">View more</a></span></h3><!--  border-bottom-5 -->
								<p class="custom-text custom-p">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back , welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body ask-detail-page-card">
								<?php
								$result = $User->query("SELECT `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName` FROM `tblBonusCards` WHERE `rating` >= '3' ORDER BY `rating` desc LIMIT 3");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $data) {				
								?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">
									<div class="ask-cards">
										<div class="ask-item-bonus-card">
											<div class="front">
												<div class="cardHeader">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $data['bonusName']) . '+' . $data['id'] )), true);?>"><h5><?php echo $data['bonustype']; ?></h5></a>
													<span class="fa fa-info info" style="font-size:10px;"></span>
				                                </div>
				                                <div class="cardLogo" style="overflow:hidden;">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $data['bonusName']) . '+' . $data['id'] )), true);?>"><img src="<?php echo $data['bonusImage'];?>" class="img-responsive" style="height:87px;"  alt=""></a>
				                                    <div class="cardReview text-center text-black">
				                                    	<span class="bonus-name text-center text-uppercase <?php if(mb_strlen($data['sportsName'], 'UTF-8') > 9){ echo "font12";}?>"><?php echo $data['sportsName'];?></span>
					                                    <div class="rating padding3 font13 color" style="margin-top: 0px; margin-left: 2px;">
					                                        <?php 
				                                    		if ($data['rating'] == 1) {
			                                    			?>
			                                    			<i class="fa fa-star first" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 2){
			                                    			?>
			                                    			<i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 3){
			                                    			?>
			                                    			<i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 4){
			                                    			?>
			                                    			<i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 5){
			                                    			?>
															<i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i>
			                                    			<?php
					                                    		}
					                                    	?>
					                                    </div>
					                                    <div class="ask-code">
				                                        	<p class="custom-border1">가입코드</p> <br>
				                                        	<span class="custom-border" <?php if(mb_strlen($data['joinCode'], 'UTF-8') > 9){ echo 'style="font-size:12px;padding-left:3px;padding-right:3px;"';}?>><?php echo $data['joinCode']; ?></span>
					                                    </div>
					                                </div>
				                                </div>
				                                <div class="mainView" style="overflow:hidden;">
			                                        <div class="bonus">
			                                            <div class="bonusAmount">
			                                                <span class="text-center"><?php echo $data['bonusAmount']; ?></span>
			                                            </div>
			                                            <div class="bonusType">
			                                                <span class="text-center text-uppercase <?php if(mb_strlen($data['bonusName'], 'UTF-8') > '7'){ echo "font12";}?>"><?php echo $data['bonusName'];?></span>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="bonusCode text-center">
			                                        <span style="font-size:12px">BONUS CODE</span><br>
			                                        <span><b><?php echo $data['bonusCode']; ?></b></span>
			                                    </div>
				                                <div class="playNow custom-play-now" style="margin-top: 20px;">
													<a href="http://<?php echo $data['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="cardHeader">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $data['bonusName']) . '+' . $data['id'] )), true);?>"><h5 class="text-uppercase"><?php echo $data['bonustype']; ?></h5></a>
				                                    <span class="pull-right fa fa-close info"></span>
				                                </div>
				                                <div class="bonus-desc">
				                                	<ul class="information-list">
														<li>
															<div class="list-left">Bonus</div>
															<div class="list-right"><?php echo $data['bonusAmount']; ?></div>
														</li>
														<li>
															<div class="list-left">Sports</div>
															<div class="list-right"><?php echo $data['sportsName']; ?></div>
														</li>
														<li>
															<div class="list-left">W.R</div>
															<div class="list-right"><?php echo $data['wageringRequirements']; ?></div>
														</li>
														<li>
															<div class="list-left">Type</div>
															<div class="list-right"><?php echo $data['bonustype']; ?></div>
														</li>
													</ul>
				                                </div>
				                                <div class="getNow">
				                                <div class="text-center" style="position:relative;bottom:10px;">
													<a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $data['bonusName']) . '+' . $data['id'] )), true);?>" class="readMore">Read More</a>
												</div>
				                                    <a href="http://<?php echo $data['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
				                                </div>
											</div><!-- back -->
									    </div><!-- ask-item-bonus-card -->
									</div>
								</div><!-- col-md-3 -->
								<?php
									}
								}
								?>
							</div>
						</div><!-- bonus code landing-->
					</div><!-- col-lg-9 col-md-9 -->
					<div class="col-lg-3 col-md-3 sticky_column" style="padding-left: 0px;">
						<?php require_once('includes/sportsRecommend.php'); ?>
					</div>
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>