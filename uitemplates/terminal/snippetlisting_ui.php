
    <div align="left" class="col-md-6 mt-5">
       <div style="text-align: center; ">
    		<?php if(isset($_GET['table_alert'])) echo magic_toast('Success', $_GET['table_alert'], 'darkgreen', '#FFF'); ?>
    	</div>
    	<?php echo magic_button_link('./editasn_snippets.php?newrecord', '<i class="fa fa-plus"></i> Add new', 'style="display:inline-block;"');?> 
    	<?php echo magic_button_link('./snippetlisting.php', '<i class="fa fa-refresh"></i> Refresh', 'style="display:inline-block;"');?> 

		<hr><input type="text" placeholder="Search asn snippets" name="txt_asn_snippets" class=" form-control col-md-9" style="display:inline-block; background-color:transparent; border-bottom:1px solid gray; "  autofocus="" />
    	<?php echo magic_button('qasn_snippets_btn', 'Search', 'style="display:inline-block;"');?> 

	</div>
	<div class="table-responsive data-tables" style="background-color: #FFF; margin-top: 20px; padding-bottom: 150px;">
	<table class="table table-hover text-left" id="asn_snippets_data_table">
	    <thead class="text-uppercase">
		   <tr>
		    <th scope="col">#</th>
 <th scope="col">Snippet Title</th>
 <th scope="col">Snippet Details</th>

		   </tr>
	    </thead>
	    <tbody>
		<?php 
		$pagination_record_count=$asn_snippets_pgcount;
        $i=0;
		while($listasn_snippets_result=mysqli_fetch_array($asn_snippets_list_query)){
	        $i++;

	        $edit_drop_link=magic_link('./editasn_snippets.php?asn_snippets_uptoken='.base64_encode($listasn_snippets_result["primkey"]).'','<i class="fa fa-edit"></i> Edit', '');

	        $delete_drop_link=magic_link('./editasn_snippets.php?asn_snippets_uptoken='.base64_encode($listasn_snippets_result["primkey"]).'&deleteasn_snippets','<i class="fa fa-trash"></i> Delete', '');

	        $dropdown_items =$edit_drop_link.$delete_drop_link;
        ?>
	    <tr>
	    	<td scope="col"><?php echo magic_dropdown($i, $dropdown_items, 'no')?></td>
 <td scope="col"><?php echo $listasn_snippets_result["snippet_title"];?></td>
 <td scope="col"><?php echo magic_strip_if($listasn_snippets_result["snippet_details"], 50, 50);?></td>

	    </tr>
	    <?php }?>
	    </tbody>
	    </table>
	 <hr>
	 <?php include("./pagination.php");?>
	</div>