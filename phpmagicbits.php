<?php

/*WELCOME TO PHP MAGIC BITS OPEN SOURCE*
 * PhpMagic bits or PMB is an open source library template for the most basic mysqli functions in php to the advanced php calls such as file upload, write read and Simple UX ui functions.
 *
 *
 * PHP version 2.0
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   PHP Library
 * @package    PHP MAGIC BITS
 * @author     JEREMIAH ASANYA FOUNDER : ASANETIC TECHNOLOGIES <jereasanya@gmail.com>
 * @copyright  ASANETIC TECHNOLOGIES
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    2.0
 * @link       https://github.com/Asanetic/phpmagicbits
 * @DOCUMENTATION : https://github.com/Asanetic/phpmagicbits/blob/master/README.md
*/





//====================== create message pop ups ==========================
function magic_message($message_to_display)
{

global $alert_box;

$alert_box=
magic_css().'<!-- The Modal -->
	<div id="msg_alert_myModal" class="msg_alert_modal" onclick="this.style.display=\'none\';" style="z-index:99999;">
	  <!-- Modal content -->
	   <div class="msg_modal-content ">
	     <span class="msg_modalclose" onclick="document.getElementById(\'msg_alert_myModal\').style.display=\'none\';">&times;</span>
	    <p>'.$message_to_display.'</p>
	  </div>
	</div>';


return $alert_box;
}

function magic_screen($message_to_display)
{
	global $alert_box;


 $alert_box=
magic_css().'<!-- The Modal -->
	<div id="msg_alert_myModal" class="msg_alert_modal"style="z-index:99999;">
	  <!-- Modal content -->
	  <div class="msg_modal-content">
	    <span class="btn btn-primary" onclick="document.getElementById(\'msg_alert_myModal\').style.display=\'none\';" style="float:right;">&times;</span>
	    <p>'.$message_to_display.'</p>
	  </div>
	</div>';


return $alert_box;
}



function magic_modal($message_to_display)
{

global $alert_box;

 $alert_box=
	magic_css().'<!-- The Modal -->
		<div id="msg_alert_myModal" class="msg_alert_modal"style="z-index:99;">
		  <!-- Modal content -->
		  <div class="msg_modal-content_banner" style="max-height:600px; overflow-y:auto;">
		    <span class="btn btn-primary" onclick="document.getElementById(\'msg_alert_myModal\').style.display=\'none\';" style="float:right;">&times;</span>
		    <p>'.$message_to_display.'</p>
		  </div>
		</div>';


return $alert_box;
}


function magic_error_message($message_to_display)
{
	global $alert_box;
	$alert_box=
		magic_css().'<!-- The Modal -->
			<div id="msg_alert_myModal" class="msg_alert_modal" onclick="this.style.display=\'none\';" style="z-index:99999;">
			  <!-- Modal content -->
			  <div class="msg_modal-content" style="background-color:darkred;">
			    <span class="msg_modalclose" onclick="document.getElementById(\'msg_alert_myModal\').style.display=\'none\';">&times;</span>
			    <p style="color:#FFF;">'.$message_to_display.'</p>
			  </div>
			</div>';

	return $alert_box;
}

//====================== create message pop ups ==========================


//============================== begin Cookie functions  ===============
function magic_create_cookie($cookie_name, $cookie_value)
{
	global $cookie_action;

	$cookie_action=setcookie($cookie_name, $cookie_value, 2147483647);

	return $cookie_action;

}



function  magic_cookie_value($cookie_name)
{

	global $return_cookie_value;

	$return_cookie_value="No Cookie Found";

	if(isset($_COOKIE[$cookie_name])){
		$return_cookie_value =$_COOKIE[$cookie_name];
	}

	return $return_cookie_value;
}


function magic_drop_cookie($cookie_name)
{

	global $drop_cookie_action;

	setcookie($cookie_name,"", time()-3600);

	unset($cookie_name);

	return $drop_cookie_action;

}

//============================== end Cookie functions  ===============



//===================== begin drop zone file upload ================

