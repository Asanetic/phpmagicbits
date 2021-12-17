<?php
function mosy_paginate_ui($pagination_record_count, $datalimit, $token_name)
{  
  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['filelim']))
{
  $_SESSION['filelim']=15;
}
$limit_per_page='Show '.$_SESSION['filelim'].' Rows per Page'; 

if($_SESSION['filelim']=='100000000000000000'){
$limit_per_page=" Showing All Records ";
}
  
$ui_str='
<style>
.looppage_labelwidget{
font-size:12px;
font-weight:bold;
display:inline-block;
margin:20px;
margin-left:0px;
margin-bottom:5px;
}
.looppage_combowidget{
width:90px;
border:none;
border-bottom:1px solid gray;
margin-bottom:1px;
background-color:rgba(255,255,255,0.0);
}
.page-link{
	margin-top: 10px;
}
@media screen and (max-width: 700px){
.hide_mobi
{
display: none;
}
}
</style>

<div style="width: 100%; text-align: left!important; margin-top: 30px; " class="table-responsive">';

	$current_url_params="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$clean_current_url=$current_url_params.'?'.$token_name.'=';


	if (strpos($current_url_params, '?') !== false) {
	    
	    $clean_current_url=$current_url_params.'&'.$token_name.'=';

	}
	if (strpos($current_url_params, '?'.$token_name.'')) {

		$remove_old_token = substr($current_url_params, 0, strpos($current_url_params, "?".$token_name.""));

		$clean_current_url=$remove_old_token.'?'.$token_name.'=';

	}
	if(strpos($current_url_params, '&'.$token_name.'')) {

		$remove_old_token = substr($current_url_params, 0, strpos($current_url_params, "&".$token_name.""));

		$clean_current_url=$remove_old_token.'&'.$token_name.'=';

	}


	if (isset($_GET[''.$token_name.'']) && $_GET[''.$token_name.'']!="") {
		$page_no = base64_decode($_GET[''.$token_name.'']);
		} else {
			$page_no = 1;
	        }
	 	$total_records_per_page = $datalimit;
	    $offset = ($page_no-1) * $total_records_per_page;
		$previous_page = $page_no - 1;
		$next_page = $page_no + 1;
		$adjacents = "2";
		$mobi_adjacents = "0";

		$total_no_of_pages=$pagination_record_count;


		$second_last = $total_no_of_pages - 1; // total page minus 1
  
$ui_str.='<div style="border-top: dotted 1px blue; padding-left: 20px;" class="d-none d-md-none d-sm-none d-lg-block">

	<ul class="pagination  pagination-sm  justify-content-center">
      <p  class="looppage_labelwidget" align="center"> '.$limit_per_page.' | Change  
      <select class="looppage_combowidget" onChange="changelim(this.value);" >
      <option>1</option>
      <option>2</option>
      <option>5</option>
      <option>10</option>
      <option>50</option>
      <option>100</option>
      <option>200</option>
      <option>500</option>
      <option>1000</option>
      <option value="100000000000000000">All Records</option>
      </select>
      </p>
