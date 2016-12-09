<?php
require_once ('config.php');
$User = new User();
$Common = new Common();

if(isset($_GET['logout']) && trim($_GET['logout']) == 'logout'){
    UNSET($_SESSION['admin']);
    header("LOCATION:index.php");
}

// if($User->checkLoginStatus()){
// 	$Common->redirect('index.php');
// }




?>
<!-- modal signup myModalTwo-->
	    <div class="modal fade" id="myModalTwo" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-dialog ask-modal-dialog">
	            <div class="modal-content ask-modal-content">
	            	<div class="ask-modal-content" style="width:95%;margin:10px auto;">
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                    <h4 class="modal-title">Register here</h4>
		                </div>
		                <div class="modal-body">
		                	<div class="login-icon-ask visible-md visible-lg">
		                		<span class="glyphicon glyphicon-pin login-glymph-icon"></span>
		                		<img src="images/user2.png" class=""  alt="">
		                	</div>
		                	<?php require_once(INCLUDES . "message.php");?>
		                    <form class="kode-loginform ask-login-form" id="signupForm" action="" enctype="multipart/form-data" method="post" autocomplete="off">
		                    	<input type="hidden" name="__FORM" value="_SIGNUP_" />
		                    	<p class="border-bottom-2"><span class="glyphicon glyphicon-user"></span> <input type="text" name="tblUser[userId]" id="tblUser_userId" placeholder="User Id" required="required"></p>
		                    	<p class="border-bottom-2"><span class="glyphicon glyphicon-edit"></span> <input type="text" name="tblUser[nickName]" id="tblUser_nickName" placeholder="Nick Name" required="required"></p>
		                      	<p class="border-bottom-2"><span class="glyphicon glyphicon-envelope"></span> <input type="email" name="tblUser[email]" id="tblUser_email" placeholder="Email" required="required"></p>
		                      	<p class="border-bottom-2"><span class="glyphicon glyphicon-lock"></span> <input type="password" name="tblUser[password]" id="tblUser_password" placeholder="Password" required="required"></p>
		                      	<p class="border-bottom-2"><span class="glyphicon glyphicon-lock"></span> <input type="password" name="tblUser[confirmpassword]" id="tblUser_confirm_password" placeholder="Confirm Password" required="required"></p>
		                      	<div class="row">
		                      		<div class="col-xs-6">
		                      			<button class="btn btn-ask-green btn-100" type="submit" style="margin-left:0px;">Sign Up</button>
		                      		</div>

		                      		<div class="col-xs-6">
		                      			<a href="#" class="text-white btn btn-ask-red btn-100 myModalBtn" data-backdrop="true" data-toggle="modal" id="sn_modal" data-target="#myModal">Sign In</a>
		                      		</div>
                            </div>
	                      		</div>
		                    </form>
		                </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- modal signup -->