function magic_dropzone_file_upload($path, $tempfile, $new_file_name)
{
 
 global $uploaded_file_name;

$ds          = '/';  //1
 
$storeFolder = $path;   //2
 
if (!empty($_FILES)) {

	$newfilename=$new_file_name;


    $imageFileType = pathinfo($tempfile,PATHINFO_EXTENSION);

	$temp = explode(".", $_FILES['file']["name"]);

	if($new_file_name=="")
	{
		$newfilename=$temp[0];
	}

	$newfilename = $newfilename.".".$temp[1];
           
      
    $targetPath =$storeFolder.$ds;  //4
     
    $targetFile =  $targetPath.$newfilename;  //5
 
    move_uploaded_file($tempfile,$targetFile); //6

    $uploaded_file_name=$targetFile;

    return $uploaded_file_name;

}


}
//===================== end drop zone file upload ================



//===================== begin calculate difference in days ================
function magic_time_diff($first_d_m_y_h_i_s_a, $sec_d_m_y_h_i_s_a)
{
	global $diff_in_days;

	$first_date=DateTime::createFromFormat('d-m-Y h:i:s A', $first_d_m_y_h_i_s_a);
	$formatted_first_date=$first_date->format('d-m-Y h:i:s A');

	$second_date=DateTime::createFromFormat('d-m-Y h:i:s A', $sec_d_m_y_h_i_s_a);
	$formatted_second_date=$second_date->format('d-m-Y h:i:s A');


	$date1=date_create($formatted_first_date);
	$date2=date_create($formatted_second_date);
	$diff=date_diff($date1,$date2);

	$diff_in_days=$diff->format("%R%a");


	return $diff_in_days;
}
//===================== begin calculate difference in days ================


//======== show current url ===============

function magic_current_url() 
{

global $spro_curr_file_url;

// url to inspect
$spro_curr_file_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


return $spro_curr_file_url;

}


function magic_basename($url_path)
{

	global $spro_curr_file_basefile;

		// parsed path
	$spro_curr_file_path = parse_url($url_path, PHP_URL_PATH);

	// extracted basename
	$spro_curr_file_basefile=basename($spro_curr_file_path);

	return $spro_curr_file_basefile;

}

//======== show current url ===============

//===============begin compress image=========================
function magic_compress_file($source, $destination, $quality) 
{

		$info = getimagesize($source);

		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source);

		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source);

		elseif ($info['mime'] == 'image/png') 
			$image = imagecreatefrompng($source);
		elseif ($info['mime'] == 'image/bmp') 
			$image = imagecreatefrompng($source);

		imagejpeg($image, $destination, $quality);

		return $destination;
	}
//===============end compress image=========================

//------------------------- begin  generate random string --------//

function magic_random_str($length)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	global $randomString;

    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;

}
//------------------------- end  generate random string --------//

//============== begin file upload function ===================