<div class="looppage_labelwidget text-primary hide_mobi"> Page '.$page_no.' of '.$total_no_of_pages.'</div>';		
$ui_str.='<li '; if($page_no <= 1){ $ui_str.=' class="page-item disabled"'; }else{ $ui_str.=' class="page-item"';} $ui_str.='>';
		$ui_str.='<a class="page-link"'; if($page_no > 1){ $ui_str.=' href="'.$clean_current_url.base64_encode($previous_page).'"'; } $ui_str.='>Prev</a>
		</li>';
	       
	    
		if ($total_no_of_pages <= 10){  	 
			for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
				if ($counter == $page_no) {
			   $ui_str.='<li class="page-item active"><a class="page-link" >'.$counter.'</a></li>';	
					}else{
	           $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode($counter).'">'.$counter.'</a></li>';
					}
	        }
		}
		elseif($total_no_of_pages > 10){
			
		if($page_no <= 4) {			
		 for ($counter = 1; $counter < 8; $counter++){		 
				if ($counter == $page_no) {
			   $ui_str.='<li class="page-item active"><a href=""class="page-link">'.$counter.'</a></li>';	
					}else{
	           $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode($counter).'">'.$counter.'</a></li>';
					}
	        }
			$ui_str.='<li class="page-item" ><a href="" class="page-link">...</a></li>';
			$ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode($second_last).'">'.$second_last.'</a></li>';
			$ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode($total_no_of_pages).'">'.$total_no_of_pages.'</a></li>';
			}

		 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
			$ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode(1).'">1</a></li>';
			$ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode(2).'">2</a></li>';
	        $ui_str.='<li class="page-item" ><a class="page-link" >...</a></li>';
	        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
	           if ($counter == $page_no) {
			   $ui_str.='<li class="page-item active"><a class="page-link" >'.$counter.'</a></li>';	
					}else{
	           $ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode($counter).'">'.$counter.'</a></li>';
					}                  
	       }
	       $ui_str.='<li class="page-item" ><a class="page-link" >...</a></li>';
		   $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode($second_last).'">'.$second_last.'</a></li>';
		   $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode($total_no_of_pages).'">'.$total_no_of_pages.'</a></li>';      
	            }
			
			else {
	        $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode(1).'">1</a></li>';
			$ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode(2).'">2</a></li>';
	        $ui_str.='<li class="page-item" ><a class="page-link" >...</a></li>';

	        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
	          if ($counter == $page_no) {
			   $ui_str.='<li class="page-item active"><a class="page-link" >'.$counter.'</a></li>';	
					}else{
	           $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode($counter).'">'.$counter.'</a></li>';
					}                   
	                }
	            }
		}
	    
		$ui_str.='<li '; if($page_no >= $total_no_of_pages){ $ui_str.='class="page-item disabled"'; }else{ $ui_str.=' class="page-item"';}$ui_str.='>';
		$ui_str.='<a class="page-link"';  if($page_no < $total_no_of_pages) { $ui_str.='href="'.$clean_current_url.base64_encode($next_page).'"'; } $ui_str.='>Next</a>';
		$ui_str.='</li>';
  
	     if($page_no < $total_no_of_pages){
			$ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode($total_no_of_pages).'">Last ››</a></li>';
			} 
	$ui_str.='</ul>
</div>
<div style="border-top: dotted 1px blue; padding-left: 20px;" class="d-lg-none">
    <p  class="looppage_labelwidget" align="center" style="width: 100%;">   '.$limit_per_page.'   
    <select class="looppage_combowidget" onChange="changelim(this.value);" >
    <option>1</option>
    <option>2</option>
    <option>5</option>
    <option>10</option>
    <option>50</option>
    <option>100</option>
    <option>200</option>
    <option>500</option>
    <option>1000</option>
    <option value="100000000000000000">All Records</option>
    </select>
    </p>
