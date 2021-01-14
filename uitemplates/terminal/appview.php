<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="./terminal.css">
<title>Terminal</title>

<div style="text-align: center;">
	<img src="./deskfull.png" class="screen_frame">
	<iframe src="./index" class="desk_iframe"  id="load_desk_iframe" onLoad="change_scroll_bar();"></iframe>
	<img src="./mobiview2.png" class="mobi_screen_frame" id="mobile_screen">
	<div class="close_mobile_view" onclick="close_mobile_view();this.style.display='none'" id="close_mobile_view_btn" title="Close Mobile View">X</div>
	<iframe src="./index" class="mobi_iframe"  id="load_mobi_iFrame" onLoad="change_scroll_bar();"></iframe>
	<div class="bottom_tray">
		<input type="text" id="iframeurl" placeholder="Url to show" class="txt_url">
		<div class="go_btn" onclick="loadwebpage()">Go</div>
	</div>
	<div class="minimized_mobi" id="minimized_mobi_div" title="Show Mobile View" onclick="show_mobi(); this.style.display='none'" >
		[Show Mobile View]
	</div>
<!--Start editor-->
<div class="navbar_ribbon">
	<div class="exe_btn" onclick="pop_snippet();">Snippets</div>
	<div class="exe_btn" onclick="execute_terminal();">Php Execute</div>
    <input type="text" style="font-size: 12px; width: 15%; background-color: #000; color:#FFF; border: none; display: inline-block; padding-left: 2px;" value="<?php if(isset($_POST['txt_directory'])){ echo $_POST['txt_directory'];}else{ echo "./terminal_exe.php";}?>" name="txt_directory" id="txt_directory" required="" placeholder=" Enter exe file path">

	<div class="exe_btn" onclick="load_file();">Load File</div>
    <input type="text" style="font-size: 12px; width: 15%; background-color: #000; color:#FFF; border: none; display: inline-block; padding-left: 2px;" value="<?php if(isset($_POST['txt_writeto'])){ echo $_POST['txt_writeto'];}else{ echo "./txt_writeto.php";}?>" id="txt_writeto" name="txt_writeto" required="" placeholder=" Enter writable file path">
	<div class="exe_btn" id="showeditor" onclick="this.style.display='none';showeditor()">Show Editor</div>

	<div class="exe_btn" id="hideeditor" style="display: none;" onclick="this.style.display='none';hideeditor();">Hide Editor</div>
	<a href="#" class="exe_btn"  onclick="window.open('./appview', 'newwindow', 'width=1300,height=900'); 
              return false;">New Instance</a>
	<a href="./appview" class="exe_btn">Reload</a>
	<div class="exe_btn" onclick="save_file()">Save File</div>
</div>

<div class="log_window" id="parent_log_window" style="display: none;" >
<div id="parent_log_windowheader" style="border:1px solid #FFF; cursor: move;">
< Drag >
</div>
<input type="text" style="font-size: 12px; width: 100%; background-color: #000; color:#FFF; border: none; display: inline-block; padding-left: 2px; margin-top: 5px; padding: 5px;" onkeyup="search_log()" required="" id="function_card" placeholder=" Enter writable file path">
<textarea style="background-color: #000; width: 100%; color: #FFF; height: 60px; margin-top: 10px;" placeholder="Append Text here"></textarea>
<div id="log_window" style="max-height: 300px; overflow-y: auto; margin-top: 12px;"></div>

</div>

<textarea class="editor_skin" id="txt_new_code" style="display: none;"  ></textarea>
<!--End editor-->

</div>
<div id="alert_box"></div>

<script type="text/javascript" src="./jquery.js"></script>
<script type="text/javascript" src="./terminal.js"></script>
<script type="text/javascript" src="./jsfunctions.js"></script>