
<title>Mobile simulator</title>
<style type="text/css">
	.frame{
	position: fixed;
    top: 48px;
    right: 473px;
    width: 369px;
    height: 85vh;
    scroll-behavior:
    }
    .mobil_frame{
    	width: 31%;
	    height: 105vh;
	    position: fixed;
	    right: 36%;
	    top: -18px;  
    }
	
	.bottom_tray{
	position: fixed;
    top: 0px;
    right: 10px;
    margin: 10px;
	}
	.go_btn{
		padding: 10px;
		background-color: darkblue;
		display: inline-block;
		cursor: pointer;
		color: #FFF;

	}
	.txt_url{
		border: 0px;
		border-bottom: 1px solid #CCC;
		padding: 9px;
	}
	input[type="text"]:focus{
		outline:0!important;
	}


</style>
<div style="text-align: center;">
	<img src="./mobiview.png" class="mobil_frame">
	<iframe src="http://localhost/asanetic/projects/gradewhizz/home_clients" class="frame"  id="myiFrame"></iframe>
	<div class="bottom_tray">
		<input type="text" id="iframeurl" placeholder="Url to show" class="txt_url">
		<div class="go_btn" onclick="loadwebpage()">Go</div>
	</div>
</div>

<script type="text/javascript">
	window.onload = function() 
	{ 
		var scrollbar_style='<style type="text/css">/* width */::-webkit-scrollbar {width: 4px;box-shadow: 2px 2px 3px 3px lightgray;}/* Track */::-webkit-scrollbar-track {background: #FFF; }/* Handle */::-webkit-scrollbar-thumb {background: green; border-radius: 90px;}/* Handle on hover */::-webkit-scrollbar-thumb:hover {background: #000; }</style>';

		let frameElement = document.getElementById("myiFrame");
		let doc = frameElement.contentDocument;
		//let doc_body =document 
		doc.head.innerHTML = scrollbar_style+doc.head.innerHTML;
	 
	 }

	 function loadwebpage()
	 {
	 	document.getElementById('myiFrame').src=document.getElementById('iframeurl').value;
	 }
</script>