<?php
require_once('config.php');

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$User = new User();
$Card = new Card();

if(isset($_GET['logout']) && trim($_GET['logout']) == 'logout'){
    UNSET($_SESSION['admin']);
    header("LOCATION:index.php");
}





?>
<?php require_once('includes/doc_head.php'); ?>
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9 sticky_column">
						<?php require_once('includes/sportsRecommend.php'); ?>
					</div>
					<div class="col-lg-9 col-md-9 col-lg-pull-3 col-md-pull-3">
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Search Result </h3><!--  border-bottom-5 -->
								<p class="custom-p custom-text searchTextResult"></p>
							</div>
							<div class="search-body">
								<?php
								if(isset($_GET['searchQuery']) && trim($_GET['searchQuery'])){
									$searchQuery = $_GET['searchQuery'];
								?>
								<input type="hidden" value="<?php echo $searchQuery; ?>" id="searchTextHighlight" />
								<p class="text-center text-yellow noResultFound"></p>
								<div class="ask-home-card ask-search-card">
								<?php
								$result = $User->query("SELECT `id`, `sportsName`, `isHot`, `sportsImage`, `rating`, `joinCode`, `link`, `miniGame`, `crossBetting`, `maxPrizeMoney`, `welcomeBonus` FROM `tblWebCards` WHERE (`sportsName` LIKE '%" . $searchQuery . "%') OR (`miniGame` LIKE '%" . $searchQuery . "%') OR (`joinCode` LIKE '%" . $searchQuery . "%') OR (`maxPrizeMoney` LIKE '%" . $searchQuery . "%') OR (`welcomeBonus` LIKE '%" . $searchQuery . "%') OR (`crossBetting` LIKE '%" . $searchQuery . "%')");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
								?>
									<div class="col-md-4 col-sm-4 col-xs-4 paddingbottoms">
										<div class="ask-cards">
											<div class="ask-item-web-card">
												<div class="front">
													<div class="cardHeader">
														<a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><h5><?php echo $value['sportsName']; ?></h5></a>
														<span class="pull-right fa fa-info info"></span>
													</div>
													<div class="cardLogo">
														<?php
														if($value['isHot'] == "H"){
														?>
														<span class="card-tag-red">HOT</span>
														<?php
														} else{
														?>
														<span class="card-tag-blue">NEW</span>
														<?php
														}
														?>
														<a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><img src="<?php echo $value['sportsImage']; ?>" width="196px" height="133px" alt=""></a>
													</div>
													<div class="cardReview text-center text-black">
														<div class="rating padding-5 font16">
															<?php
					                                    		if ($value['rating'] == 1) {
				                                    			?>
				                                    			<i class="fa fa-star first" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
				                                    			<?php
						                                    		} else if($value['rating'] == 2){
				                                    			?>
				                                    			<i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
				                                    			<?php
						                                    		} else if($value['rating'] == 3){
				                                    			?>
				                                    			<i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
				                                    			<?php
						                                    		} else if($value['rating'] == 4){
				                                    			?>
				                                    			<i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
				                                    			<?php
						                                    		} else if($value['rating'] == 5){
				                                    			?>
																<i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i>
				                                    			<?php
						                                    		}
						                                    	?>
														</div>
														<div class="code padding-5">
															<p class="text-center text-black"><span style="font-size:13px;">JOIN CODE</span><b> : <?php echo $value['joinCode']; ?></b></p>
														</div>
													</div>
													<div class="playNow">
														<a href="http://<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
													</div>
												</div><!-- front -->
												<div class="back">
													<div class="cardHeader">
														<a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><h5 style="text-transform:uppercase;"><?php echo $value['sportsName']; ?></h5></a>
														<span class="pull-right fa fa-close info"></span>
													</div>
													<div class="sport-desc">
					                                	<ul class="information-list">
															<li>
																<div class="list-left">Welcome Bonus</div>
																<div class="list-right"><?php echo $value['welcomeBonus']; ?></div>
															</li>
															<li>
																<div class="list-left">Max Prize</div>
																<div class="list-right"><?php echo $value['maxPrizeMoney']; ?></div>
															</li>
															<li>
																<div class="list-left">Cross Betting</div>
																<div class="list-right"><?php echo $value['crossBetting']; ?></div>
															</li>
															<li>
																<div class="list-left">Mini Game</div>
																<div class="list-right"><?php echo $value['miniGame']; ?></div>
															</li>
														</ul>
														<div class="clearfix"></div>
														<div class="text-center" style="margin-top: 50px;">
															<a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>" class="readMore">Read More</a>
														</div>
													</div><!-- sport-desc -->
													<div class="getNow">
														<a href="<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
													</div>
												</div><!-- back -->
											</div><!-- ask-item-web-card -->
										</div>
									</div><!-- col-md-3 -->
								<?php
									}
								}
								?>
								</div>
								<div class="ask-home-card ask-search-card">
								<?php
								$result = $User->query("SELECT `id`, `sportsName`, `isHot`, `sportsImage`, `rating`, `joinCode`, `link`, `sadariOdd`, `wager`, `maximumBetting`, `ruMatin`, `closingTime` FROM `tblSadariCards` WHERE (`sportsName` LIKE '%" . $searchQuery . "%') OR (`wager` LIKE '%" . $searchQuery . "%') OR (`joinCode` LIKE '%" . $searchQuery . "%') OR (`sadariOdd` LIKE '%" . $searchQuery . "%') OR (`maximumBetting` LIKE '%" . $searchQuery . "%') OR (`ruMatin` LIKE '%" . $searchQuery . "%')");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
								?>
									<div class="col-md-4 col-sm-4 col-xs-4 paddingbottoms">
										<div class="ask-cards">
											<div class="ask-item-web-card">
												<div class="front">
													<div class="cardHeader">
														<a href="<?php echo C::link('sadariDetails.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><h5><?php echo $value['sportsName']; ?></h5></a>
														<span class="pull-right fa fa-info info"></span>
													</div>
													<div class="cardLogo">
														<?php
														if($value['isHot'] == "H"){
														?>
														<span class="card-tag-red">HOT</span>
														<?php
														} else{
														?>
														<span class="card-tag-blue">NEW</span>
														<?php
														}
														?>
														<a href="<?php echo C::link('sadariDetails.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><img src="<?php echo $value['sportsImage']; ?>" width="196px" height="133px" alt=""></a>
													</div>
													<div class="cardReview text-center text-black">
														<div class="rating padding-5 font16">
															<?php
					                                    		if ($value['rating'] == 1) {
				                                    			?>
				                                    			<i class="fa fa-star first" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
				                                    			<?php
						                                    		} else if($value['rating'] == 2){
				                                    			?>
				                                    			<i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
				                                    			<?php
						                                    		} else if($value['rating'] == 3){
				                                    			?>
				                                    			<i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
				                                    			<?php
						                                    		} else if($value['rating'] == 4){
				                                    			?>
				                                    			<i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
				                                    			<?php
						                                    		} else if($value['rating'] == 5){
				                                    			?>
																<i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i>
				                                    			<?php
						                                    		}
						                                    	?>
														</div>
														<div class="code padding-5">
															<p class="text-center text-black"><span style="font-size:13px;">JOIN CODE</span><b> : <?php echo $value['joinCode']; ?></b></p>
														</div>
													</div>
													<div class="playNow">
														<a href="http://<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
													</div>
												</div><!-- front -->
												<div class="back">
													<div class="cardHeader">
														<a href="<?php echo C::link('sadariDetails.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><h5 style="text-transform:uppercase;"><?php echo $value['sportsName']; ?></h5></a>
														<span class="pull-right fa fa-close info"></span>
													</div>
													<div class="sport-desc">
					                                	<ul class="information-list">
															<li>
																<div class="list-left">Sadari Odd</div>
																<div class="list-right"><?php echo $value['sadariOdd']; ?></div>
															</li>
															<li>
																<div class="list-left">Wager</div>
																<div class="list-right"><?php echo $value['wager']; ?></div>
															</li>
															<li>
																<div class="list-left">Maximum Betting</div>
																<div class="list-right"><?php echo $value['maximumBetting']; ?></div>
															</li>
															<li>
																<div class="list-left">Rutin/Matin</div>
																<div class="list-right"><?php echo $value['ruMatin']; ?></div>
															</li>
															<li>
																<div class="list-left">Closing time</div>
																<div class="list-right"><?php echo $value['closingTime']; ?></div>
															</li>
														</ul>
														<div class="clearfix"></div>
														<div class="text-center" style="margin-top: 50px;">
															<a href="<?php echo C::link('sadariDetails.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>" class="readMore">Read More</a>
														</div>
													</div><!-- sport-desc -->
													<div class="getNow">
														<a href="http://<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
													</div>
												</div><!-- back -->
											</div><!-- ask-item-web-card -->
										</div>
									</div><!-- col-md-3 -->
								<?php
									}
								}
								?>
								</div>
								<div class="ask-home-card ask-search-card">
									<?php
									$result = $User->query("SELECT `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName` FROM `tblBonusCards` WHERE (`sportsName` LIKE '%" . $searchQuery . "%') OR (`bonusName` LIKE '%" . $searchQuery . "%') OR (`joinCode` LIKE '%" . $searchQuery . "%') OR (`wageringRequirements` LIKE '%" . $searchQuery . "%') OR (`bonusCode` LIKE '%" . $searchQuery . "%') OR (`bonustype` LIKE '%" . $searchQuery . "%') OR (`bonusAmount` LIKE '%" . $searchQuery . "%')");
									if(is_array($result) && count($result) > 0){
										foreach ($result as $key => $value) {
									?>
									<div class="col-md-4 col-sm-4 col-xs-4 paddingbottoms">
									<div class="ask-cards">
										<div class="ask-item-bonus-card">
											<div class="front">
												<div class="cardHeader">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['bonusName']) . '+' . $value['id'] )), true);?>"><h5><?php echo $value['bonustype']; ?></h5></a>
													<span class="fa fa-info info" style="font-size:14px;"></span>
				                                </div>
				                                <div class="cardLogo" style="overflow:hidden;">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['bonusName']) . '+' . $value['id'] )), true);?>"><img src="<?php echo $value['bonusImage'];?>" class="img-responsive" style="height:87px;"  alt=""></a>
				                                    <div class="cardReview text-center text-black <?php if(strlen($value['bonusName']) > 9){ echo "margin-bottom-3";}?>">
				                                    	<span class="bonus-name text-center text-uppercase <?php if(strlen($value['sportsName']) > 9){ echo "font12";}?>"><?php echo $value['sportsName'];?>
					                                    <div class="rating padding3 font13 color" style="margin-top: -1px; margin-left: 2px;">
					                                    	<?php
				                                    		if ($value['rating'] == 1) {
			                                    			?>
			                                    			<i class="fa fa-star first" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 2){
			                                    			?>
			                                    			<i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 3){
			                                    			?>
			                                    			<i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 4){
			                                    			?>
			                                    			<i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 5){
			                                    			?>
															<i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i>
			                                    			<?php
					                                    		}
					                                    	?>
					                                    </div>
					                                    <div class="ask-code">
				                                        	<p class="custom-border1">가입코드</p> <br>
				                                        	<span class="custom-border"  <?php if(mb_strlen($value['joinCode'], 'UTF-8') > 9){ echo 'style="font-size:12px;padding-left:3px;padding-right:3px;"';}?>><?php echo $value['joinCode'];?></span>
					                                    </div>
					                                </div>
				                                </div>
				                                <div class="mainView" style="overflow:hidden;margin-top:-17px;">
			                                        <div class="bonus">
			                                            <div class="bonusAmount">
			                                                <span class="text-center"><?php echo $value['bonusAmount']; ?></span>
			                                            </div>
			                                            <div class="bonusType">
			                                                <span class="text-center text-uppercase <?php if(mb_strlen($value['bonusName'], 'UTF-8') > '7'){ echo "font12";}?>"><?php echo $value['bonusName']; ?></span>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="bonusCode text-center">
			                                        <span style="font-size:12px">BONUS CODE</span><br>
			                                        <span><b><?php echo $value['bonusCode']; ?></b></span>
			                                    </div>
				                                <div class="playNow" style="margin-top: 4px;">
													<a href="<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="cardHeader">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['bonusName']) . '+' . $value['id'] )), true);?>"><h5 class="text-uppercase"><?php echo $value['bonustype']; ?></h5></a>
				                                    <span class="pull-right fa fa-close info"></span>
				                                </div>
				                                <div class="bonus-desc">
				                                	<ul class="information-list">
														<li>
															<div class="list-left">Bonus</div>
															<div class="list-right"><?php echo $value['bonusAmount']; ?></div>
														</li>
														<li>
															<div class="list-left">Sports</div>
															<div class="list-right"><?php echo $value['sportsName']; ?></div>
														</li>
														<li>
															<div class="list-left">W.R</div>
															<div class="list-right"><?php echo $value['wageringRequirements']; ?></div>
														</li>
														<li>
															<div class="list-left">Type</div>
															<div class="list-right"><?php echo $value['bonustype']; ?></div>
														</li>
													</ul>
				                                </div>
				                                <div class="clearfix"></div>
				                                <div class="text-center" style="margin-top: 20px;font-size:14px;">
													<a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['bonusName']) . '+' . $value['id'] )), true);?>" class="readMore">Read More</a>
												</div>
				                                <div class="getNow">
				                                    <a href="http://<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
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
								<div class="ask-home-card ask-search-card">
								<?php
									$result = $User->query("SELECT `id`, `reason`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y' AND (`siteName` LIKE '%" . $searchQuery . "%') OR (`complaintTitle` LIKE '%" . $searchQuery . "%') OR (`amount` LIKE '%" . $searchQuery . "%') OR (`complaintText` LIKE '%" . $searchQuery . "%')");
									if(is_array($result) && count($result) > 0){
										foreach ($result as $key => $value) {
									?>
									<div class="col-md-4 col-sm-4 col-xs-4 paddingbottoms">
									<div class="ask-cards">
										<div class="ask-item-complain-card">
											<div class="front">
											<span class="pull-right fa fa-info info"></span>
												<a href="<?php echo C::link('complaintsDetail.php', array('detail' => $value['id']), true);?>">
													<div class="complain-logo">
													<?php
														if($value['status'] == 'P'){
													?>
														<div class="ask-ripple ask-ripple-pending">
															<span class="glyphicon glyphicon-hourglass ask-complai-logo complai-pending"></span>
															<span class="ripple-pending"></span>
														</div>
													<?php
														}else if($value['status'] == 'S'){
													?>
														<div class="ask-ripple ask-ripple-success">
															<span class="glyphicon glyphicon glyphicon-ok-sign ask-complai-logo complai-success"></span>
															<span class="ripple-success"></span>
														</div>
													<?php
														}else if($value['status'] == 'U'){
													?>
														<div class="ask-ripple ask-ripple-reject">
															<span class="glyphicon glyphicon-remove-circle ask-complai-logo complai-reject"></span>
															<span class="ripple-reject"></span>
														</div>
													<?php } ?>
													</div>
												</a>
												<a href="<?php echo C::link('complaintsDetail.php', array('detail' => $value['id']), true);?>">
												<?php
														if($value['status'] == 'P'){
													?>
														<p class="text-center text-capitalize text-pending pt5"><b>Pending</b></p>
													<?php
														}else if($value['status'] == 'S'){
													?>
														<p class="text-center text-capitalize text-sucess pt5"><b>solved</b></p>
													<?php
														}else if($value['status'] == 'U'){
													?>
														<p class="text-center text-capitalize text-reject pt5"><b>unsolved</b></p>
													<?php } ?>
												</a>
												<a href="<?php echo C::link('complaintsDetail.php', array('detail' => $value['id']), true);?>">
												<div class="complain-short-desc" style="padding-top: 0px;">
													<p><?php echo $value['complaintTitle']; ?></p>
												</div>
												<div class="complain-Date" style="padding-top: 2px;">
													<p> <span style="line-height:32px;font-size:20px;font-weight:700;"><?php echo $value['amount']; ?> 만원</span><br>
														<span style="line-height:17px;"><?php echo $value['reason']; ?></span> </p>
												</div>
												</a>
											</div><!-- front -->
											<div class="back">
												<div class="complain-short-desc">
													<p><?php echo $value['complaintTitle']; ?></p>
													<!-- <span class="pull-right fa fa-close info"></span> -->
												</div>
												<div class="complain-about">
													<p><?php echo $value['complaintText']; ?></p>
												</div>
												<div class="complaint-readmore">
													<div class="text-center">
														<a href="<?php echo C::link('complaintsDetail.php', array('detail' => $value['id']), true);?>" class="readMore">Read More</a>
													</div>
													<span class="pull-right fa fa-close info"></span>
												</div>
											</div><!-- back -->
										</div><!-- ask-item-complain-card -->
									</div>
								</div><!-- col-md-3 -->
								<?php
									 }
								}
								?>
								</div>
								<div class="ask-home-card ask-search-card">
								<?php
									$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `updatedOn` FROM `tblNewsBlog` WHERE `isNews` = 'N' AND (`title` LIKE '%" . $searchQuery . "%') OR (`newsDesc` LIKE '%" . $searchQuery . "%') OR (`author` LIKE '%" . $searchQuery . "%')");
									if(is_array($result) && count($result) > 0){
										foreach ($result as $key => $value) {
								?>
									<div class="col-md-4 col-sm-4 col-xs-4 paddingbottoms">
									<div class="ask-cards">
										<div class="ask-item-news-card">
											<div class="front">
												<div class="news-logo">
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>">
														<img src="<?php echo $value['newsImage']; ?>" class="img-responsive" alt="" />
													</a>
													<span class="pull-right fa fa-info info"></span>
												</div>
												<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>">
													<div class="news-short-desc">
														<p class="text-black"><?php echo $value['title']; ?></p>
													</div>
													<div class="news-Date">
														<p> April 12, 2016</p>
													</div>
												</a>
											</div><!-- front -->
											<div class="back">
												<div class="news-short-desc">
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>"><p class="text-black"><b><?php echo $value['title']; ?></b></p></a>
													<span class="pull-right fa fa-close info"></span>
												</div>
												<div class="news-about">
													<p><?php echo C::contentMore($value['newsDesc'], 150, C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true)); ?></p>
												</div>
											</div><!-- back -->
										</div><!-- ask-item-news-card -->
									</div>
								</div><!-- col-md-3 -->
								<?php
									}
								}
								?>
								</div>
								<div class="ask-home-card ask-search-card">
								<?php
									$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `updatedOn` FROM `tblNewsBlog` WHERE `isNews` = 'B' AND (`title` LIKE '%" . $searchQuery . "%') OR (`newsDesc` LIKE '%" . $searchQuery . "%') OR (`author` LIKE '%" . $searchQuery . "%')");
									if(is_array($result) && count($result) > 0){
										foreach ($result as $key => $value) {
								?>
									<div class="col-md-4 col-sm-4 col-xs-4 paddingbottoms">
									<div class="ask-cards">
										<div class="ask-item-news-card">
											<div class="front">
												<div class="news-logo">
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>">
														<img src="<?php echo $value['newsImage']; ?>" class="img-responsive" alt="" />
													</a>
													<span class="pull-right fa fa-info info"></span>
												</div>
												<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>">
													<div class="news-short-desc">
														<p class="text-black"><?php echo $value['title']; ?></p>
													</div>
													<div class="news-Date">
														<p> April 12, 2016</p>
													</div>
												</a>
											</div><!-- front -->
											<div class="back">
												<div class="news-short-desc">
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '/' . $value['id'] )), true);?>"><p class="text-black"><b><?php echo $value['title']; ?></b></p></a>
													<span class="pull-right fa fa-close info"></span>
												</div>
												<div class="news-about">
													<p><?php echo C::contentMore($value['newsDesc'], 150, C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true)); ?></p>
												</div>
											</div><!-- back -->
										</div><!-- ask-item-news-card -->
									</div>
								</div><!-- col-md-3 -->
								<?php
									}
								}
								?>
								</div>
								<?php }else{ ?>
									<p>No result found...</p>
								<?php } ?>
							</div><!--Search-body-->
							<!-- extra -->
						<div class="clearfix"></div>
					</div><!-- col-lg-9 col-md-9 -->
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>
