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

if(!$User->checkLoginStatus()){
	$Common->redirect('index.php');
}
$logedInID = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
$groupId = $User->query("SELECT `siteName`, `groupId` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 1");
if ( $groupId[0]['groupId'] != 2) {
	$Common->redirect('index.php');
}else{
	$_SESSION['sitename'] = $groupId[0]['siteName'];
}

// if ( $groupId[0]['groupId'] != 0 && $groupId[0]['groupId'] == 2) {
// 	$siteName = $Base->query("SELECT `siteName` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 1");
// }

?>
<?php require_once('includes/doc_head.php'); ?>
	<div class="ask-content" id="ask-content">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="ask-page-content-body-details" style="overflow:hidden;">
					<div class="">
					 	<div class="col-md-12 text-white complain-form">
							<div class="ask-page-content">
								<div class="ask-page-content-header">
									<h3 class="text-uppercase">Site Name</h3>
								</div>
								<div class="ask-page-content-body-details">
									<?php 
										$result = $User->query("SELECT `id`, `userId`, `siteName`, `link`, `reason`, `complaintTitle`, `complaintText`, `complaintFiles`, `onSiteAccountName`, `onSiteEmail`, `isVerified`, `status` FROM `tblComplaints` WHERE `siteName` = '" . $_SESSION['sitename'] . "' ORDER BY `updatedOn` DESC");
										if(is_array($result) && count($result) > 0){
											foreach ($result as $key => $value) {
									?>
									<div class="content">
										<div class="arrow-content">
											<?php
											$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
											if(is_array($res) && count($res) > 0){
												foreach ($res as $index => $val) {
											?>
											<h5 class="page-header comment-preview-header margin-top-0"><span class="text-yellow"><?php echo $val['userId']; ?></span> has Complaint against <a href="http://<?php echo $value['link']; ?>" target="_blank"><span class="text-success text-uppercase"> <?php echo $value['siteName']; ?></span></a></h5>
											<?php
												}
											}
											?>
											<div class="comment-show">
												<table class="ask-table">
													<tr>
														<td>Reason: <?php echo $value['reason']; ?></td>
													</tr>
													<tr>
														<td class="text-yellow"><?php echo $value['complaintTitle']; ?></td>
													</tr>
													<tr>
														<td><?php echo $value['complaintText']; ?></td>
													</tr>
													<tr>
														<td>
															<?php
															$loggedInId = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
															$groupId = $User->query("SELECT `groupId` FROM `tblUser` WHERE `parentId` == '" . $loggedInId . "' LIMIT, 1");
														 if(isset($groupId[0]['groupId']) == 0){
															 if($value['isVerified'] == 'N'){?>
															 	<a href="<?php echo C::link('complaint.php', array('edit' => $value['id'] . '+verifyComplaint'), true);?>" class="btn btn-ask-grd-blue text-white" disabled=’disabled’>Verify</a>
															<?php }
															else{ ?>
																<a href="<?php echo C::link('complaint.php', array('edit' => $value['id'] . '+verifiedComplaint'), true);?>" class="btn btn-ask-grd-blue text-white" disabled=’disabled’>Verify</a>
															<?php } ?>
															<?php
															 if($value['status'] == 'P'){?>
															 	<a href="<?php echo C::link('complaint-edit.php', array('status' => $value['id']), true);?>" class="btn btn-ask-green text-white" disabled=’disabled’>Pending</a>
															<?php }
															else if ($value['status'] == 'U'){ ?>
																<a href="<?php echo C::link('complaint-edit.php', array('status' => $value['id']), true);?>" class="btn btn-ask-green text-white" disabled=’disabled’>Unsolved</a>
																<?php }
														 	else if ($value['status'] == 'S'){ ?>
																<a href="<?php echo C::link('complaint-edit.php', array('status' => $value['id']), true);?>" class="btn btn-ask-green text-white" disabled=’disabled’>Solved</a>
																<?php 
																}
															} ?>
															<!-- <a href="" class="btn btn-ask-grd-blue text-white">Verify</a>
															<a href="" class="btn btn-ask-green text-white">Status</a> -->
															<a href="<?php echo C::link('siteComplaintRespons.php', array('edit' => $value['id']), true);?>" class="btn btn-ask-red text-white">Replay</a>
															<!-- <span id=""  class="btn btn-ask-black text-white responseButton">Conversation</span> -->
															<a href="<?php echo C::link('siteComplaintRespons.php', array('edit' => $value['id']), true);?>" class="btn btn-ask-black text-white">Conversation</a>
														</td>
													</tr>
												</table>
											</div>
										</div>
								 	</div>
									<?php
										}
									}
									?>
							 	</div>

							</div>
						</div>
					</div>
				</div>
			</div><!-- col-lg-12 col-md-12 -->
			
			</div><!-- row -->
		</div><!-- ask-content -->
	</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>