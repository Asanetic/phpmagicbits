/*WELCOME TO AJAX MAGIC BITS OPEN SOURCE*
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
 * @category   JAVASCRIPT Library
 * @package    AJAX MAGIC BITS
 * @author     JEREMIAH ASANYA FOUNDER : ASANETIC TECHNOLOGIES <jereasanya@gmail.com>
 * @copyright  ASANETIC TECHNOLOGIES
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    2.0
 * @link       https://github.com/Asanetic/phpmagicbits
 * @DOCUMENTATION : https://github.com/Asanetic/phpmagicbits/blob/master/README.md
*/

//++++++++++++++++++++++++++++++++++ begin Library ++++++++++++++++++++++++++++++



var magic_css= magic_css();
var drop_css= drop_css();

function magic_clean_str (str) {
    return str.replace(/[\0\x08\x09\x1a\n\r"'\\\%]/g, function (char) {
        switch (char) {
            case "\0":
                return "\\0";
            case "\x08":
                return "\\b";
            case "\x09":
                return "\\t";
            case "\x1a":
                return "\\z";
            case "\n":
                return "\\n";
            case "\r":
                return "\\r";
            case "\"":
            case "'":
            case "\\":
            case "%":
                return "\\"+char; // prepends a backslash to backslash, percent,
                                  // and double/single quotes
            default:
                return char;
        }
    });
}

///=========================== RANDOM STRING
function magic_random_str(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}
///=========================== TIME MANAGER

function magic_current_date()
{
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  current_today = mm+'-'+dd+'-'+ yyyy;

  return current_today;
}

function magic_current_month()
{
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();


  return mm;
}
function magic_current_year()
{
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();


  return yyyy;
}

///=========================== TIME MANAGER


function magic_create_cookie(cname, cvalue) 
{
  var expires = "expires=2147483647";
  document.cookie = cname + "=" + cvalue + ";" + expires + ";";
}

function magic_cookie_value(cname)
 {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
}

function magic_destroy_cookie(cname) {
  document.cookie = cname + "=; -2147483647;"
}



function magic_ajax_spinner(spinner,message)
{
    $('#'+spinner+'').hide();
    
    $(document).ajaxStart(function() {
    $('#'+spinner+'').show();
    });
    
    $(document).ajaxStop(function() {
    $('#'+spinner+'').hide();
    });
    
    if(message!==""){
    $('#'+spinner+'').html(message);
    }
}


function magic_spinner_box(message_to_display, attach_to, spinnerid)
{

var alert_box=
'<!-- The Modal -->'+
'<style>.spinner_css_div{position: fixed;top: 10px;z-index: 99999990;left: 29%;}@media screen and (max-width:700px){.spinner_css_div{position: fixed;top: 10px;z-index: 99999990;left: 1%;}}</style>'+
  '<div id="'+spinnerid+'" class="msg_alert_modal"style="z-index:9999999; background-color:rgba(0,0,0,0.04);" onclick="this.style.display=\'none\';">'+
    '<!-- Modal content -->'+
    '<div class="msg_modal-content spinner_css_div">'+
      '<p>'+message_to_display+'</p>'+
    '</div>'+
  '</div>';

if(attach_to!='')
{
  document.getElementById(attach_to).innerHTML=alert_box;
}


return alert_box;
}


//====================== create message pop ups ==========================
function magic_message(message_to_display, attach_to)
{


var alert_box=
magic_css+'<!-- The Modal -->'+
    '<div id="msg_alert_myModal" class="msg_alert_modal" onclick="this.style.display=\'none\';" style="z-index:99999;">'+
     '<!-- Modal content -->'+
       '<div class="msg_modal-content ">'+
         '<span class="msg_modalclose" onclick="document.getElementById(\'msg_alert_myModal\').style.display=\'none\';">&times;</span>'+
        '<p>'+message_to_display+'</p>'+
      '</div>'+
    '</div>';

if(attach_to!='')
{
  document.getElementById(attach_to).innerHTML=alert_box;
}

return alert_box;
}

function magic_screen(message_to_display, attach_to)
{

 var alert_box=
magic_css+'<!-- The Modal -->'+
    '<div id="msg_alert_myModal" class="msg_alert_modal"style="z-index:99;">'+
      '<!-- Modal content -->'+
      '<div class="msg_modal-content" style="background-color:#000; color:#FFF; border-bottom:4px solid #FFF;">'+
        '<span class="exe_btn" onclick="document.getElementById(\'msg_alert_myModal\').style.display=\'none\';" style="float:right;">&times;</span>'+
        '<p>'+message_to_display+'</p>'+
      '</div>'+
    '</div>';
if(attach_to!='')
{
  document.getElementById(attach_to).innerHTML=alert_box;
}

return  alert_box;
}