function magic_upload_file($upload_path, $input_element_name, $new_file_name) 
{

global $uploadedpicname;

$target_dir = $upload_path;
$target_file= $target_dir . basename($_FILES[$input_element_name]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$temp = explode(".", $_FILES[$input_element_name]["name"]);
$newfilename = $new_file_name. '.' . end($temp);

$target_file2=$target_dir .$newfilename;

move_uploaded_file($_FILES[$input_element_name]["tmp_name"], $target_file2);

$uploadedpicname=$target_file2;

return $uploadedpicname;

}

//============== end file upload function ===================

//------------------------- begin write table columns in the current file--------//

function magic_sql_show_cols($tbl)
{
	global $single_db;
	global $single_conn;
	global $columns_to_write;

	$write_tbl_cols_query = mysqli_query($single_conn, "SHOW COLUMNS FROM `$single_db`.`$tbl`");

	$found_columns='';

	while($write_tbl_cols_res = mysqli_fetch_array($write_tbl_cols_query)){

		$found_columns.=$write_tbl_cols_res['Field']." ,";
	}

	$columns_to_write=$found_columns;

	return $columns_to_write;

}

function magic_multisql_show_cols($conn, $db, $tbl)
{

	global $columns_to_write;

	$write_tbl_cols_query = mysqli_query($conn, "SHOW COLUMNS FROM `$db`.`$tbl`");

	$found_columns='';

	while($write_tbl_cols_res = mysqli_fetch_array($write_tbl_cols_query)){

		$found_columns.=$write_tbl_cols_res['Field']." ,";
	}

	$columns_to_write=$found_columns;

	return $columns_to_write;

}
//------------------------- end write table columns in the current file--------//



//------------------------- begin replace file contents --------//

function magic_replace_file_contents($file_path, $item_to_be_replaced, $item_to_replace_with)
{

	global $final_file_content;

	$curr_filepath=$file_path;

	$original_file_content=file_get_contents($curr_filepath);

	$new_file_content=str_replace($item_to_be_replaced, $item_to_replace_with, $original_file_content);
  
  	$file_to_write = fopen($curr_filepath, 'w') or die("can't open file");
	fwrite($file_to_write, $new_file_content);
	fclose($file_to_write);

	$final_file_content=$new_file_content;

	return $final_file_content;

}
//------------------------- end replace file contents --------//


//------------------------- begin write new file contents --------//

function magic_write_to_file($file_path, $new_content_to_write)
{

	global $final_file_content;
  
  	$file_to_write = fopen($file_path, 'w') or die("can't open file");
	fwrite($file_to_write, $new_content_to_write);
	fclose($file_to_write);


	$final_file_content=file_get_contents($file_path);


	return $final_file_content;

}
//------------------------- end write new file contents --------//


//==================== magic ui elemnts 
function magic_sql_params($file_path, $param_fields, $comment)
{

	global $sql_param_data;



		$final_sql_block="";
		$insert_cols="";
		$insert_values="";
		$update_vars="";
		$ajax_fields="";
		$ajax_update_vars="";
		$ajax_insert_values="";
		$ajax_insert_cols="";
		$json_post_params="";


		foreach ($param_fields as $sql_vars) {

			$final_sql_block.='$'.$sql_vars.'=mysqli_real_escape_string($mysqliconn, $_POST["txt_'.$sql_vars.'"]);'.PHP_EOL;

			$insert_cols.='`'.$sql_vars.'`, ';
			$insert_values.="'$".$sql_vars."', ";
			$update_vars.='`'.$sql_vars.'`=\'$'.$sql_vars.'\', ';

			$ajax_update_vars.='`'.$sql_vars.'`=\'"+mysqli_real_escape_string('.$sql_vars.'.value)+"\', ';

			$ajax_fields.= 'var '.$sql_vars.' = document.getElementById("txt_'.$sql_vars.'");'.PHP_EOL;

			$ajax_insert_values.='\'"+mysqli_real_escape_string('.$sql_vars.'.value)+"\', ';
			$ajax_insert_cols.='`'.$sql_vars.'`, ';
			$json_post_params.='"'.$sql_vars.'":"?",';



		}

		$insert_val_arr='$post_vars='.$insert_values.';';

		$insert_cols_arr='$insert_col_arrays='.$insert_cols.';';

		$combined_arr=$insert_cols_arr.PHP_EOL.$insert_val_arr;

		$update_var_array='$update_fileds="'.$update_vars.'"';

		$generated_ajax_fields=''.$ajax_fields.'';
		$generated_ajax_update_vars='var ajax_update_fields='.$ajax_update_vars.'';
		$generated_ajax_insert_values='var ajax_insert_fields_values='.$ajax_insert_values.'';
		$generated_ajax_insert_cols='var ajax_insert_cols='.$ajax_insert_cols.'';
		$json_post_params_finale='$json_post_params=\'{'.$json_post_params.'}';



	  	$file_to_write = fopen($file_path, 'w') or die("can't open file");
		fwrite($file_to_write, "//------- begin ".$comment." --> ".PHP_EOL.$final_sql_block."//===-- End ".$comment." -->".PHP_EOL.PHP_EOL.$combined_arr.PHP_EOL.$update_var_array.PHP_EOL.PHP_EOL.$generated_ajax_fields.PHP_EOL.$generated_ajax_update_vars.PHP_EOL.$generated_ajax_insert_values.PHP_EOL.PHP_EOL.$generated_ajax_insert_cols.PHP_EOL.PHP_EOL.$json_post_params_finale);

		fclose($file_to_write);


		$final_file_content=file_get_contents($file_path);


		return $final_file_content;


}

//***************************** MAGIC SQL *******************************************************************

function magic_sql_insert($tbl, $fileds_n_values_json)
{
	global $single_db;
	global $single_conn;
	global $return_key;

	$json_inputs_array = json_decode($fileds_n_values_json, true);


	$magic_columns=array();
	$magic_values=array();

	foreach ($json_inputs_array as $key => $value) 
	{
		$magic_columns[]="`".$key."`";

		if($json_inputs_array[$key]=="?"){

			$magic_values[]="'".mysqli_real_escape_string($single_conn, $_POST["txt_".$key])."'";

		}else{

			$magic_values[]="'".mysqli_real_escape_string($single_conn, $json_inputs_array[$key])."'";

		}

	}
	
	$prepared_cols=implode(", ", $magic_columns);
	$prepared_vals=implode(", ", $magic_values);


	$magic_insert_query = mysqli_query($single_conn, "INSERT INTO `$single_db`.`$tbl` (".$prepared_cols.") VALUES (".$prepared_vals.")");

	$return_key=mysqli_insert_id($single_conn);

	return $return_key;

}

function magic_multisql_insert($conn, $db, $tbl, $fileds_n_values_json)
{

	global $return_key;

	$json_inputs_array = json_decode($fileds_n_values_json, true);


	$magic_columns=array();
	$magic_values=array();

	foreach ($json_inputs_array as $key => $value) 
	{
		$magic_columns[]="`".$key."`";

		if($json_inputs_array[$key]=="?"){

			$magic_values[]="'".mysqli_real_escape_string($conn, $_POST["txt_".$key])."'";

		}else{

			$magic_values[]="'".mysqli_real_escape_string($conn, $json_inputs_array[$key])."'";

		}

	}
	
	$prepared_cols=implode(", ", $magic_columns);
	$prepared_vals=implode(", ", $magic_values);


	$magic_insert_query = mysqli_query($conn, "INSERT INTO `$db`.`$tbl` (".$prepared_cols.") VALUES (".$prepared_vals.")");

	$return_key=mysqli_insert_id($conn);

	return $return_key;

}


function magic_sql_where($input_where_json)
{
	global $single_db;
	global $single_conn;
	global $where_str;

$json_where_array = json_decode($input_where_json, true);


	$magic_where_str=array();

	foreach ($json_where_array as $key => $value) 
	{

		if($json_where_array[$key]=="?"){

			$magic_where_str[]="`".$key."`='".mysqli_real_escape_string($single_conn, $_POST["txt_".$key])."'";

		}else{

			$magic_where_str[]="`".$key."`='".mysqli_real_escape_string($single_conn, $json_where_array[$key])."'";

		}

	}

	$prepared_where_str=implode(" AND ", $magic_where_str);

	$where_str=$prepared_where_str;

	return $where_str;

}


function magic_multisql_where($conn, $input_where_json)
{
	global $where_str;

$json_where_array = json_decode($input_where_json, true);


	$magic_where_str=array();

	foreach ($json_where_array as $key => $value) 
	{

		if($json_where_array[$key]=="?"){

			$magic_where_str[]="`".$key."`='".mysqli_real_escape_string($conn, $_POST["txt_".$key])."'";

		}else{

			$magic_where_str[]="`".$key."`='".mysqli_real_escape_string($conn, $json_where_array[$key])."'";

		}

	}

	$prepared_where_str=implode(" AND ", $magic_where_str);

	$where_str=$prepared_where_str;

	return $where_str;

}

function magic_create_session($input_session_json)
{
	global $session_str;

	$json_session_array = json_decode($input_session_json, true);

	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}

	$magic_session_str=array();

	foreach ($json_session_array as $key => $value) 
	{

		if($json_session_array[$key]=="?"){

			$magic_session_str[]=$_SESSION[$key]=$_POST["txt_".$key];

		}else{

			$magic_session_str[]=$_SESSION[$key]=$json_session_array[$key];


		}


	}

	$prepared_session_str=implode(" == ", $magic_session_str);

	$session_str=$prepared_session_str;

	return $session_str;

}


