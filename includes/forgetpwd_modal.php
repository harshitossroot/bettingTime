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

// $message = false;
// if($message = Message::getMessage()){
//     $message = implode('<br />', $message[0]);
// }

?>

<div class="modal fade" id="myModalThree" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ask-modal-dialog">
        <div class="modal-content ask-modal-content">
        	<div class="ask-modal-content" style="width:95%;margin:10px auto;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Forgot Password</h4>
                </div>
                <div class="modal-body">
                    <form class="kode-loginform ask-login-form" id="" name="sndPwd" action="" enctype="multipart/form-data" method="post" autocomplete="off">
                        <input type="hidden" name="__FORM" value="_PASSWORD_" />
                      	<p class="border-bottom-5"><span class="glyphicon glyphicon-user"></span> <input type="text" name="email" placeholder="email"></p>
                      	<div class="row">
	                      	<div class="col-xs-6">
	                      		<button class="btn btn-ask-green btn-100" type="submit">Send password</button>
	                      	</div>
	                      	<div class="col-xs-6">
	                      		<a href="#" class="text-white btn btn-ask-red btn-100 myModalTwoBtn" data-toggle="modal" data-target="#myModalTwo">Sign up</a>
	                      	</div>
                      	</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>