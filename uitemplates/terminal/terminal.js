function get_live_date(){

var getcurr_date =new Date();

var live_execution_time =getcurr_date.getHours()+" : "+getcurr_date.getMinutes()+":"+getcurr_date.getSeconds();

return live_execution_time;
}

var execution_time = get_live_date();

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


 function loadwebpage()
 {
 	document.getElementById('load_desk_iframe').src=document.getElementById('iframeurl').value;
 	document.getElementById('load_mobi_iFrame').src=document.getElementById('iframeurl').value;
 }

 function execute_terminal()
 {

	var txt_directory = document.getElementById("txt_directory").value;
	var txt_new_code = document.getElementById("txt_new_code").value;

	if(txt_new_code=='clearthis'){
		 
		document.getElementById('txt_new_code').value='';

	}else if(txt_new_code=='clearlog'){
		document.getElementById('log_window').innerHTML='';

	}else{

	document.getElementById('log_window').innerHTML= '<span style="font-size:18px;">@ '+execution_time+' Begin execution...</span>'+'<hr style="border : 1px solid #7f7e7e">'+document.getElementById('log_window').innerHTML;

      $.ajax({ 
      url: './ajaxexe.php',
      type: "POST",
      data: {
        'execute_terminal':'ok',
        'txt_directory':txt_directory,
        'txt_new_code':txt_new_code,
      },

      success: function (data) {

      	var remove_exec = document.getElementById('log_window').innerHTML+'<span style="font-size:18px;">  @ '+execution_time+' End execution...</span>';

		 document.getElementById('log_window').innerHTML= data+'<hr style="border : 1px solid #7f7e7e">'+remove_exec;

		 //alert(data);

      }

  })
  }

}

function load_file()
{
 
 var  txt_writeto = document.getElementById('txt_writeto').value;

    $.ajax({ 
      url: './ajaxexe.php',
      type: "POST",
      data: {
        'load_file':'ok',
        'txt_writeto':txt_writeto
      },

      success: function (data) {

      	var remove_exec = document.getElementById('log_window').innerHTML+'<span style="font-size:18px;">  @ '+execution_time+' End execution...</span>';

		 document.getElementById('txt_new_code').value=data;

		 //alert(data);

      }

  })
}


function save_file()
{
 
 var  txt_writeto = document.getElementById('txt_writeto').value;
 var  txt_new_code = document.getElementById('txt_new_code').value;

	document.getElementById('log_window').innerHTML= '<span style="font-size:18px;">@ '+execution_time+' Begin execution...</span>'+'<hr style="border : 1px solid #7f7e7e">'+document.getElementById('log_window').innerHTML;

    $.ajax({ 
      url: './ajaxexe.php',
      type: "POST",
      data: {
        'save_file':'ok',
        'txt_writeto':txt_writeto,
        'txt_new_code':txt_new_code
      },

      success: function (data) {

      	var remove_exec = document.getElementById('log_window').innerHTML+'<span style="font-size:18px;">  @ '+execution_time+' End execution...</span>';

		 alert(data);

      }

  })
}

function pop_snippet()
{

var snippet_bar ='<div class="">'+
'<h5>Snippet Manager<hr></h5>'+
'<div>'+
'<div style="width:100%; padding-top:6px;"><input class="input_widget" type="text" id="snippet_title" autocomplete="off"  placeholder="Snippet Title">'+
'<div class="exe_btn" onclick="add_snippet()">Add</div></div>'+
'<div style="width:100%; padding-top:6px;"><input class="input_widget" id="qsnippet" style="width:100%;" autocomplete="off" placeholder="Search Snippet" onkeyup="qsnippet(this.value)"></div>'+
'</div>'+
'<div id="qsnippet_result" style="width:100%; padding-top:8px; " class="snippres"></div>'+
'<br><br><a href="./snippetlisting.php" target="_blank" class="text-white m-4">View All</a><br><br>'+
'</div>';

magic_screen(snippet_bar, 'alert_box');

document.getElementById('qsnippet').focus();

}

