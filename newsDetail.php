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
	if(isset($reqID['1'])){
	$result = $User->query("SELECT `id`, `title`, `newsDesc`, `author`, `newsImage`, `updatedOn` FROM `tblNewsBlog` WHERE `id` = '" . $reqID[1] . "'");
		if(isset($result) && is_array($result) && count($result) > 0){
			$_SESSION['value'] = $result;
		}
	}
}

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	if(!$User->checkLoginStatus()){
		$Common->redirect('index.php');
	}else{
		if($Card->addNewsComments($_POST, $reqID['1'])){
    		//C::redirect(C::link('newsDetail.php', false, true));
			Message::addMessage("Your comment will be displayed after verify by admin.", SUCCS);
    	}
	}
}


?>
<?php require_once('includes/doc_head.php'); ?>
			<!-- <div class="test">
				<div class="row content">
					<img src="images/unnamed.jpg" class="newsDetail-image" alt="">
				</div>
			</div> -->
			<div class="clearfix"></div>
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-9 col-md-9">
						<div class="ask-page-content">
							<div class="">
								<h3 class="heading text-white text-uppercase page-header text-yellow"><?php echo $_SESSION['value']['0']['title']; ?> </h3><!--  border-bottom-5 -->
								<p class="text-white"><em><?php echo $_SESSION['value']['0']['author']; ?></em> in Site News published on <?php echo $_SESSION['value']['0']['updatedOn']; ?> </p>
								<img src="<?php echo $_SESSION['value']['0']['newsImage']; ?>" class="img-responsive w-100" />
							</div>
							<div class="ask-page-content-body-details" style="overflow:hidden;">
								<div class="content newsDescSec">
									<?php echo $_SESSION['value']['0']['newsDesc']; ?>
								</div>
							</div>
						</div>
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Other News</h3><!--  border-bottom-5 -->
								<p class="custom-p custom-text">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body ask-detail-page-card"><!--  -->
							<?php
								$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `updatedOn` FROM `tblNewsBlog` ORDER BY `updatedOn` desc LIMIT 3");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
							?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">
									<div class="ask-cards">
										<div class="ask-item-news-card">
											<div class="front">
												<div class="news-logo">
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>">
														<img src="<?php echo $value['newsImage']; ?>" class="img-responsive" alt="" />
													</a>
													<span class="pull-right fa fa-info info"></span>
												</div>
												<div class="news-short-desc">
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>"><p class="text-black"><?php echo $value['title']; ?></p></a>
												</div>
												<div class="news-Date">
													<p> April 12, 2016</p>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="news-short-desc">
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>"><p class="text-black"><b><?php echo $value['title']; ?></b></p></a>
													<span class="pull-right fa fa-close info"></span>
												</div>
												<div class="news-about">
													<p><?php $newsDesc=strip_tags($value['newsDesc']); echo substr($newsDesc, 0, 100) . '...'; ?></p>
													<div class="text-center">
														<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>" class="readMore">Read More</a>
													</div>
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
						</div><!-- verified sports landing -->
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="heading text-white text-uppercase">Player Comments</h3><!--  border-bottom-5 -->
							</div>
							<div class="ask-page-content-body-details">
								<form action="" method="post" enctype="multipart/form-data">
									<div class="col-lg-12 col-md-12">
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
											<p class="text-white">Rate this Content</p>
											<div class="rating font13 text-white star-margin" style="margin-top:-7px;">
		                                        <div class="rateyo-readonly-widg" data-toggle="tooltip" title=""></div>
		                                        <div class="counter ratingCounter"></div>
		                                        <input type="hidden" name="commentRate" value="" />
		                                    </div>
		                                    <p class="text-white"><input type="checkbox" name="checkPost" /><span style="margin-left:30px;">I declare that my review is based on my own experience and represents my genuine opinion of this casino. I'm not a casino employee and have not been offered any incentive or payment by the casino to write this review. I understand that AskGamblers has zero-tolerance policy on fake reviews. </span></p>
		                                    <div style="margin-top:20px;margin-bottom:10px;">
		                                    	<button type="submit" class="btn btn-ask-red" style="margin-left:0px;margin-top:0px;">Post Comment</button><a href="" class="text-yellow">View Posting Guidelines</a>
	                                    	</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div><!-- col-lg-9 col-md-9 -->
					<div class="col-lg-3 col-md-3" style="padding-left: 0px;">
						<?php require_once('includes/sportsRecommend.php'); ?>
					</div>
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>
