<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set("Africa/Nairobi");

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password

$db="asntag";
$asntag="asntag";
$dbname="asntag";


$mysqliconn=mysqli_connect("$host", "$username", "$password") or die("cannot connect"); 

mysqli_select_db($mysqliconn, $db);

$single_db=$db;
$single_conn=$mysqliconn;


$datalimit=15;

if(isset($_SESSION["recordlimit"])){
$datalimit=$_SESSION["filelim"];
}

////=========== record per page function 

function list_record_per_page($mysqliconn, $sqlstring, $reclimit)
{

global $recordperpage_data;


$requested_page = isset($_GET["rectkn"]) ? intval(base64_decode($_GET["rectkn"])) : 1;
$firstrecords_query=mysqli_query($mysqliconn, "".$sqlstring."");
$firstrecords_res = mysqli_fetch_row($firstrecords_query);

$product_count = $firstrecords_res[0];

$products_per_page = $reclimit;

$page_count = ceil($product_count / $products_per_page);
// You can check if $requested_page is > to $page_count OR < 1,
// and redirect to the page one.

$first_product_shown = ($requested_page - 1) * $products_per_page;

$recordperpage_data=array($first_product_shown,$page_count);

return $recordperpage_data;
}



?>