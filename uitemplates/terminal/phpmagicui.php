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
         <div style="text-align: center; ">
    		<?php if(isset($_GET[\'table_alert\'])) echo magic_toast(\'Success\', $_GET[\'table_alert\'], \'darkgreen\', \'#FFF\'); ?>
    	</div>
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
       <div style="text-align: center; ">
    		<?php if(isset($_GET[\'table_alert\'])) echo magic_toast(\'Success\', $_GET[\'table_alert\'], \'darkgreen\', \'#FFF\'); ?>
    	</div>
    	<?php echo magic_button_link(\'./edit'.$tbl.'.php?newrecord\', \'<i class="fa fa-plus"></i> Add new\', \'style="display:inline-block;"\');?> 
    	<?php echo magic_button_link(\'./'.$tbl.'.php\', \'<i class="fa fa-refresh"></i> Refresh\', \'style="display:inline-block;"\');?> 

		<hr><input type="text" placeholder="Search '.str_replace("_", ' ', $tbl).'" name="txt_'.$tbl.'" class=" form-control col-md-9" style="display:inline-block; background-color:transparent; border-bottom:1px solid gray; "  autofocus="" />
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

function create_slideshow($file_path)
{

	$carousel_str= '
<!--------------- Start carousel ---------->
<div id="carouselExampleCaptions" class="carousel slide w-100" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./img/ss1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./img/ss2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./img/ss3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!--------------- End carousel ---------->
<!--<{ncgh}/>-->';

	if($file_path!='')
	{

		replace_file_section($file_path, '<!--<{ncgh}/>-->', $carousel_str);

	}
}


function  install_pdf()
{
	ui_write_to_file('../tcpdf.zip', file_get_contents('https://github.com/Asanetic/phpmagicbits/raw/master/uitemplates/tcpdf.zip'));

		$zip = new ZipArchive;
		$res = $zip->open('../tcpdf.zip');
		if ($res === TRUE) {
		  $zip->extractTo('../');
		  $zip->close();
		  echo 'TCPDF Folder Created!';

		} else {
		  echo 'An error occured!';
		}

}


function clone_module($original_module, $new_name, $create_list, $create_profile, $create_cruds)
{
	if($create_cruds=='yes'){

	//clone cruds 

	ui_write_to_file('../data_control/'.$new_name.'.php', file_get_contents('../data_control/'.$original_module.'.php'));
	
	}

	if($create_list=='yes'){

	//clone listing 

	ui_write_to_file('../data_ui/'.$new_name.'.php', file_get_contents('../data_ui/'.$original_module.'.php'));

	ui_write_to_file('../'.$new_name.'.php', file_get_contents('../'.$original_module.'.php'));
	

	//==== replace include cruds 

	replace_file_section('../'.$new_name.'.php', './data_control/'.$original_module.'.php', './data_control/'.$new_name.'.php');

		//==== replace include cruds 

	replace_file_section('../'.$new_name.'.php', './data_ui/'.$original_module.'.php', './data_ui/'.$new_name.'.php');

	
	}

	if($create_profile=='yes'){

	//clone profile 

	ui_write_to_file('../edit'.$new_name.'.php', file_get_contents('../edit'.$original_module.'.php'));
	
	//==== replace include cruds 

	replace_file_section('../edit'.$new_name.'.php', './data_control/'.$original_module.'.php', './data_control/'.$new_name.'.php');

	
	}
}


function create_pdf_frame($title, $file_path, $sub_headers)
{
$pdflist_ui='<?php
ob_start();
include("./data_control/conn.php"); 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$buttonclr="#007bff";

$logoimg="./img/bg.jpg";

$logohead2="./img/logo.png";

$image = imagecreatefrompng($logohead2);
$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
imagealphablending($bg, TRUE);
imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
imagedestroy($image);
$quality = 50; 
imagejpeg($bg, $logohead2.".jpg", $quality);
imagedestroy($bg);

$logohead3= $logohead2.".jpg";
$splithex = str_split(str_replace("#","",$buttonclr), 2);
$r = hexdec($splithex[0]);
$g = hexdec($splithex[1]);
$b = hexdec($splithex[2]);
$lineclr=$r . ", " . $g . ", " . $b;


$arrayclr = explode(\',\', $lineclr);



// Include the main TCPDF library (search for installation path).
require_once("./tcpdf/tcpdf.php");

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, \'UTF-8\', false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, \'\', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, \'\', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
 $pdf->setImageScale(1.53);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).\'/lang/eng.php\')) {
    require_once(dirname(__FILE__).\'/lang/eng.php\');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// ---------------------------------------------------------

// set font
$pdf->SetFont(\'helvetica\', \'B\', 12);

// add a page
$pdf->AddPage();
$style5 = array(\'width\' => 0.25, \'color\' => array($r,$g,$b));
$style4 = array(\'width\' => 0.25, \'cap\' => \'butt\', \'join\' => \'miter\', \'dash\' => 0, \'color\' => array($r,$g,$b));

//print_r($splithex);
// Line
$pdf->Line(200, 200, 200, 30, $style4);

// Circle and ellipse
$pdf->SetLineStyle($style4);
$pdf->Circle(199,120,2);
$pdf->Circle(192,120,8);
$pdf->Circle(205,100,8);
$pdf->Circle(205,100,20);
$pdf->Circle(195,150,8);

// set alpha to semi-transparency
$pdf->SetAlpha(0.1);
//===================== params =====================================


$bus_name="'.$title.'";
$bus_email="";
$bus_tel="";
$sub_headers="'.$sub_headers.'";
//===================== params =====================================
$pdf->Image($logoimg, 0, 0, 260, 297, \'\', \'\', \'\', false, 300, \'\', false, false, 0);
$pdf->Line(200, 200, 200, 30, $style5);

//Start Graphic Transformation
// set bacground image
$pdf->SetAlpha(1);

$pdf->StartTransform();
$pdf->StarPolygon(106, 26, 9, 25, 3, 0, 1, \'CNZ\');
$pdf->Image($logohead3, 96, 16, 20, 20, \'\',\'\', \'\', false, 0, \'\', false, false, 0, false, false, false);

$pdf->StopTransform();

$pdf->Ln(10);
$pdf->Write(0, $bus_name, \'\', 0, \'C\', 1, 0, false, false, 0);
$pdf->SetFont(\'helvetica\', \'\', 10);
$pdf->Ln(3);
$pdf->Write(0, $sub_headers, \'\', 0, \'C\', 1, 0, false, false, 0);
$pdf->Ln(10);


$pdf->SetFont(\'helvetica\', \'b\', 10);
$pdf->Line(200, 200, 200, 30, $style4);

$pdf->writeHTML(\'<div align="left"> '.$title.'<hr/></div>\', true, false, false, false, \'C\');

$pdf->SetFont(\'helvetica\', \'\', 8);




// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output(\''.$title.'.pdf\', \'I\');

//============================================================+
// END OF FILE
//============================================================+

?>';

	if($file_path!='')
	{

		ui_write_to_file($file_path, $pdflist_ui);

	}
}

function btstrp_grid($file_path, $writehere, $bootclasses, $additions, $container, $create_new_file)
{
	
	global $btstrp_grid;

	$btstrp_grid='
	<'.$container.' class="'.$bootclasses.'" '.$additions.'>
		'.$writehere.'
	</'.$container.'>';


	if($file_path!='')
	{

		if($create_new_file=='yes'){

		ui_write_to_file($file_path, $btstrp_grid);

		}else{

		replace_file_section($file_path,  $writehere, $btstrp_grid);

		}

	}

	return $btstrp_grid;

}


function fend_help()
{
$help_functions='

<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

//_ _ _create app frame

create_appframe($page_title, $navbar_path, $footer_path, $header_css_scripts, $newfile_name, $background_image_path, $template_path);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >


//---create navigation bar file from template

create_navbarui($appname, $app_logo_path, $newfile_name, $template_path);
</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >

//create bootstrap form 

create_magic_form($write_to_path,  $fileds_n_values_json, $tbl, $rows_per_grid, $grid_class, $elements_plate, $ui_comment);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//====create bootstrap table 

create_table_ui($file_path, $fileds_n_values_json, $tbl, $create_new_file, $edit_key, $plain_link, $linkcol);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//clone any file or write a file

ui_write_to_file($file_path, $new_content_to_write);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//ck editor script library

echo editor_script();

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//===== create side bar

create_side_bar($file_path, $hidden, $parent_id);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//create dash board

create_dash_icons($icon_title_json, $col_class, $file_path, $create_new_file);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//=============Create app frame work 

create_app_frmrk($appname);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//==== create login reset passwrod and create acc ui

create_accounts_ui($file_path, $login_resetrequest_updatepass_newacc);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//==========create pdf frame==============

create_pdf_frame($title, $file_path, $sub_headers);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//=============== create pdf folder

install_pdf();

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//================clone modules

clone_module($original_module, $new_name, $create_list, $create_profile, $create_cruds);

</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//============= Create  carousel

create_slideshow($file_path)
</div>
<div class="function_card" onclick="load_to_editor(this.innerHTML)" >
//============= Create  bootstrap container
btstrp_grid($file, $writehere, $bootclasses, $additions, $container, $create_new_file);
</div>
';



	return nl2br($help_functions);
}
?>