function qsnippet(qasn_snippets)
{

    $.ajax({ 
      url: './ajaxexe.php',
      type: "POST",
      data: {
        'qasn_snippets_btn':'ok',
        'qasn_snippets':qasn_snippets
      },

      success: function (data) {

      	document.getElementById('qsnippet_result').innerHTML=data;
		 //alert(data);

      }

  })
}
function add_snippet()
{

 var  snippet_title = document.getElementById('snippet_title').value;
 var  txt_new_code = document.getElementById('txt_new_code').value;

	document.getElementById('log_window').innerHTML= '<span style="font-size:18px;">@ '+execution_time+' Begin execution...</span>'+'<hr style="border : 1px solid #7f7e7e">'+document.getElementById('log_window').innerHTML;

if(snippet_title!=''){
    $.ajax({ 
      url: './ajaxexe.php',
      type: "POST",
      data: {
        'asn_snippets_insert_btn':'ok',
        'txt_snippet_title':snippet_title,
        'txt_snippet_details':txt_new_code
      },

      success: function (data) {

      	var remove_exec = document.getElementById('log_window').innerHTML+'<span style="font-size:18px;">  @ '+execution_time+' End execution...</span>';

		 alert(data);

      }

  })
}else{
	alert('add Snippet Title');
}

}


function load_to_editor(content)
{
	var strip_br = content.replace(/<br\s*\/?>/mg,"");

	document.getElementById('txt_new_code').value=document.getElementById('txt_new_code').value+strip_br;
	document.getElementById('txt_new_code').focus();
	document.getElementById('msg_alert_myModal').style.display='none'; 

}

function showeditor(){

 document.getElementById('hideeditor').style.display='inline-block'; 
 document.getElementById('txt_new_code').style.display='inline-block';
 document.getElementById('parent_log_window').style.display='inline-block';
  document.getElementById('txt_new_code').focus();
}

function hideeditor(){

 document.getElementById('showeditor').style.display='inline-block';  
 document.getElementById('txt_new_code').style.display='none';
 document.getElementById('parent_log_window').style.display='none';

}


document.getElementById('txt_new_code').addEventListener('keydown', function (e){
    // Do your key combination detection

        if(e.altKey  && e.keyCode=='69'){
            e.preventDefault();

            execute_terminal();
        }

        if(e.altKey  && e.keyCode=='83'){
            e.preventDefault();

            document.getElementById('function_card').focus();
        }

        if(e.altKey  && e.keyCode=='67'){
            e.preventDefault();

            document.getElementById('txt_new_code').focus();
        }

        if(e.altKey  && e.keyCode=='78'){
            e.preventDefault();

 			pop_snippet();
         }
  if(e.keyCode=='9'){

    var start = this.selectionStart;
    var end = this.selectionEnd;

    // set textarea value to: text before caret + tab + text after caret
    this.value = this.value.substring(0, start) +
      "\t" + this.value.substring(end);

    // put caret at right position again
    this.selectionStart =
      this.selectionEnd = start + 1;
  }


}, false);


//Make the DIV element draggagle:
dragElement(document.getElementById("parent_log_window"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}


var element = document.getElementById('parent_log_window');
var resizer = document.createElement('div');
resizer.className = 'resizer';
resizer.style.width = '10px';
resizer.style.height = '10px';
resizer.style.background = 'red';
resizer.style.position = 'absolute';
resizer.style.right = 0;
resizer.style.bottom = 0;
resizer.style.cursor = 'se-resize';
element.appendChild(resizer);
resizer.addEventListener('mousedown', initResize, false);

function initResize(e) {
   window.addEventListener('mousemove', Resize, false);
   window.addEventListener('mouseup', stopResize, false);
}
function Resize(e) {
   element.style.width = (e.clientX - element.offsetLeft) + 'px';
   element.style.height = (e.clientY - element.offsetTop) + 'px';
}
function stopResize(e) {
    window.removeEventListener('mousemove', Resize, false);
    window.removeEventListener('mouseup', stopResize, false);
}


function search_log() {
  var input = document.getElementById("function_card");
  var filter = input.value.toLowerCase();
  var nodes = document.getElementsByClassName('function_card');

if(input.value=='clearlog'){

	document.getElementById('log_window').innerHTML='';
}else{
  for (i = 0; i < nodes.length; i++) {
    if (nodes[i].innerText.toLowerCase().includes(filter)) {
      nodes[i].style.display = "block";
    } else {
      nodes[i].style.display = "none";
    }
  }
}
     $("#parent_log_window").html(function(_, html){
        html.replace(filter, '<span style="color:#FFF; background-color:red;">'+filter+'</span>');   
     });
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
