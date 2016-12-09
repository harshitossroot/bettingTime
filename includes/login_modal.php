<?php
require_once ('config.php');
$User = new User();
$Common = new Common();

// if(isset($_GET['logout']) && trim($_GET['logout']) == 'logout'){
//     UNSET($_SESSION['admin']);
//     header("LOCATION:login.php");
// }

// if($User->checkLoginStatus()){
// 	$Common->redirect('index.php');
// }
// if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['__FORM']) && $_POST['__FORM'] == '_LOGIN_'){
// 	if($User->login($_POST)){
// 		$Common->redirect('index.php');
//     Message::addMessage("successfull.", SUCCS);
// 	}
// }



?>
<!-- modal login -->

		<div class="modal fade in" id="myModal" role="dialog">
	        <div class="modal-dialog ask-modal-dialog">
	            <div class="modal-content ask-modal-content">
	            	<div class="ask-modal-content" style="width:95%;margin:10px auto;">
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                    <h4 class="modal-title">Login To Your Account</h4>
		                </div>
		                <div class="modal-body">
		                	<div class="login-icon-ask">
		                		<!-- <span class="glyphicon glyphicon-user login-glymph-icon"></span> -->
		                		<img src="images/user2.png" class="" style="height:200px;margin-top: 30px;" alt="">
		                	</div>
		                    <form class="kode-loginform ask-login-form" id="loginForm" action="" enctype="multipart/form-data" method="post" autocomplete="off">
		                      	<input type="hidden" name="__FORM" value="_LOGIN_" />
		                      	<p class="border-bottom-5"><span class="glyphicon glyphicon-user"></span> <input type="text" name="userId" placeholder="User Id" required="required"></p>
		                      	<p class="border-bottom-5"><span class="glyphicon glyphicon-lock"></span> <input type="password" name="password" placeholder="Password" required="required"></p>
		                      	<a href="" class="text-white myModalThreeBtn" data-toggle="modal" data-target="#myModalThree">Forgot Password</a>
		                      	<br/>
		                      	<div class="row">
			                      	<div class="col-xs-6" style="padding-left: 10px;">
			                      		<button class="btn btn-ask-green btn-100" type="submit">Sign in</button>
			                      	</div>

			                      	<div class="col-xs-6">
			                      		<!-- <a href="#" class="text-white btn btn-ask-red btn-100 myModalTwoBtn" data-backdrop="true" data-toggle="modal" data-target="#myModalTwo">Sign up</a> -->
			                      		<!-- <a href="#" class="text-white btn btn-ask-red btn-100 myModalTwoBtn" data-backdrop="true" data-toggle="modal" data-target="#myModalTwo">Sign up</a> -->
			                      		<a href="#" class="text-white btn btn-ask-red btn-100 myModalTwoBtn" data-backdrop="false" data-toggle="modal" data-target="#myModalTwo" id="signUp">회원가입</a>
			                      	</div>
		                      	</div>
		                    </form>
		                </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <?php require_once('includes/forgetpwd_modal.php'); ?>



	    <!-- modal login -->
