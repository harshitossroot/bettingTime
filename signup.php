<?php
if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['__FORM']) && $_POST['__FORM'] == '_SIGNUP_'){
{
  require_once ('config.php');
  $User = new User();
  echo print_r($_POST);
/*  if($User->userSignUp($_POST)){
    Message::addMessage("Congratulation! Your account has been created successfully. To continue using site, please verify your e-mail", SUCCS);
  }*/

}


 ?>
