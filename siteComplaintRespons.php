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

if(isset($_GET['edit']) && trim($_GET['edit'])){
 	$_SESSION['cId'] = $_GET['edit'];
}
if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->complaintResponse($_POST, $_FILES)){
    	C::redirect(C::link('siteComplaintRespons.php', false, true));
    }	
}
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
										$result = $User->query("SELECT `id`, `userId`, `siteName`, `link`, `reason`, `complaintTitle`, `complaintText`, `complaintFiles`, `onSiteAccountName`, `onSiteEmail`, `isVerified`, `status` FROM `tblComplaints` WHERE `id` = '" . $_SESSION['cId'] . "'");
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
														<td style="padding-top:20px;">
															<?php
															$loggedInId = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
															$groupId = $User->query("SELECT `groupId` FROM `tblUser` WHERE `parentId` == '" . $loggedInId . "' LIMIT, 1");
														 if(isset($groupId[0]['groupId']) == 0){
															 if($value['isVerified'] == 'N'){?>
															 	<span style="color:#fff;background:#DA1E2A;padding:5px;">Verify</span>
															<?php }
															else{ ?>
																<span style="color:#fff;background:#DA1E2A;padding:5px;">Verified</span>
															<?php } ?>
															<?php
															 if($value['status'] == 'P'){?>
															 	<span style="color:#fff;background:#5FB962;padding:5px;">Pending</span>
															<?php }
															else if ($value['status'] == 'U'){ ?>
																<span style="color:#fff;background:#5FB962;padding:5px;">Unsolved</span>
																<?php }
														 	else if ($value['status'] == 'S'){ ?>
																<span style="color:#fff;background:#5FB962;padding:5px;">Solved</span>
																<?php 
																}
															} ?>
														</td>
													</tr>
												</table>
											</div>
										</div>

										
										<div class="ask-page-content-body-details responseMsg">
											<?php
											$sql = $User->query("SELECT `id`, `userId`, `siteName`, `responsText`, `responsFiles`, `isVerified` FROM `tblComplaintsResponse` WHERE `complaintId` = '" . $_SESSION['cId'] . "' ORDER BY `updatedOn`");
											if(is_array($sql) && count($sql) > 0){
												foreach ($sql as $idn => $response) {			
											?>
											<div class="content">
												<div class="arrow-content">
													<?php
													$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $response['userId'] . "'");
													if(is_array($res) && count($res) > 0){
														foreach ($res as $index => $val) {
													?>
													<h5 class="page-header comment-preview-header margin-top-0"><span class="text-yellow"><?php echo $val['userId']; ?></span> </h5>
													<?php
														}
													}
													?>
													<div class="comment-show">
														<table class="ask-table">
															<tr>
																<td><?php echo htmlspecialchars($response['responsText']); ?></td>
															</tr>
															<?php if($response['siteName'] != ''){?>
															<tr>
																<td class="text-yellow"><img src="<?php echo $response['complaintFiles']; ?>" alt="" /></td>
															</tr>
															<?php } ?>
															<tr>
																<td>
																	<?php if(isset($groupId[0]['groupId']) == 0){ if($response['isVerified'] == 'N'){?>
																	<span style="color:#fff;background:#5FB962;padding:5px;">Verify</span>
																<?php }
																else{ ?>
																	<span style="color:#fff;background:#5FB962;padding:5px;">Verified</span>
																<?php
																	}
															 	} ?>
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
								 	<hr>
									<?php
										}
									}
									?>
							 	</div>
							 	<div class="ask-page-content">
									<div class="">
										<div class="content">
										 	<form action="" method="POST" enctype="multipart/form-data">
										 		<div class="form-group arrow-content">
										 			<textarea id="" name="responsText" class="form-control" rows="5" style="width:100%;"></textarea>
										 			<input type="hidden" name="complaintId" value="<?php echo $_SESSION['cId'] ;?>">
										 		</div>
										 		<div>
										 			<button type="submit" class="btn btn-ask-red">Complaint Response</button>
										 		</div>

										 	</form>
									 	</div>
							 		</div>
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