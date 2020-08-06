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

function replace_file_section($file_path, $item_to_be_replaced, $item_to_replace_with)
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

function ui_write_to_file($file_path, $new_content_to_write)
{

	global $final_file_content;
  
  if (!file_exists($file_path))
  {
  	$file_to_write = fopen($file_path, 'w') or die("can't open file");
	fwrite($file_to_write, $new_content_to_write);
	fclose($file_to_write);

	$final_file_content=file_get_contents($file_path);

	echo '<h2><u>File Succesfully created on <a href="'.$file_path.'" target="_blank">'.$file_path.'</a></u></h2>';
  }else{
  	echo "<h2>Sorry, File Overwrite is not allowed, a similar file '".$file_path."'  already exists. Delete this file before creating a new one. </h2> ";
  }

	return $final_file_content;

}
//------------------------- end write new file contents --------//



//----------------Start create ui frame------------>

function create_appframe($page_title, $navbar_path, $footer_path, $header_css_scripts, $newfile_name, $background_image_path, $template_path)
{

	//==============  Find App Frame Name  ======================
if($template_path=='')
{
	$new_appframe1=file_get_contents('https://raw.githubusercontent.com/Asanetic/phpmagicbits/master/uitemplates/appframe.php');
}else{
		$new_appframe1=file_get_contents($template_path);

}

if($navbar_path!='')
{
	$navbar_str='<?php include("'.$navbar_path.'");?>';
}else
{
	$navbar_str="";
}

if($header_css_scripts!='')
{
	$header_css_scripts_str='<?php include("'.$header_css_scripts.'");?>';
}else
{
	$header_css_scripts_str="";
}

if($footer_path!='')
{
	$footer_path_str='<?php include("'.$footer_path.'");?>';
}else
{function bend_help()
{
	$help_functions='
	insert_update_str($file_path, $param_fields, $comment, $dbname, $tbl, $editkey, $create_new_file);
	bend_select_str($db, $tbl, $where_str, $file_path, $create_new_file, $orderby_col, $ordertype);
	gen_where_like($input_where_json, $file_path, $create_new_file);
	



	';

	return $help_functions;

}
	$footer_path_str="";
}

	$new_appframe2=str_replace("{page_title}", $page_title, $new_appframe1);
	$new_appframe3=str_replace("{navbar_path}", $navbar_str, $new_appframe2);
	$new_appframe4=str_replace("{header_css_scripts}", $header_css_scripts_str, $new_appframe3);
	$new_appframe5=str_replace("{background_image}", $background_image_path, $new_appframe4);
	$new_appframe=str_replace("{footer_path}", $footer_path_str, $new_appframe5);

 	ui_write_to_file($newfile_name, $new_appframe);

}
//----------------End create ui frame------------>

//----------------Start create Nav bar ----------->


function create_navbarui($appname, $app_logo_path, $newfile_name, $template_path)
{

if($template_path=='')
{
	$new_appui=file_get_contents('https://raw.githubusercontent.com/Asanetic/phpmagicbits/master/uitemplates/navbar.php');
}else{
		$new_appui=file_get_contents($template_path);

}
	$new_str1=str_replace("{appname}", $appname, $new_appui);
	$new_str2=str_replace("{app_logo}", $app_logo_path, $new_str1);
	$new_str=str_replace("{app_navlinks}", $appname." Home ", $new_str2);

 	ui_write_to_file($newfile_name, $new_str);



}

//----------------End create Nav bar ----------->


