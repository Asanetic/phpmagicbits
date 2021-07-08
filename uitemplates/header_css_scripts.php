<?php
//*******************************  app Settings

//Name and Logo

$mep_app_name="{appname}";
$mep_app_logo="{app_logo}";
$mep_app_logo_style="width: auto; height: 50px;";

//App color Scheme
//------------------------------

$theme_name="Mosy"; //-Theme Name - Default - Modular Operating system (Mosy)
$btn_bg="#0673DC"; //-Button color
$btn_txt="#fff"; //-Button text color
$ctn_bg="transparent"; //-Container color
$ctn_txt="#000"; //-Container text color - $ctn_txt
$body_color="rgba(255, 255, 255, 0.2)"; //-Body color - $body_color
$body_txt="#000"; //-Body text - $body_txt
$nav_bar_bg_color="#BEEFEF"; //-nav_bar_bg_color
$navbar_border_color="#000"; //-navbar_border_color
$navbar_border_size="2"; //-navbar_border_size
$nav_shadow_class=""; // -nav_shadow_class
$gen_border_color="#0673DC";
$gen_border_size="1";
$wild_color="";
$skin_plasma="rgba(255, 255, 255, 0.5)"; //-Body color - $body_color

//Gradient colors
//------------------

 $first_color="255,255,255"; //rgb
 $second_color="5,195,193"; //rgb

 $btn_first_color="#0673DC";
 $btn_second_color="#000";

//*******************************  app Settings

?>
    <link rel="stylesheet" href="./css/designer.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="icon" href="<?php echo $mep_app_logo;?>?v=<?php echo date('dmysa');?>">
  
<style>
/*------------------------custom theme color scheme  ------------------------------*/
.msg_modal-content {
    border-left: 7px solid <?php echo $btn_bg; ?>;
    text-align: center;
}
.toast_card 
{
	z-index:99999;    
}

.border_set{
  border-color:<?php echo $gen_border_color?>!important;
  border-width:<?php echo $gen_border_size; ?>px!important;
}  
.btn_neo{
  border-radius: 30px;
  box-shadow:  20px 20px 60px $btn_first_color,
             -20px -20px 60px $btn_second_color;
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
  background: <?php echo $btn_bg;?>; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: rgba(255,255,255,0.2); 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
/*------------------------custom theme color scheme  ------------------------------*/

body
{
    background-repeat: no-repeat;
    background-position: center;
    background-size: coverer;
    background-image: url('./img/bg.jpg');
	background: linear-gradient(0deg, rgba(<?php  echo $first_color; ?>, 0.21612394957983194) 0%, rgba(<?php echo $second_color ?>,1) 100%);
}
                                
.bg_grad{
  background: rgb(238,174,202);
	background: linear-gradient(0deg, rgba(<?php  echo $first_color; ?>, 0.21612394957983194) 0%, rgba(<?php echo $second_color ?>,1) 100%);
}
                                
.form-control{
  background-color:transparent;
  border:none;
  border-bottom:1px solid <?php echo $btn_first_color?>;
  border-radius:0px;
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
margin-top: 100px!important;
}
.padding_row
{
margin-top: 65px!important;
}
.navbar-brand{
    font-size:27px;
}


@media screen and (max-width: 700px)
{
.padding_row
{
margin-top: 65px!important;
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

}
    
</style>