function magic_modal(message_to_display, attach_to)
{

 var alert_box=
    magic_css+'<!-- The Modal -->'+
        '<div id="msg_alert_myModal" class="msg_alert_modal"style="z-index:99;">'+
          '<!-- Modal content -->'+
          '<div class="msg_modal-content_banner" style="max-height:600px; overflow-y:auto;">'+
            '<span class="btn btn-primary" onclick="document.getElementById(\'msg_alert_myModal\').style.display=\'none\';" style="float:right;">&times;</span>'+
            '<p>'+message_to_display+'</p>'+
          '</div>'+
        '</div>';

if(attach_to!='')
{
  document.getElementById(attach_to).innerHTML=alert_box;
}

return alert_box;
}


function magic_error_message(message_to_display, attach_to)
{

    var alert_box=
        magic_css+'<!-- The Modal -->'+
            '<div id="msg_alert_myModal" class="msg_alert_modal" onclick="this.style.display=\'none\';" style="z-index:99999;">'+
              '<!-- Modal content -->'+
              '<div class="msg_modal-content" style="background-color:darkred;">'+
                '<span class="msg_modalclose" onclick="document.getElementById(\'msg_alert_myModal\').style.display=\'none\';">&times;</span>'+
                '<p style="color:#FFF;">'+message_to_display+'</p>'+
              '</div>'+
            '</div>';

            if(attach_to!='')
            {
              document.getElementById(attach_to).innerHTML=alert_box;
            }

    return alert_box;
}

function magic_button(name_n_id, value_text, additional_attributes, attach_to)
{


    var newbtn='<input type="submit" name="'+name_n_id+'" id="'+name_n_id+'" value="'+value_text+'" class="btn btn-primary" '+additional_attributes+'/>';

    var btnstr=newbtn;

    if(attach_to!='')
    {
    document.getElementById(attach_to).innerHTML=newbtn;
    }


    return btnstr;

}

function magic_input(name_n_id, placeholder, additional_attributes, attach_to)
{

    var newtxt='<input type="text" name="'+name_n_id+'" id="'+name_n_id+'" placeholder="'+placeholder+'" class="form-control" '+additional_attributes+'/>';

    var txtstr=newtxt;

    if(attach_to!='')
    {
    document.getElementById(attach_to).innerHTML=newtxt;
    }


    return txtstr;

}

function magic_plain_button(name_n_id, name_text, additional_attributes, attach_to)
{


    var newbtn='<div name="'+name_n_id+'" id="'+name_n_id+'" class="btn btn-primary" '+additional_attributes+'>'+name_text+'</div>';

    var pbtnstr=newbtn;

    if(attach_to!='')
    {
    document.getElementById(attach_to).innerHTML=newbtn;
    }
    return pbtnstr;

}

function magic_dropdown(title, dropdown_items, inline_css_yes_no)
{

        var inline_css=drop_css;

        if(inline_css_yes_no=='no'){
            var inline_css="";
        }

      var mg_dropdown = 
      inline_css+'<div class="table_cell_dropdown">'+
          '<div class="table_cell_dropbtn">'+title+'</div>'+
          '<div class="table_cell_dropdown-content">'+
            dropdown_items
          '</div>'+
        '</div>';

        return mg_dropdown;

}


function magic_link(location, name_text, additional_attributes, attach_to)
{

    var newlinkstr='<a href="'+location+'"  '+additional_attributes+'>'+name_text+'</a>';

    var linkstr=newlinkstr;

    if(attach_to!='')
    {
    document.getElementById(attach_to).innerHTML=newlinkstr;
    }

    return linkstr;

}

function magic_button_link(location, name_text, additional_attributes, attach_to)
{

    var newlinkstr='<a href="'+location+'" class="btn btn-primary" '+additional_attributes+'>'+name_text+'</a>';

    var linkstr=newlinkstr;

    if(attach_to!='')
    {
    document.getElementById(attach_to).innerHTML=newlinkstr;
    }
    return linkstr;

}


function magic_validate_required(message_to_display, attach_to)
{


    if(message_to_display==''){

        var message_to_display ="Please Fill Out this Field";
    }

    var proceed_state="True";

     validate_alert='<em id="'+attach_to+'_validate_span" class="validate_error_class">'+message_to_display+'</em>';

     var validate_label =document.getElementById(attach_to+'_validate_span');

    if(document.getElementById(attach_to).value==""){
    

    if (typeof(validate_label) != 'undefined' && validate_label != null)
        {
              
         document.getElementById(attach_to+'_validate_span').remove();

        }
        
    $('#'+attach_to+'').before(validate_alert);

    proceed_state="False";

    }else{

    if (typeof(validate_label) != 'undefined' && validate_label != null)
        {
              
         document.getElementById(attach_to+'_validate_span').remove();

        }

    }

    return proceed_state;

}




function magic_validate_email_required(message_to_display, attach_to)
{


    if(message_to_display==''){

        var message_to_display ="Invalid Email";
    }

    var proceed_state="True";

     validate_alert='<em id="'+attach_to+'_validate_span" class="validate_error_class">'+message_to_display+'</em>';

     var validate_label =document.getElementById(attach_to+'_validate_span');

     filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;


        if (filter.test(email.value)) {
          // Yay! valid
          if (typeof(validate_label) != 'undefined' && validate_label != null)
                {
                      
                 document.getElementById(attach_to+'_validate_span').remove();

                }      
            }else{

            if (typeof(validate_label) != 'undefined' && validate_label != null)
                    {
                          
                     document.getElementById(attach_to+'_validate_span').remove();

                    }
                    
                $('#'+attach_to+'').before(validate_alert);

                proceed_state="False";
          }

    return proceed_state;

}

