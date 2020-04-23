<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['recordlimit'])){
$_SESSION['recordlimit']=TRUE;
$_SESSION['filelim']="15";
}


$limit_per_page='Limit to '.$_SESSION['filelim'].' records per Page'; 

if($_SESSION['filelim']=='100000000000000000'){
$limit_per_page=" Showing All Records ";
}
?><style>
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

</style>
<div style="width: 100%; text-align: center;">
<!--loop next pages -->
<p  class="looppage_labelwidget" align="center">  <?php echo $limit_per_page;?> | Change  
<select class="looppage_combowidget" onChange="changelim();" name="reclimcmb" id="reclimcmb">
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
Go to Page

<select class="looppage_combowidget"  onchange="nextnavpg();" id="pgtkn">
	<option value="<?php echo base64_encode("1")?>" >Go to</option>

  <?php
  //===================== change records limit ===============
  if(isset($_GET['txtreclim'])){
$_SESSION['filelim']=$_GET['txtreclim'];

	?>
	<script>
	currrecloc=window.location.href;
	var paramtotrim = "?txtreclim";
	if (currrecloc.indexOf("&txtreclim") >= 0){
	paramtotrim ="&txtreclim";
	}
	
	window.location=window.location.href.split(paramtotrim)[0];
	</script>
	<?php
  }
  //===================== change records limit ===============

  $showingpg="1";
  if(isset($_GET['rectkn'])){
  $showingpg=base64_decode($_GET['rectkn']);
  }
for($i=1; $i<=$pagination_record_count; $i++) {?>
<option value="<?php echo base64_encode($i)?>" >Page <?php echo $i?></option>
<?php }?>
</select>
| Showing page  <?php echo $showingpg;?>
</p>
 <!-- loop next pages  -->
<script>
function nextnavpg(){
var pgtkn=document.getElementById("pgtkn").value;
var recparam= "?rectkn="+pgtkn;
//===================== search if param already ==========
var currloc = window.location.href;
if (currloc.indexOf("?") >= 0){
recparam= "&rectkn="+pgtkn;
}

if (currloc.indexOf("&rectkn") >= 0){
currloc= currloc.split("&rectkn")[0];
}
if (currloc.indexOf("?rectkn") >= 0){
currloc= currloc.split("?rectkn")[0];
recparam= "?rectkn="+pgtkn;

}
//===================== search if param already ==========
window.location=currloc +recparam;
}

//=========================== push write limit to file
function changelim(){
var pgtkn=document.getElementById("reclimcmb").value;

var iofile = "?txtreclim="+pgtkn;
var currloc2 = window.location.href;
if (currloc2.indexOf("?") >= 0){
iofile = "&txtreclim="+pgtkn;
}
window.location=currloc2 +iofile;
//=========================== push write limit to file

}
</script>
</div>
