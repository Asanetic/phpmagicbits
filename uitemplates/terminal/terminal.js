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

  document.getElementById('log_window').innerHTML= document.getElementById('log_window').innerHTML;

      $.ajax({ 
      url: './ajaxexe.php',
      type: "POST",
      data: {
        'execute_terminal':'ok',
        'txt_directory':txt_directory,
        'txt_new_code':txt_new_code,
      },

      success: function (data) {

        var remove_exec = document.getElementById('log_window').innerHTML;

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

        var remove_exec = document.getElementById('log_window').innerHTML;

     document.getElementById('txt_new_code').value=data;

     //alert(data);

      }

  })
}


function save_file()
{
 
 var  txt_writeto = document.getElementById('txt_writeto').value;
 var  txt_new_code = document.getElementById('txt_new_code').value;

  document.getElementById('log_window').innerHTML=document.getElementById('log_window').innerHTML;

    $.ajax({ 
      url: './ajaxexe.php',
      type: "POST",
      data: {
        'save_file':'ok',
        'txt_writeto':txt_writeto,
        'txt_new_code':txt_new_code
      },

      success: function (data) {

        var remove_exec = document.getElementById('log_window').innerHTML;

        document.getElementById('notification_card').style.display='block';
        document.getElementById('notification_card').innerHTML=data;

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
'<textarea class="snippet_card" id="txt_snippet_details" placeholder="Snippet Details"></textarea>'+
'<br><br><a href="./snippetlisting.php" target="_blank" class="text-white m-4">View All</a><br><br>'+
'</div>';

magic_screen(snippet_bar, 'alert_box');

document.getElementById('qsnippet').focus();

}

function pop_new_snippet()
{

var snippet_bar ='<div class="">'+
'<h5>Snippet Manager<hr></h5>'+
'<div>'+
'<div style="width:100%; padding-top:6px;"><input class="input_widget" type="text" id="snippet_title" autocomplete="off"  placeholder="Snippet Title">'+
'<div class="exe_btn" onclick="add_snippet()">Add</div></div>'+
'<div style="width:100%; padding-top:6px;"><input class="input_widget" id="qsnippet" style="width:100%;" autocomplete="off" placeholder="Search Snippet" onkeyup="qsnippet(this.value)"></div>'+
'</div>'+
'<div id="qsnippet_result" style="width:100%; padding-top:8px; " class="snippres"></div>'+
'<textarea class="snippet_card" id="txt_snippet_details" placeholder="Snippet Details"></textarea>'+
'<br><br><a href="./snippetlisting.php" target="_blank" class="text-white m-4">View All</a><br><br>'+
'</div>';

magic_screen(snippet_bar, 'alert_box');

document.getElementById('snippet_title').focus();

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


function flag_search(qasn_snippets)
{
  if(qasn_snippets!=''){
     document.getElementById('flag_search').value="@"+qasn_snippets;
    $.ajax({ 
      url: './ajaxexe.php',
      type: "POST",
      data: {
        'flag_search':'ok',
        'qasn_snippets':qasn_snippets
      },

      success: function (data) {
        if(data!='')
        {
        document.getElementById('flag_search_div').style.display='inline-block';
        document.getElementById('flag_search_div').innerHTML=data;
        document.getElementById('trigger_arrow_keys').value='trigger_arrow_keys';
        }else{
        document.getElementById('flag_search_div').style.display='none';
        document.getElementById('trigger_arrow_keys').value='untrigger_arrow_keys';
        }

     //alert(data);

      }

  })

  }
}


function pop_new_instance()
{

  window.open('./appview', 'newwindow', 'width=1300,height=900'); 
              return false;
              
}


function loop_folder(folder)
{

    $.ajax({ 
      url: './ajaxexe.php',
      type: "POST",
      data: {
        'loop_folder':'ok',
        'folder':folder
      },

      success: function (data) {
          if(data=='DNF'){
        //document.getElementById('notification_card').style.display='block';
        //document.getElementById('notification_card').innerHTML='Directory '+folder+' Not found';
          }else{
        var folder_card= '<div  class="function_card" >Directory Listing for '+folder+'<br>'+data+'<hr></div>'
        document.getElementById('log_window').innerHTML=folder_card+document.getElementById('log_window').innerHTML;
        document.getElementById('notification_card').style.display='none';

          }

      }

  })
}

function add_snippet()
{

 var  snippet_title = document.getElementById('snippet_title').value;
 var  txt_snippet_details = document.getElementById('txt_snippet_details').value;

  document.getElementById('log_window').innerHTML=document.getElementById('log_window').innerHTML;

if(snippet_title!=''){
    $.ajax({ 
      url: './ajaxexe.php',
      type: "POST",
      data: {
        'asn_snippets_insert_btn':'ok',
        'txt_snippet_title':snippet_title,
        'txt_snippet_details':txt_snippet_details
      },

      success: function (data) {

        var remove_exec = document.getElementById('log_window').innerHTML;

     alert(data);

      }

  })
}else{
  alert('add Snippet Title');
}

}


function setTextToCurrentPos(content) { 

    var curPos = document.getElementById("txt_new_code").selectionStart; 
    
    var flagged_val =document.getElementById('flag_search').value;

    //let x = ($("#txt_new_code").val()).replace(flagged_val, "");

    let x = $("#txt_new_code").val(); 

    let text_to_insert =content; 

    var back_to_typed_start=(curPos-(flagged_val.length))+content.length;
    
    $("#txt_new_code").val( x.slice(0, curPos) + text_to_insert + x.slice(curPos)); 
    
    document.getElementById('flag_search').value="";

    document.getElementById("txt_new_code").value = ($("#txt_new_code").val()).replace(flagged_val, "");
    setCaretToPos(document.getElementById("txt_new_code"), back_to_typed_start);

 }


function load_to_editor(content)
{
  var strip_br = content.replace(/<br\s*\/?>/mg,"");

setTextToCurrentPos(strip_br);; 

}

function load_to_path(content)
{

  document.getElementById('txt_writeto').value=content;

}

function add_to_frame(filepath)
{
  document.getElementById('iframeurl').value=filepath;

  loadwebpage();
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

window.onkeyup = function(e) {

        if(e.altKey  && e.keyCode=='72'){
            e.preventDefault();

            hideeditor();
        }

        if(e.altKey  && e.keyCode=='86'){
            e.preventDefault();

            showeditor();
        }

        if(e.altKey  && e.keyCode=='82'){
            e.preventDefault();

          var curr_path = document.getElementById('txt_writeto').value;

          document.getElementById('iframeurl').value=curr_path;

          loadwebpage();

         }
}

        function disableScroll() { 
            // Get the current page scroll position 
            scrollTop =  
              window.pageYOffset || document.documentElement.scrollTop; 
            scrollLeft =  
              window.pageXOffset || document.documentElement.scrollLeft, 
  
                // if any scroll is attempted, 
                // set this to the previous value 
                window.onscroll = function() { 
                    window.scrollTo(scrollLeft, scrollTop); 
                }; 
        }

document.getElementById('load_desk_iframe').addEventListener('keydown', function (e){
        if(e.altKey  && e.keyCode=='72'){
            e.preventDefault();

            hideeditor();
        }

        if(e.altKey  && e.keyCode=='86'){
            e.preventDefault();

            showeditor();
        }

}, false);


var onkeyup_iframe = document.getElementById("load_desk_iframe");
var iframeDoc = onkeyup_iframe.contentDocument || onkeyup_iframe.contentWindow.document;

function handleIframeKeyUp(evt) {
    alert("Key up!");
}

if (typeof iframeDoc.addEventListener != "undefined") {
    iframeDoc.addEventListener("keyup", handleIframeKeyUp, false);
} else if (typeof iframeDoc.attachEvent != "undefined") {
    iframeDoc.attachEvent("onkeyup", handleIframeKeyUp);
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

      if(e.altKey  && e.keyCode=='79'){
            e.preventDefault();

      save_file();
         }

      if(e.altKey  && e.keyCode=='87'){
            e.preventDefault();

            document.getElementById('log_window').innerHTML='';
         }

      if(e.altKey  && e.keyCode=='76'){
            e.preventDefault();

            document.getElementById('folderpath').focus();

         }

      if(e.altKey  && e.keyCode=='73'){
            e.preventDefault();

            indent_line();

         }

        if(e.altKey  && e.keyCode=='82'){
            e.preventDefault();

          var curr_path = document.getElementById('txt_writeto').value;

          document.getElementById('iframeurl').value=curr_path;

          loadwebpage();

         }
        if(e.altKey  && e.keyCode=='65'){
            e.preventDefault();
            pop_new_snippet();
           qsnippet('add new snippet dialog');


         }
        if(e.altKey  && e.keyCode=='81'){
            e.preventDefault();

            document.getElementById('mainsearch').focus();
            document.getElementById('mainsearch').value='';

         }

}, false);


function indent_line()
{

    
    var code_line = $("#txt_new_code").val();

    var curPos = document.getElementById("txt_new_code").selectionStart; 

    $("#txt_new_code").val( code_line.slice(0, curPos) + "  " + code_line.slice(curPos)); 

    setCaretToPos(document.getElementById("txt_new_code"), curPos+2);

}


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

function trigger_log_search(qstr)
{
  document.getElementById("function_card").value=qstr;

  search_log();
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
}



function setSelectionRange(input, selectionStart, selectionEnd) {
  if (input.setSelectionRange) {
    input.setSelectionRange(selectionStart, selectionEnd);
        input.focus();
  }
  else if (input.createTextRange) {
    var range = input.createTextRange();
    range.collapse(true);
    range.moveEnd('character', selectionEnd);
    range.moveStart('character', selectionStart);
    range.select();
    input.focus();


  }
}

function setCaretToPos (input, pos) {
   setSelectionRange(input, pos, pos);
}


document.getElementById('txt_new_code').addEventListener('keyup', e => {
var cpos =e.target.selectionStart;
var str =document.getElementById('txt_new_code').value;

var cursorPosition = cpos;

  var preText = str.substring(0, cursorPosition);
        var words = preText.split("@");
        var lastletter = (words[words.length-1]);

   var replace_at=lastletter.replace("@", "");
   
   flag_search(replace_at);

})

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



