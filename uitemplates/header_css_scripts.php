<?php
//*******************************  app Settings

//Name and Logo

$mep_app_name="{appname}";
$mep_app_logo="{app_logo}";
$mep_app_logo_style="width: auto; height: 50px;";

//App color Scheme
//------------------------------

$theme_name="Mosy"; //-Theme Name - Default - Modular Operating system (Mosy)
$btn_bg="#1f34ab"; //-Button color
$btn_txt="#fff"; //-Button text color
$ctn_bg="#fff"; //-Container color
$ctn_txt="#000"; //-Container text color - $ctn_txt
$body_color="rgba(255, 255, 255, 0.9)"; //-Body color - $body_color
$body_txt="#344767"; //-Body text - $body_txt
$nav_bar_bg_color="#fff"; //-nav_bar_bg_color
$navbar_border_color="#ccc"; //-navbar_border_color
$navbar_border_size="1"; //-navbar_border_size
$nav_shadow_class="shadow-sm"; // -nav_shadow_class
$gen_border_color="#1f34ab";
$gen_border_size="1";
$wild_color="";
$skin_plasma="rgba(255, 255, 255, 0.0)"; //-Body color - $body_color
$body_skin_css="#f8f9fa";

//Gradient colors
//------------------
 $btn_first_color="#10102a";
 $btn_second_color="#1f34ab";

//*******************************  app Settings
$skinclr=$ctn_bg;
$buttonclr=$btn_bg;
$gentxtclr=$ctn_txt;
$buttontxtclr=$btn_txt;
?>
    <link rel="stylesheet" href="./css/designer.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href=".//fonts/css/all.min.css">  
    <link rel="stylesheet" href="./css/adminlte.css?v=77">
    <link type=text/css href="https://fonts.googleapis.com/css?family=Muli:400,300" rel=stylesheet>
    <link rel="icon" href="<?php echo $mep_app_logo;?>?v=<?php echo date('dmysa');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php echo magic_css();?>

<style>
/*------------------------custom theme color scheme  ------------------------------*/
.trim_text {
  width: 100%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.overflow_y{
overflow-y:auto;
}

.max_height_350{
max-height:350px;
overflow-y:auto;
}

.desk_font
{
 font-size:14px; 
} 

.large_icon{
 font-size:50px; 
}  
.medium_icon{
 font-size:30px; 
}                           
.rounded_big
{
border-radius:30px; 
 overflow:hidden;
} 

.rounded_medium
{
border-radius:10px; 
 overflow:hidden;
} 

.useravatar_small{
width:50px;
height:50px;
border-radius:50%;
}

.useravatar_90{
width:80px;
height:80px;
border-radius:50%;
}

.card-img-overlay{
background:rgba(255, 255, 255, 0.8);
}

.bg_w_img_overlay{
background:rgba(255, 255, 255, 0.8);

}
.shadow{
  box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%)!important;
}
  
  .slanted_tray{
clip-path: polygon(0 0, 95% 0%, 100% 100%, 0% 100%);
padding-right:30px;
} 
.sticky_scroll{
  position:sticky;
  top:0px;
}

.stats_knob{
  border: 3px solid <?php echo $btn_bg?>;
  border-bottom-color: #F8DD83;
  border-left-color: #F8DD83;
}
.bg-warning {
    background-color: #f7c72f!important;
}
@keyframes zoom_in_out_anime {
    0% {
        transform: scale(1,1);
    }
    50% {
        transform: scale(1.2,1.2);
    }
    100% {
        transform: scale(1,1);
    }
}
@keyframes spin {
    from {
        transform:rotate(0deg);
    }
    to {
        transform:rotate(360deg);
    }
}
.btn:hover {
	animation: zoom_in_out_anime 1s linear ;
}

.bounce_up_down:hover {
  animation: bounce_anime 2s linear alternate;
  -webkit-animation: bounce_anime 2s linear alternate;
}

.zoom_in_out:hover {
  animation: zoom_in_out_anime 2s linear alternate;
  -webkit-animation: zoom_in_out_anime 2s linear alternate;
}

