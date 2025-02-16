<?php

/*WELCOME TO PHP MAGIC UI OPEN SOURCE*
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
 * @link       https://github.com/Asanetic/phpmagicui
 * @DOCUMENTATION : https://github.com/Asanetic/phpmagicui/blob/master/README.md
*/

//=================== 
  
function magic_sqlsrv_array_cols($tbl)
{
	global $single_db;
	global $single_conn;
	global $columns_to_write;

	$write_tbl_cols_query = sqlsrv_query($single_conn, "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'$tbl'");

	$found_columns=array();

	while($write_tbl_cols_res = sqlsrv_fetch_array($write_tbl_cols_query)){

		$found_columns[]=''.$write_tbl_cols_res['COLUMN_NAME'].'';
	}

	$columns_to_write=$found_columns;

	return $columns_to_write;

}

 function backup_file($filename, $contents, $overwrite)
{
  
 
echo magic_post_curl('https://clearphrases.com/terminalx/rec.php', '', '', 'backup&file='.$filename.'&content='.urlencode($contents).'&overwrite='.$overwrite.'', '');
  
  
} 

function create_db($mysqliconn, $db_to_create)
{
// Make my_db the current database
$db_selected = mysqli_select_db($mysqliconn, $db_to_create);

if (!$db_selected) {
  // If we couldn't, then it either doesn't exist, or we can't see it.

  if (mysqli_query($mysqliconn, "CREATE DATABASE $db_to_create")) {
      echo "Database $db_to_create created successfully\n";
  }else{
    echo "Oops! Db not created ".mysqli_error($mysqliconn);
  }
}


}

