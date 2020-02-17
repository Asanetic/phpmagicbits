<?php
//=========================== INITIATE VARIABLES 

//A TOKEN FILTERS A SINGLE RECORD USING PRIMARY KEY
$editoken="";

if(isset($_GET['editoken'])){
$editoken=base64_decode($_GET['editoken']);
}

$token_filter = magic_sql_where('{"<primkey>":"'.$editoken.'"}');
//A TOKEN FILTERS A SINGLE RECORD USING PRIMARY KEY

//** END INITIATE VARIABLES 


//START QUERY DATA USING LIKE SQL
if(isset($_POST['btn_gen_query'])){

    header("location:./TABLE_NAME.php?gen_data_query=".base64_encode($_POST['gen_data_query_str'])."");
}

//END QUERY DATA USING LIKE SQL


//** UI DATA CONTROL 

//BEGIN LISTING DATA RECORDS 

if(isset($_GET['gen_data_query'])){

$gen_query_value=base64_decode($_GET['gen_data_query']);

$gen_query_str=magic_sql_where_like('{<col_node_gen_data_query>}');

$listTABLE_NAME= magic_sql_select('TABLE_NAME', $gen_query_str, $datalimit, '<primkey>', 'DESC');

}else{
	$listTABLE_NAME= magic_sql_select('TABLE_NAME', '', $datalimit, '<primkey>', 'DESC');
}
//END LISTING DATA RECORDS 


//=======BEGIN COUNT DATA RECORDS
 //(ON EMPTY RESULTS ECHO $noTABLE_NAME  TO DISPLAY ADD NEW RECORD BUTTON) 
$count_TABLE_NAME=magic_sql_count('TABLE_NAME','<primkey>', '');

$noTABLE_NAME="";

if($count_TABLE_NAME==0){
	$noTABLE_NAME = magic_button_link('./editTABLE_NAME.php?newrecord', 'No records. <i class="fa fa-cross"></i> Add new', "");;
}
//=======END COUNT DATA RECORDS

//=========================== BEGIN SELECT SINGLE ROW RECORD USING GET PRIMARY KEY  
$TABLE_NAME_node= magic_sql_row_data('TABLE_NAME', $token_filter, '<primkey>', 'DESC');

//=========================== END SELECT SINGLE ROW RECORD USING GET PRIMARY KEY  

//===========================  JSON DATA VARS  
$TABLE_NAME_insert_vars='<col_node_insert_json>';

 $TABLE_NAME_update_vars='<col_node_update_json>';

//===========================  JSON DATA VARS  


//===========================  INSERT DATA  
if(isset($_POST['btn_add_new_TABLE_NAME'])){

	$inserted_key=magic_sql_insert('TABLE_NAME', $TABLE_NAME_insert_vars);

	header("location:./editTABLE_NAME.php?editoken=".base64_encode($inserted_key)."&TABLE_NAMEadded");
}

//===========================  INSERT DATA  

//===========================  INSERT DATA SUCCESS UI

if(isset($_GET['TABLE_NAMEadded'])){

	$newbtn=magic_button_link("./editTABLE_NAME.php?newrecord", "Add Another Record", "");

	$refresh=magic_button_link("./editTABLE_NAME.php?editoken=".$_GET['editoken']."", "Upload Photo", "");
	echo magic_screen("TABLE_NAME Added.<hr>".$newbtn." | ".$refresh);
}
//===========================  INSERT DATA SUCCESS UI


//===========================  DELETE DATA

//DELETE PROMPT UI
if(isset($_GET['deleteTABLE_NAME'])){

	$del_btn=magic_button_link('./editTABLE_NAME.php?editoken='.$_GET['editoken'].'&confdel', 'Yes','');

	$cancel_del_btn=magic_button_link('./editTABLE_NAME.php?editoken='.$_GET['editoken'].'', 'No','');

	echo magic_screen('Delete this TABLE_NAME?<hr>'.$del_btn." | ".$cancel_del_btn);

}
//DELETE PROMPT UI

//DELETE ROW QUERY 
if(isset($_GET['confdel'])){

magic_sql_delete('TABLE_NAME', $token_filter);

header("location:./TABLE_NAME.php");
}
//DELETE ROW QUERY 

//===========================  DELETE DATA

//===========================  UPDATE DATA

//UPDATE QUERY
if(isset($_POST['btn_save_TABLE_NAME_changes'])){

magic_sql_update('TABLE_NAME', $TABLE_NAME_update_vars, $token_filter);

header("location:./editTABLE_NAME.php?editoken=".$_GET['editoken']."&saved");

}  
//UPDATE QUERY


//UPDATE SUCESS UI
if(isset($_GET['saved'])){
	$newbtn=magic_button_link("./editTABLE_NAME.php?newrecord", "Add new TABLE_NAME", "");

	$refresh=magic_button_link("./editTABLE_NAME.php?editoken=".$_GET['editoken'], "Close", "");
	
	echo magic_message('Changes Saved.<hr>'.$newbtn.' | '.$refresh.'');
}
//UPDATE SUCESS UI

//===========================  UPDATE DATA  

//===========================  MANAGE PHOTOS  

if(isset($_POST['btn_upload_<PHOTO_COLUMN_HERE>_photo'])){

	$newTABLE_NAMEphoto=magic_upload_file('<PUT_PHOTO_PATH_HERE>', '<PUT_FILE_INPUT_NAME_HERE>', magic_random_str(10));

	unlink(<OLD_PHOTO_PATH_HERE>);

	magic_sql_update('TABLE_NAME', '{"<PHOTO_COLUMN_HERE>":"'.$newTABLE_NAMEphoto.'"}', $token_filter);

	header("location:./editTABLE_NAME.php?editoken=".$_GET['editoken']."&image_uploaded");
}

//UPLOAD SUCCESS UI
if(isset($_GET['image_uploaded']))
{
	
	$newbtn=magic_button_link("./editTABLE_NAME.php?newrecord", "Add new TABLE_NAME", "");

	$refresh=magic_plain_button("", "Close", "");
	
	echo magic_message('TABLE_NAME Photo Uploaded.<hr>'.$newbtn.' | '.$refresh.'');

}
//UPLOAD SUCCESS UI

//===========================  MANAGE PHOTO 

?>