.badge:hover{
  animation: zoom_in_out_anime 2s linear alternate;
  -webkit-animation: zoom_in_out_anime 2s linear alternate;
}
.badge-primary
{
margin-bottom:10px;  
}

@-webkit-keyframes bounce_anime {
  0%, 100% {
    -webkit-transform: translateY(0);
  }
  50% {
    -webkit-transform: translateY(-10px);
  }
}


@keyframes bounce_anime {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}


@-webkit-keyframes bounce_left_right_anime {
  0%, 100% {
    -webkit-transform: translateX(0);
  }
  50% {
    -webkit-transform: translateX(-10px);
  }
}


@keyframes bounce_left_right_anime {
  0%, 100% {
    transform: translateX(0);
  }
  50% {
    transform: translateX(-10px);
  }
}

.bounce_left_right:hover{
  animation: bounce_left_right_anime 2s linear alternate;
  -webkit-animation: bounce_left_right_anime 2s linear alternate;
}
.auto_bounce_left_right{
  animation: bounce_left_right_anime 2s linear alternate;
  -webkit-animation: bounce_left_right_anime 2s linear alternate;
}
tr:hover{
  animation: bounce_left_right_anime 2s linear alternate;
  -webkit-animation: bounce_left_right_anime 2s linear alternate;
}        
         @-webkit-keyframes fadeindown {
            0% {
               opacity: 0;
               -webkit-transform: translateY(-10px);
            }
            100% {
               opacity: 1;
               -webkit-transform: translateY(0);
            }
         }
         
         @keyframes fadeindown {
            0% {
               opacity: 0;
               transform: translateY(-10px);
            }
            100% {
               opacity: 1;
               transform: translateY(0);
            }
         }
         
         .fadeindown {
            -webkit-animation: fadeindown;
            animation: fadeindown ease 2s;
         }


.table_cell_dropdown-content a {
    font-size: 13px;
  padding-top:6px!important;
  padding-bottom:6px!important;
  z-index:999;
  
}

.bg_w_img{
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    background-image: url('./img/bg.jpg');
}
body
{
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    /*background-image: url('./img/bg.jpg');*/
    background:<?php echo $body_skin_css ?>;
    font-family: "Muli","Helvetica Neue","Open Sans","Arial","sans-serif"; 
  	line-height:30px;
  	font-weight:400;
  	font-size:16px;
}
.msg_alert_modal{
  animation: bounce_anime 1s linear alternate;
  -webkit-animation: bounce_anime 1s linear alternate;
  border-radius:15px;
            
}                            
.msg_modal-content {
    border-top: 7px solid <?php echo $btn_bg; ?>!important;
    text-align: center;
  	background-color:<?php echo $nav_bar_bg_color; ?>!important;
  border-radius:15px;
}
.auto_bounce{
    animation: bounce_anime 1s linear alternate;
  -webkit-animation: bounce_anime 1s linear alternate;
}
.command_pic_ring{
width:100px;
height:100px;
border-radius:50%;
padding:0px;
display:inline-block;
margin:50px;
    border-top:1px solid #000;
    animation-name: spin;
    animation-duration: 17000ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}
.command_pic_ring2{
width:200px;
height:200px;
border-radius:50%;
box-shadow:1px 1px 1px 1px <?php echo $btn_bg ?>;
padding:0px;
display:inline-block;
    border-top:1px solid #000;
    animation-name: spin;
    animation-duration: 13000ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}



.toast_card 
{
	z-index:99999;   
}
.toast {
    background-color:<?php echo $btn_first_color ?>!important;

}

::-webkit-file-upload-button {
  border-radius: 10px;
  background: linear-gradient(225deg, <?php echo $btn_first_color ?>, <?php echo $btn_second_color?>);
  border:0px;  
  color:<?php echo $btn_txt; ?>;
  padding:4px;
  padding-right:7px;
  padding-left:7px;
}