function create_magic_form($write_to_path,  $fileds_n_values_json, $tbl, $rows_per_grid, $grid_class, $elements_plate, $ui_comment)
{

	global $return_profile_ui_str;


	$tbl_primkey ="dummy_primkey".date("dmyhisa");

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

		if($elements_plate!='')
		{
		
		$ui_id=str_replace('<elemid>', 'id="txt_'.$key.'"', $elements_plate);
		$name_id=str_replace("<elemname>", 'name="txt_'.$key.'"', $ui_id);
		$label_name=str_replace("<elemlabel>", ucwords(strtolower(str_replace("_", " ", $label_node))), $name_id);
		$placeholder=str_replace("<elemplaceholder>", 'placeholder="Enter '.ucwords(strtolower(str_replace("_", " ", $label_node)))."\"", $label_name);
		$template_str[]=str_replace("<elemdata>", $label_node, $placeholder);


		 }else{
		 	if($tbl!=''){
		 		$php_data_node='<?php echo $'.$tbl.'_node["'.$key.'"];?>';
		 	}else{
		 		$php_data_node='';
		 	}

			$template_str[]=
			' <div class="form-group">'.PHP_EOL.
		    '  <label >'.$label_node.'</label>'.PHP_EOL.
		    '  <input class="form-control" id="txt_'.$key.'" name="txt_'.$key.'" value="'.$php_data_node.'" placeholder="'.$label_node.'" type="text">'.PHP_EOL.
		  	' </div>';

		  }
		}
	}

	$prepared_form_inputs=$template_str;

	$grid_capsule="";
	
	$size = sizeof($prepared_form_inputs);

