<?php
ob_start();
include('./svrconn.php');
include('./phpmagicbits.php');
include('./asndata.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="./terminal.css">
	<link rel="stylesheet" href="./boot.css">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit snippet</title>

    <!-- Bootstrap core CSS -->
</head>

<body>
<form method="post">
<!--Start editor-->
<div class="navbar_ribbon">
<a href="./appview" class="exe_btn text-white">Load Terminal</a>
</div>
<!--Start asn_snippets Inputs-->  
	<div class="col-md-12 mb-md-3 mt-5" style="text-align: center;">

    	<?php echo magic_button_link('./snippetlisting.php', '<i class="fa fa-arrow-left"></i> Back to list', "");?>

    	<?php echo magic_button_link('./editasn_snippets.php?newrecord', '<i class="fa fa-plus"></i> Add new', "");?> 

		<?php if(isset($_GET['asn_snippets_uptoken'])) echo magic_button_link('./editasn_snippets.php?asn_snippets_uptoken='.($_GET["asn_snippets_uptoken"]).'&deleteasn_snippets','<i class="fa fa-trash"></i> Delete', 'style="background-color:red;"');?>
	</div>     
	<div class="row p-md-3 justify-content-center bg-white col-md-11">
	

<div class="col-md-8">
 <div class="form-group">
  <label >Snippet Title</label>
  <input class="form-control" id="txt_snippet_title" name="txt_snippet_title" value="<?php echo $asn_snippets_node["snippet_title"];?>" placeholder="Snippet Title" type="text">
 </div>
 <div class="form-group">
  <label >Snippet Details</label>
<textarea class="form-control" placeholder="Snippet Details" style="height:300px;" id="txt_snippet_details" name="txt_snippet_details"><?php echo $asn_snippets_node["snippet_details"];?></textarea>

 </div>

</div>
                   
		<div align="center" style="width: 98%">
			<?php if(!isset($_GET['asn_snippets_uptoken'])) echo magic_button("asn_snippets_insert_btn","Proceed","");?>
			<?php if(isset($_GET['asn_snippets_uptoken'])) echo magic_button("asn_snippets_update_btn","Save Changes","");?>
		</div>
		</div>

<!--End asn_snippets Inputs-->
<!--<{ncgh}/>-->

</form>
</body>
</html>