.border_set{
  border-color:<?php echo $gen_border_color?>!important;
  border-width:<?php echo $gen_border_size; ?>px!important;
}  
.btn_neo{
  border-radius: 10px;
  background: linear-gradient(225deg, <?php echo $btn_first_color ?>, <?php echo $btn_second_color?>);
  border:0px;  
}

.text-primary{
  color:<?php echo $body_txt;?>!important;
}

.btn_neoo2{
	border-radius: 10px;
	background: linear-gradient(225deg, <?php echo $btn_first_color ?>, <?php echo $btn_second_color?>);
	/*box-shadow:  -10px 10px 90px <?php echo $btn_first_color ?>,
             10px -10px 50px #ffffff;*/
}

.btn-primary{
  border-radius: 10px;
  background: linear-gradient(225deg, <?php echo $btn_first_color ?>, <?php echo $btn_second_color?>);
	/*box-shadow:  -10px 10px 90px <?php echo $btn_first_color ?>,
             10px -10px 50px #ffffff;*/
  border:0px;                            
}

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
  border-radius: 0px;
  background: linear-gradient(225deg, <?php echo $btn_first_color ?>, <?php echo $btn_second_color?>);
	/*box-shadow:  -10px 10px 90px <?php echo $btn_first_color ?>,
             10px -10px 50px #ffffff;*/
  border:0px;  
}
  
.ctn_set
{
   background-color:<?php echo $ctn_bg;?>; 
   color:<?php echo $ctn_txt?>;
}

.btn_set
{
 	background-color:<?php echo $btn_bg;?>; 
 	color:<?php echo $btn_txt?>;
}

.body_set
{
   background-color:<?php echo $body_color;?>; 
   color:<?php echo $body_txt?>;
}
.nav_bar_set
{
 background-color:<?php echo $nav_bar_bg_color;?>; 
 border-bottom:<?php echo $navbar_border_size?>px solid <?php echo $navbar_border_color?>;  
}

.page-item.active .page-link 
{
  color: <?php echo $btn_txt?>;
  background-color: <?php echo  $btn_bg?>;
  border-color: <?php echo  $btn_bg?>;
}

.skin_plasma
{
	height: auto;
	background-color: <?php echo $skin_plasma;?>
}
   /* width */
::-webkit-scrollbar 
{
  width: 8px;
}

/* Track */
::-webkit-scrollbar-track {
  background: <?php echo $nav_bar_bg_color;?>; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: <?php echo $btn_bg; ?>; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
/*------------------------custom theme color scheme  ------------------------------*/
                                
.form-control{
  background-color:transparent;
  border:none;
  border-bottom:1px solid <?php echo $btn_first_color?>;
  border-radius:0px;
  color:<?php echo $body_txt?>;
}
.table {
color:<?php echo $body_txt;?>;
}
.form-group label
{
	font-weight:bold;  
}

.cpointer{
    cursor: pointer;
}

.padding_row_gen
{
margin-top: 0px!important;
}
.padding_row
{
margin-top: 0px!important;
}
.navbar-brand{
    font-size:27px;
}


@media screen and (max-width: 700px)
{
.badge-primary{
 margin-bottom:10px; 
}
.msg_alert_modal{
  padding-top:60px!important;
} 

/* width */
::-webkit-scrollbar {
  width: 1px;
}

.padding_row
{
margin-top: 50px!important;
}
    
.navbar-brand{
    font-size:14px;
}

.padding_row_gen
{
margin-top: 50px!important;
}

.skin_plasma
{
height: auto;
}

.text_center_mobi{
text-align:center!important;
}

}
    
</style>
<script type="text/javascript">
  
	var mosythread ="mosythread?render_modal=";
	var client_hive="clients_table";
	var supplier_hive="suppliers";
 	var ajaxw=" WHERE ";
	var ajaxl=" LIKE ";
	var ajaxo =" OR ";
	var ajaxa=" AND ";
	var ajaxe="=";
	var ajaxgb=" group by ";
	var ajaxob=" order by ";
    var ajaxvl ="  \'%' magic_clean_str(this.value) '%\' ";
	var ajaxij= " INNER JOIN ";
	var ajaxon= " ON ";
</script>