function magic_destroy_session($input_session_json)
{
	global $session_str;
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	$json_session_array = json_decode($input_session_json, true);


	$magic_session_str=array();

	foreach ($json_session_array as $key => $value) 
	{

		if($json_session_array[$key]=="?"){

			unset($_SESSION[$_POST["txt_".$key]]);

		}else{

			unset($_SESSION[$key]);


		}


	}

	return $session_str;

}



function magic_sql_where_like($input_where_json)
{
	global $single_db;
	global $single_conn;
	global $where_str;
	

$json_where_array = json_decode($input_where_json, true);


	$magic_where_str=array();

	foreach ($json_where_array as $key => $value) 
	{

		if($json_where_array[$key]=="?"){

			$magic_where_str[]="`".$key."` LIKE '%".mysqli_real_escape_string($single_conn, $_POST["txt_".$key])."%'";

		}else{

			$magic_where_str[]="`".$key."` LIKE '%".mysqli_real_escape_string($single_conn, $json_where_array[$key])."%'";

		}

	}

	$prepared_where_str=implode(" OR  ", $magic_where_str);

	$where_str="(".$prepared_where_str.")";

	return $where_str;

}


function magic_multisql_where_like($conn, $input_where_json)
{
	global $where_str;

$json_where_array = json_decode($input_where_json, true);


	$magic_where_str=array();

	foreach ($json_where_array as $key => $value) 
	{

		if($json_where_array[$key]=="?"){

			$magic_where_str[]="`".$key."` LIKE '%".mysqli_real_escape_string($conn, $_POST["txt_".$key])."%'";

		}else{

			$magic_where_str[]="`".$key."` LIKE '%".mysqli_real_escape_string($conn, $json_where_array[$key])."%'";

		}

	}

	$prepared_where_str=implode(" OR  ", $magic_where_str);

	$where_str="(".$prepared_where_str.")";

	return $where_str;

}

