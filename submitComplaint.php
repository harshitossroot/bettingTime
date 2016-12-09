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




if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	if(!$User->checkLoginStatus()){
		//$Common->redirect('index.php');
		Message::addMessage("You are not logged in. Please login here to post your Complaints", ERR);
	}else{
		if($Card->addComplaint($_POST, $_FILES)){
			//C::redirect(C::link('submitComplaint.php', false, true));
			Message::addMessage("Your Complaint will be displayed after verify by admin.", SUCCS);
    	}
	}
}
?>
<?php require_once('includes/doc_head.php'); ?>
			<div class="test">
				<div class="row content">
					<div class="image-complain"></div>
					<h2 class="text-center text-uppercase text-white">Trouble with sports? Here we are to help You</h2>
					<div class="details-page">
						<div class="row">
							<div class="col-md-4">
								<div class="complainPage-page-logo">
									<div class="complain-logo">
										<div class="ask-ripple">
											<span class="glyphicon glyphicon-hourglass ask-complai-logo complai-pending"></span>
											<span class="ripple-pending" style="z-index:-1;"></span>
										</div>
									</div>
								</div>
								<div class="complainPage-counter">
									<p class="text-center text-white">pending</p>
									<?php 
									$result = $User->query("SELECT COUNT( * ) AS `count` , `status` FROM `tblComplaints` GROUP BY `status` ");
									?>
									
									<h2 class="text-center text-white complain-counter"><?php echo $result[0]['count'];?></h2>
								</div>
							</div>
							<div class="col-md-4">
								<div class="complainPage-page-logo">
									<div class="complain-logo">
										<div class="ask-ripple">
											<span class="glyphicon glyphicon glyphicon-ok-sign ask-complai-logo complai-success"></span>
											<span class="ripple-success"></span>
										</div>
									</div>
								</div>
								<div class="complainPage-counter">
									<p class="text-center text-white">Solved</p>
									<h2 class="text-center text-white complain-counter"><?php echo $result[1]['count'];?></h2>
								</div>
							</div>
							<div class="col-md-4">
								<div class="complainPage-page-logo">
									<div class="complain-logo">
										<div class="ask-ripple">
											<span class="glyphicon glyphicon-remove-circle ask-complai-logo complai-reject"></span>
											<span class="ripple-reject"></span>
										</div>
									</div>
								</div>
								<div class="complainPage-counter">
									<p class="text-center text-white">Unsolved</p>
									<h2 class="text-center text-white complain-counter"><?php echo $result[2]['count'];?></h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<style>
			select option {
				/*margin:40px;*/
				background: rgba(0,0,0,0.3);
				color:#fff;
				text-shadow:0 1px 0 rgba(0,0,0,0.4);
			}
			 #sel2 option {
				/*margin:40px;*/
				background: #051730 !important;
				color:#fff !important;
				text-shadow:0 1px 0 rgba(0,0,0,0.4) !important;
			}
			.not-show{display:none;}
			</style>
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="heading text-white text-uppercase">Submit Your Complaint Here </h3><!--  border-bottom-5 -->
							</div>
							<div class="ask-page-content-body-details" style="overflow:hidden;">
								<div class="content">
									<form action="" method="post" enctype="multipart/form-data">
										<p class="text-white">Select an option that best describes the issue</p>
									 	<div class="col-md-6">
										 	<select class="form-control issue-select" id="sel1" name="reason" required>
										 		<optgroup label="입금/출금">
											    	<option value="입출금 지연" data-show=".1">입출금 지연</option>
											    	<option value="입출금 거절" data-show=".2">입출금 거절</option>
											    	<option value="추가입금 요구" data-show=".3">추가입금 요구</option>
												</optgroup>
												<optgroup label="보너스">
											    	<option value="보너스 조건 위반" data-show=".3">보너스 조건 위반</option>
											    	<option value="보너스 지불 거절" data-show=".4">보너스 지불 거절</option>
											    	<option value="보너스 지불 거절" data-show=".5">보너스 철회 거절</option>
												</optgroup>
												<optgroup label="계정">
											    	<option value="계정 잠금" data-show=".6">계정 잠금</option>
											    	<option value="사이트 규정 위반" data-show=".7">사이트 규정 위반</option>
												</optgroup>
												<optgroup label="기타">
											    	<option value="기타" data-show=".7">기타</option>
												</optgroup>
								  			</select>
									 	</div>
									 	<div class="clearfix"></div>
									 	<div class="col-md-12 margin-top-30">
										 	<h3 id="issue-heading" class="text-yellow page-header">입출금 지연</h3>
											<div class="reason-text">
												<div id="" class="1 not-show">
													<p class="text-white">1Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
												</div>
												<div id="" class="2 not-show">
													<p class="text-white">2Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
												</div>
												<div id="" class="3 not-show">
													<p class="text-white">3Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
												</div>
												<div id="" class="4 not-show">
													<p class="text-white">4Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
												</div>
												<div id="" class="5 not-show">
													<p class="text-white">5Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
												</div>
												<div id="" class="6 not-show">
													<p class="text-white">6Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
												</div>
												<div id="" class="7 not-show">
													<p class="text-white">7Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
													<p class="text-white">Game of Thrones! Need we say anymore? Let’s face it we all love it and Optibet Casino are just as excited about Season 6 as we are. So much so they’ve decided to offer a special weekly bonus and free spins and of course the game you’ll be playing is Microgaming’s legendary Game of Thrones Slot.</p>
												</div>
											</div>
									 	</div>
									 	<div class="col-md-12 margin-top-30 text-white">
									 		<h4>Was this helpful?</h4>
										 	<div class="radio">
										      	<label><input type="radio" name="optradio" autocomplete="off">Yes. I understand how to resolve my issue.</label>
										    </div>
										    <div class="radio">
										      	<label><input type="radio" name="optradio" id="optradioNo" autocomplete="off">No. I still want to submit a complaint.</label>
										    </div>
									 	</div>
									 	<div class="col-md-12 margin-top-30 text-white" id="complain-form">
									 		<h4>File a complaint submission form:</h4>
										 	<ul>
										 		<li>Be descriptive</li>
										 		<li>Always attach documented proof</li>
										 		<li>Play fair</li>
										 		<li>Using false or fake evidence is law infringement and bad manners.</li>
										 	</ul>
										 	<div class="">
									 			<div class="col-md-6">
									 				<div class="form-group">
									 					<input type="text" name="complaintTitle" class="form-control" placeholder="Complaint Title" required />
									 				</div>
									 				<div class="form-group">
									 					<select class="form-control" id="sel2" name="link" required>
													    	<?php
															$res = $User->query("SELECT `siteName`, `link` FROM `tblWebCards` GROUP BY `siteName`");
																if(isset($res) && is_array($res) && count($res) > 0){
																	foreach ($res as $id => $data) {
														?>
													    	<!-- <option value="<?php echo $data['link'].'/'.$data['siteName']; ?>"><?php echo $data['siteName']; ?></option> -->
													    	<option value="<?php echo $data['link']; ?>"><?php echo $data['siteName']; ?></option>
												    	<?php
												    		}
												    	}
												    	?>
											  			</select>
											  			<input type="hidden" name="siteName" id="complaintSitName" value="" />
									 				</div>
									 				<div class="form-group">
									 					<textarea name="complaintText" id="" rows="3" style="width:100%;" placeholder="Complaint Text" required></textarea>
									 				</div>
									 				<div class="form-group">
									 					<input type="text" name="amount" class="form-control" placeholder="Amount" required />
									 				</div>
									 				<div class="form-group addMoreContainer">
									 					<input type="file" name="complaintFiles" class="form-control complaintFiles" />
									 					<button type="button" class="btn btn-ask-green" id="addMoreFile">Add More</button>
									 					<button type="button" class="btn btn-ask-red" id="removeFile">Remove</button>
									 				</div>
									 				<h4 class="text-yellow">Following information will not be published.</h4>
									 				<div class="form-group">
									 					<input type="text" name="onSiteAccountName" class="form-control" placeholder="Account Name used in sports site" required />
									 				</div>
									 				<div class="form-group">
									 					<input type="email" name="onSiteEmail" class="form-control" placeholder="Email Name used in sports site" />
									 				</div>
									 				<div class="radio">
												      	<label><input type="radio" name="radioTerms" autocomplete="off" required>I read the <a href="#" class="text-red">Terms and Conditions</a></label>
												    </div>
												    <div>
												      	<button type="submit" class="btn btn-ask-red btn-w100">Submit my complaint</button>
												    </div>
									 			</div>
										 	</div>
									 	</div>
									</div>
								</form>
							</div>
						</div>
					</div><!-- col-lg-12 col-md-12 -->
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
		
<?php require_once('includes/doc_footer.php'); ?>