//print_r($prepared_form_inputs);


	$i=0;
	while($i<$size-1){
	      $i++;
	//echo "Size ".$size." Modulus ".$i%$rows_per_grid." rpg ".$rows_per_grid." Count ".$i.PHP_EOL;
	$first_capsule="";

	if($i==1)
	{
	$first_capsule=$template_str[0].PHP_EOL;

	}

if ($i%$rows_per_grid ==1){
	$grid_capsule.=PHP_EOL.
	'<div class="'.$grid_class.'">'.PHP_EOL.$first_capsule;
	};
	 $grid_capsule.=
	 ''.$prepared_form_inputs[$i].PHP_EOL;
	 if ($i%$rows_per_grid ==0){
	 $grid_capsule.=PHP_EOL.'
	</div>'.PHP_EOL;
	 };
	}
	if ($i%$rows_per_grid != 0) 
	$grid_capsule.=PHP_EOL.'</div>'.PHP_EOL;

	//echo $grid_capsule;

		if($tbl!=''){

	$button_str='                   
		<div align="center" style="width: 98%">
			<?php if(!isset($_GET[\''.$tbl.'_uptoken\'])) echo magic_button("'.$tbl.'_insert_btn","Proceed","");?>
			<?php if(isset($_GET[\''.$tbl.'_uptoken\'])) echo magic_button("'.$tbl.'_update_btn","Save Changes","");?>
		</div>
		</div>'.PHP_EOL;

	$edit_butons='  
	<div class="col-md-12 mb-md-3" style="text-align: center;">
     
    	<?php echo magic_button_link(\'./'.$tbl.'.php\', \'<i class="fa fa-arrow-left"></i> Back to list\', "");?>

    	<?php echo magic_button_link(\'./edit'.$tbl.'.php?newrecord\', \'<i class="fa fa-plus"></i> Add new\', "");?> 

		<?php if(isset($_GET[\''.$tbl.'_uptoken\'])) echo magic_button_link(\'./edit'.$tbl.'.php?'.$tbl.'_uptoken=\'.($_GET["'.$tbl.'_uptoken"]).\'&delete'.$tbl.'\',\'<i class="fa fa-trash"></i> Delete\', \'style="background-color:red;"\');?>
	</div>     
	<div class="row p-md-3 justify-content-center bg-white col-md-11">
	'.PHP_EOL;

	}else{
	
	$button_str='';

	$edit_butons='';

	}

	$row_div_top=$edit_butons;

	$row_div_bottom=$button_str;

	if($write_to_path!='')
	{

 	replace_file_section($write_to_path, '<!--<{ncgh}/>-->', '<!--Start '.$ui_comment.'-->'.$row_div_top.$grid_capsule.$row_div_bottom.PHP_EOL.'<!--End '.$ui_comment.'-->'.PHP_EOL.'<!--<{ncgh}/>-->'.PHP_EOL);

	}
	$return_profile_ui_str=$grid_capsule;

	return $return_profile_ui_str." Key ".$tbl_primkey;

}

function create_dash_icons($title_icon_json, $col_class, $file_path, $create_new_file)
{

    global $dash_template_str;


	$json_inputs_array = json_decode($title_icon_json, true);

	$template_str='';

		foreach ($json_inputs_array as $key => $value) 
		{
              $template_str.=
              '<a href="#" class="'.$col_class.' shadow-sm pb-md-3 mr-md-3 mb-2 bg-white">
                <img src="'.$json_inputs_array[$key].'" class="mt-3" style="width: 60%; ">
                <hr>
                <h5>'.$key.'</h5>
              </a>';

		}

         $dash_capsule='
         <div class="row justify-content-center" style="text-align: center;">
            '.$template_str.'
          </div>';

	if($file_path!='')
	{
		if($create_new_file=='yes'){


			ui_write_to_file($file_path, $dash_capsule.PHP_EOL."<!--<{ncgh}/>-->");
		
		}else{

			replace_file_section($file_path, '<!--<{ncgh}/>-->', $dash_capsule.PHP_EOL."<!--<{ncgh}/>-->");
		}


	}

	$dash_template_str=$template_str;


return $dash_template_str;

}


function create_table_ui($file_path, $fileds_n_values_json, $tbl, $create_new_file, $edit_key, $plain_link, $linkcol)
{

	global $return_table_ui_str;


	$tbl_primkey=$edit_key;



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
			' <th scope="col">'.$label_node.'</th>'.PHP_EOL;

		if($plain_link=='yes'){
			if($key==$linkcol){
				$template_cell_str.=
				' <td scope="col">
				<a href="<?php echo (\'./edit'.$tbl.'.php?'.$tbl.'_uptoken=\'.base64_encode($list'.$tbl.'_result["'.$tbl_primkey.'"]));?>">
					<?php echo $list'.$tbl.'_result["'.$key.'"];?>
				</a>
				</td>'.PHP_EOL;
			}else{
				$template_cell_str.=
				' <td scope="col"><?php echo $list'.$tbl.'_result["'.$key.'"];?></td>'.PHP_EOL;

			}
		}else{
			$template_cell_str.=
				' <td scope="col"><?php echo $list'.$tbl.'_result["'.$key.'"];?></td>'.PHP_EOL;

		}

		}


	}
		if($plain_link=='yes'){
	     $drop_col_card='<td scope="col"><?php echo $i;?></td>';
	     $edit_del_drop_ui='';
	 	}else{
	     $drop_col_card='<td scope="col"><?php echo magic_dropdown($i, $dropdown_items, \'no\')?></td>';

	        $edit_del_drop_ui='$edit_drop_link=magic_link(\'./edit'.$tbl.'.php?'.$tbl.'_uptoken=\'.base64_encode($list'.$tbl.'_result["'.$tbl_primkey.'"]).\'\',\'<i class="fa fa-edit"></i> Edit\', \'\');

	        $delete_drop_link=magic_link(\'./edit'.$tbl.'.php?'.$tbl.'_uptoken=\'.base64_encode($list'.$tbl.'_result["'.$tbl_primkey.'"]).\'&delete'.$tbl.'\',\'<i class="fa fa-trash"></i> Delete\', \'\');

	        $dropdown_items =$edit_drop_link.$delete_drop_link;';

	 	}


	$return_table_ui_str='
    <div align="left" class="col-md-6">
    	<?php echo magic_button_link(\'./edit'.$tbl.'.php?newrecord\', \'<i class="fa fa-plus"></i> Add new\', \'style="display:inline-block;"\');?> 
    	<?php echo magic_button_link(\'./'.$tbl.'.php\', \'<i class="fa fa-refresh"></i> Refresh\', \'style="display:inline-block;"\');?> 

		<hr><input type="text" placeholder="Search '.str_replace("_", ' ', $tbl).'" name="txt_'.$tbl.'" class=" form-control col-md-9" style="display:inline-block; background-color:transparent; border-bottom:1px solid gray; "/>
    	<?php echo magic_button(\'q'.$tbl.'_btn\', \'Search\', \'style="display:inline-block;"\');?> 

	</div>
	<div class="table-responsive data-tables" style="background-color: #FFF; margin-top: 20px; padding-bottom: 150px;">
	<table class="table table-hover text-left" id="'.$tbl.'_data_table">
	    <thead class="text-uppercase">
		   <tr>
		    <th scope="col">#</th>
				'.$template_head_str.'
		   </tr>
	    </thead>
	    <tbody>
		<?php 
		$pagination_record_count=$'.$tbl.'_pgcount;
        $i=0;
		while($list'.$tbl.'_result=mysqli_fetch_array($'.$tbl.'_list_query)){
	        $i++;

	        '.$edit_del_drop_ui.'
        ?>
	    <tr>
	    	'.$drop_col_card.'
			'.$template_cell_str.'
	    </tr>
	    <?php }?>
	    </tbody>
	    </table>
	 <hr>
	 <?php include("./pagination.php");?>
	</div>';

	if($file_path!='')
	{
		if($create_new_file=='yes'){


			ui_write_to_file($file_path, $return_table_ui_str);
		
		}else{

			replace_file_section($file_path, '//--<{ncgh}/>', $return_table_ui_str);


		}


	}

	return $return_table_ui_str;
}

function editor_script()

{

	global $editor_script;

	$editor_script= '    
	<script src="./editor/ckeditor.js"></script>
    <script src="./editor/adapters/jquery.js"></script>

    <script type="text/javascript">
            CKEDITOR.disableAutoInline = true;

            $( document ).ready( function() {
                $( \'#editable_div_id\' ).ckeditor(); // Use CKEDITOR.inline().
            } );


    function flip_editable_div(){

        document.getElementById("editable_div_id_textbox").value=document.getElementById("editable_div_id").innerHTML;
    
    }
    </script>';

	return nl2br(htmlspecialchars($editor_script));
}

function create_side_bar($file_path, $hidden, $parent_id)
{

	global $retun_side_bar;


	$return_side_bar_str ='	
	<style>
	.mobile_bars{
		display: none;
	}


	@media screen and (max-width: 700px)
	{	

		.desk_filter
		{
			display: none;
		}
		.mobile_bars{
			display: inline-block;
		}

		.mobi_cartegory{
		display: none;
		}

	}
	</style>		
			<div class="mobile_bars" id="showfilter_bars"  onclick="document.getElementById(\'cart_tray\').style.display=\'block\'; this.style.display=\'none\'; document.getElementById(\'showfilter_bars\').style.display=\'none\';document.getElementById(\'hidefilter_bars2\').style.display=\'block\';document.getElementById(\'hidefilter_bars\').style.display=\'block\';"  style="text-align: left; font-weight: bold; font-size: 18px; padding-top: 10px; border: 0px solid red; width: 100%;">
						&#8801; View Quick Menu<hr style="margin-top: 3px;">
			</div>
			<div id="hidefilter_bars" onclick="document.getElementById(\'cart_tray\').style.display=\'none\'; this.style.display=\'none\'; document.getElementById(\'showfilter_bars\').style.display=\'inline-block\';document.getElementById(\'hidefilter_bars2\').style.display=\'none\';" style="text-align: left; font-weight: bold; font-size: 18px; padding-top: 10px; border: 0px solid red; width: 100%; display: none;">
				&#8801; Hide Menu <hr style="margin-top: 3px;">
			</div> 
			<div style="font-weight: bold; font-size: 15px; text-align: left;" class="p-2 desk_filter">Quick Menu<hr style="margin-bottom: 0px;"></div>
			<div  style="text-align: left;" class="mobi_cartegory" id="cart_tray">

			<i class="fa fa-home"></i>			
			<a href="#">Home</a>
			<hr class="mt-0">
			</div>

			<a id="hidefilter_bars2" href="#" onclick="document.getElementById(\'cart_tray\').style.display=\'none\'; this.style.display=\'none\'; document.getElementById(\'showfilter_bars\').style.display=\'inline-block\';document.getElementById(\'hidefilter_bars\').style.display=\'none\';" style="text-align: left; font-weight: bold; font-size: 18px; padding-top: 10px; border: 0px solid red; width: 100%; display: none;">
				&#8801; Hide Menu<hr style="margin-top: 3px;">
			</a> ';

			if($hidden=='yes'){
				$return_side_bar_str='
				<style>
				.side_nav_inner{
				    max-height: 500px; 
				    overflow-y: auto;
				}
				</style>
				<div id="'.$parent_id.'" class="col-md-2 bg-white mt-md-3 p-md-2 shadow-sm" style="position: fixed; z-index: 9999; display: none; border-right:5px solid orange; top:10%;">
				    <strong> Quick menu</strong>
					<span class="badge badge-danger" style="float: right; cursor: pointer;" onclick="document.getElementById(\''.$parent_id.'\').style.display=\'none\';"> X</span>
					    <div class="side_nav_inner">
					   		<hr>
						    <i class="fa fa-home"></i>			
							<a href="#">Home</a>
					    </div>
				    </div>';
			}
	if($file_path!='')
	{

		ui_write_to_file($file_path, $return_side_bar_str);

	}


	return $retun_side_bar;

}


function create_app_frmrk($appname)
{
	mkdir('../data_control/');
	mkdir('../img/');
	mkdir('../data_ui/');

	ui_write_to_file('../assets.zip', file_get_contents('https://github.com/Asanetic/phpmagicbits/raw/master/uitemplates/assets.zip'));

		$zip = new ZipArchive;
		$res = $zip->open('../assets.zip');
		if ($res === TRUE) {
		  $zip->extractTo('../');
		  $zip->close();
		  echo 'Assests Files Created!';

		  	create_navbarui($appname, './img/logo.png', '../includes/navbar.php', '');
			
			ui_write_to_file('../data_control/phpmagicbits.php', file_get_contents('https://raw.githubusercontent.com/Asanetic/phpmagicbits/master/phpmagicbits.php'));

		} else {
		  echo 'An error occured!';
		}

}


function create_accounts_ui($file_path, $login_resetrequest_updatepass_newacc)
{

	global $accounts_ui;

	$accounts_ui='<!--<{ncgh}/>-->';

if($login_resetrequest_updatepass_newacc=='newacc'){
	$accounts_ui='
<div class="col-md-12" style="text-align: center;">
	<img src="./img/logo.png" style="height: 90px;">
</div>

<!--Start system_admins Login inputs-->  


<div class="col-md-4 p-4 mt-md-5 rounded-lg shadow-sm" style="background-color: rgba(255,255,255, 0.5);  border-top: 2px solid orange;">
  <h6>Create Account</h6>
	<div class="form-group mt-3">
		<label ><i class="fa fa-user"></i> Username</label>
		<input class="form-control" id="txt_username" name="txt_username" placeholder="Username" type="text" required="">
	</div>
	<div class="form-group">
		<label ><i class="fa fa-lock"></i> Password </label>
		<input class="form-control" id="txt_password" name="txt_password" placeholder="Password" type="password" required="">
	</div>
	<div align="center" style="width: 98%">
		<?php   echo magic_button("create_acc","Proceed","");?>
		<br>
		<br>
	</div>

</div><!--<{ncgh}/>-->';
}

if($login_resetrequest_updatepass_newacc=='login'){
	$accounts_ui='
<div class="col-md-12" style="text-align: center;">
	<img src="./img/logo.png" style="height: 90px;">
</div>

<!--Start system_admins Login inputs-->  


<div class="col-md-4 p-4 mt-md-5 rounded-lg  shadow-sm" style="background-color: rgba(255,255,255, 0.5);  border-top: 2px solid orange;">
  <h6>Login to proceed</h6>
	<div class="form-group mt-3">
		<label ><i class="fa fa-user"></i> Username</label>
		<input class="form-control" id="txt_username" name="txt_username" placeholder="Username" type="text" required="">
	</div>
	<div class="form-group">
		<label ><i class="fa fa-lock"></i> Password </label>
		<input class="form-control" id="txt_password" name="txt_password" placeholder="Password" type="password" required="">
	</div>
	<div align="center" style="width: 98%">
		<?php   echo magic_button("btn_login","Proceed","");?>
		<br>
		<br>
	</div>

</div><!--<{ncgh}/>-->';
}

if($login_resetrequest_updatepass_newacc=='resetrequest'){
	$accounts_ui='
<div class="col-md-12" style="text-align: center;">
	<img src="./img/logo.png" style="height: 90px;">
</div>

<!--Start system_admins Login inputs-->  
<div class="col-md-4 p-4 mt-md-5 rounded-lg  shadow-sm" style="background-color: rgba(255,255,255, 0.5);  border-top: 2px solid orange;">
  <h6>Reset Password</h6>
	<div class="form-group mt-3">
		<label ><i class="fa fa-at"></i> Enter your Email</label>
		<input class="form-control" id="email_user" name="email_user" placeholder="Email" type="email" required="">
	</div>
	<div align="center" style="width: 98%">
		<?php   echo magic_button("requestnewpass_btn","Proceed","");?>
		<br>
		<br>
	</div>

</div><!--<{ncgh}/>-->';
}

if($login_resetrequest_updatepass_newacc=='updatepass'){
	$accounts_ui='
<div class="col-md-12" style="text-align: center;">
	<img src="./img/logo.png" style="height: 90px;">
</div>

<!--Start system_admins Login inputs-->  
<div class="col-md-4 p-4 mt-md-5 rounded-lg  shadow-sm" style="background-color: rgba(255,255,255, 0.5);  border-top: 2px solid orange;">
  <h6>Change Password</h6>
	<div class="form-group mt-3">
		<label ><i class="fa fa-lock"></i> New Password</label>
		<input class="form-control" id="email_user" name="email_user" placeholder="Enter New Password<" type="text" required="">
	</div>
	<div class="form-group mt-3">
		<label ><i class="fa fa-lock"></i> Confirm New Password</label>
		<input class="form-control" id="email_user" name="email_user" placeholder="Confirm New Password" type="text" required="">
	</div>
	<div align="center" style="width: 98%">
		<?php   echo magic_button("changepass_btn","Proceed","");?>
		<br>
		<br>
	</div>

</div><!--<{ncgh}/>-->';
}



	if($file_path!='')
	{

		replace_file_section($file_path, '<!--<{ncgh}/>-->', $accounts_ui);

	}

}

function fend_help()
{
	$help_functions='
	
	//_ _ _create app frame

 	create_appframe($page_title, $navbar_path, $footer_path, $header_css_scripts, $newfile_name, $background_image_path, $template_path);


 	//---create navigation bar file from template

 	create_navbarui($appname, $app_logo_path, $newfile_name, $template_path);

	//create bootstrap form 

	create_magic_form($write_to_path,  $fileds_n_values_json, $tbl, $rows_per_grid, $grid_class, $elements_plate, $ui_comment);

	//====create bootstrap table 

	create_table_ui($file_path, $fileds_n_values_json, $tbl, $create_new_file, $edit_key, $plain_link, $linkcol);

 	//clone any file or write a file

 	ui_write_to_file($file_path, $new_content_to_write);

 	//ck editor script library

 	echo editor_script();

 	//===== create side bar

	create_side_bar($file_path, $hidden, $parent_id);

	//create dash board

	create_dash_icons($icon_title_json, $col_class, $file_path, $create_new_file);
 	
 	//=============Create app frame work 

 	create_app_frmrk($appname);

	//==== create login reset passwrod and create acc ui

	create_accounts_ui($file_path, $login_resetrequest_updatepass_newacc);
 	';


	return nl2br($help_functions);
}



?>