//------------------------- begin update query--------//
function magic_sql_update($tbl, $fileds_n_values, $where)
{
	global $single_db;
	global $single_conn;
	global $gen_update_query;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
	{

		$where_clause="";
	}


		$json_update_array = json_decode($fileds_n_values, true);


	$magic_update_str=array();

	foreach ($json_update_array as $key => $value) 
	{

		if($json_update_array[$key]=="?"){

			$magic_update_str[]="`".$key."`='".mysqli_real_escape_string($single_conn, $_POST["txt_".$key])."'";

		}else{

			$magic_update_str[]="`".$key."`='".mysqli_real_escape_string($single_conn, $json_update_array[$key])."'";

		}

	}

	$prepared_update_str=implode(", ", $magic_update_str);

	$gen_update_query=mysqli_query($single_conn, "UPDATE `$single_db`.`$tbl` SET $prepared_update_str ".$where_clause."");

	return $gen_update_query;

}

function magic_multisql_update($conn, $db, $tbl, $fileds_n_values, $where)
{

	global $gen_update_query;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
	{

		$where_clause="";
	}


		$json_update_array = json_decode($fileds_n_values, true);


	$magic_update_str=array();

	foreach ($json_update_array as $key => $value) 
	{

		if($json_update_array[$key]=="?"){

			$magic_update_str[]="`".$key."`='".mysqli_real_escape_string($conn, $_POST["txt_".$key])."'";

		}else{

			$magic_update_str[]="`".$key."`='".mysqli_real_escape_string($conn, $json_update_array[$key])."'";

		}

	}

	$prepared_update_str=implode(", ", $magic_update_str);

	$gen_update_query=mysqli_query($conn, "UPDATE `$db`.`$tbl` SET $prepared_update_str ".$where_clause."");

	return $gen_update_query;

}
//------------------------- begin update query--------//


