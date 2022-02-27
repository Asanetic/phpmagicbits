<?php
//*******************************  app Settings

//Name and Logo

$mep_app_name="{appname}";
$mep_app_logo="{app_logo}";
$mep_app_logo_style="width: auto; height: 50px;";

//App color Scheme
//------------------------------

$theme_name="Mosy"; //-Theme Name - Default - Modular Operating system (Mosy)
$btn_bg="#E9AB0A"; //-Button color
$btn_txt="#fff"; //-Button text color
$ctn_bg="rgba(255, 255, 255, 0.4)"; //-Container color
$ctn_txt="#000"; //-Container text color - $ctn_txt
$body_color="rgba(255, 255, 255, 0.2)"; //-Body color - $body_color
$body_txt="#000"; //-Body text - $body_txt
$nav_bar_bg_color="#F9EAC1"; //-nav_bar_bg_color
$navbar_border_color="#E9AB0A"; //-navbar_border_color
$navbar_border_size="1"; //-navbar_border_size
$nav_shadow_class=""; // -nav_shadow_class
$gen_border_color="#E9AB0A";
$gen_border_size="1";
$wild_color="";
$skin_plasma="rgba(255, 255, 255, 0.2)"; //-Body color - $body_color
$body_skin_css="linear-gradient(0deg, rgba(255,255,255, 0.2) 0%, rgb(19 31 42 / 1%) 29%,  rgb(245 220 151 / 75%) 75%)";

//Gradient colors
//------------------
 $btn_first_color="#E9AB0A";
 $btn_second_color="#000";

//*******************************  app Settings

?>
    <link rel="stylesheet" href="./css/designer.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="icon" href="<?php echo $mep_app_logo;?>?v=<?php echo date('dmysa');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

<style>
/*------------------------custom theme color scheme  ------------------------------*/
.slanted_tray{
clip-path: polygon(0 0, 95% 0%, 100% 100%, 0% 100%);
padding-right:30px;
} 
.sticky_scroll{
  position:sticky;
  top:0px;
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
    ba1kground-size: cover;
    /*background-image: url('./img/bg.jpg');*/
    background:<?php echo $body_skin_css ?>;
                                  
}
.msg_alert_modal{
  animation: bounce_anime 1s linear alternate;
  -webkit-animation: bounce_anime 1s linear alternate;
            
}                            
.msg_modal-content {
    border-top: 7px solid <?php echo $btn_bg; ?>!important;
    text-align: center;
  	background-color:<?php echo $nav_bar_bg_color; ?>!important;
}


body
{
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    /*background-image: url('./img/bg.jpg');*/
    background:<?php echo $body_skin_css ?>;
                                  
}
                            
.msg_modal-content {
    border-top: 7px solid <?php echo $btn_bg; ?>!important;
    text-align: center;
  	background-color:<?php echo $nav_bar_bg_color; ?>!important;
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
  border-radius: 30px;
  background: linear-gradient(225deg, <?php echo $btn_first_color ?>, <?php echo $btn_second_color?>);
  border:0px;  
}

.text-primary{
  color:#000!important;
}

.btn_neoo2{
	border-radius: 30px;
	background: linear-gradient(225deg, <?php echo $btn_first_color ?>, <?php echo $btn_second_color?>);
	/*box-shadow:  -10px 10px 90px <?php echo $btn_first_color ?>,
             10px -10px 50px #ffffff;*/
}

.btn-primary{
  border-radius: 30px;
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
.page-item.active .page-link {
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
::-webkit-scrollbar {
  width: 10px;
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
margin-top: 60px!important;
}
    
.navbar-brand{
    font-size:1.25rem;
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
