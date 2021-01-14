<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Mobile simulator</title>
<style type="text/css">
	.desk_iframe{
		position: fixed;
		top: 31px;
		right: 22px;
		width: 96%;
		height: 79vh;
		border: none;
    }


    .screen_frame{
    	width: 100%;
    	height: 116vh;
    }
    .mobi_iframe {
    	position: fixed;
    	top: 150px;
    	left: 13px;
    	width: 320px;
    	height: 77vh;
    	border: none;
    	border-radius: 0px;
    }
    .mobi_screen_frame {
    	width: 338px;
    	    height: 88vh;
    	    position: fixed;
    	    left: 4px;
    	    top: 101px;
    	    border-radius: 60px;
    }
	
	.bottom_tray{
	position: fixed;
    bottom: 0px;
    right: 10px;
    margin: 10px;
    width: 30%;
	}
	.go_btn{
    padding: 10px;
    background-color: darkblue;
    display: inline-block;
    cursor: pointer;
    color: #FFF;
    border-radius: 9px;
    width: 10%;

	}
	.txt_url{
	border: 0px;
    border-bottom: 1px solid #CCC;
    padding: 9px;
    background-color: rgba(0,0,0,0.3);
    color: #FFF;
    width: 80%;
    display: inline-block;
	}
	input[type="text"]:focus{
		outline:0!important;
	}
	.minimized_mobi{
		position: fixed;
	    left: 5px;
	    bottom: 0px;
	    background-color: rgba(0,0,0,0.6);
	    width: 20%;
	    padding: 10px;
	    text-align: right;
	    border-top: 2px solid #FFF;
	    border-radius: 9px;
	    color: #fff;
	    display: none;
	    cursor: pointer;

	}
	.close_mobile_view{
		position: fixed;
		left: 150px;
		bottom: 6px;
		padding: 5px;
		border: 2px solid #fff;
		border-radius: 50%;
		height: 10px;
		width: 10px;
		line-height: 11px;
		padding-right: 6px;
		font-family: arial;
		cursor: pointer;
		background-color: #ccc;
		box-shadow: 1px 9px 12px 2px lightgrey;
	}
@media screen and (max-width: 700px) {
	.desk_iframe {
	position: fixed;
    top: 43px;
    right: 7px;
    width: 94%;
    height: 85vh
    }
    .screen_frame{
    	width: 100%;
	    height: 105vh;
	    position: fixed;
	    right: 0px;
	    top: -18px;  
    }
	
	.bottom_tray{
	position: fixed;
    top: auto;
    bottom: 0px;
    right: 41px;
    margin: 10px;
	}
}

</style>
<div style="text-align: center;">
	<img src="./deskfull.png" class="screen_frame">
	<iframe src="http://localhost/asanetic/projects/gradewhizz/home_clients" class="desk_iframe"  id="load_desk_iframe" onLoad="change_scroll_bar();"></iframe>
	<img src="./mobiview2.png" class="mobi_screen_frame" id="mobile_screen">
	<div class="close_mobile_view" onclick="close_mobile_view();this.style.display='none'" id="close_mobile_view_btn" title="Close Mobile View">X</div>
	<iframe src="http://localhost/asanetic/projects/gradewhizz/home_clients" class="mobi_iframe"  id="load_mobi_iFrame" onLoad="change_scroll_bar();"></iframe>
	<div class="bottom_tray">
		<input type="text" id="iframeurl" placeholder="Url to show" class="txt_url">
		<div class="go_btn" onclick="loadwebpage()">Go</div>
	</div>
	<div class="minimized_mobi" id="minimized_mobi_div" title="Show Mobile View" onclick="show_mobi(); this.style.display='none'" >
		[Show Mobile View]
	</div>

</div>

<script type="text/javascript">
function show_mobi()
{
document.getElementById("load_mobi_iFrame").style.display='block';
document.getElementById("mobile_screen").style.display='block';
document.getElementById("close_mobile_view_btn").style.display='block';
}

function close_mobile_view()
{
document.getElementById("load_mobi_iFrame").style.display='none';
document.getElementById("mobile_screen").style.display='none';
document.getElementById("minimized_mobi_div").style.display='block';
}


	window.onload =change_scroll_bar();

	function change_scroll_bar(){
		var scrollbar_style='<style type="text/css">/* width */::-webkit-scrollbar {width: 4px;box-shadow: 2px 2px 3px 3px lightgray;}/* Track */::-webkit-scrollbar-track {background: #FFF; }/* Handle */::-webkit-scrollbar-thumb {background: green; border-radius: 90px;}/* Handle on hover */::-webkit-scrollbar-thumb:hover {background: #000; }</style>';

		let desk_frameElement = document.getElementById("load_desk_iframe");
		let mobi_frameElement = document.getElementById("load_mobi_iFrame");

		let desk_doc = desk_frameElement.contentDocument;
		let mobi_doc = mobi_frameElement.contentDocument;

		desk_doc.head.innerHTML = scrollbar_style+desk_doc.head.innerHTML;
		mobi_doc.head.innerHTML = scrollbar_style+mobi_doc.head.innerHTML;
	 
	 }

	 function loadwebpage()
	 {
	 	document.getElementById('load_desk_iframe').src=document.getElementById('iframeurl').value;
	 	document.getElementById('load_mobi_iFrame').src=document.getElementById('iframeurl').value;
	 }
</script>