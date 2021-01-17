<?php 

		//== initialize edit token variables

		$asn_snippets_uptoken="";

		if(isset($_GET["asn_snippets_uptoken"]))
		{
		$asn_snippets_uptoken=base64_decode($_GET["asn_snippets_uptoken"]);
		}

//************* START INSERT QUERY 
if(isset($_POST["asn_snippets_insert_btn"])){
//------- begin Create Update record from asn_snippets --> 
$snippetid=mysqli_real_escape_string($mysqliconn, $_POST["txt_snippetid"]);
$snippet_title=mysqli_real_escape_string($mysqliconn, $_POST["txt_snippet_title"]);
$snippet_details=mysqli_real_escape_string($mysqliconn, $_POST["txt_snippet_details"]);
//===-- End Create Update record from asn_snippets -->


$asn_snippets_insert_query = mysqli_query($mysqliconn, "INSERT INTO `$asntag`.`asn_snippets` (`primkey`,`snippetid`,`snippet_title`,`snippet_details`) VALUES (NULL,'$snippetid','$snippet_title','$snippet_details')");

 //--- get primary key id
$asn_snippets_return_key=mysqli_insert_id($mysqliconn);

 //--- Redirect to current location with primary key
header('location:./'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).'?asn_snippets_uptoken='.base64_encode($asn_snippets_return_key).'&table_alert=Record added Succesfully');
}
//************* END INSERT QUERY 


//************* START UPDATE QUERY 
if(isset($_POST["asn_snippets_update_btn"])){
//------- begin Create Update record from asn_snippets --> 
$snippetid=mysqli_real_escape_string($mysqliconn, $_POST["txt_snippetid"]);
$snippet_title=mysqli_real_escape_string($mysqliconn, $_POST["txt_snippet_title"]);
$snippet_details=mysqli_real_escape_string($mysqliconn, $_POST["txt_snippet_details"]);
//===-- End Create Update record from asn_snippets -->


$asn_snippets_update_query = mysqli_query($mysqliconn, "UPDATE  `$asntag`.`asn_snippets` SET `snippet_title`='$snippet_title',`snippet_details`='$snippet_details' WHERE primkey='$asn_snippets_uptoken'");

//--- Redirect to current location with primary key
header('location:./'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).'?asn_snippets_uptoken='.base64_encode($asn_snippets_uptoken).'&table_alert=Record Updated Succesfully');

}
//************* END UPDATE QUERY 


//=== start asn_snippets select Find asn_snippets Records Profile query 

$find_asn_snippets_records_profile_asn_snippets_query=mysqli_query($mysqliconn, "SELECT * FROM `$asntag`.`asn_snippets` WHERE `primkey`='$asn_snippets_uptoken' ORDER BY `primkey` DESC LIMIT 1" );

$asn_snippets_node=mysqli_fetch_array($find_asn_snippets_records_profile_asn_snippets_query);

//=== End asn_snippets select Find asn_snippets Records Profile  query




if(isset($_POST["qasn_snippets_btn"])){


$qasn_snippets_str=base64_encode($_POST["txt_asn_snippets"]);


header('location:./'.basename($_SERVER["REQUEST_URI"], "?".$_SERVER["QUERY_STRING"]).'?qasn_snippets='.($qasn_snippets_str).'');

}

if(isset($_GET["qasn_snippets"])){


$qasn_snippets=mysqli_real_escape_string($mysqliconn, base64_decode($_GET["qasn_snippets"]));



//===== limit record value

$asn_snippets_sqlstring="SELECT COUNT(*) FROM `$asntag`.`asn_snippets` WHERE (`primkey` LIKE '%".$qasn_snippets."%' OR  `snippetid` LIKE '%".$qasn_snippets."%' OR  `snippet_title` LIKE '%".$qasn_snippets."%' OR  `snippet_details` LIKE '%".$qasn_snippets."%')";

//===== Pagination function

$asn_snippets_pagination= list_record_per_page($mysqliconn, $asn_snippets_sqlstring, $datalimit);


//===== get return values


$asn_snippets_firstproduct=$asn_snippets_pagination["0"];

$asn_snippets_pgcount=$asn_snippets_pagination["1"];

//=== start asn_snippets select  Like Query String asn_snippets list  

$asn_snippets_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$asntag`.`asn_snippets`  WHERE (`primkey` LIKE '%".$qasn_snippets."%' OR  `snippetid` LIKE '%".$qasn_snippets."%' OR  `snippet_title` LIKE '%".$qasn_snippets."%' OR  `snippet_details` LIKE '%".$qasn_snippets."%') ORDER BY `primkey` DESC LIMIT $asn_snippets_firstproduct, $datalimit" );



//=== End asn_snippets select  Like Query String asn_snippets list
;

}else{

//===== limit record value

$asn_snippets_sqlstring="SELECT COUNT(*) FROM `$asntag`.`asn_snippets`";

//===== Pagination function

$asn_snippets_pagination= list_record_per_page($mysqliconn, $asn_snippets_sqlstring, $datalimit);


//===== get return values


$asn_snippets_firstproduct=$asn_snippets_pagination["0"];

$asn_snippets_pgcount=$asn_snippets_pagination["1"];

//=== start asn_snippets select  Like Query String asn_snippets list  

$asn_snippets_list_query=mysqli_query($mysqliconn, "SELECT * FROM `$asntag`.`asn_snippets`  ORDER BY `primkey` DESC LIMIT $asn_snippets_firstproduct, $datalimit" );

//$asn_snippets_list_res=mysqli_fetch_array($asn_snippets_list_query);

//=== End asn_snippets select  Like Query String asn_snippets list

}


//== Start  **** Delete asn_snippets Records  

if(isset($_GET["deleteasn_snippets"]))
{

//======confirm pop up 

$conf_del_asn_snippets_btn=magic_button_link("./editasn_snippets.php?asn_snippets_uptoken=".$_GET["asn_snippets_uptoken"]."&conf_deleteasn_snippets", "Yes", 'style="margin-right:10px;"');

$cancel_del_asn_snippets_btn=magic_button_link("./editasn_snippets.php?asn_snippets_uptoken=".$_GET["asn_snippets_uptoken"], "No", "");

echo magic_screen("Delete this record?<hr>".$conf_del_asn_snippets_btn." ".$cancel_del_asn_snippets_btn."");

}

//==Delete Record 

if(isset($_GET["conf_deleteasn_snippets"]))
{

mysqli_query($mysqliconn, "DELETE FROM `$asntag`.`asn_snippets` WHERE `primkey`='$asn_snippets_uptoken'");

//==add your redirect here 

header("location:./snippetlisting.php?table_alert=Record Deleted Succesfully");
}

//== End  **** Delete asn_snippets Records 

//--<{ncgh}/>
?>