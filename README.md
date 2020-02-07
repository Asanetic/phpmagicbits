/*WELCOME TO PHP MAGIC BITS OPEN SOURCE*
 * PhpMagic bits or PMB is an open source library template for the most basic mysqli -> s in php to the advanced php calls such as file upload, write read and Simple UX ui -> s.
 *
 *
 * PHP version 2.0
 *
	=========================================================================	Copyright 2020 ASANETIC TECHNOLOGIES

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





//====================== create message pop ups ==========================

magic_message($message_to_display) ; - creates an alert message that closes on click
Example :
<?php echo magic_message(‘Hello World’) ;?>
magic_screen($message_to_display); - creates an alert message that closes only when close button is clicked
<?php echo magic_ screen (‘Hello World’) ;?>
magic_modal($message_to_display)

magic_error_message($message_to_display)
//====================== create message pop ups ==========================

//============================ create inputs on the fly ===
magic_inputs($write_to, $input_fileds_in_json, $input_template, $bootstrap_col_str, $comment)

magic_button($name_n_id, $value_text, $additional_attributes)

magic_input($name_n_id, $placeholder, $additional_attributes)

magic_plain_button($name_n_id, $name_text, $additional_attributes)
magic_link($location, $name_text, $additional_attributes)
magic_button_link($location, $name_text, $additional_attributes)

magic_dropdown($title, $dropdown_items, $inline_css_yes_no)
//------------------------- end write new file contents --------//


//============================ create inputs on the fly ===

//============================== begin Cookie -> s  ===============
magic_create_cookie($cookie_name, $cookie_value)

magic_cookie_value($cookie_name)
magic_drop_cookie($cookie_name)

//============================== end Cookie -> s  ===============


//===================== begin drop zone file upload ================

magic_dropzone_file_upload($path, $tempfile, $new_file_name)
magic_destroy_file($file_path)

//===================== begin calculate difference in days ================
magic_time_diff($first_d_m_y_h_i_s_a, $sec_d_m_y_h_i_s_a)
//===================== begin calculate difference in days ================


//======== show current url ===============


magic_basename($url_path)

//======== show current url ===============

//===============begin compress image=========================
magic_compress_file($source, $destination, $quality) 
//===============end compress image=========================

//------------------------- begin  generate random string --------//
magic_random_str($length)
//------------------------- end  generate random string --------//
//============== begin file upload ->  ===================

magic_upload_file($upload_path, $input_element_name, $new_file_name) 
//============== end file upload ->  ===================

//------------------------- begin write table columns in the current file--------//

->  magic_sql_show_cols($tbl)
->  magic_sql_array_cols($tbl)
->  magic_multisql_show_cols($conn, $db, $tbl)
->  magic_multisql_array_cols($conn, $db, $tbl)

//------------------------- end write table columns in the current file--------//



//------------------------- begin replace file contents --------//

->  magic_replace_file_contents($file_path, $item_to_be_replaced, $item_to_replace_with)
//------------------------- end replace file contents --------//


//------------------------- begin write new file contents --------//

->  magic_write_to_file($file_path, $new_content_to_write)
//------------------------- end write new file contents --------//


//==================== magic ui elemnts 
->  magic_sql_params($file_path, $param_fields, $comment)
	->  magic_validate_email ($input_validate_json,$message)
	

->  magic_validate_required($input_validate_json, $message)


//***************************** MAGIC SQL *******************************************************************

->  magic_sql_insert($tbl, $fileds_n_values_json)

->  magic_multisql_insert($conn, $db, $tbl, $fileds_n_values_json)


->  magic_sql_where($input_where_json)

->  magic_multisql_where($conn, $input_where_json)

->  magic_create_session($input_session_json)

->  magic_destroy_session($input_session_json)


->  magic_sql_where_like($input_where_json)


->  magic_multisql_where_like($conn, $input_where_json)

//------------------------- begin update query--------//
->  magic_sql_update($tbl, $fileds_n_values, $where)

->  magic_multisql_update($conn, $db, $tbl, $fileds_n_values, $where)
//------------------------- begin update query--------//


//***************************** MAGIC SQL *******************************************************************

->  magic_clean_str($str)





//------------------------- begin find file type --------//

//------------------------- begin find file type --------//


//------------------------- begin strip text--------//

->  magic_strip_if($text, $length, $strip_if)
//------------------------- end strip text--------//





//------------------------- begin find file type --------//

->  magic_if_image($file_path)
//------------------------- begin find file type --------//


/////////////// CONVERT HTML FILES TO PHP 
->  html_to_php($php_directory, $html_file){
//======================  Directory Listings ==============================
->  dirlisting($directory_to_list)
->  magic_html_to_php($source_folder, $destination_folder)

->  magic_copy_folder($src, $dst) 
//======================  Directory Listings ==============================
/////////////// CONVERT HTML FILES TO PHP 
	


// ****************************************************************** BEGIN SQL QUERIES *******************************//

->  magic_sql_record_per_page($conn, $sqlstring, $reclimit)

//------------------------- begin select query--------//


->  magic_sql_select($tbl, $where, $datalimit, $orderby_col, $ordertype)

->  magic_multisql_select($conn, $db, $tbl, $where, $datalimit, $orderby_col, $ordertype)

//------------------------- end select query--------//




//------------------------- START cell select query--------//

->  magic_sql_data_cell($tbl, $return_col, $where, $orderby_col, $ordertype)

->  magic_multisql_data_cell($conn, $db, $tbl, $return_col, $where, $orderby_col, $ordertype)
//------------------------- END cell select query--------//

//------------------------- START cell select query--------//

->  magic_sql_cell_array($tbl, $where, $orderby_col, $ordertype)

->  magic_multisql_cell_array($conn, $db, $tbl, $where, $orderby_col, $ordertype)
//------------------------- END cell select query--------//


//------------------------- START cell Delete query--------//

->  magic_sql_delete($tbl, $where)

->  magic_multisql_delete($conn, $db, $tbl, $where)
//------------------------- END cell Delete query--------//


//------------------------- start sum select query--------//

->  magic_sql_sum($tbl, $sum_col, $where)

->  magic_multisql_sum($conn, $db, $tbl, $sum_col, $where)
//------------------------- end sum select query--------//

//------------------------- start count select query--------//

->  magic_sql_count($tbl, $count_col, $where)

->  magic_multisql_count($conn, $db, $tbl, $count_col, $where)
//------------------------- end count select query--------//


->  magic_sql_group($tbl, $where, $datalimit, $orderby_col, $ordertype, $group_by_col)
->  magic_multisql_group($conn, $db, $tbl, $where, $datalimit, $orderby_col, $ordertype, $group_by_col)
//------------------------- end group by select query--------//


// ***************************************************************** END SQL QUERIES *******************************//


->  magic_css()

->  drop_css()
->  magic_send_mail($to_email, $from_email, $sender_name, $subject, $message)
?>