//***************************** MAGIC SQL *******************************************************************

function magic_clean_str($str)
{

	global $clean_str;

    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    $clean_str= str_replace($search, $replace, $value);

    return $clean_str;
}

//------------------------- begin write new file contents --------//

function magic_create_ui_inputs($file_path, $elements_to_gen, $element_fields, $comment)
{

	global $final_file_content;


	$final_ui_block="";

	foreach ($element_fields as $elems) {

		$ui_id=str_replace('<elemid>', 'id="txt_'.$elems.'"', $elements_to_gen);
		$name_id=str_replace("<elemname>", 'name="txt_'.$elems.'"', $ui_id);
		$label_name=str_replace("<elemlabel>", ucwords(strtolower(str_replace("_", " ", $elems))), $name_id);
		$placeholder=str_replace("<elemplaceholder>", 'placeholder="Enter '.ucwords(strtolower(str_replace("_", " ", $elems)))."\"", $label_name);
		$elem_data=str_replace("<elemdata>", $elems, $placeholder);

		
		$final_ui_block.=$elem_data;


	}
  

  	$file_to_write = fopen($file_path, 'w') or die("can't open file");
	fwrite($file_to_write, "<!-- begin ".$comment." --> ".$final_ui_block."<!-- End ".$comment." -->");
	fclose($file_to_write);


	$final_file_content=file_get_contents($file_path);


	return $final_file_content;

}
//------------------------- end write new file contents --------//



//------------------------- begin find file type --------//

function magic_file_type($file_path)
{

	global $file_type;

	$info = new SplFileInfo($file_path);

	$file_type=$info->getExtension(); 

	return $file_type;

}
//------------------------- begin find file type --------//


//------------------------- begin strip text--------//

function magic_strip_if($text, $length, $strip_if)
{

	global $stripped_text;

		$strlen=strip_tags( mb_strlen($text));

		$stripped_text=$text;

		if($strlen>$strip_if){ 
		$stripped_text=substr(strip_tags($text),0,$length)."...";

		}
		return $stripped_text;

}
//------------------------- end strip text--------//





//------------------------- begin find file type --------//

function magic_if_image($file_path)
{

	global $is_image;

	$info = new SplFileInfo($file_path);

	$filetype=$info->getExtension(); 

	if($filetype=='jpg' || $filetype=='png' || $filetype=='bmp' || $filetype=='gif' || $filetype=='jpeg'){

		$is_image='Yes';

	}else{
		$is_image='No';
	}


	return $is_image;

}
//------------------------- begin find file type --------//




// ****************************************************************** BEGIN SQL QUERIES *******************************//

function magic_sql_record_per_page($conn, $sqlstring, $reclimit)
{

global $recordperpage_data;


$requested_page = isset($_GET["rectkn"]) ? intval(base64_decode($_GET["rectkn"])) : 1;
$firstrecords_query=mysqli_query($conn, "".$sqlstring."");
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


//------------------------- begin select query--------//


function magic_sql_select($tbl, $where, $datalimit, $orderby_col, $ordertype)
{
	global $single_db;
	global $single_conn;
	global $select_data_arr;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}

	//===== limit record value

$reclimit=$datalimit;

$sqlstring="SELECT COUNT(*) FROM `$single_db`.`$tbl`".$where_clause."";

//=====call limit function in mysqligateway

$paramret= magic_sql_record_per_page($single_conn, $sqlstring, $reclimit);


//===== get return values


$reclim_firstproduct=$paramret["0"];

$reclim_pgcount=$paramret["1"];


$gen_select_query=mysqli_query($single_conn, "SELECT * FROM `$single_db`.`$tbl` ".$where_clause." ORDER BY `$orderby_col` $ordertype LIMIT $reclim_firstproduct, $reclimit" );

$select_data_arr=array($gen_select_query, $reclim_pgcount);


return $select_data_arr;

}

function magic_multisql_select($conn, $db, $tbl, $where, $datalimit, $orderby_col, $ordertype)
{

	global $select_data_arr;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}

	//===== limit record value

$reclimit=$datalimit;

