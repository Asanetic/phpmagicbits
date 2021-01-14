<?php
ob_start();
include('./svrconn.php');
include('./phpmagicbits.php');
include('./asndata.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="./terminal.css">
<link rel="stylesheet" href="./boot.css">
<title>Terminal</title>

    <meta name="description" content="">
    <meta name="author" content="">
    <title>Snippet Listing</title>

    <!-- Bootstrap core CSS -->
<?php //include("./includes/header_css_scripts.php");?>
</head>

<body style="background-color:#FFF;">
<form method="post">
<!--Start editor-->
<div class="navbar_ribbon">
<a href="./appview" class="exe_btn text-white">Load Terminal</a>
</div>
<?php 

echo drop_css();

include('./snippetlisting_ui.php');?>
<!--<{ncgh}/>-->
</form>
</body>
</html>




