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

	echo '<h2><u>File Succesfully created on <a href="'.$file_path.'"  target="_blank">'.$file_path.'</a></u></h2>';
  }else{
  	echo "<h2>Sorry, File Overwrite is not allowed, a similar file '".$file_path."'  already exists. Delete this file before creating a new one. </h2> ";
  }

	return $final_file_content;

}
//------------------------- end write new file contents --------//



//=========== create update insert string =================

function insert_update_str($file_path, $param_fields, $comment, $dbname, $tbl, $editkey, $create_new_file)
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


		foreach ($param_fields as $sql_vars) {

			if($sql_vars==$editkey)
			{
			$insert_values[]="NULL";
			$final_sql_block.="";
			}else{
			$insert_values[]="'$".$sql_vars."'";
			$final_sql_block.='$'.$sql_vars.'=mysqli_real_escape_string($mysqliconn, $_POST["txt_'.$sql_vars.'"]);'.PHP_EOL;
			}
			$insert_cols[]='`'.$sql_vars.'`';

			$update_vars[]='`'.$sql_vars.'`=\'$'.$sql_vars.'\'';



		}

		$prepared_cols=implode(',', $insert_cols);
		$insert_post_vars=implode(',', $insert_values);

		$update_set_str=implode(',', $update_vars);

		$insert_query_str=
		 '$'.$tbl.'_insert_query = mysqli_query($mysqliconn, "INSERT INTO `$'.$dbname.'`.`'.$tbl.'` ('.$prepared_cols.') VALUES ('.$insert_post_vars.')");'.PHP_EOL.PHP_EOL.' //--- get primary key id'.PHP_EOL.'$'.$tbl.'_return_key=mysqli_insert_id($mysqliconn);'.PHP_EOL.PHP_EOL.' //--- Redirect to current location with primary key'.PHP_EOL.'header(\'location:./\'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).\'?'.$tbl.'_uptoken=\'.base64_encode($'.$tbl.'_return_key).\'\');';

		$update_query_str=
		'$'.$tbl.'_update_query = mysqli_query($mysqliconn, "UPDATE  `$'.$dbname.'`.`'.$tbl.'` SET '.$update_set_str.' WHERE '.$editkey.'=\'$'.$tbl.'_uptoken\'");'.PHP_EOL.PHP_EOL.'//--- Redirect to current location with primary key'.PHP_EOL.'header(\'location:./\'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).\'?'.$tbl.'_uptoken=\'.base64_encode($'.$tbl.'_uptoken).\'\');'.PHP_EOL;
	

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


$sql_param_str= $php_start_tag.''.PHP_EOL.PHP_EOL.'//************* START INSERT QUERY '.PHP_EOL.'if(isset($_POST["'.$tbl.'_insert_btn"])){'.PHP_EOL.'//------- begin '.$comment.' --> '.PHP_EOL.$final_sql_block.'//===-- End '.$comment.' -->'.PHP_EOL.PHP_EOL.PHP_EOL.$insert_query_str.PHP_EOL.'}'.PHP_EOL.'//************* END INSERT QUERY '.PHP_EOL.'';

$sql_param_str.= ''.PHP_EOL.PHP_EOL.'//************* START UPDATE QUERY '.PHP_EOL.'if(isset($_POST["'.$tbl.'_update_btn"])){'.PHP_EOL.'//------- begin '.$comment.' --> '.PHP_EOL.$final_sql_block.'//===-- End '.$comment.' -->'.PHP_EOL.PHP_EOL.PHP_EOL.$update_query_str.PHP_EOL.'}'.PHP_EOL.'//************* END UPDATE QUERY '.PHP_EOL.'//--<{ncgh}/>'.PHP_EOL.''.$php_end_tag;

if($file_path!='')
{
	if($create_new_file=='yes'){


		bend_write_to_file($file_path, $sql_param_str);
	
	}else{

		bend_replace_file_section($file_path, '//--<{ncgh}/>', $sql_param_str);


	}

	$final_file_content=file_get_contents($file_path);

}


return $final_file_content;


}
//=========== create update insert string =================


function gen_sql_params($file_path, $param_fields, $comment, $create_new_file)
{

	global $sql_param_data;

		$var_prefix='';

		if($comment!=""){
			$var_prefix=strtolower(str_replace(" ", '_', $comment))."_";
		}

		$final_sql_block="";

		foreach ($param_fields as $sql_vars) {

			$final_sql_block.='$'.$sql_vars.'=mysqli_real_escape_string($mysqliconn, $_POST["txt_'.$sql_vars.'"]);'.PHP_EOL;
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

		bend_replace_file_section($file_path, '//--<{ncgh}/>', $sql_param_str);


	}

	$final_file_content=file_get_contents($file_path);

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


function bend_row_select_str($db, $tbl, $where_str, $file_path, $create_new_file, $orderby_col, $ordertype, $comment)
{

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

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $gen_select_query);


		}


	}
}


function full_bend_select_str($db, $tbl, $where_str, $param_fields, $file_path, $create_new_file, $orderby_col, $ordertype, $comment)
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

$gen_select_query=PHP_EOL.PHP_EOL.'