<div class="looppage_labelwidget text-primary" style="text-align: center; width: 100%"> Page  '.$page_no.' of '.$total_no_of_pages.'</div>';
	$ui_str.='<ul class="pagination  pagination-sm  justify-content-center">';
	$ui_str.='<li '; if($page_no <= 1){ $ui_str.='class="page-item disabled"'; }else{ $ui_str.=' class="page-item"';}  $ui_str.='>';
  
		$ui_str.='<a class="page-link"';  if($page_no > 1){ $ui_str.='href="'.$clean_current_url.base64_encode($previous_page).'"'; } $ui_str.='> Prev </a>
		</li>';
	       
		if ($total_no_of_pages <= 4){  	 
			for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
				if ($counter == $page_no) {
			   $ui_str.='<li class="page-item active"><a class="page-link" >'.$counter.'</a></li>';	
					}else{
	           $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode($counter).'">'.$counter.'</a></li>';
					}
	        }
		}
		elseif($total_no_of_pages > 4){
			
		if($page_no <= 4) {			
		 for ($counter = 1; $counter <= 4; $counter++){		 
				if ($counter == $page_no) {
			   $ui_str.='<li class="page-item active"><a href="" class="page-link" >'.$counter.'</a></li>';	
					}else{
	           $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode($counter).'">'.$counter.'</a></li>';
					}
	        }
			$ui_str.='<li class="page-item" ><a href="" class="page-link">...</a></li>';
			$ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode($second_last).'">'.$second_last.'</a></li>';
			$ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode($total_no_of_pages).'">'.$total_no_of_pages.'</a></li>';
			}

		 elseif($page_no > 4 && $page_no < $total_no_of_pages - 2) {		 
			$ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode(1).'">1</a></li>';
			$ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode(2).'">2</a></li>';
	        $ui_str.='<li class="page-item" ><a class="page-link" >...</a></li>';
	        for ($counter = $page_no - $mobi_adjacents; $counter <= $page_no + $mobi_adjacents; $counter++) {			
	           if ($counter == $page_no) {
			   $ui_str.='<li class="page-item active"><a class="page-link" >'.$counter.'</a></li>';	
					}else{
	           $ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode($counter).'">'.$counter.'</a></li>';
					}                  
	       }
	       $ui_str.='<li class="page-item" ><a class="page-link" >...</a></li>';
		   $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode($second_last).'">'.$second_last.'</a></li>';
		   $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode($total_no_of_pages).'">'.$total_no_of_pages.'</a></li>';      
	            }
			
			else {
	        $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode(1).'">1</a></li>';
			$ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode(2).'">2</a></li>';
	        $ui_str.='<li class="page-item" ><a class="page-link" >...</a></li>';

	        for ($counter = $total_no_of_pages - 2; $counter <= $total_no_of_pages; $counter++) {
	          if ($counter == $page_no) {
			   $ui_str.='<li class="page-item active"><a class="page-link" >'.$counter.'</a></li>';	
					}else{
	           $ui_str.='<li class="page-item" ><a class="page-link" href="'.$clean_current_url.base64_encode($counter).'">'.$counter.'</a></li>';
					}                   
	                }
	            }
		}
	    
		$ui_str.='<li'; if($page_no >= $total_no_of_pages){ $ui_str.='class="page-item disabled"'; }else{ $ui_str.=' class="page-item"';} $ui_str.='>';
  
		$ui_str.='<a class="page-link"';  if($page_no < $total_no_of_pages) { $ui_str.='href="'.$clean_current_url.base64_encode($next_page).'"'; } $ui_str.='>Next</a>
		</li>';
	    if($page_no < $total_no_of_pages){
			$ui_str.='<li class="page-item" ><a class="page-link"  href="'.$clean_current_url.base64_encode($total_no_of_pages).'"> > </a></li>';
			} 
	$ui_str.='</ul>
</div>';
  
  if(isset($_GET["txtreclim"])){
	$_SESSION["filelim"]=$_GET["txtreclim"];
$ui_str.='
	<script>
	currrecloc=window.location.href;
	var paramtotrim = "?txtreclim";
	if (currrecloc.indexOf("&txtreclim") >= 0){
	paramtotrim ="&txtreclim";
	}
	
	window.location=window.location.href.split(paramtotrim)[0];
	</script>';
	
  }
 $ui_str.='
<script type="text/javascript">
//=========================== push write limit to file
function changelim(newlimit){
var pgtkn=newlimit;

var iofile = "?txtreclim="+pgtkn;
var currloc2 = window.location.href;
if (currloc2.indexOf("?") >= 0){
iofile = "&txtreclim="+pgtkn;
}
window.location=currloc2 +iofile;
//=========================== push write limit to file

}
</script>
';
    
return $ui_str;
    
}

?>
