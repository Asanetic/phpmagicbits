<?php

/*WELCOME TO PHP MAGIC BITS OPEN SOURCE*
 * PhpMagic bits or PMB is an open source library template for the most basic mysqli functions in php to the advanced php calls such as file upload, write read and Simple UX ui functions.
 *
 *
 * PHP version 2.0
 *
	===================================================================================================================================
	Copyright 2020 ASANETIC TECHNOLOGIES

	Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

	===================================================================================================================================
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

function magic_toast($title, $message, $bgcolor, $color)
{
global $toast_str;

$toast_str='
<style>

.toast_card{
position: fixed;
top: 150px;
left: 40%;
}
@media screen and (max-width: 700px)
{
.toast_card{
position: inherit;
left: 0%;
top: -4px;
}
}
</style>
 <div class="toast_card">
  <div class="toast ml-md-5 " data-delay="10000" style="background-color:'.$bgcolor.'; color:'.$color.'; ">
    <div class="toast-header">
      <strong class="mr-auto"> '.$title.'</strong>
      <small>@ '.date('h:i:s A').'</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      '.$message.'
    </div>
  </div>
 </div>
';

return $toast_str;

}
	
function magic_str_to_url($string, $title, $additional_attr) 
{
  return preg_replace(
  '%(https?|ftp)://([-A-Z0-9./_*?&;=#]+)%i',
  '<a href="$0" '.$additional_attr.' >'.$title.'</a>', $string);
}


//====================== create message pop ups ==========================
function magic_message($message_to_display)
{

global $alert_box;

$alert_box=
magic_css().'<!-- The Modal -->
	<div id="msg_alert_myModal" class="msg_alert_modal" onclick="this.style.display=\'none\';" style="z-index:999;">
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
	<div id="msg_alert_myModal" class="msg_alert_modal"style="z-index:999;">
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
			<div id="msg_alert_myModal" class="msg_alert_modal" onclick="this.style.display=\'none\';" style="z-index:999;">
			  <!-- Modal content -->
			  <div class="msg_modal-content" style="background-color:darkred;">
			    <span class="msg_modalclose" onclick="document.getElementById(\'msg_alert_myModal\').style.display=\'none\';">&times;</span>
			    <p style="color:#FFF;">'.$message_to_display.'</p>
			  </div>
			</div>';

	return $alert_box;
}

//====================== create message pop ups ==========================

//============================ create inputs on the fly ===
function magic_inputs($write_to, $input_fileds_in_json, $input_template, $bootstrap_col_str, $comment)
{
	
	global $final_inputs;

	$form_input_template=' 
	<div class="form-group '.$bootstrap_col_str.'">
    	<label ><elemlabel></label>
    	<input class="form-control" <elemid> <elemname> <elemplaceholder> type="text">
  	</div>';


  	$elements_to_gen=$input_template;

  	if($input_template==""){
  		$elements_to_gen=$form_input_template;
  	}

	$json_inputs_array = json_decode($input_fileds_in_json, true);

	$final_ui_block="";

	foreach ($json_inputs_array as $key => $value) 
	{

		if($json_inputs_array[$key]=="?"){

			$label_node=$key;

		}else{

			$label_node=$json_inputs_array[$key];


		}

		$elems=$key;

		$ui_id=str_replace('<elemid>', 'id="txt_'.$elems.'"', $elements_to_gen);
		$name_id=str_replace("<elemname>", 'name="txt_'.$elems.'"', $ui_id);
		$label_name=str_replace("<elemlabel>", ucwords(strtolower(str_replace("_", " ", $label_node))), $name_id);
		$placeholder=str_replace("<elemplaceholder>", 'placeholder="'.ucwords(strtolower(str_replace("_", " ", $label_node)))."\"", $label_name);
		$elem_data=str_replace("<elemdata>", $elems, $placeholder);

		$final_ui_block.=$elem_data;


	}


	$uiblock="<!-- begin ".$comment." --> ".$final_ui_block."<!-- End ".$comment." -->";

	if($write_to!=""){

  		$file_to_write = fopen($write_to, 'w') or die("can't open file");
		fwrite($file_to_write, $uiblock);
		fclose($file_to_write);
	}

	$final_inputs=$uiblock;

	return $final_inputs;

}

function magic_button($name_n_id, $value_text, $additional_attributes)
{

	global $btnstr;


	$newbtn='<input type="submit" name="'.$name_n_id.'" id="'.$name_n_id.'" value="'.$value_text.'" class="btn btn-primary" '.$additional_attributes.'/>';

	$btnstr=$newbtn;

	return $btnstr;

}

function magic_input($name_n_id, $placeholder, $additional_attributes)
{

	global $txtstr;


	$newtxt='<input type="text" name="'.$name_n_id.'" id="'.$name_n_id.'" placeholder="'.$placeholder.'" class="form-control" '.$additional_attributes.'/>';

	$txtstr=$newtxt;

	return $txtstr;

}

function magic_plain_button($name_n_id, $name_text, $additional_attributes)
{

	global $pbtnstr;


	$newbtn='<div name="'.$name_n_id.'" id="'.$name_n_id.'" class="btn btn-primary" '.$additional_attributes.'>'.$name_text.'</div>';

	$pbtnstr=$newbtn;

	return $pbtnstr;

}

function magic_link($location, $name_text, $additional_attributes)
{

	global $linkstr;


	$newlinkstr='<a href="'.$location.'"  '.$additional_attributes.'>'.$name_text.'</a>';

	$linkstr=$newlinkstr;

	return $linkstr;

}

function magic_button_link($location, $name_text, $additional_attributes)
{

	global $linkstr;


	$newlinkstr='<a href="'.$location.'" class="btn btn-primary" '.$additional_attributes.'>'.$name_text.'</a>';

	$linkstr=$newlinkstr;

	return $linkstr;

}


function magic_share_button($additional_attributes)
{
	global $return_share;

	$return_share='<!-- AddToAny BEGIN -->
	<div class="a2a_kit a2a_kit_size_32 a2a_default_style" '.$additional_attributes.'>
	<a class="a2a_button_facebook"></a>
	<a class="a2a_button_twitter"></a>
	<a class="a2a_button_email"></a>
	<a class="a2a_button_linkedin"></a>
	<a class="a2a_button_whatsapp"></a>
	<a class="a2a_button_telegram"></a>
	<a class="a2a_button_reddit"></a>
	<a class="a2a_button_pinterest"></a>
	<a class="a2a_button_copy_link"></a>
	<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
	<!--Start of PDF Profile Button-->


	</div>
	<script async src="https://static.addtoany.com/menu/page.js"></script>';

	return $return_share;


}


function magic_sms_link($phone_no, $message, $title, $additional_attributes)
{
global $sms_button;

$sms_button =' <a href="sms://'.$phone_no.';?&body='.preg_replace( "/\r|\n/", '',str_replace('<br />','%0D%0A', nl2br($message))).'" '.$additional_attributes.'>'.$title.'</a>';

	return $sms_button;

}


function magic_email_link($send_to, $subject, $message, $title, $additional_attributes)
{
	global $magic_email_button;

	$magic_email_button='<a href="mailto:'.$send_to.'&subject='.$subject.'&body='.preg_replace( '/\r|\n/', '',str_replace('<br />','%0D%0A', nl2br($message))).'" '.$additional_attributes.'>'.$title.'</a>';

	return $magic_email_button;


}

function magic_gmail_link($send_to, $subject, $message, $title, $additional_attributes)
{
	global $magic_gmail_button;

	$magic_gmail_button='<a href="https://mail.google.com/mail/?view=cm&fs=1&to='.$send_to.'&su='.$subject.'&body='.preg_replace( '/\r|\n/', '',str_replace('<br />','%0D%0A', nl2br($message))).'" '.$additional_attributes.'>'.$title.'</a>';

	return $magic_gmail_button;


}

function magic_whatsapp_button($phone_no, $message, $title, $additional_attributes)
{
	global $return_whatsapp_btn;

	$return_whatsapp_btn='<a href="https://api.whatsapp.com/send?phone='.$phone_no.'&text='.preg_replace( '/\r|\n/', "",str_replace('<br />','%0D%0A', nl2br($message))).'" '.$additional_attributes.'>'.$title.'</a>';

	return $return_whatsapp_btn;

}



function magic_dropdown($title, $dropdown_items, $inline_css_yes_no)
{

	global $dropdown;

		$inline_css=drop_css();

		if($inline_css_yes_no=='no'){
		$inline_css="";
		}

	  $dropdown = 
	  $inline_css.'<div class="table_cell_dropdown">
		  <div class="table_cell_dropbtn">'.$title.'</div>
		  <div class="table_cell_dropdown-content">
		  	'.$dropdown_items.'
		  </div>
		</div>';

		return $dropdown;

}


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


//============================ create inputs on the fly ===

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

function magic_destroy_file($file_path){
	global $path_return;

	unlink($file_path);
	
	return $file_path;
}
//===================== end drop zone file upload ================



//===================== end drop zone file upload ================



//===================== begin calculate difference in days ================
function magic_time_diff_in_days($first_d_m_y_h_i_s_a, $sec_d_m_y_h_i_s_a)
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

//===================== begin calculate difference in secs ================
function magic_time_diff_in_secs($first_d_m_y_h_i_s_a, $sec_d_m_y_h_i_s_a)
{
	global $diff_in_secs;

	$first_date=DateTime::createFromFormat('d-m-Y h:i:s A', $first_d_m_y_h_i_s_a);
	$formatted_first_date=$first_date->format('d-m-Y h:i:s A');

	$second_date=DateTime::createFromFormat('d-m-Y h:i:s A', $sec_d_m_y_h_i_s_a);
	$formatted_second_date=$second_date->format('d-m-Y h:i:s A');


	$date1=date_create($formatted_first_date);
	$date2=date_create($formatted_second_date);
	$diff=date_diff($date1,$date2);

	$diff_in_secs=$diff->format("%R%s");


	return $diff_in_secs;
}
//===================== begin calculate difference in secs ================

//===================== begin calculate difference in secs ================
function magic_time_diff_in_hrs($first_d_m_y_h_i_s_a, $sec_d_m_y_h_i_s_a)
{
	global $diff_in_hrs;

	$first_date=DateTime::createFromFormat('d-m-Y h:i:s A', $first_d_m_y_h_i_s_a);
	$formatted_first_date=$first_date->format('d-m-Y h:i:s A');

	$second_date=DateTime::createFromFormat('d-m-Y h:i:s A', $sec_d_m_y_h_i_s_a);
	$formatted_second_date=$second_date->format('d-m-Y h:i:s A');


	$date1=date_create($formatted_first_date);
	$date2=date_create($formatted_second_date);
	$diff=date_diff($date1,$date2);

	$diff_in_hrs=$diff->format("%R%h");


	return $diff_in_hrs;
}
//===================== begin calculate difference in secs ================




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
function resize_png_img($width = NULL, $height = NULL, $targetFile, $originalFile) 
{
  
$img = imagecreatefrompng($originalFile);
/*if custom values for width and height are not set, 
 *Calculate from image original width and height
 */
    $imgWidth = imagesx($img);//get width of original image
    $imgHeight = imagesy($img);
  