if(isset($_POST["q'.$tbl.'_btn"])){


$q'.$tbl.'_str=base64_encode($_POST["txt_'.$tbl.'"]);


header(\'location:./\'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).\'?q'.$tbl.'=\'.($q'.$tbl.'_str).\'\');

}

if(isset($_GET["q'.$tbl.'"])){


$q'.$tbl.'=base64_decode($_GET["q'.$tbl.'"]);



//===== limit record value

$'.$tbl.'_sqlstring="SELECT COUNT(*) FROM `$'.$db.'`.`'.$tbl.'`'.$where_like_str.$additional_where_clause.'";

//===== Pagination function

$'.$tbl.'_pagination= list_record_per_page($mysqliconn, $'.$tbl.'_sqlstring, $datalimit);


//===== get return values


$'.$tbl.'_firstproduct=$'.$tbl.'_pagination["0"];

$'.$tbl.'_pgcount=$'.$tbl.'_pagination["1"];';


$gen_select_query.=PHP_EOL.PHP_EOL.'//=== start '.$tbl.' select  '.$comment.' list  '.PHP_EOL.PHP_EOL.'$'.$tbl.'_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$'.$db.'`.`'.$tbl.'` '.$where_like_str.$additional_where_clause.' ORDER BY `'.$orderby_col.'` '.$ordertype.' LIMIT $'.$tbl.'_firstproduct, $datalimit" );

'.PHP_EOL.PHP_EOL.'//=== End '.$tbl.' select  '.$comment.' list'.PHP_EOL.';

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


function ajax_post_str($post_url, $json_post_params, $file_path, $create_new_file)
{
	
	$json_post_params_decoded = json_decode($json_post_params, true);


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

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $ajaxstr);


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

$conf_del_'.$tbl.'_btn=magic_button_link("./edit'.$tbl.'.php?'.$tbl.'_uptoken=".$_GET["'.$tbl.'_uptoken"]."&conf_delete'.$tbl.'", "Yes", \'style="margin-right:10px;"\');

$cancel_del_'.$tbl.'_btn=magic_button_link("./edit'.$tbl.'.php?'.$tbl.'_uptoken=".$_GET["'.$tbl.'_uptoken"], "No", "");

echo magic_screen("Delete this record?<hr>".$conf_del_'.$tbl.'_btn." ".$cancel_del_'.$tbl.'_btn."");

}';

$del_sql_str.='

//==Delete Record 

if(isset($_GET["conf_delete'.$tbl.'"]))
{

mysqli_query($mysqliconn, "DELETE FROM `$'.$dbname.'`.`'.$tbl.'` '.$where_clause.'");

//==add your redirect here 

header("location:./'.$tbl.'.php");
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



?>';

if($file_path!='')
	{
		if($create_new_file=='yes'){


			bend_write_to_file($file_path, $conn_file_str);
		
		}else{

			bend_replace_file_section($file_path, '//--<{ncgh}/>', $conn_file_str);


		}


	}



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

insert_update_str($file_path, $param_fields, 'Create Update record from '.$tbl, $dbname, $tbl, $primkey, 'yes');

bend_row_select_str($dbname, $tbl, '', $file_path, 'no', $primkey, 'DESC', 'Find '.$tbl.' Records Profile');

full_bend_select_str($dbname, $tbl, '', $param_fields, $file_path, 'no', $primkey, 'DESC', 'Like Query String '.$tbl);

create_del_str($file_path, ' **** Delete '.$tbl.' Records ', $dbname, $tbl, '', $primkey, 'no');


}

function bend_help()
{
	$help_functions='

	//======= create a script to insert and update table

	insert_update_str($new_file_path, $columns_fields_array, $comment, $dbname, $tbl, $editkey_eg_primkey, $create_new_file_yes_no);

	//======= create a select string

	bend_select_str($db, $tbl, $where_str, $file_path, $create_new_file, $orderby_col, $ordertype, $comment);



	//create a where like string 

	gen_where_like($input_where_json, $file_path, $create_new_file);



	//========= create connection file 

	create_conn_str($file_path, $host, $username, $password, $dbname, $create_new_file);



	//======= create table in db

 	create_table($mysqliconn, $dbname, $tbl, $col_script);



 	//====== alter table

 	alter_table($mysqliconn, $dbname, $tbl, $col_script);



 	//==== select string for single row ==

	bend_row_select_str($db, $tbl, $where_str, $file_path, $create_new_file, $orderby_col, $ordertype, $comment);



	//===== generate data variables 

	gen_sql_params($file_path, $param_fields, $comment, $create_new_file);



	///====== generate sql count data string

	bend_sql_count($dbname, $file_path, $tbl, $count_col, $where, $comment, $create_new_file);


	///============ Create select update insert and delete functions

	create_cruds($file_path, $param_fields, $dbname, $tbl, $primkey);


	//create AJAX query str

 	ajax_post_str($post_url, $json_post_params, $file_path, $create_new_file);



	//==== Create delete string 

	create_del_str($file_path, $comment, $dbname, $tbl, $where_str, $create_new_file);


	//====write to file 

	bend_write_to_file($file_path, $new_content_to_write);



	//========= replace text in a file_path

 	bend_replace_file_section($file_path, $item_to_be_replaced, $item_to_replace_with)



	';



	return nl2br($help_functions);

}
?>
