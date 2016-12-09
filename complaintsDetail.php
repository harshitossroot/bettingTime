<?php

require_once('config.php');



// Load Classes
C::loadClass('User');
C::loadClass('Card');

//Init User class
$User = new User();
$Card = new Card();


if(isset($_GET['detail']) && trim($_GET['detail'])){
	$reqID = $_GET['detail'];
	$result = $User->query("SELECT `id`, `userId`, `siteName`, `link`, `reason`, `statusText`, `complaintTitle`, `complaintText`, `complaintFiles`, `amount`, `isVerified`, `status`, `updatedOn` FROM `tblComplaints` WHERE `id` = " . $reqID . " ");
	if(isset($result) && is_array($result) && count($result) > 0){
		$_SESSION['value'] = $result;
	}
}

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->complaintResponse($_POST, $_FILES)){
    	C::redirect(C::link('complaint.php', false, true));
    }
}


?>
<?php require_once('includes/doc_head.php'); ?>
<div class="test">
  <div class="row content">
      <div class="image-complain"></div>
    <div class="details-page">
      <div class="ask-desktop-table">
        <table class="ask-top-table">
          <tr>
            <td>
              <div class="details-page-name">
                <span><span class="text-capitalize"><?php echo $_SESSION['value'][0]['siteName']; ?></span> - <?php echo $_SESSION['value'][0]['complaintTitle']; ?></span>
              </div>
            </td>
            <td>
              <div class="details-page-joinCode">
                <!-- <span>Join Code</span><br>
                <span>6969</span> -->
              </div>
              <div class="details-page-logo">
                <div class="complain-logo">
                  <?php
                    if($_SESSION['value'][0]['status'] == 'P'){
                  ?>
                    <div class="ask-ripple ask-ripple-pending">
                      <span class="glyphicon glyphicon-hourglass ask-complai-logo complai-pending"></span>
                      <span class="ripple-pending" style="z-index:-1;"></span>
                    </div>
                  <?php
                    }else if($_SESSION['value'][0]['status'] == 'S'){
                  ?>
                    <div class="ask-ripple ask-ripple-success">
                      <span class="glyphicon glyphicon-hourglass ask-complai-logo complai-success"></span>
                      <span class="ripple-success" style="z-index:-1;"></span>
                    </div>
                  <?php
                    }else if($_SESSION['value'][0]['status'] == 'U'){
                  ?>
                    <div class="ask-ripple ask-ripple-reject">
                      <span class="glyphicon glyphicon-hourglass ask-complai-logo complai-reject"></span>
                      <span class="ripple-reject" style="z-index:-1;"></span>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </td>
          </tr>
        </table>
        <h5 class="text-white">Complaint Info</h5>
        <table class="ask-table">
          <tr>
            <th class="text-yellow text-capitalize"><?php echo $_SESSION['value'][0]['siteName']; ?></th>
            <th class="text-yellow"><?php echo $_SESSION['value'][0]['reason']; ?></th>
            <th class="text-yellow">
            <?php
              if($_SESSION['value'][0]['status'] == 'P'){
                echo "Pending";
              } else if($_SESSION['value'][0]['status'] == 'S'){
                echo "Solved";
              } else if($_SESSION['value'][0]['status'] == 'U'){
                echo "Unsolved";
              }
            ?>
            </th>
          </tr>
          <tr>
            <td>Disputed Site</td>
            <td>Reason</td>
            <td><?php echo $_SESSION['value'][0]['statusText'] ;?></td>
          </tr>
        </table>
      </div>
      <!-- info for mobile and tablet -->
    <div class="ask-mobile-table">
      <table class="ask-table">
        <tr>
          <td colspan="2">
            <div class="details-page-name">
              <span><span class="text-capitalize"><?php echo $_SESSION['value'][0]['siteName']; ?></span> - <?php echo $_SESSION['value'][0]['complaintTitle']; ?></span>
            </div>
          </td>
        </tr>
      </table>
      <h5 class="text-white">Complaint Info</h5>
      <table class="ask-table">
        <tr>
          <td class="text-yellow">Disputed Site</td>
          <td><?php echo $_SESSION['value'][0]['siteName']; ?></td>
        </tr>
        <tr>
          <td class="text-yellow">Reason</td>
          <td><?php echo $_SESSION['value'][0]['reason']; ?></td>
        </tr>
        <tr>
          <td class="text-yellow"><?php echo $_SESSION['value'][0]['statusText'] ;?></td>
          <td>
            <?php
              if($_SESSION['value'][0]['status'] == 'P'){
                echo "Pending";
              } else if($_SESSION['value'][0]['status'] == 'S'){
                echo "Solved";
              } else if($_SESSION['value'][0]['status'] == 'U'){
                echo "Unsolved";
              }
            ?>
          </td>
        </tr>
      </table>
    </div>
    <!-- info for mobile and tablet end -->
      <div class="margin-top-20">
        <p class="text-white">
          <?php
          if($_SESSION['value'][0]['status'] != 'S'){
          ?>
          <i class="fa fa-cog margin-right-5 font15" aria-hidden="true"></i>
          <span class="font15"><a href="http://<?php echo $_SESSION['value'][0]['link']; ?>" class="text-capitalize text-yellow"><?php echo $_SESSION['value'][0]['siteName']; ?></a> : <?php echo $_SESSION['value'][0]['statusText'] ;?></span>
          <?php } ?>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="ask-content" id="ask-content">
	<div class="row">
		<div class="col-lg-9 col-md-9">
			<div class="ask-page-content">
        <div class="ask-page-content-header">
          <h3 class="heading text-white text-uppercase">Complaint </h3><!--  border-bottom-5 -->
        </div>
        <div class="ask-page-content-body-details" style="overflow:hidden;">
          <div class="row">
            <?php
              $complaintUserId = $User->query("SELECT `userId` FROM `tblUser` WHERE `id` = '" . $_SESSION['value'][0]['userId'] . "'");

            ?>
            <div class="col-lg-2 col-md-2">
              <div class="content img-circle user-complaint text-center">
                <!-- <p class="text-uppercase" style="padding-top:10px;"><b><?php echo $complaintUserId[0]['userId'][0];?></b></p> -->
                <i class="fa fa-user fa-2x" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-lg-10 col-md-10">
              <table class="ask-table table-comments-show">
                <tr>
                  <td>
                    <div class="content arrow-content">
                      <h5 class="page-header comment-preview-header margin-top-0">
                        <span class="text-yellow margin-right-5"><?php echo $complaintUserId[0]['userId'];?></span>
                        <span class="text-white">(posted on <?php echo $_SESSION['value'][0]['updatedOn']; ?>)</span>
                      </h5>
                      <div class="comment-show">
                        <table class="ask-table">
                          <tr>
                            <td style="padding-bottom:10px;">
                              <?php echo $_SESSION['value'][0]['complaintText'] ;?>
                              <?php
                              if($_SESSION['value'][0]['complaintFiles'] != ''){
                              ?>
                              <hr>
                              <ul class="compliant-img">

                                <li>
                                  <a href="<?php echo $_SESSION['value'][0]['complaintFiles'] ;?>" target="_blank"><img src="<?php echo $_SESSION['value'][0]['complaintFiles'] ;?>" class="img-responsive" width="150px" height="90px" alt=""></a>
                                </li>
                              </ul>
                              <?php } ?>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row">
          <?php
            $res = $User->query("SELECT `id`, `siteName`, `userId`, `siteName`, `responsText`, `responsFiles`, `updatedOn` FROM `tblComplaintsResponse` WHERE `isVerified` = 'Y' AND `complaintId` = '" . $_SESSION['value'][0]['id'] . "'");
            if(isset($res) && is_array($res) && count($res) > 0){
              foreach ($res as $key => $val) {
          ?>
            <div class="col-lg-2 col-md-2">
              <div class="content img-circle user-complaint text-center">
                <?php
                  $icon = $User->query("SELECT `groupId` FROM `tblUser` WHERE `id` = '" . $val['userId'] . "'");
                  if($icon[0]['groupId'] == 3){
                ?>
                <i class="fa fa-user fa-2x" aria-hidden="true"></i>
                <?php } else if($icon[0]['groupId'] == 2){ ?>
                <i class="fa fa-user-secret fa-2x" aria-hidden="true" style="margin-left: 3px; margin-top: 4px;"></i>
                <?php } else { ?>
                <i class="fa fa-adn" aria-hidden="true" style="font-size:105px;margin-top:-17px;margin-left:-10px;color:#fff;"></i>
                <?php } ?>
              </div>
            </div>
            <div class="col-lg-10 col-md-10">
              <table class="ask-table table-comments-show">
                <tr>
                  <td>
                    <div class="content arrow-content">
                      <h5 class="page-header comment-preview-header margin-top-0">
                        <span class="text-yellow margin-right-5"><?php echo $val['siteName']; ?></span>
                        <span class="text-white">(posted on <?php echo $val['updatedOn']; ?>)</span>
                      </h5>
                      <div class="comment-show">
                        <table class="ask-table">
                          <tr>
                            <td style="padding-bottom:10px;">
                              <?php echo $val['responsText']; ?>
                              <?php
                              if($val['responsFiles'] != ''){
                              ?>
                              <hr>
                              <ul class="compliant-img">

                                <li>
                                  <img src="<?php echo $val['responsFiles'] ;?>" class="img-responsive" alt="">
                                </li>
                              </ul>
                              <?php } ?>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <?php
              }
            }
            ?>
          </div>

        </div>
      </div>

			<?php
    $logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;
		if( $logedInID == $_SESSION['value'][0]['userId']){

	  ?>
      <div class="ask-page-content">
        <div class="col-md-12">
          <div class="content">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group arrow-content">
                <input type="hidden" name="complaintId" value="<?php echo $_SESSION['value'][0]['id']; ?>" />
                <textarea name="responsText" id="" width="100%" rows="5"></textarea>
              </div>
              <div>
                <button type="submit" class="btn btn-ask-red"> POST RESPONSE</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php
      }
      ?>


<div class="ask-page-content ask-land-page-content">
	<div class="ask-page-content-header">
		<h3 class="text-uppercase">Other Complaints <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="complaint.php" class="text-white">View more</a></span></h3><!--  border-bottom-5 -->
		<p class="custom-p custom-text">Have troubles with Sports? <a href="submitComplaint.php">Submit a complaint</a> or <a href="">Learn more</a> .  </p>
	</div>
	<div class="ask-page-content-body ask-detail-page-card">
	<?php
		$result = $User->query("SELECT `id`, `reason`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y'  ORDER BY `updatedOn` desc LIMIT 3");
		if(is_array($result) && count($result) > 0){
			foreach ($result as $key => $value) {
		?>
		<div class="col-md-3 col-sm-3 col-xs-3 padding0  ask-land-web-card">
			<div class="ask-cards">
				<div class="ask-item-complain-card">
					<div class="front">
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
									<span class="glyphicon glyphicon-ok-sign ask-complai-logo complai-success"></span>
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
								<span class="pull-right fa fa-info info"></span>
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
						<a href="<?php echo C::link('complaintsDetail.php', array('detail' => $value['id']), true);?>">
							<div class="complain-short-desc" style="padding-top: 0px;">
								<p><?php echo $value['complaintTitle']; ?></p>
							</div>
							<div class="complain-Date" style="padding-top: 2px;">
								<p> <span style="font-size:24px;font-weight:900;">&pound; <?php echo $value['amount']; ?></span><br>
									<?php echo $value['reason']; ?> </p>
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
</div><!-- bonus code landing-->


    </div><!-- col-lg-9 col-md-9 -->
		<div class="col-lg-3 col-md-3" style="padding-left: 0px;">
      <?php require_once('includes/sportsRecommend.php'); ?>
    </div>
	</div>
</div>
<?php require_once('includes/doc_footer.php'); ?>
