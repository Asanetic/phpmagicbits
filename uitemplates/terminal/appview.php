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
    <input type="text" id="mainsearch" style="font-size: 12px; width: 15%; background-color: #000; color:#FFF; border: none; display: inline-block; padding-left: 2px;" value="Search" required="" placeholder=" Search System" onkeyup='loop_folder(this.value); trigger_log_search(this.value);flag_search(this.value)'>
	<div class="exe_btn" onclick="execute_terminal();">Php Execute</div>

	<div class="exe_btn" onclick="pop_snippet();">Snippets</div>
    <input type="hidden" style="font-size: 12px; width: 15%; background-color: #000; color:#FFF; border: none; display: inline-block; padding-left: 2px;" value="<?php if(isset($_POST['txt_directory'])){ echo $_POST['txt_directory'];}else{ echo "./terminal_exe.php";}?>" name="txt_directory" id="txt_directory" required="" placeholder=" Enter exe file path">

	<div class="exe_btn" onclick="load_file();">Load File</div>
    <input type="text" style="font-size: 12px; width: 15%; background-color: #000; color:#FFF; border: none; display: inline-block; padding-left: 2px;" value="<?php if(isset($_POST['txt_writeto'])){ echo $_POST['txt_writeto'];}else{ echo "./txt_writeto.php";}?>" id="txt_writeto" name="txt_writeto" required="" placeholder=" Enter writable file path" onkeyup='loop_folder(this.value); trigger_log_search(this.value)'>
	<div class="exe_btn" id="showeditor" onclick="this.style.display='none';showeditor()">Show Editor</div>

	<div class="exe_btn" id="hideeditor" style="display: none;" onclick="this.style.display='none';hideeditor();">Hide Editor</div>
	<a href="#" class="exe_btn"  onclick="pop_new_instance()">New Instance</a>
	<a href="./appview" class="exe_btn">Reload</a>
	<div class="exe_btn" onclick="save_file()">Save File</div>
</div>

<div class="log_window" id="parent_log_window" style="display: none;" >
<div id="parent_log_windowheader" style="border:1px solid #FFF; cursor: move;">
< Drag >
</div>
<div style="padding:10px; font-size: 28px; display: none;" onclick="this.style.display='none'" id="notification_card">Notifications</div>

<input type="text" style="font-size: 12px; width: 100%; background-color: #000; color:#FFF; border: none; display: inline-block; padding-left: 2px; margin-top: 5px; padding: 5px;" onkeyup="search_log()" required="" id="function_card" placeholder=" Search Window"  autocomplete="off">

<input type="text" id="folderpath" style="font-size: 12px; width: 100%; background-color: #000; color:#FFF; border: none; display: inline-block; padding-left: 2px; margin-top: 5px; padding: 5px;" onkeyup="loop_folder(this.value)" required="" placeholder="Search Folders"  autocomplete="off">


<textarea id="append_text" style="background-color: #000; width: 100%; color: #FFF; height: 20px; margin-top: 10px;" placeholder="Append Text here"></textarea>

<div id="log_window" style="max-height: 300px; overflow-y: auto; margin-top: 12px;"></div>

</div>

<textarea class="editor_skin" id="txt_new_code" onkeyup="" style="display: none;"  ></textarea>
<div onclick="this.style.display='none'" id="flag_search_div" style="position: fixed;
    bottom: 20px;
    left: 400px;
    display: none;
    padding: 20px;
    background-color: #000; color: #FFF; max-height: 200px; overflow-y: auto; text-align: left;">
</div>
<input type="hidden" style="position: fixed; bottom: 72px; right: 20px; width: 70%; background-color: rgba(0,0,0, 0.9); z-index: 999; color: #FFF;" id="flag_search" name="">
<input type="hidden" style="position: fixed; bottom: 72px; right: 20px; width: 40%; background-color: rgba(0,0,0, 0.9); z-index: 999; color: #FFF;" id="trigger_arrow_keys" name="">

<!--End editor-->

</div>
<div id="alert_box"></div>

<script type="text/javascript" src="./jquery.js"></script>
<script type="text/javascript" src="./terminal.js"></script>
<script type="text/javascript" src="./jsfunctions.js"></script>