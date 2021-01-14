<?php
ob_start();
include('./svrconn.php');

include("./phpmagicbits.php");

function help()
{
return "Type echo fend_help(); for front end and echo bend_help(); for back end";
}

include("./phpmagicui.php");
include("./phpmagicbackend.php");
//include('./bootui.php');

  //error handler function

  function customError($errno, $errstr) {
    echo "<b>Error:</b> [$errno] $errstr<hr>".help();
  }

  //set error handler
  //set_error_handler("customError");

//=========
$col_script="
`primkey` int(255) PRIMARY KEY AUTO_INCREMENT,
`snippetid` varchar(500) NOT NULL,
`snippet_title` varchar(500) NOT NULL,
`snippet_details` blob NOT NULL";


$snippet_code="
`primkey` int(255) PRIMARY KEY AUTO_INCREMENT,
`snippetid` varchar(500) NOT NULL,
`snippet_title` varchar(500) NOT NULL,
`snippet_details` blob NOT NULL";
//snippet table == asn_snippets


$navbar_path="./includes/navbar.php";
$footer_path="./includes/footer.php";
$header_css_scripts="./includes/header_css_scripts.php";
$background_image_path="";
$template_path="";

$icon_title_json='{"New Projects":"./img/logo.png","Revisions":"./img/logo.png","Available Projects":"./img/logo.png"}';

if(isset($_POST['execute_terminal']))
{

		  $file_to_write = fopen($_POST['txt_directory'], 'w') or die("can't open file");
		  fwrite($file_to_write, "<?php ".$_POST['txt_new_code']."?>");
		  fclose($file_to_write);

		  echo "Input : ".$_POST['txt_new_code'].'<hr style="border : 1px solid #7f7e7e">Output : ';

		  include(($_POST['txt_directory']));

}


if(isset($_POST['load_file']))
{
	echo file_get_contents($_POST['txt_writeto']);

}

if(isset($_POST['save_file']))
{

	$backup= file_get_contents($_POST['txt_writeto']);

   if (!file_exists('./edithistory')) @mkdir('./edithistory');

		  $file_to_write = fopen('./edithistory/'.$_POST['txt_writeto'].'_bkup.astg', 'w') or die("can't open file");
		  fwrite($file_to_write, $backup);
		  fclose($file_to_write);

	 file_put_contents($_POST['txt_writeto'], $_POST['txt_new_code']);

	 echo "File Saved";

}

if(isset($_POST["asn_snippets_insert_btn"])){
//------- begin Create Update record from asn_snippets --> 
$snippetid=mysqli_real_escape_string($mysqliconn, magic_random_str(10));
$snippet_title=mysqli_real_escape_string($mysqliconn, $_POST["txt_snippet_title"]);
$snippet_details=mysqli_real_escape_string($mysqliconn, $_POST["txt_snippet_details"]);
//===-- End Create Update record from asn_snippets -->


$asn_snippets_insert_query = mysqli_query($mysqliconn, "INSERT INTO `$asntag`.`asn_snippets` (`primkey`,`snippetid`,`snippet_title`,`snippet_details`) VALUES (NULL,'$snippetid','$snippet_title','$snippet_details')");

echo "Snippet Added";
}
//************* END INSERT QUERY 

if(isset($_POST["qasn_snippets_btn"])){

$qasn_snippets=mysqli_real_escape_string($mysqliconn, ($_POST["qasn_snippets"]));

//=== start asn_snippets select  Like Query String asn_snippets list  

$asn_snippets_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$asntag`.`asn_snippets`  WHERE (`snippet_title` LIKE '%".$qasn_snippets."%' OR  `snippet_details` LIKE '%".$qasn_snippets."%') ORDER BY `primkey` DESC LIMIT $datalimit" );
$snippent_r="";

while($asn_snippets_list_r=mysqli_fetch_array($asn_snippets_list_query))
{
	$snippent_r.='Snippet -- <b>'.$asn_snippets_list_r['snippet_title'].'</b><br><textarea class="snippet_card" onclick="load_to_editor(this.value)" onkeydown = "if (event.keyCode == 13) load_to_editor(this.value);">'.$asn_snippets_list_r['snippet_details'].'</textarea>';
}

echo '`'.$qasn_snippets.'` Results | <a href="./snippetlisting.php" target="_blank" class="text-white m-4">View All</a><br><br>'.$snippent_r ;

//=== End asn_snippets select  Like Query String asn_snippets list

}
?>