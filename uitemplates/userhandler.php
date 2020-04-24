$userhandler_scripts='
<?php

//********************************** Start insert Query **************************

//=========Insert Variables


if(isset($_POST["membregister_btn"])){

 '.str_replace("<br/>" ,PHP_EOL, $insvals).'
 
 //============ Insert Query SQL
 //====validate duplicates
'.$validatedups.'
if($userduplicate_res==0){
//====validate duplicates
 '.$insertquery.'
    header(\'location:./login\');
}else{
echo \'<div class="office57_alertmsgbox_placard" id="msgcard" Onclick="document.getElementById(\'."\'msgcard\'".\').style.display=\'."\'none\'".\';">
<div class="placrdmsg">Sorry! Email already registered with us, please try another one. :)</div></div>\';
 }
}
 //************************ End insert Query *************************
 
//===sign up=====


//===login=====
if(isset($_POST[\'memb_login_btn\'])){

$adminemail=$_POST[\'login_user\'];

$adminpass=$_POST[\'login_password\'];

$login_query=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tblname.'` WHERE '.$extraemail.'=\'$adminemail\' AND '.$extrapass.'=\'$adminpass\'") or die ("User Login Query Error occured");

$login_result=mysqli_fetch_array($login_query);

if (!empty($login_result[\''.$extraemail.'\']) AND !empty($login_result[\''.$extrapass.'\'])){

session_start();

	$_SESSION[\'user_'.strtolower(str_replace(" ", "", $_SESSION['session_app'])).'_'.$tblname.'_logged\']=TRUE;
	
'.$sessvars.'
$_SESSION[\''.$sessionappusername.'_user_name\']=$login_result[\''.$extrauser.'\'];

	
	$retmsg=base64_encode("Login Succesful! Hello ".$_SESSION[\'msg_username\'].". Pick any task to get started");
	$othervars="";
	header("Location: ../'.base64_decode($_GET['extras_go_to']).'");
	
}else{
	$retmsg=("Wrong Password Or username. Please try again");
	
	$othervars="error";

echo \'<div class="office57_alertmsgbox_placard" id="msgcard" Onclick="document.getElementById(\'."\'msgcard\'".\').style.display=\'."\'none\'".\';">
<div class="placrdmsg">\'.$retmsg.\'</div></div>\';	
}


}
//===login=====

//=========request password
if(isset($_POST[\'requestnewpass_btn\'])){

$membusername=$_POST[\'email_user\'];

$cpsreset_query1=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tblname.'`  WHERE '.$extraemail.'=\'$membusername\'");

$cpsreset_res1=mysqli_fetch_array($cpsreset_query1);

$cpsreset_query=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tblname.'`   WHERE '.$extraemail.'=\'$membusername\'");

$cpsreset_res=mysqli_num_rows($cpsreset_query);
if($cpsreset_res==1){

$showname="'.$_SESSION['session_app'].'"; 
$tel="0710766390"; 

$from_email="clearphrases@gmail.com";

$to_email=$_POST[\'email_user\'];
$client_names=$cpsreset_res1[\''.$extrauser.'\'];


$path1="http://".$_SERVER[\'HTTP_HOST\'].$_SERVER[\'PHP_SELF\'];
//echo $path1;

$msgtosend=\'Hello You requested a password request. Follow this link to create a new password.<br /><br />
<a href="\'.$path1.\'?reset_token=\'.base64_encode($cpsreset_res1[\''.$edittoken.'\']).\'">Reset Password</a><br /><br />\';

$message=$msgtosend;
$subject="Password reset Request";
$actlink="http://www.clearphrases.com";


$replypath="http://www.clearphrases.com";


$messvars = "sendemailapi=send&mailsubj=".$subject."&showname=".$showname."&namesarray=".$client_names."&mailmessage=".$message."&sendto=".$to_email."&repmail=".$from_email."&actlink=".$actlink."&replypath=".$replypath."&imgreq=";

//echo $msgtosend;
$agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)";
$ch = curl_init( "http://clearphrases.com/clearphrases_apis/comms/emailsender.php");
curl_setopt( $ch, CURLOPT_POST, 1);

curl_setopt( $ch, CURLOPT_POSTFIELDS, $messvars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
$sendsmsres = curl_exec( $ch );

echo \'<div class="office57_alertmsgbox_placard" id="msgcard">
<div class="placrdmsg">We have sent you a reset password email. Follow that link to reset your password</div></div>\';




}else{
echo \'<div class="office57_alertmsgbox_placard" id="msgcard">
<div class="placrdmsg">Sorry that email does not exist. Please Try Again.</div></div>\';
}
}
//===================reset password request

////===========reset pass=============
if(isset($_GET[\'reset_token\'])){

$memberkey=base64_decode($_GET[\'reset_token\']);


$cpsresetoken_query=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tblname.'`  WHERE '.$edittoken.'=\'$memberkey\'");

$cpsresetoken_res=mysqli_num_rows($cpsresetoken_query);


}
if(isset($_POST[\'changepass_btn\'])){
$memberkey=base64_decode($_GET[\'reset_token\']);

$cpsresetoken_query1=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tblname.'`  WHERE '.$edittoken.'=\'$memberkey\'");

$cpsresetoken_res1=mysqli_fetch_array($cpsresetoken_query1);

$foundresetmail=$cpsresetoken_res1[\''.$extraemail.'\'];
$resetpass1=mysqli_real_escape_string($mysqliconn,$_POST[\'newpass_user\']);
$resetpass2=mysqli_real_escape_string($mysqliconn,$_POST[\'confirmnewpass_user\']);
if($resetpass1!=$resetpass2){

echo \'<div class="office57_alertmsgbox_placard" id="msgcard" >
<div class="placrdmsg">Password Do Not match!!</div></div>\';
}else{

mysqli_query($mysqliconn,"UPDATE `$'.$dbname.'`.`'.$tblname.'` SET '.$extrapass.'=\'$resetpass1\' WHERE '.$extraemail.'=\'$foundresetmail\' AND '.$edittoken.'=\'$memberkey\'");

echo \'<div class="office57_alertmsgbox_placard" id="msgcard">
<div class="placrdmsg">Password reset succesfully. Login afresh to continue. </div></div>\';
}
}
//===========reset pass=============
?>
';
