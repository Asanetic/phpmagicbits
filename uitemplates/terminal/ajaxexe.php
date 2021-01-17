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

		  $file_to_write = fopen('./edithistory/'.magic_basename($_POST['txt_writeto'])."_".date("dmyhisa").'_bkup.astg', 'w') or die("can't open file");
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
	$snippent_r.='Snippet -- <b>'.$asn_snippets_list_r['snippet_title'].'</b><br><textarea class="snippet_card" onclick="load_to_editor(this.value);  document.getElementById(\'msg_alert_myModal\').style.display=\'none\'" onkeydown = "if (event.keyCode == 13) load_to_editor(this.value);   document.getElementById(\'msg_alert_myModal\').style.display=\'none\'">'.$asn_snippets_list_r['snippet_details'].'</textarea>';
}

echo '`'.$qasn_snippets.'` Results <br><br>'.$snippent_r ;

//=== End asn_snippets select  Like Query String asn_snippets list


}

if(isset($_POST["flag_search"])){

$qasn_snippets=mysqli_real_escape_string($mysqliconn, ($_POST["qasn_snippets"]));

//=== start asn_snippets select  Like Query String asn_snippets list  

$asn_snippets_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$asntag`.`asn_snippets`  WHERE (`snippet_title` LIKE '%".$qasn_snippets."%' OR  `snippet_details` LIKE '%".$qasn_snippets."%') ORDER BY `primkey` DESC LIMIT $datalimit" );
$snippent_f="";

while($asn_snippets_list_r=mysqli_fetch_array($asn_snippets_list_query))
{
	$snippent_f.='Snippet -- <b style="color:#FFF;">'.$asn_snippets_list_r['snippet_title'].'</b><br><textarea class="snippet_card" onclick="load_to_editor(this.value);  document.getElementById(\'flag_search_div\').style.display=\'none\'" onkeydown = "if (event.keyCode == 13){ load_to_editor(this.value); document.getElementById(\'flag_search_div\').style.display=\'none\';}" style="width: 100%; height: 20px; margin-top: 8px;" readonly >'.$asn_snippets_list_r['snippet_details'].'</textarea>';
}

echo $snippent_f;

//=== End asn_snippets select  Like Query String asn_snippets list


}

if(isset($_POST['loop_folder']))
{

$parent=$_POST['folder'];

 if (!file_exists($parent)){
 	echo "DNF";
 }else{


if ($handle = opendir($parent)) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {
		$a = $entry;
	
		if (strpos($a, '.') !== false) {
		$dirtype="File";
		$fileicon="file";
			$folderrec= '<a href="'.$parent.'/'.$entry.'" target="_blank" title="View File">VF</a>  | <div style="color:#FFF; cursor:pointer; text-decoration:underline; display:inline-block" onclick="load_to_editor(\''.$parent.'/'.$entry.'\')" title="Add to editor">ATE</div> | <a href="#"  onclick="load_to_path(\''.$parent.'/'.$entry.'\')" title="Load to Path">LTP</a> | <a href="#"  onclick="load_to_path(\''.$parent.'/'.$entry.'\');load_file()" title="View Source Code">VSC</a> | <a href="#"  onclick="add_to_frame(\''.$parent.'/'.$entry.'\');" title="Add to Frame">ATF</a>';
		}else{
				$dirtype="Folder";
				$fileicon="fld";

		    $folderrec= '<a href="#"  onclick="document.getElementById(\'folderpath\').value=\''.$parent.'/'.$entry.'\';loop_folder(\''.$parent.'/'.$entry.'\')">Open Folder</a>' ;

		}

echo '
<div class="function_card" style="border-bottom:1px solid #CCC; margin-bottom:9px;">
<div style="display:inline-block; padding:3px;">
<img src="'.$fileicon.'.png" style="width:20px;"/>
 '.$entry.'
</div>
<div style=" font-size:12px; margin:7px;">
<div class="cpointer">'.$folderrec.'</div>
</div>
</div>';

		 }
    }

    closedir($handle);
}

}
}
?>