if($width != NULL && $height != NULL){
    $newWidth = $width;
    $newHeight = $height;
}else{

    $newWidth = intval($imgWidth);
    $newHeight = intval($imgHeight);
}
$newImage = imagecreatetruecolor($newWidth, $newHeight);
imagealphablending($newImage, false);
imagesavealpha($newImage,true);
$transparency = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparency);
imagecopyresampled($newImage, $img, 0, 0, 0, 0, $newWidth, $newHeight, $imgWidth, $imgHeight);
imagepng($newImage,$targetFile, 9);
}

function magic_compress_file($source, $destination, $quality) 
{

		$info = getimagesize($source);

	if ($info['mime'] == 'image/jpeg'){ 
		$image = imagecreatefromjpeg($source);
		imagejpeg($image, $destination, $quality);

        }elseif ($info['mime'] == 'image/gif') {
		$image = imagecreatefromgif($source);
		imagejpeg($image, $destination, $quality);

        }elseif ($info['mime'] == 'image/png') {
          
          $width = imagesx(imagecreatefrompng($source))/3;
	  $height = imagesy(imagecreatefrompng($source))/3;
	
	 resize_png_img($width, $height, $destination, $source);
          
        }elseif ($info['mime'] == 'image/bmp'){
	$image = imagecreatefrompng($source);
        }		

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

function magic_sql_array_cols($tbl)
{
	global $single_db;
	global $single_conn;
	global $columns_to_write;

	$write_tbl_cols_query = mysqli_query($single_conn, "SHOW COLUMNS FROM `$single_db`.`$tbl`");

	$found_columns=array();

	while($write_tbl_cols_res = mysqli_fetch_array($write_tbl_cols_query)){

		$found_columns[]=''.$write_tbl_cols_res['Field'].'';
	}

	$columns_to_write=$found_columns;

	return $columns_to_write;

}

function magic_sql_json_cols($tbl)
{
	global $single_db;
	global $single_conn;
	global $columns_to_write;

	$write_tbl_cols_query = mysqli_query($single_conn, "SHOW COLUMNS FROM `$single_db`.`$tbl`");

	$tbl_primkey_query=mysqli_query($single_conn, "SHOW KEYS FROM `$single_db`.`$tbl` WHERE Key_name ='PRIMARY'");

	$tbl_primkey_res=mysqli_fetch_array($tbl_primkey_query);

	$tbl_primkey=$tbl_primkey_res['Column_name'];

	$json_post_params=array();

	while($write_tbl_cols_res = mysqli_fetch_array($write_tbl_cols_query)){


		if($write_tbl_cols_res['Field']==$tbl_primkey)
		{
		$json_post_params[]='"'.$write_tbl_cols_res['Field'].'":"NULL"';

		}else{
		$json_post_params[]='"'.$write_tbl_cols_res['Field'].'":"?"';

		}
	}
	
	$json_post_params_finale='{'.implode(',', $json_post_params).'}';

	$columns_to_write=$json_post_params_finale;

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
function magic_multisql_array_cols($conn, $db, $tbl)
{

	global $columns_to_array;

	$write_tbl_cols_query = mysqli_query($conn, "SHOW COLUMNS FROM `$db`.`$tbl`");

	$found_columns=array();

	while($write_tbl_cols_res = mysqli_fetch_array($write_tbl_cols_query)){

		$found_columns[]=''.$write_tbl_cols_res['Field'].'';
	}

	$columns_to_write=[implode(',', $found_columns)];

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
  
  if (!file_exists($file_path))
  {
  	$file_to_write = fopen($file_path, 'w') or die("can't open file");
	fwrite($file_to_write, $new_content_to_write);
	fclose($file_to_write);

	$final_file_content=file_get_contents($file_path);
  }else{
  	echo "<h2>Sorry, File Overwrite is not allowed, a similar file '".$file_path."'  already exists. Delete this file before creating a new one. </h2> ";
  }

	return $final_file_content;

}
//------------------------- end write new file contents --------//


//==================== magic ui elemnts 
function magic_sql_params($file_path, $param_fields, $comment)
{

	global $sql_param_data;

		$var_prefix='';

		if($comment!=""){
			$var_prefix=strtolower(str_replace(" ", '_', $comment))."_";
		}

		$final_sql_block="";
		$insert_cols=array();
		$insert_values=array();
		$update_vars=array();
		$ajax_fields="";
		$ajax_update_vars=array();
		$ajax_insert_values=array();
		$ajax_insert_cols=array();
		$json_post_params=array();


		foreach ($param_fields as $sql_vars) {

			$final_sql_block.='$'.$sql_vars.'=mysqli_real_escape_string($mysqliconn, $_POST["txt_'.$sql_vars.'"]);'.PHP_EOL;

			$insert_cols[]='`'.$sql_vars.'`';
			$insert_values[]="'$".$sql_vars."'";
			$update_vars[]='`'.$sql_vars.'`=\'$'.$sql_vars.'\'';

			$ajax_update_vars[]='`'.$sql_vars.'`=\'"+mysqli_real_escape_string('.$sql_vars.'.value)+"\'';

			$ajax_fields.= 'var '.$sql_vars.' = document.getElementById("txt_'.$sql_vars.'");'.PHP_EOL;

			$ajax_insert_values[]='\'"+mysqli_real_escape_string('.$sql_vars.'.value)+"\'';
			$ajax_insert_cols[]='`'.$sql_vars.'`';
			$json_post_params[]='"'.$sql_vars.'":"?"';



		}

		$insert_val_arr='$'.$var_prefix.'post_vars="'.implode(',', $insert_values).'";';

		$insert_cols_arr='$'.$var_prefix.'insert_col_arrays="'.implode(',', $insert_cols).'";';

		$combined_arr=$insert_cols_arr.PHP_EOL.$insert_val_arr;

		$update_var_array='$'.$var_prefix.'update_fileds="'.implode(',', $update_vars).'"';

		$generated_ajax_fields=''.$ajax_fields.'';
		$generated_ajax_update_vars='var '.$var_prefix.'ajax_update_fields="'.implode(',', $ajax_update_vars).'"';
		$generated_ajax_insert_values='var '.$var_prefix.'ajax_insert_fields_values="'.implode(',', $ajax_insert_values).'";';
		$generated_ajax_insert_cols='var '.$var_prefix.'ajax_insert_cols="'.implode(',', $ajax_insert_cols).'"';
		$json_post_params_finale='$'.$var_prefix.'json_post_params=\'{'.implode(',', $json_post_params).'}\';';



	  	$file_to_write = fopen($file_path, 'w') or die("can't open file");
		fwrite($file_to_write, "//------- begin ".$comment." --> ".PHP_EOL.$final_sql_block."//===-- End ".$comment." -->".PHP_EOL.PHP_EOL.$combined_arr.PHP_EOL.$update_var_array.PHP_EOL.PHP_EOL.$generated_ajax_fields.PHP_EOL.$generated_ajax_update_vars.PHP_EOL.$generated_ajax_insert_values.PHP_EOL.PHP_EOL.$generated_ajax_insert_cols.PHP_EOL.PHP_EOL.$json_post_params_finale);

		fclose($file_to_write);


		$final_file_content=file_get_contents($file_path);


		return $final_file_content;


}


	function magic_validate_email ($input_validate_json,$message)
	{

	global $validate_array;

	$validate_msg="";
	$validate_state=array();
	


	$json_validate_array = json_decode($input_validate_json, true);

	foreach ($json_validate_array as $key => $value) 
	{

		if($json_validate_array[$key]=="?"){

			$field_name="txt_".$key;

		}else{


			$field_name=$json_validate_array[$key];

		}
		if(isset($_POST[$field_name])){

		if (!filter_var($_POST[$field_name], FILTER_VALIDATE_EMAIL)) {

				$validate_state[]="Invalid";


				if($message==""){
					$validate_msg='<em class="validate_error_class">Invalid Email</em>';

				}else{
					$validate_msg='<em class="validate_error_class">'.$message.'</em>';
				}

			}
		}


	}

		$validate_array=array($validate_state, $validate_msg);
		
		return $validate_array;


	}

function magic_validate_required($input_validate_json, $message)
{

	global $validate_array;

	$validate_msg="";
	$validate_state=array();
	


	$json_validate_array = json_decode($input_validate_json, true);

	foreach ($json_validate_array as $key => $value) 
	{

		if($json_validate_array[$key]=="?"){

			$field_name="txt_".$key;

		}else{


			$field_name=$json_validate_array[$key];

		}
		if(isset($_POST[$field_name])){

			if($_POST[$field_name]==""){

				$validate_state[]="Empty";


				if($message==""){
					$validate_msg='<em class="validate_error_class">This field is required</em>';

				}else{
					$validate_msg='<em class="validate_error_class">'.$message.'</em>';
				}

			}
		}

	}

		$validate_array=array($validate_state, $validate_msg);
		
		return $validate_array;

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

//======================================================= mosy_insert and update 
function mosy_sql_insert($tbl, $insert_cols, $insert_values)
{
	global $single_db;
	global $single_conn;
	global $return_key;


	$magic_insert_query = mysqli_query($single_conn, "INSERT INTO `$single_db`.`$tbl` (".$insert_cols.") VALUES (".$insert_values.")")  or die(mysqli_error($mysqliconn));

	$return_key=mysqli_insert_id($single_conn);

	return $return_key;

}

function mosy_multisql_insert($conn, $db, $tbl,  $insert_cols, $insert_values)
{

	global $return_key;
  
	$magic_insert_query = mysqli_query($conn, "INSERT INTO `$db`.`$tbl` (".$insert_cols.") VALUES (".$insert_values.")");

	$return_key=mysqli_insert_id($conn);

	return $return_key;

}


//------------------------- begin update query--------//
function mosy_sql_update($tbl, $update_col_str, $where)
{
	global $single_db;
	global $single_conn;
	global $gen_update_query;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
	{

		$where_clause="";
	}


	$gen_update_query=mysqli_query($single_conn, "UPDATE `$single_db`.`$tbl` SET $update_col_str ".$where_clause."");

	return $gen_update_query;

}

function mosy_multisql_update($conn, $db, $tbl, $update_col_str, $where)
{

	global $gen_update_query;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
	{

		$where_clause="";
	}

	$gen_update_query=mysqli_query($conn, "UPDATE `$db`.`$tbl` SET $update_col_str ".$where_clause."") or die(mysqli_error($mysqliconn));

	return $gen_update_query;

}
//------------------------- begin update query--------//
///=mysqli_real_escape_string
function mmres($escape_str)
{
  global $single_conn;
  
  return mysqli_real_escape_string($single_conn, $escape_str);
  
}
//=mysqli_real_escape_string


//==================================================================


function mosy_sqlarr_insert($tbl, $fileds_n_values_json)
{
	global $single_db;
	global $single_conn;
	global $return_key;

	$json_inputs_array = ($fileds_n_values_json);


	$magic_columns=array();
	$magic_values=array();

	foreach ($json_inputs_array as $key => $value) 
	{

		if($json_inputs_array[$key]=="?"){
			if(isset($_POST["txt_".$key]))
            {
              $set_post_key=$_POST["txt_".$key];
              $magic_values[]="'".mysqli_real_escape_string($single_conn, $set_post_key)."'";
              $magic_columns[]="`".$key."`";
            }

		}else{
          
			$magic_columns[]="`".$key."`";
			$magic_values[]="'".mysqli_real_escape_string($single_conn, $json_inputs_array[$key])."'";

		}

	}
	
	$prepared_cols=implode(", ", $magic_columns);
	$prepared_vals=implode(", ", $magic_values);


	$magic_insert_query = mysqli_query($single_conn, "INSERT INTO `$single_db`.`$tbl` (".$prepared_cols.") VALUES (".$prepared_vals.")") or die(mysqli_error($single_conn));

	$return_key=mysqli_insert_id($single_conn);

	return $return_key;

}



  
//------------------------- begin update query--------//
function mosy_sqlarr_update($tbl, $fileds_n_values, $where)
{
	global $single_db;
	global $single_conn;
	global $gen_update_query;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
	{

		$where_clause="";
	}


		$json_update_array = ($fileds_n_values);


	$magic_update_str=array();

	foreach ($json_update_array as $key => $value) 
	{

		if($json_update_array[$key]=="?"){

			if(isset($_POST["txt_".$key]))
            {
              $set_post_key=$_POST["txt_".$key];
			  $magic_update_str[]="`".$key."`='".mysqli_real_escape_string($single_conn, $set_post_key)."'";
              
            }
		}else{

			$magic_update_str[]="`".$key."`='".mysqli_real_escape_string($single_conn, $json_update_array[$key])."'";

		}

	}

	$prepared_update_str=implode(", ", $magic_update_str);
  ////echo $prepared_update_str;

	$gen_update_query=mysqli_query($single_conn, "UPDATE `$single_db`.`$tbl` SET $prepared_update_str ".$where_clause."") or die(mysqli_error($single_conn));

	return $gen_update_query;
  

}

function magic_multisqlarr_update($conn, $db, $tbl, $fileds_n_values, $where)
{

	global $gen_update_query;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
	{

		$where_clause="";
	}


		$json_update_array = ($fileds_n_values);


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


//===========================================================================================================================================








//======================================================= mosy_insert and update

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

   $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a", "\x09", "x0c", "\0", "\x08", "x0c");
   $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z", "\\t","\\r", "\\0", "\\b");


    $clean_str= str_replace($search, $replace, $str);

    return $clean_str;
}
  

function magic_clean_json_str($str)
{

	global $clean_str;

    $search = array("\\",  "\x00", "\n",  "\r", '"', "\x1a", "\x09", "x0c", "\0", "\x08", "x0c");
    $replace = array("\\\\","\\0","\\n", "\\r",  '\"', "\\Z", "\\t","\\r", "\\0", "\\b");

    $clean_str= str_replace($search, $replace, $str);

    return $clean_str;
}





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

	if($filetype=='jpg' || $filetype=='png' || $filetype=='bmp' || $filetype=='gif' || $filetype=='jpeg' || $filetype=='webp'){

		$is_image='Yes';

	}else{
		$is_image='No';
	}


	return $is_image;

}
//------------------------- begin find file type --------//


/////////////// CONVERT HTML FILES TO PHP 
function html_to_php($php_directory, $html_file){

		$entry=$html_file;
		$fileattr = pathinfo("./".$entry);
		$extension=$fileattr['extension'];
		$directory=$fileattr['dirname'];
		$filename=$fileattr['filename'];
		
		$fileextract="";
		if($extension=="html"){
				
		//echo "Filename only ".$filename." file name ".$entry." Extension ".$extension."<br />";
		
		//============= Get HTML file content =================
		$currhtmlfile=$php_directory.'/'.$entry;
		
		$htmlfile_contents=file_get_contents($currhtmlfile);
		
		$replace_htmllinks2=str_replace(".html",".php", $htmlfile_contents);
		$purefilecode=$replace_htmllinks2;		
		//echo $htmlfile_contents;
		//============= Get HTML file content =================		
		$newphp_file=$php_directory."/".$filename.".php";
	  	$fh = fopen($newphp_file, 'w') or die("can't open file");
		fwrite($fh, $purefilecode);
		
		@unlink($currhtmlfile);
		//fclose($fh);	
		
		}
}



//======================  Directory Listings ==============================
function dirlisting($directory_to_list){

	if ($handle = opendir($directory_to_list)) {
	
		while (false !== ($entry = readdir($handle))) {
	
			if ($entry != "." && $entry != "..") {
				$a = $entry;
		
				if (strpos($a, '.') !== false) {
	
				// ==================== cnovert html files ==================== 
				html_to_php($directory_to_list, $entry);
				}else{
				dirlisting($directory_to_list."/".$entry);
				}
			
			}
		}
	}
}



function magic_html_to_php($source_folder, $destination_folder)
{

magic_copy_folder($source_folder, $destination_folder);
$sqlprotestfile=$destination_folder."/sqlpro3_1_test_file.html";
$fhtst = fopen($sqlprotestfile, 'w') or die("can't open file");
fwrite($fhtst, "test file");

dirlisting($destination_folder);

}

function magic_copy_folder($src, $dst) {

  /* Returns false if src doesn't exist */
  $dir = @opendir($src);

  /* Make destination directory. False on failure */
  if (!file_exists($dst)) @mkdir($dst);

  /* Recursively copy */
  while (false !== ($file = readdir($dir))) {

      if (( $file != '.' ) && ( $file != '..' )) {
         if ( is_dir($src . '/' . $file) ) magic_copy_folder($src . '/' . $file, $dst . '/' . $file); 
         else copy($src . '/' . $file, $dst . '/' . $file);
      }

  }
 closedir($dir); 
}
//======================  Directory Listings ==============================
/////////////// CONVERT HTML FILES TO PHP 
	


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

function magic_multisql_row_data($conn, $db, $tbl, $where, $orderby_col, $ordertype)
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

function magic_sql_row_data($tbl, $where, $orderby_col, $ordertype)
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
//------------------------- END cell select query--------//

function magic_sql_show_tables($dbname)
{
	global $db_tables;
	global $single_conn;

$table_array=array();

$db_tables_list = mysqli_query($single_conn, "SHOW TABLES FROM `$dbname`");

while($db_tables_list_r=mysqli_fetch_array($db_tables_list))
{
$table_array[]= $db_tables_list_r[0];
}

$db_tables=implode(",", $table_array);

return $db_tables;
}

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


$count_totals_query=mysqli_query($single_conn, "SELECT count($count_col) AS TOT_COUNT FROM `$single_db`.`$tbl` ".$where_clause."") or die(mysqli_error($single_conn));

$count_totals_res=mysqli_fetch_array($count_totals_query);

$tot_count=$count_totals_res['TOT_COUNT'];

return $tot_count;

}
function magic_sql_count_max($tbl, $count_col, $where)
{
	global $single_db;
	global $single_conn;
	global $tot_count;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
	{

		$where_clause="";
	}


$count_totals_query=mysqli_query($single_conn, "SELECT count($count_col) AS TOT_COUNT, $count_col FROM `$single_db`.`$tbl` ".$where_clause." GROUP BY $count_col ORDER BY COUNT($count_col) DESC LIMIT 1");

$count_totals_res=mysqli_fetch_array($count_totals_query);

$tot_count=array($count_totals_res[$count_col], $count_totals_res['TOT_COUNT']);

return $tot_count;

}

function magic_sql_count_min($tbl, $count_col, $where)
{
	global $single_db;
	global $single_conn;
	global $tot_count;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
	{

		$where_clause="";
	}


$count_totals_query=mysqli_query($single_conn, "SELECT count($count_col) AS TOT_COUNT, $count_col FROM `$single_db`.`$tbl` ".$where_clause." GROUP BY $count_col ORDER BY COUNT($count_col) ASC LIMIT 1");

$count_totals_res=mysqli_fetch_array($count_totals_query);

$tot_count=array($count_totals_res[$count_col], $count_totals_res['TOT_COUNT']);

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

function magic_multisql_count_max($conn, $db, $tbl, $count_col, $where)
{

	global $tot_count;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
{

		$where_clause="";
	}


$count_totals_query=mysqli_query($conn, "SELECT count($count_col) AS TOT_COUNT, $count_col FROM `$db`.`$tbl` ".$where_clause." GROUP BY $count_col ORDER BY COUNT($count_col) DESC LIMIT 1");

$count_totals_res=mysqli_fetch_array($count_totals_query);

$tot_count=array($count_totals_res[$count_col], $count_totals_res['TOT_COUNT']);

return $tot_count;

}

function magic_multisql_count_min($conn, $db, $tbl, $count_col, $where)
{

	global $tot_count;

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
{

		$where_clause="";
	}


$count_totals_query=mysqli_query($conn, "SELECT count($count_col) AS TOT_COUNT, $count_col FROM `$db`.`$tbl` ".$where_clause." GROUP BY $count_col ORDER BY COUNT($count_col) ASC LIMIT 1");

$count_totals_res=mysqli_fetch_array($count_totals_query);

$tot_count=array($count_totals_res[$count_col], $count_totals_res['TOT_COUNT']);

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


	$magic_css='<style> .msg_alert_modal{display:block;position:fixed;z-index:1;padding-top:100px;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:#000;background-color:rgba(0,0,0,.4)}.msg_modal-content{background-color:#fefefe;margin:auto;padding:20px;border:1px solid #888;width:40%;text-align:center;}.msg_modal-content_banner{background-color:#fefefe;margin:auto;padding:20px;border:1px solid #888;width:52%;font-size:16px}.msg_modalclose{color:#aaa;float:right;font-size:28px;font-weight:700}.msg_modalclose:focus,.msg_modalclose:hover{color:#000;text-decoration:none;cursor:pointer}.validate_error_class{font-size:11px;color:red}.hide_error_class{display:none}@media screen and (max-width:700px){.msg_modal-content{width:98%}.msg_modal-content_banner{padding:5px;width:98%}}</style>';


	return $magic_css;

}

function drop_css(){

	global $drop_css;

	$drop_css='<style>.table_cell_dropbtn{font-size:16px;font-weight:700}.table_cell_dropdown{position:relative;display:inline-block}.table_cell_dropdown-content{display:none;position:absolute;background-color:#fff;min-width:160px;box-shadow:0 8px 16px 0 rgba(0,0,0,.2);z-index:1;text-align:left;padding-left:5px;border-left:2px solid #00f}.table_cell_dropdown-content a{color:#000;padding:12px 16px;text-decoration:none;display:block}.table_cell_dropdown-content span{color:#000;padding:12px 16px;text-decoration:none;display:block;cursor:pointer}.table_cell_dropdown-content a:hover{background-color:#ddd}.table_cell_dropdown-content span:hover{background-color:#ddd}.table_cell_dropdown:hover .table_cell_dropdown-content{display:block}tr:hover .table_cell_dropdown-content{display:block}</style>';

	return $drop_css;
}

function magic_send_mail($to_email, $from_email, $sender_name, $subject, $message)
{
	// create email headers
	$replyto_mail="";
	$returnpath="";
	$headers="";

	if($from_email!='')
	{
    	$replyto_mail='Reply-To: ' .$sender_name." <".$from_email.">\r\n";
    	$returnpath='Return-Path: ' .$sender_name." <".$from_email.">\r\n";
	}

	$busmail=$from_email;
	$bus_name=$sender_name;

	if($to_email=='')
	{
		$busmail='info@clearphrases.com';
	}

	if($sender_name=='')
	{
		$bus_name="";
	}

    $headers = 'From: '.$bus_name.'<'.$busmail.'>' . "\r\n" .
    $headers.=$replyto_mail;
    $headers.=$returnpath;
    $headers .= "Organization: ".$bus_name."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers.='Content-type: text/html; charset=UTF-8'. "\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
   
   mail($to_email, $subject, $message, $headers);        
}

function magic_phpmailer($mail, $to, $frommail, $sender_name, $subject, $body, $attachments_json)
{
    /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */

/* Open the try/catch block. */
try {
   $mail->isHTML(TRUE);

   /* Set the mail sender. */
   $mail->setFrom($frommail, $sender_name);

   /* Add a recipient. */
   $mail->addAddress($to);

   /* Set the subject. */
   $mail->Subject = $subject;

   /* Set the mail message body. */
   $mail->Body =  $body;
   
    if($attachments_json!='')
    {
        $json_attatch_array = json_decode($attachments_json, true);

	foreach ($json_attatch_array as $key => $value) 
	{
	   $mail->addAttachment($key, $json_attatch_array[$key]);
	   
	}
	
    }
   /* Finally send the mail. */
   $mail->send();
}
catch (Exception $e)
{
   /* PHPMailer exception. */
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   /* PHP exception (note the backslash to select the global namespace Exception class). */
   echo $e->getMessage();
}
}

function push_to_paypal($tel_no, $amount_ksh,$ref_no,$app_name,$app_logo_url,$app_slogan)

{
		global $error_message;
	if($tel_no=='')
	{
		$error_message ="tel_no required";
	}elseif ($amount_ksh=='')
	 {
		$error_message ="amount_ksh required";

	}elseif ($ref_no=='')
	 
	{
		$error_message ="ref_no required";
	}elseif ($app_name=="")
	 {
		$error_message="app_name required";
	}else{


 header('location:https://clearphrases.com/payport/lipa-na-mpesa/paypal_api?payport_online&paidamt='.base64_encode($amount_ksh).'&accno='.base64_encode($ref_no).'&telno='.base64_encode($tel_no).'&request_app_name='.base64_encode($app_name).'&request_app_logo='.base64_encode($app_logo_url).'&request_app_slogan='.base64_encode($app_slogan).'');
	}

	return $error_message;
}

function push_to_mpesa($tel_no, $amount_ksh,$ref_no,$app_name,$app_logo_url,$app_slogan)
{
	global $error_message;
	if($tel_no=='')
	{
		$error_message ="tel_no required";
	}elseif ($amount_ksh=='')
	 {
		$error_message ="amount_ksh required";

	}elseif ($ref_no=='')
	 
	{
		$error_message ="ref_no required";
	}elseif ($app_name=="")
	 {
		$error_message="app_name required";
	}else{
	header('location:https://clearphrases.com/payport/lipa-na-mpesa/buy?payport_online&paidamt='.base64_encode($amount_ksh).'&accno='.base64_encode($ref_no).'&telno='.base64_encode($tel_no).'&request_app_name='.base64_encode($app_name).'&request_app_logo='.base64_encode($app_logo_url).'&request_app_slogan='.base64_encode($app_slogan).'');
	}

	return $error_message;
}

function magic_rel2abs( $rel, $base ) 
{

	// parse base URL  and convert to local variables: $scheme, $host,  $path
	extract( parse_url( $base ) );

	if ( strpos( $rel,"//" ) === 0 ) {
		return $scheme . ':' . $rel;
	}

	// return if already absolute URL
	if ( parse_url( $rel, PHP_URL_SCHEME ) != '' ) {
		return $rel;
	}

	// queries and anchors
	if ( $rel[0] == '#' || $rel[0] == '?' ) {
		return $base . $rel;
	}

	// remove non-directory element from path
	$path = preg_replace( '#/[^/]*$#', '', $path );

	// destroy path if relative url points to root
	if ( $rel[0] ==  '/' ) {
		$path = '';
	}

	// dirty absolute URL
	$abs = $host . $path . "/" . $rel;

	// replace '//' or  '/./' or '/foo/../' with '/'
	$abs = preg_replace( "/(\/\.?\/)/", "/", $abs );
	$abs = preg_replace( "/\/(?!\.\.)[^\/]+\/\.\.\//", "/", $abs );

	// absolute URL is ready!
	return $scheme . '://' . $abs;
}

function magic_trx_listener($write_to)
{

	global $return_trx_str;

	$return_trx_str='<?php
header("Content-Type:application/json");

//====================== GET RESPONSE JSON DATA FROM CURL; COMMENT THIS LINE WHEN USING SAMPLE DATA ==========

$paybilljson = file_get_contents(\'php://input\');

//====================== GET RESPONSE JSON DATA FROM CURL; COMMENT THIS LINE WHEN USING SAMPLE DATA ==========


//====================== SAMPLE JSON DATA FROM CURL; COMMENT THIS LINE WHEN USING lIVE DATA ==========
//   $paybilljson=\'{
//             "TransactionType": "Pay Bill",
//             "TransID": "TEST-SANDBOX",
//             "TransTime": "\'.date("d-m-Y h:i:s").\'",
//             "TransAmount": "10000.00",
//             "BusinessShortCode": "XXX-XXX-XXX",
//             "BillRefNumber": "EBK-5N02",
//             "InvoiceNumber": "EBK-5N02",
//             "OrgAccountBalance": "000.00",
//             "ThirdPartyTransID": "0",
//             "MSISDN": "+254-000-000-000",
//             "FirstName": "ASANETIC",
//             "MiddleName": "TECHNOLOGIES",
//             "LastName": "INC."
//         }\';
        
//====================== SAMPLE JSON DATA FROM CURL; COMMENT THIS LINE WHEN USING lIVE DATA ==========


            
//====================== GET JSON DATA  FROM DECODED JSON ARRAY ==========

$trx_record = json_decode($paybilljson, true);

$tr_type=$trx_record[\'TransactionType\'];
$trans_id=$trx_record[\'TransID\'];
$TransTime=$trx_record[\'TransTime\'];
$TransAmount=$trx_record[\'TransAmount\'];
$BusinessShortCode=$trx_record[\'BusinessShortCode\'];
$BillRefNumber=$trx_record[\'BillRefNumber\'];
$OrgAccountBalance=$trx_record[\'OrgAccountBalance\'];
$ThirdPartyTransID=$trx_record[\'ThirdPartyTransID\'];
$MSISDN=$trx_record[\'MSISDN\'];
$FirstName=$trx_record[\'FirstName\'];
$MiddleName=$trx_record[\'MiddleName\'];
$LastName=$trx_record[\'LastName\'];

//====================== GET JSON DATA  FROM DECODED JSON ARRAY ==========


//====================== GET BillRefNumber PREFIX AND SUFFIX ==========
$explode_BillRefNumber=explode("-",$BillRefNumber);
$BillRefNumber_prefix=$explode_BillRefNumber[0];
$BillRefNumber_suffix=$explode_BillRefNumber[1];
//====================== GET BillRefNumber PREFIX AND SUFFIX ==========

//====================== INSERT INTO DB ADD, ANY RELEVANT CODE HERE ==========

$post_params=\'{"primkey":"NULL","transaction_id":"\'.$trans_id.\'","transaction_ref":"\'.$BillRefNumber.\'","order_no":"\'.$BillRefNumber.\'","date_of_transaction":"\'.date("d-m-Y h:i:s A").\'","month_year":"\'.date("M-Y").\'","client_id":"\'.date("dmYAhis").\'","fname":"\'.$FirstName.\'","mname":"\'.$MiddleName.\'","lname":"\'.$LastName.\'","email":"","mobile":"\'.$MSISDN.\'","amount":"\'.$TransAmount.\'","type":"Income","transaction_remark":"\'.$tr_type.\'","transaction_status":"Complete","filter_date":"","time_stamp":"\'.date("d-m-Y h:i:s A").\'","site_id":"","tab_type":"","receipt_no":"\'.$trans_id.\'","admin_id":"","payment_mode":"Paybill"}\';

magic_sql_insert("transactions",$post_params);

//====================== INSERT INTO DB ADD, ANY RELEVANT CODE HERE ==========

?>';

if($write_to!=""){

  		$file_to_write = fopen($write_to, 'w') or die("can't open file");
		fwrite($file_to_write, $return_trx_str);
		fclose($file_to_write);
	}


	return $return_trx_str;






}


function magic_split_str($text, $length, $maxLength)
{
 //Text length
 $textLength = strlen($text);

//echo "text length ".$textLength;
 //initialize empty array to store split text
 $splitText = array();

 //return without breaking if text is already short
 if (!($textLength > $maxLength)){
  $splitText[] = $text;
  return $splitText;
 }

 //Guess sentence completion
 $needle = '.';

 /*iterate over $text length 
   as substr_replace deleting it*/  
 while (strlen($text) > $length){

  $end = strpos($text, $needle, $length);

  if ($end === false){

   //Returns FALSE if the needle (in this case ".") was not found.
   $splitText[] = substr($text,0);
   $text = '';
   break;

  }

  $end++;

  $splitText[] = substr($text,0,$end);
  $text = substr_replace($text,'',0,$end);

 }
 
 if ($text){
  $splitText[] = substr($text,0);
 }

return $splitText;
}


function magic_post_curl($curlopt_url, $curlopt_httpheader = "", $curlopt_userpwd = "", $curlopt_post_fields = "", $curlopt_customrequest = "POST") {
    global $curl_post_response;

    $new_curl_method = 'POST';
    if ($curlopt_customrequest != '') {
        $new_curl_method = $curlopt_customrequest;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $curlopt_url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $new_curl_method);

    if ($curlopt_httpheader != "") {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlopt_httpheader);
    }
    curl_setopt($ch, CURLOPT_USERPWD, $curlopt_userpwd);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlopt_post_fields);

    $curl_post_response = curl_exec($ch);

    if ($curl_post_response === false) {
        // Handle cURL error
        $error_message = curl_error($ch);
        $error_code = curl_errno($ch);
        $curl_post_response = "cURL Error $error_code: $error_message";
    }

    curl_close($ch);

    return $curl_post_response;
}

function magic_post_curl_min($curlopt_url, $curlopt_post_fields = "", $curlopt_customrequest = "POST", $curlopt_httpheader = "", $curlopt_userpwd = "") {
    global $curl_post_response;

    $new_curl_method = 'POST';
    if ($curlopt_customrequest != '') {
        $new_curl_method = $curlopt_customrequest;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $curlopt_url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $new_curl_method);

    if ($curlopt_httpheader != "") {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlopt_httpheader);
    }
    curl_setopt($ch, CURLOPT_USERPWD, $curlopt_userpwd);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlopt_post_fields);

    $curl_post_response = curl_exec($ch);

    if ($curl_post_response === false) {
        // Handle cURL error
        $error_message = curl_error($ch);
        $error_code = curl_errno($ch);
        $curl_post_response = "cURL Error $error_code: $error_message";
    }

    curl_close($ch);

    return $curl_post_response;
}

function magic_create_backend($newdbfile_path, $fileds_n_values_json, $tbl, $imgcol_path_json, $template_path)
{	

	global $single_db;
	global $single_conn;
	global $return_backend_str;

	$tbl_primkey_query=mysqli_query($single_conn, "SHOW KEYS FROM `$single_db`.`$tbl` WHERE Key_name ='PRIMARY'");

	$tbl_primkey_res=mysqli_fetch_array($tbl_primkey_query);

	$tbl_primkey=$tbl_primkey_res['Column_name'];

	//============
	$json_inputs_array = json_decode($fileds_n_values_json, true);

	$col_node_gen_q_str=array();

	foreach ($json_inputs_array as $key => $value) 
	{
		if($key!=$tbl_primkey){
			$col_node_gen_q_str[]='"'.$key.'":"\'.$gen_query_value.\'"';
		}
	}


	$img_col="";
	$img_path="";

	if($imgcol_path_json!=''){
	$json_img_array = json_decode($imgcol_path_json, true);

	foreach ($json_img_array as $key => $value) 
	{
		$img_col=$key;
		$img_path=$json_img_array[$key];

	}
	}


	
	$col_node_gen_q_str_prepared=implode(", ", $col_node_gen_q_str);
	$col_node_update_str=str_replace('"'.$tbl_primkey.'":"NULL",', '', $fileds_n_values_json);
	//=====

	if($template_path=='')
	{
		$mold_content=file_get_contents('https://raw.githubusercontent.com/Asanetic/phpmagicbits/master/backend_template.php');
	}else{
		$mold_content=file_get_contents($template_path);
	}
	$tablename_replace=str_replace('TABLE_NAME', $tbl, $mold_content);
	$primkey_replace=str_replace('<primkey>', $tbl_primkey, $tablename_replace);
	$col_node_gen_q_replace=str_replace('<col_node_gen_data_query>', $col_node_gen_q_str_prepared, $primkey_replace);

	$col_node_insert_json=str_replace('<col_node_insert_json>', $fileds_n_values_json, $col_node_gen_q_replace);
	$col_node_update_json_replace=str_replace('<col_node_update_json>', $col_node_update_str, $col_node_insert_json);
	$pic_path_replace=str_replace('<PUT_PHOTO_PATH_HERE>', $img_path, $col_node_update_json_replace);
	$pic_txt_replace=str_replace('<PUT_FILE_INPUT_NAME_HERE>', 'txt_'.$img_col, $pic_path_replace);
	$pic_col_path_replace=str_replace('<OLD_PHOTO_PATH_HERE>', '$'.$tbl.'_node["'.$img_col.'"]', $pic_txt_replace);
	$pic_col_replace=str_replace('<PHOTO_COLUMN_HERE>', $img_col, $pic_col_path_replace);

	if($newdbfile_path!=''){
		magic_write_to_file($newdbfile_path, $pic_col_replace);
	}
	return $pic_col_replace;
}


function magic_create_form_ui($newfilename,  $fileds_n_values_json, $tbl, $rows_per_grid, $grid_class)
{

	global $single_db;
	global $single_conn;
	global $return_profile_ui_str;

	$tbl_primkey_query=mysqli_query($single_conn, "SHOW KEYS FROM `$single_db`.`$tbl` WHERE Key_name ='PRIMARY'");

	$tbl_primkey_res=mysqli_fetch_array($tbl_primkey_query);

	$tbl_primkey=$tbl_primkey_res['Column_name'];



	$json_inputs_array = json_decode($fileds_n_values_json, true);

	$template_str=array();

	foreach ($json_inputs_array as $key => $value) 
	{
		if($key!=$tbl_primkey)
		{


		if($json_inputs_array[$key]=="?"){

			$label_node=ucwords(str_replace("_", " ", strtolower($key)));

		}else{

			$label_node=$json_inputs_array[$key];
		}
			$template_str[]=
			' <div class="form-group">'.PHP_EOL.
		    '  <label >'.$label_node.'</label>'.PHP_EOL.
		    '  <input class="form-control" id="txt_'.$key.'" name="txt_'.$key.'" value="<?php echo $'.$tbl.'_node["'.$key.'"];?>" placeholder="'.$label_node.'" type="text">'.PHP_EOL.
		  	' </div>';
		}
	}

	$prepared_form_inputs=$template_str;

	$grid_capsule="";
	
	$size = sizeof($prepared_form_inputs);

	$i=0;
	while($i<$size-1){
	      $i++;
	if ($i%$rows_per_grid ==1):
	$grid_capsule.=PHP_EOL.
	'<div class="'.$grid_class.'">'.PHP_EOL;
	endif;
	 $grid_capsule.=
	 ''.$prepared_form_inputs[$i].PHP_EOL;
	 if ($i%$rows_per_grid ==0):
	 $grid_capsule.=PHP_EOL.'
	</div>'.PHP_EOL;
	 endif;
	}
	if ($i%$rows_per_grid != 0) 
	$grid_capsule.=PHP_EOL.'</div>'.PHP_EOL;

	$button_str='                   
		<div align="center" style="width: 98%">
			<?php if(!isset($_GET[\'editoken\'])) echo magic_button("btn_add_new_'.$tbl.'","Proceed","");?>
			<?php if(isset($_GET[\'editoken\'])) echo magic_button("btn_save_'.$tbl.'_changes","Save Changes","");?>
		</div>';

	$edit_butons='       
    <?php echo magic_button_link(\'./edit'.$tbl.'.php?newrecord\', \'<i class="fa fa-plus"></i> Add new\', "");?> 

	<?php if(isset($_GET[\'editoken\'])) echo magic_button_link(\'./edit'.$tbl.'.php?editoken=\'.($_GET["editoken"]).\'&delete'.$tbl.'\',\'<i class="fa fa-trash"></i> Delete\', \'\');?>';
	$row_div_top=$edit_butons.PHP_EOL.'<div class="row" style="background-color: #FFF; padding: 20px;">';

	$row_div_bottom=$button_str.PHP_EOL.
	'</div>';

	if($newfilename!='')
	{
		magic_write_to_file($newfilename, $row_div_top.$grid_capsule.$row_div_bottom);
	}
	$return_profile_ui_str=$grid_capsule;

	return $return_profile_ui_str." Key ".$tbl_primkey;

}

function magic_create_table_ui($newfilename, $fileds_n_values_json, $tbl)
{
	global $single_db;
	global $single_conn;
	global $return_table_ui_str;

	$tbl_primkey_query=mysqli_query($single_conn, "SHOW KEYS FROM `$single_db`.`$tbl` WHERE Key_name ='PRIMARY'");

	$tbl_primkey_res=mysqli_fetch_array($tbl_primkey_query);

	$tbl_primkey=$tbl_primkey_res['Column_name'];



	$json_inputs_array = json_decode($fileds_n_values_json, true);

	$template_head_str='';
	$template_cell_str='';

	foreach ($json_inputs_array as $key => $value) 
	{
		if($key!=$tbl_primkey)
		{


		if($json_inputs_array[$key]=="?"){

			$label_node=ucwords(str_replace("_", " ", strtolower($key)));

		}else{

			$label_node=$json_inputs_array[$key];
		}
			$template_head_str.=
			' <th scope="col">'.$label_node.'</td>'.PHP_EOL;
			$template_cell_str.=
			' <td scope="col"><?php echo $list'.$tbl.'_result["'.$key.'"];?></td>'.PHP_EOL;

		}


	}


	$return_table_ui_str='
    <div align="left">
    	<?php echo magic_button_link(\'./edit'.$tbl.'.php?newrecord\', \'<i class="fa fa-plus"></i> Add new\', "");?> 
	</div>
	<div class="table-responsive data-tables" style="background-color: #FFF; margin-top: 20px; padding-bottom: 150px;">
	<?php echo $no'.$tbl.'?>
	<table class="table table-hover text-left" id="'.$tbl.'_data_table">
	    <thead class="text-uppercase">
		   <tr>
		    <th scope="col">#</th>
				'.$template_head_str.'
		   </tr>
	    </thead>
	    <tbody>
		<?php 
		$pagination_record_count=$list'.$tbl.'[1];
        $i=0;
		while($list'.$tbl.'_result=mysqli_fetch_array($list'.$tbl.'[0])){
	        $i++;

	        $edit_drop_link=magic_link(\'./edit'.$tbl.'.php?editoken=\'.base64_encode($list'.$tbl.'_result["'.$tbl_primkey.'"]).\'\',\'<i class="fa fa-edit"></i> Edit\', \'\');

	        $delete_drop_link=magic_link(\'./edit'.$tbl.'.php?editoken=\'.base64_encode($list'.$tbl.'_result["'.$tbl_primkey.'"]).\'&delete'.$tbl.'\',\'<i class="fa fa-trash"></i> Delete\', \'\');

	        $dropdown_items =$edit_drop_link.$delete_drop_link;
        ?>
	    <tr>
	    <td scope="col"><?php echo magic_dropdown($i, $dropdown_items, \'no\')?></td>
			'.$template_cell_str.'
	    </tr>
	    <?php }?>
	    </tbody>
	    </table>
	 <hr>
	 <?php include("./pagination.php");?>
	</div>';

	if($newfilename!='')
	{
		magic_write_to_file($newfilename, $return_table_ui_str);
	}

	return $return_table_ui_str;
}

  function magic_page_title($url)
   {
  	global $title;
        $fp = file_get_contents($url);
        if (!$fp) 
            return null;

        $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
        if (!$res) 
            return null; 

        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        return $title;
    }
?>