$sqlstring="SELECT COUNT(*) FROM `$db`.`$tbl`".$where_clause."";

//=====call limit function in mysqligateway

$paramret= magic_sql_record_per_page($conn, $sqlstring, $reclimit);


//===== get return values


$reclim_firstproduct=$paramret["0"];

$reclim_pgcount=$paramret["1"];


$gen_select_query=mysqli_query($conn, "SELECT * FROM `$db`.`$tbl` ".$where_clause." ORDER BY `$orderby_col` $ordertype LIMIT $reclim_firstproduct, $reclimit" );

$select_data_arr=array($gen_select_query, $reclim_pgcount);


return $select_data_arr;

}

//------------------------- end select query--------//




//------------------------- START cell select query--------//

function magic_sql_data_cell($tbl, $return_col, $where, $orderby_col, $ordertype)
{
	global $single_db;
	global $single_conn;
	global $return_data;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}


$cell_data_query=mysqli_query($single_conn, "SELECT * FROM `$single_db`.`$tbl`  ".$where_clause." ORDER BY `$orderby_col` $ordertype");

$cell_data_res=mysqli_fetch_array($cell_data_query);

$return_data=$cell_data_res["".$return_col.""];


return $return_data;

}

function magic_multisql_data_cell($conn, $db, $tbl, $return_col, $where, $orderby_col, $ordertype)
{

	global $return_data;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}


$cell_data_query=mysqli_query($conn, "SELECT * FROM `$db`.`$tbl`  ".$where_clause." ORDER BY `$orderby_col` $ordertype");

$cell_data_res=mysqli_fetch_array($cell_data_query);

$return_data=$cell_data_res["".$return_col.""];


return $return_data;

}
//------------------------- END cell select query--------//

//------------------------- START cell select query--------//

function magic_sql_cell_array($tbl, $where, $orderby_col, $ordertype)
{
	global $single_db;
	global $single_conn;
	global $return_data;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}


$cell_data_query=mysqli_query($single_conn, "SELECT * FROM `$single_db`.`$tbl`  ".$where_clause." ORDER BY `$orderby_col` $ordertype");

$return_data=mysqli_fetch_array($cell_data_query);



return $return_data;

}


function magic_multisql_cell_array($conn, $db, $tbl, $where, $orderby_col, $ordertype)
{

	global $return_data;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}


$cell_data_query=mysqli_query($conn, "SELECT * FROM `$db`.`$tbl`  ".$where_clause." ORDER BY `$orderby_col` $ordertype");

$return_data=mysqli_fetch_array($cell_data_query);



return $return_data;

}
//------------------------- END cell select query--------//


//------------------------- START cell Delete query--------//

function magic_sql_delete($tbl, $where)
{
	global $single_db;
	global $single_conn;
	global $del_state;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}


$cell_data_query=mysqli_query($single_conn, "DELETE FROM `$single_db`.`$tbl`  ".$where_clause."");

return $del_state;

}

function magic_multisql_delete($conn, $db, $tbl, $where)
{

	global $del_state;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}


$cell_data_query=mysqli_query($conn, "DELETE FROM `$db`.`$tbl`  ".$where_clause."");

return $del_state;

}
//------------------------- END cell Delete query--------//


//------------------------- start sum select query--------//

function magic_sql_sum($tbl, $sum_col, $where)
{
	global $single_db;
	global $single_conn;
	global $tot_summations;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}


$sum_totals_query=mysqli_query($single_conn, "SELECT SUM($sum_col) AS TOT_SUM FROM `$single_db`.`$tbl` ".$where_clause."");

$sum_totals_res=mysqli_fetch_array($sum_totals_query);

$tot_summations=$sum_totals_res['TOT_SUM'];

return $tot_summations;

}

function magic_multisql_sum($conn, $db, $tbl, $sum_col, $where)
{

	global $tot_summations;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}


$sum_totals_query=mysqli_query($conn, "SELECT SUM($sum_col) AS TOT_SUM FROM `$db`.`$tbl` ".$where_clause."");

$sum_totals_res=mysqli_fetch_array($sum_totals_query);