function magic_css(){


    var magic_css='<style> .msg_alert_modal{display:block;position:fixed;z-index:1;padding-top:100px;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:#000;color:#fff;background-color:rgba(0,0,0,.4)}.msg_modal-content{background-color:#000;margin:auto;padding:20px;border:1px solid #888;width:40%}.msg_modal-content_banner{background-color:#000;margin:auto;padding:20px;border:1px solid #888;width:52%;font-size:16px}.msg_modalclose{color:#aaa;float:right;font-size:28px;font-weight:700}.msg_modalclose:focus,.msg_modalclose:hover{color:#000;text-decoration:none;cursor:pointer}.validate_error_class{font-size:11px;color:red}.hide_error_class{display:none}@media screen and (max-width:700px){.msg_modal-content{width:98%}.msg_modal-content_banner{padding:5px;width:98%}}</style>';


    return magic_css;


}

function drop_css(){

    var drop_css='<style>.table_cell_dropbtn{font-size:16px;font-weight:700}.table_cell_dropdown{position:relative;display:inline-block}.table_cell_dropdown-content{display:none;position:absolute;background-color:#fff;min-width:160px;box-shadow:0 8px 16px 0 rgba(0,0,0,.2);z-index:1;text-align:left;padding-left:5px;border-left:2px solid #00f}.table_cell_dropdown-content a{color:#000;padding:12px 16px;text-decoration:none;display:block}.table_cell_dropdown-content span{color:#000;padding:12px 16px;text-decoration:none;display:block;cursor:pointer}.table_cell_dropdown-content a:hover{background-color:#ddd}.table_cell_dropdown-content span:hover{background-color:#ddd}.table_cell_dropdown:hover .table_cell_dropdown-content{display:block}tr:hover .table_cell_dropdown-content{display:block}</style>';

    return drop_css;
}



//====================== create message pop ups ==========================
function magic_yes_no_alert(message_to_display, attach_to, yes_function, no_function)
{
  var alert_box=
  '<!-- The Modal -->'+
    '<div id="del_msg_alert_myModal" class="msg_alert_modal" onclick="this.style.display=\'none\';" style="z-index:99999;">'+
      '<!-- Modal content -->'+
      '<div class="msg_modal-content">'+
        '<span class="msg_modalclose" onclick="document.getElementById(\'del_msg_alert_myModal\').style.display=\'none\';">&times;</span>'+
        '<p>'+message_to_display+'</p>'+
        '<hr>'+
        '<button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById(\'del_msg_alert_myModal\').style.display=\'none\';'+yes_function+'">Yes</button>'+
        '<button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById(\'del_msg_alert_myModal\').style.display=\'none\';'+no_function+'" style="margin-left:30px;">Cancel</button>'+
      '</div>'+
    '</div>';

    if(attach_to!='')
    {
    document.getElementById(attach_to).innerHTML=alert_box;
    }

  return alert_box;
}
//************************************************************ Begin Of pagination Function **************************************
function create_dropdown_pagination(record_count, request_page, appendto)
{

   var current_page_label='<em id="'+appendto+'_curr_page" style="padding-right:10px;"> Showing Page 1</em>';

  if(request_page!=""){
   var current_page_label='<em id="'+appendto+'_curr_page" style="padding-right:10px;"> Showing Page '+request_page+'</em>';
  }

   var current_page_label_id =document.getElementById(appendto+'_curr_page');
  

  if (typeof(current_page_label_id) != 'undefined' && current_page_label_id != null)
    {
          
     document.getElementById(appendto+'_curr_page').remove();

    }
      


    var populate_drop_down = '';

    var drop_down_page_count=parseInt(record_count)+1;

    for(var i = 1; i < drop_down_page_count; i++){

      populate_drop_down +=
      '<option value="'+i+'">'+i+'</option>';
    }


    document.getElementById(appendto).innerHTML='<option>Go To</option>'+populate_drop_down;

    $('#'+appendto+'').before(current_page_label);

}



function magic_ajax(function_name, params, callback_function_string, additional_callbacks)
{
      $.ajax({ 
      url: "./ajaxmagicbits.php",
      type: "POST",
      data: {
        '_magicbit_php_call_':'',
        'function_name':function_name,
        'function_params':(params) 
      },

      success: function (data) {

        window[callback_function_string](data, additional_callbacks);

      }

  })

}

function magic_post_to_ajax(post_url, json_params, post_name, callback_function_string, additional_callbacks)
{

      $.ajax({ 
      url: post_url,
      type: "POST",
      data: {
        'post_name':post_name,
        'post_data':json_params
      },

      success: function (data) {

        window[callback_function_string](data, additional_callbacks);

      }

  })

}

function magic_get_url_param(paramname)
 {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === paramname) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