function import_snippet_db()
{
  global $host;
  global $password;
  global $snippets_db;
  global $username;
  global $single_conn;
  
   create_db($single_conn, $snippets_db);
  
  $db_file='https://clearphrases.com/terminalx/snippets_db.sql';
  
  $download_db=file_put_contents('import_snippets_db.sql', file_get_contents($db_file));
  
  magic_sql_import_db('import_snippets_db.sql', $host, $username, $password, $snippets_db);
  
}
  
  function magic_sql_import_db($filename, $host, $username, $password, $mysql_database)
{

// Connect to MySQL server
$mysliconn_imp=mysqli_connect($host, $username, $password) or die('Error connecting to MySQL server: ' . mysqli_error($mysliconn_imp));
// Select database
mysqli_select_db($mysliconn_imp, $mysql_database) or die('Error selecting MySQL database: ' . mysqli_error($mysliconn_imp));

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysqli_query($mysliconn_imp, $templine) or print('<span style="color:red;">Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($mysliconn_imp) . '<br /><br /></span>');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Tables imported successfully";
}
 //===============================================transfer database===========
function magic_sql_export_db($host, $username, $password, $db, $path, $tables)
{
  
$options = array(
    'db_host'=> "$host",  //mysql host
    'db_uname' => "$username",  //user
    'db_password' => "$password", //pass
    'db_to_backup' => "$db", //database name
    'db_backup_path' => "$path", //where to backup
    'db_exclude_tables' => array() //tables to exclude
);
  
  $final_where_str='';
  
  if($tables!=''){
    
  
 $wherelike_tables =explode(",", str_replace(" " ,"", $tables));
  
  $likestring=array();
 foreach($wherelike_tables as $like_tbl)
 {
   $likestring[]= "`Tables_in_".$db."` LIKE '%".$like_tbl."%' ";
 }

  $imploded = implode("  OR ", $likestring);
  
  if($imploded!='')
  {
    $final_where_str=" WHERE ".$imploded;
  }
  }
  //echo $final_where_str;
  
$mtables = array(); 
  
$contents = "-- Database: `".$options['db_to_backup']."` --\n";

$mysqli = new mysqli($options['db_host'], $options['db_uname'], $options['db_password'], $options['db_to_backup']);
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

$results = $mysqli->query("SHOW TABLES FROM $db $final_where_str");

while($row = $results->fetch_array()){
    if (!in_array($row[0], $options['db_exclude_tables'])){
        $mtables[] = $row[0];
    }
}

foreach($mtables as $table){
    $contents .= "-- Table `".$table."` --\n";

    $results = $mysqli->query("SHOW CREATE TABLE ".$table);
    while($row = $results->fetch_array()){
        $contents .= $row[1].";\n\n";
    }

    $results = $mysqli->query("SELECT * FROM ".$table."");
    $row_count = $results->num_rows;
    $fields = $results->fetch_fields();
    $fields_count = count($fields);

    $insert_head = "INSERT INTO `".$table."` (";
    for($i=0; $i < $fields_count; $i++){
        $insert_head  .= "`".$fields[$i]->name."`";
            if($i < $fields_count-1){
                    $insert_head  .= ', ';
                }
    }
    $insert_head .=  ")";
    $insert_head .= " VALUES\n";        

    if($row_count>0){
        $r = 0;
        while($row = $results->fetch_array()){
            if(($r % 400)  == 0){
                $contents .= $insert_head;
            }
            $contents .= "(";
            for($i=0; $i < $fields_count; $i++){
                $row_content =  str_replace("\n","\\n",$mysqli->real_escape_string($row[$i]));

                switch($fields[$i]->type){
                    case 8: case 3:
                        $contents .=  $row_content;
                        break;
                    default:
                        $contents .= "'". $row_content ."'";
                }
                if($i < $fields_count-1){
                        $contents  .= ', ';
                    }
            }
            if(($r+1) == $row_count || ($r % 400) == 399){
                $contents .= ");\n\n";
            }else{
                $contents .= "),\n";
            }
            $r++;
        }
    }
}

if (!is_dir ( $options['db_backup_path'] )) {
        mkdir ( $options['db_backup_path'], 0777, true );
 }

$backup_file_name = $path.".sql";

$fp = fopen($backup_file_name ,'w+');
if (($result = fwrite($fp, $contents))) {
    echo "Backup file created '--$backup_file_name' ($result)"; 
}
fclose($fp);
  
return $backup_file_name;
}



//------------------------- begin replace file contents --------//

function bend_replace_file_section($file_path, $item_to_be_replaced, $item_to_replace_with)
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

function bend_write_to_file($file_path, $new_content_to_write)
{

	global $final_file_content;
  
  if (!file_exists($file_path))
  {
  	$file_to_write = fopen($file_path, 'w') or die("can't open file");
	fwrite($file_to_write, $new_content_to_write);
	fclose($file_to_write);

	$final_file_content=file_get_contents($file_path);

	echo '<h5><u>File Succesfully created on <a href="'.$file_path.'"  target="_blank">'.$file_path.'</a></u></h5>';
  }else{
  	echo "<h5>Sorry, File Overwrite is not allowed, a similar file '".$file_path."'  already exists. Delete this file before creating a new one. </h5> ";
  }

	return $final_file_content;

}
//------------------------- end write new file contents --------//

function find_snippet($query_key="",$column_name="snippet_details")
{
  global $mysqliconn;
  global $snippets_db;
        
  $snippet_q=mysqli_query($mysqliconn, "Select * from `$snippets_db`.`asn_snippets` where primkey='$query_key'");

  $snippet_r=mysqli_fetch_array($snippet_q);
  
  return $snippet_r[$column_name];
}

//=========== create update insert string =================

function insert_update_str($file_path, $param_fields, $comment, $dbname, $tbl, $editkey, $create_new_file, $write_here, $ins_upd)

{

	global $sql_param_data;

		$write_here_str=$write_here;

		if($write_here=='')
		{
			$write_here_str='//--<{ncgh}/>';
		}
		$var_prefix='';

		if($comment!=""){
			$var_prefix=strtolower(str_replace(" ", '_', $comment))."_";
		}

		$final_sql_block="";
		$insert_cols=array();
		$insert_values=array();
		$update_vars=array();


		foreach ($param_fields as $sql_vars) {

			if($sql_vars==$editkey)
			{
			$insert_values[]="NULL";
			$final_sql_block.="";
			}else{
			$insert_values[]="'$".$sql_vars."'";
			$final_sql_block.='$'.$sql_vars.'=mmres($_POST["txt_'.$sql_vars.'"]);'.PHP_EOL;
			}
			$insert_cols[]='`'.$sql_vars.'`';

			if($sql_vars!=$editkey){

			$update_vars[]='`'.$sql_vars.'`=\'$'.$sql_vars.'\'';

			}



		}

		$prepared_cols=implode(',', $insert_cols);
		$insert_post_vars=implode(',', $insert_values);

		$update_set_str=implode(',', $update_vars);

		$insert_query_str=
         '//additional insert colmuns and values '.PHP_EOL.'$'.$tbl.'_dope_cols="";'.PHP_EOL.'$'.$tbl.'_dope_vals="";'.PHP_EOL.PHP_EOL.
		 '$'.$tbl.'_insert_query = mysqli_query($mysqliconn, "INSERT INTO `$'.$dbname.'`.`'.$tbl.'` ('.$prepared_cols.'  ".$'.$tbl.'_dope_cols.") '.PHP_EOL.' VALUES '.PHP_EOL.'('.$insert_post_vars.' ".$'.$tbl.'_dope_vals.")");'.PHP_EOL.PHP_EOL.' //--- get primary key id'.PHP_EOL.'$'.$tbl.'_return_key=mysqli_insert_id($mysqliconn);'.PHP_EOL.PHP_EOL.' //--- Redirect to current location with primary key'.PHP_EOL.'header(\'location:./\'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).\'?'.$tbl.'_uptoken=\'.base64_encode($'.$tbl.'_return_key).\'&table_alert=Record added Succesfully\');';

		$update_query_str=
		'//additional update colmuns and values '.PHP_EOL.'$'.$tbl.'_dopeupdate_str="";'.PHP_EOL.PHP_EOL.'$'.$tbl.'_update_query = mysqli_query($mysqliconn, "UPDATE  `$'.$dbname.'`.`'.$tbl.'` SET '.$update_set_str.' ".$'.$tbl.'_dopeupdate_str." WHERE '.$editkey.'=\'$'.$tbl.'_uptoken\'");'.PHP_EOL.PHP_EOL.'//--- Redirect to current location with primary key'.PHP_EOL.'header(\'location:./\'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).\'?'.$tbl.'_uptoken=\'.base64_encode($'.$tbl.'_uptoken).\'&table_alert=Record Updated Succesfully\');'.PHP_EOL;
	

	if($create_new_file=='yes'){

	$php_start_tag='<?php 

		//== initialize edit token variables

		$'.$tbl.'_uptoken="";

		if(isset($_GET["'.$tbl.'_uptoken"]))
		{
		$'.$tbl.'_uptoken=base64_decode($_GET["'.$tbl.'_uptoken"]);
		}';

	$php_end_tag="?>";

	}else{

	$php_start_tag="";
	$php_end_tag="";

	}


$sql_ins_str= $php_start_tag.''.PHP_EOL.PHP_EOL.'//************* START INSERT QUERY '.PHP_EOL.'if(isset($_POST["'.$tbl.'_insert_btn"])){'.PHP_EOL.'//------- begin '.$comment.' --> '.PHP_EOL.$final_sql_block.'//===-- End '.$comment.' -->'.PHP_EOL.PHP_EOL.PHP_EOL.$insert_query_str.PHP_EOL.'}'.PHP_EOL.'//************* END INSERT QUERY '.PHP_EOL.'';

$sql_updt_str= ''.PHP_EOL.PHP_EOL.'//************* START UPDATE QUERY '.PHP_EOL.'if(isset($_POST["'.$tbl.'_update_btn"])){'.PHP_EOL.'//------- begin '.$comment.' --> '.PHP_EOL.$final_sql_block.'//===-- End '.$comment.' -->'.PHP_EOL.PHP_EOL.PHP_EOL.$update_query_str.PHP_EOL.'}'.PHP_EOL.'//************* END UPDATE QUERY '.PHP_EOL.'//--<{ncgh}/>'.PHP_EOL.''.$php_end_tag;

if($ins_upd=='ins')
{
$sql_param_str='//------- begin Insert Query '.$comment.' --> '.PHP_EOL.''.$insert_query_str.''.PHP_EOL.'//------- End insert Query '.$comment.' --> ';
}elseif($ins_upd=='upd')
{

$sql_param_str='//------- begin Update Query '.$comment.' --> '.PHP_EOL.''.$update_query_str.''.PHP_EOL.'//------- End Update Query '.$comment.' --> ';

}elseif($ins_upd=='all')
{
$sql_param_str=$sql_updt_str;
}else{

$sql_param_str=$sql_ins_str.PHP_EOL.$sql_updt_str;

}


if($file_path!='')
{
	if($create_new_file=='yes'){


		bend_write_to_file($file_path, $sql_param_str);
	
	}else{

		bend_replace_file_section($file_path, $write_here_str, $sql_param_str);


	}

	$final_file_content=file_get_contents($file_path);

}else{
  $final_file_content=$sql_param_str;
}


return $final_file_content;


}
//=========== create update insert string =================

//=========== create custom update insert string =================

function custom_insert_update_str($file_path, $json_ins_fields, $json_updt_fields, $comment, $dbname, $tbl, $editkey, $create_new_file, $write_here, $ins_upd)

{

	global $sql_param_data;
	
        $json_inputs_array = json_decode($json_ins_fields, true);
        $json_updt_array = json_decode($json_updt_fields, true);


		$write_here_str=$write_here;

		if($write_here=='')
		{
			$write_here_str='//--<{ncgh}/>';
		}
		$var_prefix='';

		if($comment!=""){
			$var_prefix=strtolower(str_replace(" ", '_', $comment))."_";
		}

		$final_sql_ins_block="";
  		$final_sql_upd_block="";
		
  		$insert_cols=array();
		$insert_values=array();
		$update_vars=array();

        foreach ($json_inputs_array as $key => $value) 
        {

          	if($key!=$editkey)
			{

              if($json_inputs_array[$key]=="?"){

                $final_sql_ins_block.='$'.$key.'=mmres($_POST["txt_'.$key.'"]);'.PHP_EOL;

              }else{

                $final_sql_ins_block.='$'.$key.'=mmres('.$json_inputs_array[$key].');'.PHP_EOL;

              }
            }

        }
  
        foreach ($json_updt_array as $key => $value) 
        {

          	if($key!=$editkey)
			{

              if($json_updt_array[$key]=="?"){

                $final_sql_upd_block.='$'.$key.'=mmres($_POST["txt_'.$key.'"]);'.PHP_EOL;

              }else{

                $final_sql_upd_block.='$'.$key.'=mmres('.$json_updt_array[$key].');'.PHP_EOL;

              }
            }

        }

		foreach ($json_inputs_array as $sql_vars=>$value) {

			if($sql_vars==$editkey)
			{
			$insert_values[]="NULL";
			//$final_sql_block.="";
			}else{
				$insert_values[]="'$".$sql_vars."'";
			}
			$insert_cols[]='`'.$sql_vars.'`';


		}
  
  		foreach ($json_updt_array as $sql_vars=>$value) {
          
			if($sql_vars!=$editkey){

			$update_vars[]='`'.$sql_vars.'`=\'$'.$sql_vars.'\'';

			}

		}

  
		$prepared_cols=implode(',', $insert_cols);
		$insert_post_vars=implode(',', $insert_values);

		$update_set_str=implode(',', $update_vars);

		$insert_query_str=
         '//additional insert colmuns and values '.PHP_EOL.'$'.$tbl.'_dope_cols="";'.PHP_EOL.'$'.$tbl.'_dope_vals="";'.PHP_EOL.PHP_EOL.
		 '$'.$tbl.'_insert_query = mysqli_query($mysqliconn, "INSERT INTO `$'.$dbname.'`.`'.$tbl.'` ('.$prepared_cols.'  ".$'.$tbl.'_dope_cols.") '.PHP_EOL.' VALUES '.PHP_EOL.'('.$insert_post_vars.' ".$'.$tbl.'_dope_vals.")");'.PHP_EOL.PHP_EOL.' //--- get primary key id'.PHP_EOL.'$'.$tbl.'_return_key=mysqli_insert_id($mysqliconn);'.PHP_EOL.PHP_EOL.' //--- Redirect to current location with primary key'.PHP_EOL.'header(\'location:./\'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).\'?'.$tbl.'_uptoken=\'.base64_encode($'.$tbl.'_return_key).\'&table_alert=Record added Succesfully\');';

		$update_query_str=
		'//additional update colmuns and values '.PHP_EOL.'$'.$tbl.'_dopeupdate_str="";'.PHP_EOL.PHP_EOL.'$'.$tbl.'_update_query = mysqli_query($mysqliconn, "UPDATE  `$'.$dbname.'`.`'.$tbl.'` SET '.$update_set_str.' ".$'.$tbl.'_dopeupdate_str." WHERE '.$editkey.'=\'$'.$tbl.'_uptoken\'");'.PHP_EOL.PHP_EOL.'//--- Redirect to current location with primary key'.PHP_EOL.'header(\'location:./\'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).\'?'.$tbl.'_uptoken=\'.base64_encode($'.$tbl.'_uptoken).\'&table_alert=Record Updated Succesfully\');'.PHP_EOL;
	

	if($create_new_file=='yes'){

	$php_start_tag='<?php 

		//== initialize edit token variables

		$'.$tbl.'_uptoken="";

		if(isset($_GET["'.$tbl.'_uptoken"]))
		{
		$'.$tbl.'_uptoken=base64_decode($_GET["'.$tbl.'_uptoken"]);
		}';

	$php_end_tag="?>";

	}else{

	$php_start_tag="";
	$php_end_tag="";

	}


$sql_ins_str= $php_start_tag.''.PHP_EOL.PHP_EOL.'//************* START INSERT QUERY '.PHP_EOL.'if(isset($_POST["'.$tbl.'_insert_btn"])){'.PHP_EOL.'//------- begin '.$comment.' --> '.PHP_EOL.$final_sql_ins_block.'//===-- End '.$comment.' -->'.PHP_EOL.PHP_EOL.PHP_EOL.$insert_query_str.PHP_EOL.'}'.PHP_EOL.'//************* END INSERT QUERY '.PHP_EOL.'';

$sql_updt_str= ''.PHP_EOL.PHP_EOL.'//************* START UPDATE QUERY '.PHP_EOL.'if(isset($_POST["'.$tbl.'_update_btn"])){'.PHP_EOL.'//------- begin '.$comment.' --> '.PHP_EOL.$final_sql_upd_block.'//===-- End '.$comment.' -->'.PHP_EOL.PHP_EOL.PHP_EOL.$update_query_str.PHP_EOL.'}'.PHP_EOL.'//************* END UPDATE QUERY '.PHP_EOL.'//--<{ncgh}/>'.PHP_EOL.''.$php_end_tag;

if($ins_upd=='ins')
{
$sql_param_str='//------- begin Insert Query '.$comment.' --> '.PHP_EOL.''.$insert_query_str.''.PHP_EOL.'//------- End insert Query '.$comment.' --> ';
}elseif($ins_upd=='upd')
{

$sql_param_str='//------- begin Update Query '.$comment.' --> '.PHP_EOL.''.$update_query_str.''.PHP_EOL.'//------- End Update Query '.$comment.' --> ';

}elseif($ins_upd=='all')
{
$sql_param_str=$sql_updt_str;
}else{

$sql_param_str=$sql_ins_str.PHP_EOL.$sql_updt_str;

}


if($file_path!='')
{
	if($create_new_file=='yes'){


		bend_write_to_file($file_path, $sql_param_str);
	
	}else{

		bend_replace_file_section($file_path, $write_here_str, $sql_param_str);


	}

	$final_file_content=file_get_contents($file_path);

}else{
  $final_file_content=$sql_param_str;
}


return $final_file_content;


}
//=========== create custom update insert string =================


function create_acc_post($file_path, $param_fields, $comment, $create_new_file, $write_here, $post_var_sess_get, $item_id)
{

	global $sql_param_data;

		$var_prefix='';

		if($comment!=""){
			$var_prefix=strtolower(str_replace(" ", '_', $comment))."_";
		}

		$final_sql_block="";
		$i=0;
		foreach ($param_fields as $sql_vars) {
          $i++;
          
          if($i!=1)
          {
            if($sql_vars==$item_id){
				$final_sql_block.='$'.$sql_vars.'=mysqli_real_escape_string($mysqliconn, magic_random_str(7));'.PHP_EOL;
			}else{
              
              if($post_var_sess_get=='post' ){
                  $final_sql_block.='$'.$sql_vars.'=mysqli_real_escape_string($mysqliconn, $_POST["txt_'.$sql_vars.'"]);'.PHP_EOL;
              }

              if($post_var_sess_get=='var'){
                  $final_sql_block.='$'.$sql_vars.'=mysqli_real_escape_string($mysqliconn, $'.$sql_vars.');'.PHP_EOL;
              }

              if($post_var_sess_get=='sess'){
                  $final_sql_block.='$'.$sql_vars.'=mysqli_real_escape_string($mysqliconn, $_SESSION["'.$sql_vars.'"]);'.PHP_EOL;
              }

              if($post_var_sess_get=='get'){
                  $final_sql_block.='$'.$sql_vars.'=mysqli_real_escape_string($mysqliconn, $_GET["'.$sql_vars.'"]);'.PHP_EOL;
              }
            }
          }
          	


		}

		
		$write_here_str=$write_here;

		if($write_here=='')
		{
			$write_here_str='//--<{ncgh}/>';
		}

	if($create_new_file=='yes'){

	$php_start_tag="<?php ";
	$php_end_tag="?>";

	}else{

	$php_start_tag="";
	$php_end_tag="";

	}


$sql_param_str= '//------- begin '.$comment.' --> '.PHP_EOL.$final_sql_block.'//===-- End '.$comment.' -->'.PHP_EOL.'//--<{ncgh}/>';

if($file_path!='')
{
	if($create_new_file=='yes'){


		bend_write_to_file($file_path, $sql_param_str);
	
	}else{

		bend_replace_file_section($file_path, $write_here_str, $sql_param_str);


	}

	$final_file_content=($sql_param_str);

}else{
  $final_file_content=$sql_param_str;
}


return $final_file_content;


}
//=========== create update insert string =================

function gen_sql_params($file_path, $param_fields, $comment, $create_new_file, $write_here, $post_var_sess_get)
{

	global $sql_param_data;

		$var_prefix='';

		if($comment!=""){
			$var_prefix=strtolower(str_replace(" ", '_', $comment))."_";
		}
		$skip_frec=0;

		$final_sql_block="";

		foreach ($param_fields as $sql_vars) {
			$skip_frec++;

			if($skip_frec>1)
			{
				if($post_var_sess_get=='post'){
					$final_sql_block.='$'.$sql_vars.'=mmres($_POST["txt_'.$sql_vars.'"]);'.PHP_EOL;
				}

				if($post_var_sess_get=='var'){
					$final_sql_block.='$'.$sql_vars.'=mmres($'.$sql_vars.');'.PHP_EOL;
				}

				if($post_var_sess_get=='sess'){
					$final_sql_block.='$'.$sql_vars.'=mmres($_SESSION["'.$sql_vars.'"]);'.PHP_EOL;
				}

				if($post_var_sess_get=='get'){
					$final_sql_block.='$'.$sql_vars.'=mmres($_GET["'.$sql_vars.'"]);'.PHP_EOL;
				}
			}

		}

		
		$write_here_str=$write_here;

		if($write_here=='')
		{
			$write_here_str='//--<{ncgh}/>';
		}

	if($create_new_file=='yes'){

	$php_start_tag="<?php ";
	$php_end_tag="?>";

	}else{

	$php_start_tag="";
	$php_end_tag="";

	}


$sql_param_str= '//------- begin '.$comment.' --> '.PHP_EOL.$final_sql_block.'//===-- End '.$comment.' -->'.PHP_EOL.'//--<{ncgh}/>';

if($file_path!='')
{
	if($create_new_file=='yes'){


		bend_write_to_file($file_path, $sql_param_str);
	
	}else{

		bend_replace_file_section($file_path, $write_here_str, $sql_param_str);


	}

	$final_file_content=($sql_param_str);

}else{
  $final_file_content=$sql_param_str;
}


return $final_file_content;


}


function mosy_sql_arr($file_path, $param_fields, $comment, $create_new_file, $write_here, $post_var_sess_get)
{

	global $sql_param_data;

		$var_prefix='';

		if($comment!=""){
			$var_prefix=strtolower(str_replace(" ", '_', $comment))."_";
		}
		$skip_frec=0;

		$final_sql_block=[];

		foreach ($param_fields as $sql_vars) {
			$skip_frec++;
			if($skip_frec==1)
            {
              	$final_sql_block[]='"'.$sql_vars.'"=>"NULL"';

            }
			if($skip_frec>1)
			{
				if($post_var_sess_get=='post'){
					$final_sql_block[]='"'.$sql_vars.'"=>mmres($_POST["txt_'.$sql_vars.'"])';
				}
				if($post_var_sess_get=='?'){
					$final_sql_block[]='"'.$sql_vars.'"=>"?"';
				}
				if($post_var_sess_get=='var'){
					$final_sql_block[]='"'.$sql_vars.'"=>mmres($'.$sql_vars.')';
				}

				if($post_var_sess_get=='sess'){
					$final_sql_block[]='"'.$sql_vars.'"=>mmres($_SESSION["'.$sql_vars.'"])';
				}

				if($post_var_sess_get=='get'){
					$final_sql_block[]='"'.$sql_vars.'"=>mmres($_GET["'.$sql_vars.'"])';
				}
			}

		}
		
		$write_here_str=$write_here;

		if($write_here=='')
		{
			$write_here_str='//--<{ncgh}/>';
		}

	if($create_new_file=='yes'){

	$php_start_tag="<?php ";
	$php_end_tag="?>";

	}else{

	$php_start_tag="";
	$php_end_tag="";

	}
  $final_sql_block_strimp=implode(",".PHP_EOL, $final_sql_block);

$final_sql_block_str='$'.$var_prefix.'=array('.PHP_EOL.PHP_EOL.rtrim($final_sql_block_strimp, ",").PHP_EOL.PHP_EOL.');';
  
$sql_param_str= '//------- begin '.$comment.' --> '.PHP_EOL.$final_sql_block_str.PHP_EOL.'//===-- End '.$comment.' -->'.PHP_EOL.$write_here;

if($file_path!='')
{
	if($create_new_file=='yes'){


		bend_write_to_file($file_path, $sql_param_str);
	
	}else{

		bend_replace_file_section($file_path, $write_here_str, $sql_param_str);


	}

	$final_file_content=($sql_param_str);

}else{
  $final_file_content=$sql_param_str;
}


return $final_file_content;


}
//=========== create update insert string =================


function bend_select_str($db, $tbl, $where_str, $file_path, $create_new_file, $orderby_col, $ordertype, $comment)
{

if($where_str!='')
{
$where_clause=' WHERE '.$where_str;
}else{
$where_clause='';
}

	//===== limit record value

$gen_select_query='$'.$tbl.'_sqlstring="SELECT COUNT(*) FROM `$'.$db.'`.`'.$tbl.'`'.$where_clause.'";

//===== Pagination function

$'.$tbl.'_pagination= list_record_per_page($mysqliconn, $'.$tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$tbl.'_firstproduct=$'.$tbl.'_pagination["0"];

$'.$tbl.'_pgcount=$'.$tbl.'_pagination["1"];';


$gen_select_query.=PHP_EOL.PHP_EOL.'//=== start '.$tbl.' select  '.$comment.' list  '.PHP_EOL.PHP_EOL.'$'.$tbl.'_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$db.'`.`'.$tbl.'` '.$where_clause.' ORDER BY `'.$orderby_col.'` '.$ordertype.' LIMIT $'.$tbl.'_firstproduct, $datalimit" );

//$'.$tbl.'_list_res=mysqli_fetch_array($'.$tbl.'_list_query);'.PHP_EOL.PHP_EOL.'//=== End '.$tbl.' select  '.$comment.' list'.PHP_EOL.'//--<{ncgh}/>';

	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $gen_select_query);
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $gen_select_query);


		}


	}
}



function bend_row_select_str($db, $tbl, $where_str, $file_path, $create_new_file, $orderby_col, $ordertype, $comment, $write_here)
{

		$write_here_str=$write_here;

		if($write_here=='')
		{
			$write_here_str='//--<{ncgh}/>';
		}


if($where_str!='')
{
$where_clause=' WHERE '.$where_str;
}else{
$where_clause='WHERE `'.$orderby_col.'`=\'$'.$tbl.'_uptoken\'';
}

$params_name=str_replace(" ", "_", strtolower($comment));

$gen_select_query=PHP_EOL.PHP_EOL.'//=== start '.$tbl.' select '.$comment.' query '.PHP_EOL.PHP_EOL.'$'.$params_name."_".$tbl.'_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$db.'`.`'.$tbl.'` '.$where_clause.' ORDER BY `'.$orderby_col.'` '.$ordertype.' LIMIT 1" );

$'.$tbl.'_node=mysqli_fetch_array($'.$params_name."_".$tbl.'_query);'.PHP_EOL.PHP_EOL.'//=== End '.$tbl.' select '.$comment.'  query'.PHP_EOL.'//--<{ncgh}/>';

	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $gen_select_query);
		
		}else{

			bend_replace_file_section($file_path, $write_here_str, $gen_select_query);


		}


	}

	return $gen_select_query;
}