$tot_summations=$sum_totals_res['TOT_SUM'];

return $tot_summations;

}

//------------------------- end sum select query--------//

//------------------------- start count select query--------//

function magic_sql_count($tbl, $count_col, $where)
{
	global $single_db;
	global $single_conn;
	global $tot_count;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
{

		$where_clause="";
	}


$count_totals_query=mysqli_query($single_conn, "SELECT count($count_col) AS TOT_COUNT FROM `$single_db`.`$tbl` ".$where_clause."");

$count_totals_res=mysqli_fetch_array($count_totals_query);

$tot_count=$count_totals_res['TOT_COUNT'];

return $tot_count;

}

function magic_multisql_count($conn, $db, $tbl, $count_col, $where)
{

	global $tot_count;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
{

		$where_clause="";
	}


$count_totals_query=mysqli_query($conn, "SELECT count($count_col) AS TOT_COUNT FROM `$db`.`$tbl` ".$where_clause."");

$count_totals_res=mysqli_fetch_array($count_totals_query);

$tot_count=$count_totals_res['TOT_COUNT'];

return $tot_count;

}

//------------------------- end count select query--------//


function magic_sql_group($tbl, $where, $datalimit, $orderby_col, $ordertype, $group_by_col)
{
	global $single_db;
	global $single_conn;
	global $select_data_arr;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}

	//===== limit record value

$reclimit=$datalimit;

$sqlstring="SELECT COUNT(*) FROM `$single_db`.`$tbl`".$where_clause."";

//=====call limit function in mysqligateway

$paramret= magic_sql_record_per_page($single_conn, $sqlstring, $reclimit);


//===== get return values


$reclim_firstproduct=$paramret["0"];

$reclim_pgcount=$paramret["1"];


$gen_group_by_select_query=mysqli_query($single_conn, "SELECT * FROM `$single_db`.`$tbl` ".$where_clause." GROUP BY $group_by_col ORDER BY `$orderby_col` $ordertype   LIMIT $reclim_firstproduct, $reclimit" );

$select_data_arr=array($gen_group_by_select_query, $reclim_pgcount);


return $select_data_arr;

}

function magic_multisql_group($conn, $db, $tbl, $where, $datalimit, $orderby_col, $ordertype, $group_by_col)
{

	global $select_data_arr;

	$where_clause=' WHERE '.$where.''; 

	if($where==""){

		$where_clause="";
	}

	//===== limit record value

$reclimit=$datalimit;

$sqlstring="SELECT COUNT(*) FROM `$db`.`$tbl`".$where_clause."";

//=====call limit function in mysqligateway

$paramret= magic_sql_record_per_page($single_conn, $sqlstring, $reclimit);


//===== get return values


$reclim_firstproduct=$paramret["0"];

$reclim_pgcount=$paramret["1"];


$gen_group_by_select_query=mysqli_query($single_conn, "SELECT * FROM `$single_db`.`$tbl` ".$where_clause." GROUP BY $group_by_col ORDER BY `$orderby_col` $ordertype   LIMIT $reclim_firstproduct, $reclimit" );

$select_data_arr=array($gen_group_by_select_query, $reclim_pgcount);


return $select_data_arr;

}

//------------------------- end group by select query--------//


// ***************************************************************** END SQL QUERIES *******************************//


function magic_css(){

	global $magic_css;


	$magic_css='<style> .msg_alert_modal{display:block;position:fixed;z-index:1;padding-top:100px;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:#000;background-color:rgba(0,0,0,.4)}.msg_modal-content{background-color:#fefefe;margin:auto;padding:20px;border:1px solid #888;width:40%}.msg_modal-content_banner{background-color:#fefefe;margin:auto;padding:20px;border:1px solid #888;width:52%;font-size:16px}.msg_modalclose{color:#aaa;float:right;font-size:28px;font-weight:700}.msg_modalclose:focus,.msg_modalclose:hover{color:#000;text-decoration:none;cursor:pointer}.validate_error_class{font-size:11px;color:red}.hide_error_class{display:none}</style>';


	return $magic_css;

}
?>
