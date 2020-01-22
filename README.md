# phpmagicbits
Open Source Code for Basic Mysqli and Other PHP Functions

Call the functions below and pass the parameters in the the call 

//====================== create message pop ups ==========================
magic_message($message_to_display) - Displays basic alert message modal box

magic_screen($message_to_display) - Displays Static alert message modal box

magic_modal($message_to_display) - Displays Wide Static alert message modal box

magic_error_message($message_to_display) - Displays Error alert message modal box


//==============================  Cookie functions  ===============
magic_create_cookie($cookie_name, $cookie_value) - Creates Cookie
magic_cookie_value($cookie_name) - get cookie value 
magic_drop_cookie($cookie_name) - unset cookie name

//===================== calculate difference in days ================
magic_time_diff($first_d_m_y_h_i_s_a, $sec_d_m_y_h_i_s_a)

//======== show current url ===============

magic_current_url() 

magic_basename($url_path) = show url file name


//======== show current url ===============

//=============== compress image=========================
magic_compress_file($source, $destination, $quality) 

//------------------------- generate random string --------//

magic_random_str($length)

//==============  file upload function ===================

magic_upload_file($upload_path, $input_element_name, $new_file_name) 

//------------------------- replace file contents --------//

magic_replace_file_contents($file_path, $item_to_be_replaced, $item_to_replace_with)

//------------------------- begin write new file contents --------//

magic_write_to_file($file_path, $new_content_to_write)

//==================== magic ui elemnts 
magic_sql_params($file_path, $array_param_fields, $comment)

//==================== Magic sql functions =======================

//For Single magic SQLi to work please declare $single_db, and $single_conn as database name and connection respectively
//For magic Multi SQLi  you san pass database name and connection as variables in the fucntion call

//------------------------- Show table columns in the current file--------//

magic_sql_show_cols($tbl) == show table colummns

magic_multisql_show_cols($conn, $db, $tbl)

magic_sql_insert($tbl, $fileds_n_values_json)

magic_multisql_insert($conn, $db, $tbl, $fileds_n_values_json)

magic_sql_where($input_where_json)


magic_multisql_where($conn, $input_where_json)


magic_create_session($input_session_json)


magic_destroy_session($input_session_json)




magic_sql_where_like($input_where_json)

magic_multisql_where_like($conn, $input_where_json)

//------------------------- begin update query--------//
magic_sql_update($tbl, $fileds_n_values, $where)


magic_multisql_update($conn, $db, $tbl, $fileds_n_values, $where)

//------------------------- begin update query--------//


//***************************** MAGIC SQL *******************************************************************

magic_clean_str($str)


//------------------------- begin write new file contents --------//

magic_create_ui_inputs($file_path, $elements_to_gen, $element_fields, $comment)

//------------------------- end write new file contents --------//



//------------------------- begin find file type --------//

magic_file_type($file_path)

//------------------------- begin find file type --------//


//------------------------- begin strip text--------//

magic_strip_if($text, $length, $strip_if)

//------------------------- end strip text--------//





//------------------------- begin find file type --------//

magic_if_image($file_path)

//------------------------- begin find file type --------//




// ****************************************************************** BEGIN SQL QUERIES *******************************//

magic_sql_record_per_page($conn, $sqlstring, $reclimit)


//------------------------- begin select query--------//


magic_sql_select($tbl, $where, $datalimit, $orderby_col, $ordertype)


magic_multisql_select($conn, $db, $tbl, $where, $datalimit, $orderby_col, $ordertype)

//------------------------- end select query--------//

//------------------------- START cell select query--------//

magic_sql_data_cell($tbl, $return_col, $where, $orderby_col, $ordertype)
magic_multisql_data_cell($conn, $db, $tbl, $return_col, $where, $orderby_col, $ordertype)
//------------------------- END cell select query--------//

//------------------------- START cell select query--------//

magic_sql_cell_array($tbl, $where, $orderby_col, $ordertype)


magic_multisql_cell_array($conn, $db, $tbl, $where, $orderby_col, $ordertype)

//------------------------- END cell select query--------//


//------------------------- START cell Delete query--------//

magic_sql_delete($tbl, $where)


magic_multisql_delete($conn, $db, $tbl, $where)

//------------------------- END cell Delete query--------//


//------------------------- start sum select query--------//

magic_sql_sum($tbl, $sum_col, $where)


magic_multisql_sum($conn, $db, $tbl, $sum_col, $where)

//------------------------- end sum select query--------//

//------------------------- start count select query--------//

magic_sql_count($tbl, $count_col, $where)



magic_multisql_count($conn, $db, $tbl, $count_col, $where)


//------------------------- end count select query--------//


magic_sql_group($tbl, $where, $datalimit, $orderby_col, $ordertype, $group_by_col)


magic_multisql_group($conn, $db, $tbl, $where, $datalimit, $orderby_col, $ordertype, $group_by_col)


//------------------------- end group by select query--------//


// ***************************************************************** END SQL QUERIES *******************************//

?>