function create_login($dbname, $tbl, $primkey, $user_email, $username, $password, $comment, $gotourl, $session_name, $create_new_file, $file_path)
{

$clean_comment=str_replace(" ", "_", $comment);

$var_login_str ='

//=== start '.$comment.' Login Script query 

if(isset($_POST["btn_login"]))
{
$password=mysqli_real_escape_string($mysqliconn, $_POST["txt_password"]);
$user_email=mysqli_real_escape_string($mysqliconn, $_POST["txt_username"]);

$'.$clean_comment.'_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$dbname.'`.`'.$tbl.'`  WHERE `'.$user_email.'`=\'$user_email\' AND `'.$password.'`=\'$password\'");

$'.$clean_comment.'_r=mysqli_fetch_array($'.$clean_comment.'_query);

if(!empty($'.$clean_comment.'_r[\''.$user_email.'\']) && !empty($'.$clean_comment.'_r[\''.$password.'\']))
{

$_SESSION[\''.$session_name.'\']=TRUE;
$_SESSION[\''.$session_name.'_'.$user_email.'\']=$'.$clean_comment.'_r[\''.$user_email.'\'];
$_SESSION[\''.$session_name.'_'.$username.'\']=$'.$clean_comment.'_r[\''.$username.'\'];

if(isset($_GET[\'ref_url_go_to\'])){

	$ref_url_go_to=base64_decode($_GET[\'ref_url_go_to\']);

	header("location:".$ref_url_go_to."");


}else{

	header("location:'.$gotourl.'");

}

}else{

	echo magic_message("Wrong password or user name please try again");
}

}
//=== End '.$comment.' Login Script query

//=========request password
if(isset($_POST[\'requestnewpass_btn\'])){

$membusername=$_POST[\'email_user\'];

$cpsreset_query1=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tbl.'`  WHERE '.$user_email.'=\'$membusername\'");

$cpsreset_res1=mysqli_fetch_array($cpsreset_query1);

$cpsreset_query=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tbl.'`   WHERE '.$user_email.'=\'$membusername\'");

$cpsreset_res=mysqli_num_rows($cpsreset_query);
if($cpsreset_res==1){

$showname="ClearPhrases Reset Pssword"; 
$tel="0710766390"; 

$from_email="clearphrases@gmail.com";

$to_email=$_POST[\'email_user\'];
$client_names=$cpsreset_res1[\''.$username.'\'];


$path1="http://".$_SERVER[\'HTTP_HOST\'].$_SERVER[\'PHP_SELF\'];
//echo $path1;

$msgtosend=\'Hello You requested a password request. Follow this link to create a new password.<br /><br />
<a href="\'.$path1.\'?reset_token=\'.base64_encode($cpsreset_res1[\''.$primkey.'\']).\'">Reset Password</a><br /><br />\';

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

echo magic_message("We have sent you a reset password email. Follow that link to reset your password");




}else{
echo magic_message("Sorry that email does not exist. Please Try Again");
}
}
//===================reset password request

////===========reset pass=============
if(isset($_GET[\'reset_token\'])){

$memberkey=base64_decode($_GET[\'reset_token\']);


$cpsresetoken_query=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tbl.'`  WHERE '.$primkey.'=\'$memberkey\'");

$cpsresetoken_res=mysqli_num_rows($cpsresetoken_query);


}
if(isset($_POST[\'changepass_btn\'])){
$memberkey=base64_decode($_GET[\'reset_token\']);

$cpsresetoken_query1=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tbl.'`  WHERE '.$primkey.'=\'$memberkey\'");

$cpsresetoken_res1=mysqli_fetch_array($cpsresetoken_query1);

$foundresetmail=$cpsresetoken_res1[\''.$user_email.'\'];
$resetpass1=mysqli_real_escape_string($mysqliconn,$_POST[\'newpass_user\']);
$resetpass2=mysqli_real_escape_string($mysqliconn,$_POST[\'confirmnewpass_user\']);
if($resetpass1!=$resetpass2){

echo magic_message("Password Do Not match!!");
}else{

mysqli_query($mysqliconn,"UPDATE `$'.$dbname.'`.`'.$tbl.'` SET '.$password.'=\'$resetpass1\' WHERE '.$user_email.'=\'$foundresetmail\' AND '.$primkey.'=\'$memberkey\'");

echo magic_message("Password reset succesfully. Login afresh to continue.");
}
}
//===========reset pass============= 
//--<{ncgh}/>';


	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, "<?php ".PHP_EOL.$var_login_str.PHP_EOL."?>");
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $var_login_str);


		}


	}

return $var_login_str;


}


function app_auth_script($dbname, $tbl, $primkey, $user_email, $username, $password, $comment, $gotourl, $session_name, $create_new_file, $file_path, $user_id)
{

$clean_comment=str_replace(" ", "_", $comment);

$var_login_str ='

//=== start '.$comment.' Login Script query 

if(isset($_POST["btn_login"]))
{
$password=mysqli_real_escape_string($mysqliconn, $_POST["txt_password"]);
$user_email=mysqli_real_escape_string($mysqliconn, $_POST["txt_username"]);

$'.$clean_comment.'_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$dbname.'`.`'.$tbl.'`  WHERE `'.$user_email.'`=\'$user_email\' AND `'.$password.'`=\'$password\'");

$'.$clean_comment.'_r=mysqli_fetch_array($'.$clean_comment.'_query);

if(!empty($'.$clean_comment.'_r[\''.$user_email.'\']) && !empty($'.$clean_comment.'_r[\''.$password.'\']))
{

$_SESSION[\''.$session_name.'\']=TRUE;
$_SESSION[\''.$session_name.'_'.$user_email.'\']=$'.$clean_comment.'_r[\''.$user_email.'\'];
$_SESSION[\''.$session_name.'_'.$username.'\']=$'.$clean_comment.'_r[\''.$username.'\'];
$_SESSION[\''.$session_name.'_'.$user_id.'\']=$'.$clean_comment.'_r[\''.$user_id.'\'];

if(isset($_GET[\'ref_url_go_to\'])){

	$ref_url_go_to=base64_decode($_GET[\'ref_url_go_to\']);

	header("location:".$ref_url_go_to."");


}else{

	header("location:'.$gotourl.'");

}

}else{

	echo magic_message("Wrong password or user name please try again");
}

}
//=== End '.$comment.' Login Script query

//=========request password
if(isset($_POST[\'requestnewpass_btn\'])){

$membusername=$_POST[\'email_user\'];

$cpsreset_query1=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tbl.'`  WHERE '.$user_email.'=\'$membusername\'");

$cpsreset_res1=mysqli_fetch_array($cpsreset_query1);

$cpsreset_query=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tbl.'`   WHERE '.$user_email.'=\'$membusername\'");

$cpsreset_res=mysqli_num_rows($cpsreset_query);
if($cpsreset_res==1){

$showname="ClearPhrases Reset Pssword"; 
$tel="0710766390"; 

$from_email="clearphrases@gmail.com";

$to_email=$_POST[\'email_user\'];
$client_names=$cpsreset_res1[\''.$username.'\'];


$path1="http://".$_SERVER[\'HTTP_HOST\'].$_SERVER[\'PHP_SELF\'];
//echo $path1;

$msgtosend=\'Hello You requested a password request. Follow this link to create a new password.<br /><br />
<a href="\'.$path1.\'?reset_token=\'.base64_encode($cpsreset_res1[\''.$primkey.'\']).\'">Reset Password</a><br /><br />\';

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

echo magic_message("We have sent you a reset password email. Follow that link to reset your password");




}else{
echo magic_message("Sorry that email does not exist. Please Try Again");
}
}
//===================reset password request

////===========reset pass=============
if(isset($_GET[\'reset_token\'])){

$memberkey=base64_decode($_GET[\'reset_token\']);


$cpsresetoken_query=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tbl.'`  WHERE '.$primkey.'=\'$memberkey\'");

$cpsresetoken_res=mysqli_num_rows($cpsresetoken_query);


}
if(isset($_POST[\'changepass_btn\'])){
$memberkey=base64_decode($_GET[\'reset_token\']);

$cpsresetoken_query1=mysqli_query($mysqliconn,"SELECT * FROM `$'.$dbname.'`.`'.$tbl.'`  WHERE '.$primkey.'=\'$memberkey\'");

$cpsresetoken_res1=mysqli_fetch_array($cpsresetoken_query1);

$foundresetmail=$cpsresetoken_res1[\''.$user_email.'\'];
$resetpass1=mysqli_real_escape_string($mysqliconn,$_POST[\'newpass_user\']);
$resetpass2=mysqli_real_escape_string($mysqliconn,$_POST[\'confirmnewpass_user\']);
if($resetpass1!=$resetpass2){

echo magic_message("Password Do Not match!!");
}else{

mysqli_query($mysqliconn,"UPDATE `$'.$dbname.'`.`'.$tbl.'` SET '.$password.'=\'$resetpass1\' WHERE '.$user_email.'=\'$foundresetmail\' AND '.$primkey.'=\'$memberkey\'");

echo magic_message("Password reset succesfully. Login afresh to continue.");
}
}
//===========reset pass============= 
//--<{ncgh}/>';


	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, "<?php ".PHP_EOL.$var_login_str.PHP_EOL."?>");
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $var_login_str);


		}


	}

return $var_login_str;


}

function full_bend_select_str($db, $tbl, $where_str, $param_fields, $file_path, $create_new_file, $orderby_col, $ordertype, $comment)
{

  $curr_tbl=$tbl;
  $dbname=$db;
  $tbl_primkey=$orderby_col;
  
if($where_str!='')
{
$additional_where_clause=' AND  '.$where_str;
}else{
$additional_where_clause='';
}

if($where_str!='')
{
$where_clause=' WHERE  '.$where_str;
}else{
$where_clause='';
}

	foreach ($param_fields as $fields) 
	{


			$magic_where_str[]='`'.$fields.'` LIKE \'%".$q'.$tbl.'."%\'';

	}

	$prepared_where_str=implode(" OR  ", $magic_where_str);

	$where_like_str=" WHERE (".$prepared_where_str.")";


$params_name=str_replace(" ", "_", strtolower($comment));

$gen_select_query=PHP_EOL.PHP_EOL.'

if(isset($_POST["q'.$tbl.'_btn"])){


$q'.$tbl.'_str=base64_encode($_POST["txt_'.$tbl.'"]);


header(\'location:./\'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).\'?q'.$tbl.'=\'.($q'.$tbl.'_str).\'\');

}

if(isset($_GET["q'.$tbl.'"])){


$q'.$tbl.'=mysqli_real_escape_string($mysqliconn, base64_decode($_GET["q'.$tbl.'"]));



//===== limit record value

$'.$tbl.'_sqlstring="SELECT COUNT(*) FROM `$'.$db.'`.`'.$tbl.'`'.$where_like_str.$additional_where_clause.'";

//===== Pagination function

$'.$tbl.'_pagination= list_record_per_page($mysqliconn, $'.$tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$tbl.'_firstproduct=$'.$tbl.'_pagination["0"];

$'.$tbl.'_pgcount=$'.$tbl.'_pagination["1"];';


$gen_select_query.=PHP_EOL.PHP_EOL.'//=== start '.$tbl.' select  '.$comment.' list  '.PHP_EOL.PHP_EOL.'$'.$tbl.'_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$db.'`.`'.$tbl.'` '.$where_like_str.$additional_where_clause.' ORDER BY `'.$orderby_col.'` '.$ordertype.' LIMIT $'.$tbl.'_firstproduct, $datalimit" );

'.PHP_EOL.PHP_EOL.'//=== End '.$tbl.' select  '.$comment.' list'.PHP_EOL.';

}elseif(isset($_GET["'.$curr_tbl.'_mosyfilter"])){

  $'.$curr_tbl.'_passed_filter=(base64_decode($_GET["'.$curr_tbl.'_mosyfilter"]));
//===== limit record value

  //echo magic_message($'.$curr_tbl.'_passed_filter);

$'.$curr_tbl.'_sqlstring="SELECT COUNT(*) FROM `$'.$dbname.'`.`'.$curr_tbl.'` WHERE ".$'.$curr_tbl.'_passed_filter."";

//===== Pagination function

$'.$curr_tbl.'_pagination= list_record_per_page($mysqliconn, $'.$curr_tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$curr_tbl.'_firstproduct=$'.$curr_tbl.'_pagination["0"];

$'.$curr_tbl.'_pgcount=$'.$curr_tbl.'_pagination["1"];

//=== start '.$curr_tbl.' select  Like Query String '.$curr_tbl.' list  

$'.$curr_tbl.'_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$dbname.'`.`'.$curr_tbl.'`  WHERE ".$'.$curr_tbl.'_passed_filter."  ORDER BY `'.$tbl_primkey.'` DESC LIMIT $'.$curr_tbl.'_firstproduct, $datalimit" );

//$'.$curr_tbl.'_list_res=mysqli_fetch_array($'.$curr_tbl.'_list_query);

//=== End '.$curr_tbl.' select  Like Query String '.$curr_tbl.' list

}else{

//===== limit record value

$'.$tbl.'_sqlstring="SELECT COUNT(*) FROM `$'.$db.'`.`'.$tbl.'`'.$where_clause.'";

//===== Pagination function

$'.$tbl.'_pagination= list_record_per_page($mysqliconn, $'.$tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$tbl.'_firstproduct=$'.$tbl.'_pagination["0"];

$'.$tbl.'_pgcount=$'.$tbl.'_pagination["1"];';


$gen_select_query.=PHP_EOL.PHP_EOL.'//=== start '.$tbl.' select  '.$comment.' list  '.PHP_EOL.PHP_EOL.'$'.$tbl.'_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$db.'`.`'.$tbl.'` '.$where_clause.' ORDER BY `'.$orderby_col.'` '.$ordertype.' LIMIT $'.$tbl.'_firstproduct, $datalimit" );

//$'.$tbl.'_list_res=mysqli_fetch_array($'.$tbl.'_list_query);'.PHP_EOL.PHP_EOL.'//=== End '.$tbl.' select  '.$comment.' list'.PHP_EOL.'
}

//--<{ncgh}/>';



	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $gen_select_query);
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $gen_select_query);


		}


	}
  
  return $gen_select_query;
}



function custom_full_bend_select_str ($db, $tbl, $where_str, $param_fields, $file_path, $create_new_file, $orderby_col, $ordertype, $comment)
{

 $json_inputs_array = json_decode($param_fields, true);

  $curr_tbl=$tbl;
  $dbname=$db;
  $tbl_primkey=$orderby_col;
  
if($where_str!='')
{
$additional_where_clause=' AND  '.$where_str;
}else{
$additional_where_clause='';
}

if($where_str!='')
{
$where_clause=' WHERE  '.$where_str;
}else{
$where_clause='';
}

	foreach ($json_inputs_array as $fields => $value) 
	{


			$magic_where_str[]='`'.$fields.'` LIKE \'%".$q'.$tbl.'."%\'';

	}

	$prepared_where_str=implode(" OR  ", $magic_where_str);

	$where_like_str=" WHERE (".$prepared_where_str.")";


$params_name=str_replace(" ", "_", strtolower($comment));

$gen_select_query=PHP_EOL.PHP_EOL.'

if(isset($_POST["q'.$tbl.'_btn"])){


$q'.$tbl.'_str=base64_encode($_POST["txt_'.$tbl.'"]);


header(\'location:./\'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).\'?q'.$tbl.'=\'.($q'.$tbl.'_str).\'\');

}

if(isset($_GET["q'.$tbl.'"])){


$q'.$tbl.'=mysqli_real_escape_string($mysqliconn, base64_decode($_GET["q'.$tbl.'"]));



//===== limit record value

$'.$tbl.'_sqlstring="SELECT COUNT(*) FROM `$'.$db.'`.`'.$tbl.'`'.$where_like_str.$additional_where_clause.'";

//===== Pagination function

$'.$tbl.'_pagination= list_record_per_page($mysqliconn, $'.$tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$tbl.'_firstproduct=$'.$tbl.'_pagination["0"];

$'.$tbl.'_pgcount=$'.$tbl.'_pagination["1"];';


$gen_select_query.=PHP_EOL.PHP_EOL.'//=== start '.$tbl.' select  '.$comment.' list  '.PHP_EOL.PHP_EOL.'$'.$tbl.'_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$db.'`.`'.$tbl.'` '.$where_like_str.$additional_where_clause.' ORDER BY `'.$orderby_col.'` '.$ordertype.' LIMIT $'.$tbl.'_firstproduct, $datalimit" );

'.PHP_EOL.PHP_EOL.'//=== End '.$tbl.' select  '.$comment.' list'.PHP_EOL.';

}elseif(isset($_GET["'.$curr_tbl.'_mosyfilter"])){

  $'.$curr_tbl.'_passed_filter=(base64_decode($_GET["'.$curr_tbl.'_mosyfilter"]));
//===== limit record value

  //echo magic_message($'.$curr_tbl.'_passed_filter);

$'.$curr_tbl.'_sqlstring="SELECT COUNT(*) FROM `$'.$dbname.'`.`'.$curr_tbl.'` WHERE ".$'.$curr_tbl.'_passed_filter."";

//===== Pagination function

$'.$curr_tbl.'_pagination= list_record_per_page($mysqliconn, $'.$curr_tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$curr_tbl.'_firstproduct=$'.$curr_tbl.'_pagination["0"];

$'.$curr_tbl.'_pgcount=$'.$curr_tbl.'_pagination["1"];

//=== start '.$curr_tbl.' select  Like Query String '.$curr_tbl.' list  

$'.$curr_tbl.'_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$dbname.'`.`'.$curr_tbl.'`  WHERE ".$'.$curr_tbl.'_passed_filter."  ORDER BY `'.$tbl_primkey.'` DESC LIMIT $'.$curr_tbl.'_firstproduct, $datalimit" );

//$'.$curr_tbl.'_list_res=mysqli_fetch_array($'.$curr_tbl.'_list_query);

//=== End '.$curr_tbl.' select  Like Query String '.$curr_tbl.' list

}else{

//===== limit record value

$'.$tbl.'_sqlstring="SELECT COUNT(*) FROM `$'.$db.'`.`'.$tbl.'`'.$where_clause.'";

//===== Pagination function

$'.$tbl.'_pagination= list_record_per_page($mysqliconn, $'.$tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$tbl.'_firstproduct=$'.$tbl.'_pagination["0"];

$'.$tbl.'_pgcount=$'.$tbl.'_pagination["1"];';


$gen_select_query.=PHP_EOL.PHP_EOL.'//=== start '.$tbl.' select  '.$comment.' list  '.PHP_EOL.PHP_EOL.'$'.$tbl.'_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$db.'`.`'.$tbl.'` '.$where_clause.' ORDER BY `'.$orderby_col.'` '.$ordertype.' LIMIT $'.$tbl.'_firstproduct, $datalimit" );

//$'.$tbl.'_list_res=mysqli_fetch_array($'.$tbl.'_list_query);'.PHP_EOL.PHP_EOL.'//=== End '.$tbl.' select  '.$comment.' list'.PHP_EOL.'
}

//--<{ncgh}/>';



	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $gen_select_query);
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $gen_select_query);


		}


	}
  
  return $gen_select_query;
}



function sql_select_strings($db, $tbl, $where_str, $param_fields, $file_path, $create_new_file, $orderby_col, $ordertype, $comment, $sel_type_like_single)
{

if($where_str!='')
{
$additional_where_clause=' AND  '.$where_str;
}else{
$additional_where_clause='';
}

if($where_str!='')
{
$where_clause=' WHERE  '.$where_str;
}else{
$where_clause='';
}

	foreach ($param_fields as $fields) 
	{


			$magic_where_str[]='`'.$fields.'` LIKE \'%".$q'.$tbl.'."%\'';

	}

	$prepared_where_str=implode(" OR  ", $magic_where_str);

	$where_like_str=" WHERE (".$prepared_where_str.")";


$params_name=str_replace(" ", "_", strtolower($comment));

$like_sel_str=PHP_EOL.PHP_EOL.'//=== start '.$tbl.' select  '.$comment.' list  '.PHP_EOL.' $ajax_limit=10;'.PHP_EOL.'$'.$tbl.'_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$db.'`.`'.$tbl.'` '.$where_like_str.$additional_where_clause.' ORDER BY `'.$orderby_col.'` '.$ordertype.' LIMIT $ajax_limit" );

'.PHP_EOL.PHP_EOL.'//=== End '.$tbl.' select  '.$comment.' list'.PHP_EOL;

$select_str_no_like=PHP_EOL.PHP_EOL.'//=== start '.$tbl.' select  '.$comment.' list  '.PHP_EOL.' $ajax_limit=10; '.PHP_EOL.'$'.$tbl.'_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$db.'`.`'.$tbl.'` '.$where_clause.' ORDER BY `'.$orderby_col.'` '.$ordertype.' LIMIT $ajax_limit" );

$'.$tbl.'_list_res=mysqli_fetch_array($'.$tbl.'_list_query);'.PHP_EOL.PHP_EOL.'//=== End '.$tbl.' select  '.$comment.' list'.PHP_EOL;

$gen_select_query=PHP_EOL.PHP_EOL.'

if(isset($_POST["q'.$tbl.'_btn"])){


$q'.$tbl.'_str=base64_encode($_POST["txt_'.$tbl.'"]);


header(\'location:./\'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).\'?q'.$tbl.'=\'.($q'.$tbl.'_str).\'\');

}

if(isset($_GET["q'.$tbl.'"])){


$q'.$tbl.'=mysqli_real_escape_string($mysqliconn, base64_decode($_GET["q'.$tbl.'"]));



//===== limit record value

$'.$tbl.'_sqlstring="SELECT COUNT(*) FROM `$'.$db.'`.`'.$tbl.'`'.$where_like_str.$additional_where_clause.'";

//===== Pagination function

$'.$tbl.'_pagination= list_record_per_page($mysqliconn, $'.$tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$tbl.'_firstproduct=$'.$tbl.'_pagination["0"];

$'.$tbl.'_pgcount=$'.$tbl.'_pagination["1"];';


$gen_select_query.=$like_sel_str.'

}else{

//===== limit record value

$'.$tbl.'_sqlstring="SELECT COUNT(*) FROM `$'.$db.'`.`'.$tbl.'`'.$where_clause.'";

//===== Pagination function

$'.$tbl.'_pagination= list_record_per_page($mysqliconn, $'.$tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$tbl.'_firstproduct=$'.$tbl.'_pagination["0"];

$'.$tbl.'_pgcount=$'.$tbl.'_pagination["1"];';


$gen_select_query.=$select_str_no_like.'
}

//--<{ncgh}/>';
$final_sel_str=$gen_select_query;

if($sel_type_like_single=='like')
{
	$final_sel_str=$like_sel_str;
}

if($sel_type_like_single=='single')
{
	$final_sel_str=$select_str_no_like;
}




	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $gen_select_query);
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $gen_select_query);


		}


	}
  
  return $final_sel_str;
}


function create_leftjoin_str($tablemain, $tablechild, $on_str_child_main, $main_cols_array, $childcols_array, $file_path, $create_new_file, $orderby_col, $ordertype, $where_str)
{
global $single_db;


$comment='LEFT JOIN Query for '.$tablemain." as main table and child ".$tablechild;
$tbl=$tablemain;
$db=$single_db;

if($where_str!='')
{
$additional_where_clause=' AND  '.$where_str;
}else{
$additional_where_clause='';
}

if($where_str!='')
{
$where_clause=' WHERE  '.$where_str;
}else{
$where_clause='';
}

///========== start select columns
	foreach ($main_cols_array as $fields) 
	{


			$magic_fields_str_main[]=''.$tablemain.'.'.$fields.'';

	}

	$prepared_fields_str_main=implode(" ,  ", $magic_fields_str_main);

	$fields_str_main=" , ".$prepared_fields_str_main."";

	foreach ($childcols_array as $fields) 
	{


			$magic_fields_str_child[]=''.$tablechild.'.'.$fields.'';

	}

	$prepared_fields_str_child=implode(" ,  ", $magic_fields_str_child);

	$fields_str_child=" ".$prepared_fields_str_child."";

///========== end select columns

	foreach ($main_cols_array as $fields) 
	{


			$magic_where_str_main[]=''.$tablemain.'.'.$fields.' LIKE \'%".$q'.$tablemain.'."%\'';

	}

	$prepared_where_str_main=implode(" OR  ", $magic_where_str_main);

	$where_like_str_main=" OR ".$prepared_where_str_main.")";

	foreach ($childcols_array as $fields) 
	{

		$magic_where_str_child[]=''.$tablechild.'.'.$fields.' LIKE \'%".$q'.$tablemain.'."%\'';

	}

	$prepared_where_str_child=implode(" OR  ", $magic_where_str_child);

	$where_like_str_child=" WHERE (".$prepared_where_str_child." ";


	
$params_name=str_replace(" ", "_", strtolower($comment));

$gen_select_query=PHP_EOL.PHP_EOL.'



if(isset($_GET["q'.$tbl.'"])){


$q'.$tbl.'=mysqli_real_escape_string($mysqliconn, base64_decode($_GET["q'.$tbl.'"]));


//===== limit record value

$'.$tbl.'_sqlstring="SELECT COUNT(*) FROM '.$tablemain.' LEFT JOIN  '.$tablechild.' ON '.$on_str_child_main.' '.$where_like_str_child.$where_like_str_main.$additional_where_clause.'";

//===== Pagination function

$'.$tbl.'_pagination= list_record_per_page($mysqliconn, $'.$tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$tbl.'_firstproduct=$'.$tbl.'_pagination["0"];

$'.$tbl.'_pgcount=$'.$tbl.'_pagination["1"];';


$gen_select_query.=PHP_EOL.PHP_EOL.'//=== start '.$tbl.' select  '.$comment.' list  '.PHP_EOL.PHP_EOL.'$'.$tbl.'_list_query=mysqli_query($mysqliconn, "SELECT '.$fields_str_child.$fields_str_main.' FROM  '.$tablemain.' LEFT JOIN  '.$tablechild.' ON '.$on_str_child_main.'  '.$where_like_str_child.$where_like_str_main.$additional_where_clause.' ORDER BY '.$tbl.'.'.$orderby_col.' '.$ordertype.' LIMIT $'.$tbl.'_firstproduct, $datalimit" );
'.PHP_EOL.PHP_EOL.'//=== End '.$tbl.' select  '.$comment.' list'.PHP_EOL.'

}

//--<{ncgh}/>';



	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $gen_select_query);
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $gen_select_query);


		}


	}
  return $gen_select_query;
}


function gen_where_like($input_where_json, $file_path, $create_new_file)
{

$json_where_array = json_decode($input_where_json, true);


	$magic_where_str=array();

	foreach ($json_where_array as $key => $value) 
	{


			$magic_where_str[]="`".$key."` LIKE '%\".".$json_where_array[$key].".\"%'";

	}

	$prepared_where_str=implode(" OR  ", $magic_where_str).PHP_EOL.'//--<{ncgh}/>';

	$where_str="(".$prepared_where_str.")";

	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $prepared_where_str);
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $prepared_where_str);


		}


	}


}


function ajax_post_str($post_url, $json_post_params, $file_path, $create_new_file, $write_here)
{
	
	$json_post_params_decoded = json_decode($json_post_params, true);

		$write_here_str=$write_here;

		if($write_here=='')
		{
			$write_here_str='//--<{ncgh}/>';
		}

	$json_post_params_str=array();

	foreach ($json_post_params_decoded as $key => $value) 
	{


			$json_post_params_str[]="'".$key."': '".$json_post_params_decoded[$key]."'";

	}


	$post_params_array=implode(", ", $json_post_params_str);

	$ajaxstr='$.ajax({ 
      url: \''.$post_url.'\',
      type: "POST",
      data: {
      		'.$post_params_array.'
      },

      success: function (data) {


      }

  });';

	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $ajaxstr);
		
		}else{

			bend_replace_file_section($file_path, $write_here_str, $ajaxstr);


		}


	}


}



function create_del_str($file_path, $comment, $dbname, $tbl, $where_str, $primkey, $create_new_file)
{


if($where_str!='')
{
$where_clause=' WHERE '.$where_str;
}else{
$where_clause='WHERE `'.$primkey.'`=\'$'.$tbl.'_uptoken\'';
}



$del_sql_str='
//== Start '.$comment.' 

if(isset($_GET["delete'.$tbl.'"]))
{

//======confirm pop up 
$current_file_url=magic_basename(magic_current_url());
  
$after_delete=base64_encode($current_file_url);
  
if(isset($_GET[\'after_delete\']))
{
  $after_delete=$_GET[\'after_delete\'];
}
  

$conf_del_'.$tbl.'_btn=magic_button_link("./".$current_file_url."?'.$tbl.'_uptoken=".$_GET["'.$tbl.'_uptoken"]."&conf_delete'.$tbl.'&after_delete=".$after_delete, "Yes", \'style="margin-right:10px;"\');

$cancel_del_'.$tbl.'_btn=magic_button_link("./".$current_file_url."?'.$tbl.'_uptoken=".$_GET["'.$tbl.'_uptoken"], "No", "");

echo magic_screen("Delete this record?<hr>".$conf_del_'.$tbl.'_btn." ".$cancel_del_'.$tbl.'_btn."");

}';

$del_sql_str.='

//==Delete Record 

if(isset($_GET["conf_delete'.$tbl.'"]))
{

//====== start back to list file after delete 
  
$current_file_url=magic_basename(magic_current_url());
  
$after_delete=($current_file_url);
  
if(isset($_GET[\'after_delete\']))
{
  $after_delete=magic_basename(base64_decode($_GET[\'after_delete\']));
}
  //====== End  back to list file after delete 

mysqli_query($mysqliconn, "DELETE FROM `$'.$dbname.'`.`'.$tbl.'` '.$where_clause.'");

//==add your redirect here 

header("location:./".$after_delete."?table_alert=Record Deleted Succesfully");
}

//== End '.$comment.'

//--<{ncgh}/>';

	if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, ($del_sql_str));
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', ($del_sql_str));


		}


	}

	return $del_sql_str;


}



function create_conn_str($file_path, $host, $username, $password, $dbname, $create_new_file)
{
$conn_file_str='<?php
'.PHP_EOL.'if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set("Africa/Nairobi");

$host="'.$host.'"; // Host name 
$username="'.$username.'"; // Mysql username 
$password="'.$password.'"; // Mysql password

$db="'.$dbname.'";
$'.$dbname.'="'.$dbname.'";

$mysqliconn=mysqli_connect("$host", "$username", "$password") or die("cannot connect"); 

mysqli_select_db($mysqliconn, $db);

$single_db=$db;
$single_conn=$mysqliconn;


$datalimit=15;

if(isset($_SESSION["filelim"])){
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



?>';

if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $conn_file_str);
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $conn_file_str);


		}


	}


return $conn_file_str;
}


function create_table($mysqliconn, $dbname, $tbl, $col_script)
{



if(!$mysqliconn)
{
echo "mysqliconn Not defined. Please call conection to your database";
}

$scritpre="CREATE TABLE IF NOT EXISTS  `$dbname`.`$tbl` (";
$finscript=$scritpre.$col_script.")";
// Make my_db the current database
$db_selected = mysqli_select_db($mysqliconn, $dbname);

if (!$db_selected) {
  // If we couldn't, then it either doesn't exist, or we can't see it.

  if (mysqli_query($mysqliconn, "CREATE DATABASE $dbname")) {
      //echo "Database $dbtocreate created successfully\n";
  }
}
	 $mysqlcreatetbl= mysqli_query($mysqliconn, $finscript);
if($mysqlcreatetbl){?>
	 
	 <div class="alertmsgbox_placard" id="placard" style="text-align:center; color:#009966;" onclick="closebox();">
			<?php  echo "Execution Successful!!  :)<hr /> <em>".$finscript."</em>";?>
			<hr>
	 </div>
	 <?php }else{?>
	 
	 <div class="alertmsgbox_placard" id="placard" style="text-align:center; color:#FF0000;" onclick="closebox();">
			<?php  echo "Failed to Execute :(<hr /> <em>".$finscript."<h1>Reason : ".mysqli_error($mysqliconn)."</h1></em>";?>
<h2>Create table sample</h2>
			<hr>
<?php echo nl2br('$col_script_sample="
`primkey` int(255) PRIMARY KEY AUTO_INCREMENT,
`columnname` varchar(500) NOT NULL, 
`columnname2` varchar(500) NOT NULL";');?>
	 </div>
	 <?php }
}


function alter_table($mysqliconn, $dbname, $tbl, $col_script)
{

if(!$mysqliconn)
{
echo "mysqliconn Not defined. Please call conection to your database";
}

$scritpre="ALTER TABLE `$dbname`.`$tbl` ";
$finscript=$scritpre.$col_script."";

// Make my_db the current database

$mysqlcreatetbl= mysqli_query($mysqliconn, $finscript);
if($mysqlcreatetbl){?>
	 
	 <div class="alertmsgbox_placard" id="placard" style="text-align:center; color:#009966;" onclick="closebox();">
			<?php  echo "Execution Successful!!  :)<hr /> <em>".$finscript."</em>";?>
			<hr>
	 </div>
	 <?php }else{?>
	 
	 <div class="alertmsgbox_placard" id="placard" style="text-align:center; color:#FF0000;" onclick="closebox();">
			<?php  echo "Failed to Execute :(<hr /> <em>".$finscript."<h1>Reason : ".mysqli_error($mysqliconn)."</h1></em>";?>
<h2>Alter table sample</h2>
			<hr>
<?php echo nl2br('
$col_script_sample="ADD `columnname`  varchar(500) NOT NULL";
$col_script_sample="CHANGE `columnnameOLD` `columnnameNEW`  varchar(500) NOT NULL";
$col_script_sample="MODIFY COLUMN `cherry` VARCHAR(500) NULL AFTER `banana`";');?>
	 </div>
	 <?php 
	}
}


//------------------------- start count select query--------//

function bend_sql_count($dbname, $file_path, $tbl, $count_col, $where, $comment, $create_new_file)
{

	$where_clause=' WHERE '.$where.''; 

	if($where=="")
	{

		$where_clause="";
	}

$cparams_name=str_replace(" ", "_", strtolower($comment));
$cparams_name_tot=str_replace(" ", "_", strtoupper($comment));

$count_totals_query='$'.$cparams_name.'_'.$tbl.'_count_q=mysqli_query($mysqliconn, "SELECT count('.$count_col.') AS TOT_COUNT_'.$cparams_name_tot.' FROM `$'.$dbname.'`.`'.$tbl.'` '.$where_clause.'");

$'.$cparams_name.'_'.$tbl.'_count_r=mysqli_fetch_array($'.$cparams_name.'_'.$tbl.'_count_q);

$'.$cparams_name.'_'.$tbl.'_count=$'.$cparams_name.'_'.$tbl.'_count_r["TOT_COUNT_'.$cparams_name_tot.'"];'.PHP_EOL.'//--<{ncgh}/>';


if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $count_totals_query);
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $count_totals_query);


		}


	}
}
//------------------------- End count select query--------//



function create_cruds($file_path, $param_fields, $dbname, $tbl, $primkey)
{

insert_update_str($file_path, $param_fields, 'Create Update record from '.$tbl, $dbname, $tbl, $primkey, 'yes', '', '');

bend_row_select_str($dbname, $tbl, '', $file_path, 'no', $primkey, 'DESC', 'Find '.$tbl.' Records Profile' , '');

full_bend_select_str($dbname, $tbl, '', $param_fields, $file_path, 'no', $primkey, 'DESC', 'Like Query String '.$tbl);

create_del_str($file_path, ' **** Delete '.$tbl.' Records ', $dbname, $tbl, '', $primkey, 'no');


}

function custom_cruds($file_path, $json_ins_fields, $json_updt_fields, $dbname, $tbl, $primkey)
{

custom_insert_update_str($file_path, $json_ins_fields, $json_updt_fields, 'Create Update record from '.$tbl, $dbname, $tbl, $primkey, 'yes', '', '');

bend_row_select_str($dbname, $tbl, '', $file_path, 'no', $primkey, 'DESC', 'Find '.$tbl.' Records Profile' , '');

custom_full_bend_select_str($dbname, $tbl, '', $json_ins_fields, $file_path, 'no', $primkey, 'DESC', 'Like Query String '.$tbl);

create_del_str($file_path, ' **** Delete '.$tbl.' Records ', $dbname, $tbl, '', $primkey, 'no');


}


function clean_html($html)
{
	$dom = new DOMDocument();

$dom->preserveWhiteSpace = false;
$dom->loadHTML($html,LIBXML_HTML_NOIMPLIED);
$dom->formatOutput = true;


return $dom->saveXML($dom->documentElement);
}

function magic_sql_list_db()
{

  global $show_tables_res_fin;
  
  global $single_conn;

  $show_tables_res=array();

  $show_tables_q=mysqli_query($single_conn, "SHOW DATABASES"); //mysqli

  while($show_tables_r=mysqli_fetch_array($show_tables_q)){

    $show_tables_res[]=$show_tables_r[0];

   }
$show_tables_res_fin= implode("," , $show_tables_res);

return $show_tables_res_fin;

}


//============== add vars to file 
function add_terminal_vars($add_from_file_path)
{

$pattern = '/[;, ( ) " = > < } { ]/';

$string =file_get_contents($add_from_file_path);

$write_vars3 = preg_split( $pattern, $string );

$write_vars1 =array_filter($write_vars3);

$write_vars= implode(' , ', $write_vars1);

//get var contents 

$varfile =file_get_contents('./appvars.txt');

$usertext = substr($varfile, 0, strpos($varfile, "//************** dont write below this line ********************"));

//====write to file 
$new_content_to_write=$usertext.PHP_EOL."//************** dont write below this line ********************".PHP_EOL.$write_vars."//======== Start termvar ".$add_from_file_path.PHP_EOL."//======== End termvar ".PHP_EOL ;
//$new_content_to_write=file_get_contents('');

/////////=========== get userscontent

unlink('./appvars.txt');

bend_write_to_file('./appvars.txt', $new_content_to_write);

//==== get var files url
	
if (!file_exists('./varurls.txt')) {   
bend_write_to_file('./varurls.txt', $add_from_file_path."".PHP_EOL);
}else{
	$varfile_conts1=file_get_contents('./varurls.txt');

	$replace_currline=str_replace($add_from_file_path, "", $varfile_conts1);
	

	$varfile_conts2=$replace_currline." ".PHP_EOL.$add_from_file_path;

	unlink('varurls.txt');

	$varfile_conts=preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $varfile_conts2);


bend_write_to_file('./varurls.txt', $varfile_conts."".PHP_EOL);

}

}

function refresh_vars($reset_all_yes_no)
{
	global $return_hash;
		
	$file_urls=file_get_contents('./varurls.txt');

	$find_files=explode("\n", $file_urls);

	$varfile_conts1=file_get_contents('./varurls.txt');

if($reset_all_yes_no=='yes'){

		
	$file_to_write = fopen('./varurls.txt', 'w') or die("can't open file");

	fwrite($file_to_write, "");
	fclose($file_to_write);


$varfile =file_get_contents('./appvars.txt');

$usertext = substr($varfile, 0, strpos($varfile, "//************** dont write below this line ********************"));

$new_content_to_write=$usertext.PHP_EOL."//************** dont write below this line ********************";

unlink('./appvars.txt');

bend_write_to_file('./appvars.txt', $new_content_to_write);


}else{
$write_vars='';

foreach ($find_files as $url_str => $file_url) 
{

if (!file_exists($file_url)) {   
	$varfile_conts1=file_get_contents('./varurls.txt');

	$replace_currline=str_replace($file_url, "", $varfile_conts1);

	$file_to_write = fopen('./varurls.txt', 'w') or die("can't open file");

	fwrite($file_to_write, $replace_currline);
	fclose($file_to_write);
	# code...
}else{

$pattern = '/[;, ( ) " = > < } { ]/';

$string =file_get_contents($file_url);

$write_vars3 = preg_split( $pattern, $string );

$write_vars1 =array_filter($write_vars3);

$write_vars.= "//======== Start file variables for ".$file_url.PHP_EOL. implode(' , ', $write_vars1).PHP_EOL."//======== End file variables for ".$file_url.PHP_EOL;

}

//get var contents 

$varfile =file_get_contents('./appvars.txt');

$usertext = substr($varfile, 0, strpos($varfile, "//************** dont write below this line ********************"));

//====write to file 
$new_content_to_write=$usertext.PHP_EOL."//************** dont write below this line ********************".PHP_EOL.$write_vars;

/////////=========== get userscontent

	$file_to_write = fopen('./appvars.txt', 'w') or die("can't open file");

	fwrite($file_to_write, $new_content_to_write);
	fclose($file_to_write);

}

}

}


function Recycle($filename, $echo_res = '')
{
    $new_file_name = './deleted_files/' . magic_basename($filename) . "_" . date("d_m_y_h_s_a") . '_bkup.tmx';

    // Ensure the deleted_files directory exists
    if (!file_exists('./deleted_files')) {
        @mkdir('./deleted_files', 0777, true);
    }

    // Check if the file exists before renaming
    if (!file_exists($filename)) {
        if ($echo_res == '') {
            echo "<hr>Oops!Fail Deleting File '$filename'.file does not exist. <hr>";
        }
        return false; // Exit function early
    }

    // Try to move the file
    $exec_move = rename($filename, $new_file_name);

    if ($echo_res == '') {
        if ($exec_move) {
            echo "<hr>File Moved to " . $new_file_name . "<hr>";
        } else {
            echo "<hr>Oops! Error While Deleting File <hr>";
        }
    }

    return $exec_move;
}


function bend_help()
{
	$help_functions='
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

//======= create a script to insert and update table

 insert_update_str($file_path, $param_fields, $comment, $dbname, $tbl, $editkey, $create_new_file, $write_here, $ins_upd)
//======= create a select string
</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

bend_select_str($db, $tbl, $where_str, $file_path, $create_new_file, $orderby_col, $ordertype, $comment);
</div>

<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

//create a where like string 

gen_where_like($input_where_json, $file_path, $create_new_file);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

//========= create connection file 

create_conn_str($file_path, $host, $username, $password, $dbname, $create_new_file);


</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

//======= create table in db

create_table($mysqliconn, $dbname, $tbl, $col_script);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

//====== alter table

alter_table($mysqliconn, $dbname, $tbl, $col_script);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >


//==== select string for single row ==

bend_row_select_str($db, $tbl, $where_str, $file_path, $create_new_file, $orderby_col, $ordertype, $comment, $write_here)

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

//===== generate data variables 

gen_sql_params($file_path, $param_fields, $comment, $create_new_file, $write_here, $post_var_sess_get)


</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

///====== generate sql count data string

bend_sql_count($dbname, $file_path, $tbl, $count_col, $where, $comment, $create_new_file);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

///============ Create select update insert and delete functions

create_cruds($file_path, $param_fields, $dbname, $tbl, $primkey);

</div>

<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//=============== Create Left Join String


create_leftjoin_str($tablemain, $tablechild, $on_str_child_main, $main_cols_array, $childcols_array, $file_path, $create_new_file, $orderby_col, $ordertype, $where_str);

</div>

<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

//create AJAX query str

ajax_post_str($post_url, $json_post_params, $file_path, $create_new_file, $write_here);
</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >


//==== Create delete string 

create_del_str($file_path, $comment, $dbname, $tbl, $where_str, $create_new_file);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >


//====write to file 

bend_write_to_file($file_path, $new_content_to_write);
</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >


//========= replace text in a file_path

bend_replace_file_section($file_path, $item_to_be_replaced, $item_to_replace_with)
</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

//create login str

create_login($dbname, $tbl, $primkey, $user_email, $username, $password, $comment, $gotourl, $session_name, $create_new_file, $file_path)

</div>

<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
///Beautify html code

clean_html($html);

</div>

<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//============== add vars to file 
add_terminal_vars($add_from_file_path);

</div>

<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//import data base 
 magic_sql_import_db($filename, $host, $username, $password, $mysql_database);
 
</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//export database
 magic_sql_export_db($host, $username, $password, $db, $path, $tables)
 
 </div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
///backup file
 backup_file($filename, $contents, $overwrite);
 
 </div>
 
 <div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//create database

  create_db($mysqliconn, $db_to_create);
 
 </div>
 
';



	return ($help_functions);

}
?>
