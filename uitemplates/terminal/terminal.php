<?php
ob_start();

session_start();

//=========
$col_script_sample="
`primkey` int(255) PRIMARY KEY AUTO_INCREMENT,
`msgid` varchar(500) NOT NULL,
`client_name` varchar(500) NOT NULL,
`client_mobile` varchar(500) NOT NULL,
`client_email` varchar(500) NOT NULL,
`message_date` varchar(500) NOT NULL,
`client_note` TEXT NOT NULL";

include("./dtc/dataconfig.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Terminal X</title>

    <!-- Bootstrap core CSS -->
<style>
/* width */
::-webkit-scrollbar {
  width: 3px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #00235d; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: rgba(255,255,255,0.2); 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}

a{
  color: #FFF;
}
</style>
</head>

<body style="background-image: url('./img/alien.jpg'); background-size: cover; color: #FFF;">
<form method="post">
      <div style="text-align: center;">
        <h4 class="col-md-12" style="text-align: center;">Terminal X<br><br></h2>
        <?php if(isset($_POST['btn_exec_command'])){?>
            
             <a href="./terminal.php" type="submit" style="position: fixed; right: 20px; color: #FFF;">Refresh</a>
    <?php }?>
          <!-- <{ncgh}/> - new code will replace this tag. Pleace it where you want the terminal to write new code-->
          <div align="center" style="width: 100%">
          <div style="text-align: left; padding-top:130px; width: 70%;">
 
        <?php 

            include("./includes/phpmagicbits.php");

            function help()
            {
              return "Type echo fend_help(); for front end and echo bend_help(); for back end";
            }



          include("./includes/phpmagicui.php");
          include("./includes/phpmagicbackend.php");
          ?>
          <div style="max-height: 350px; overflow-y: scroll;">
            <code>


          <?php

                    //error handler function
          function customError($errno, $errstr) {
            echo "<b>Error:</b> [$errno] $errstr<hr>".help();
          }

          //set error handler
          set_error_handler("customError");


          if(isset($_POST['btn_exec_command']))
            {
          $file_to_write = fopen($_POST['txt_directory'], 'w') or die("can't open file");
          fwrite($file_to_write, "<?php ".$_POST['txt_new_code']."?>");
          fclose($file_to_write);

          echo $_POST['txt_new_code']."<hr>";
            }


          if(isset($_POST['btn_exec_command'])){
            include(($_POST['txt_directory']));
          }

          ?>
        </code>
          </div>
          <br><br>
          <input type="text" style="font-size: 12px; width: 15%; background-color: #00235d; color:#FFF; border: none; display: inline-block; padding-left: 2px;" value="<?php if(isset($_POST['txt_directory'])){ echo $_POST['txt_directory'];}else{ echo "./terminal_exe.php";}?>" name="txt_directory" required="" placeholder=" filepath">
          <input type="text" autofocus="true" style="font-size: 12px; width: 80%; background-color: #00235d; color:#FFF; border: none; display: inline-block; border-bottom: 1px solid rgba(255,255,255,0.4);" name="txt_new_code"  placeholder="Type command" value="<?php if(isset($_POST['txt_new_code'])) echo $_POST['txt_new_code'];?>" >
        </div>
      </div>
          <!--<{ncgh}/>-->
      </div>


 <!-- Bootstrap core JavaScript -->
 <!-- Placed at the end of the document so the pages load faster -->
          <div style="position: fixed; bottom: 6px; right: 20px; text-align: center;">
            <input type="submit" name="btn_exec_command" style="    width: 80px;
    height: 80px;
    border-radius: 50%;
    color: #FFF;
    cursor: pointer;
    background-color: #00235d;"  value="Run >">
    <hr>

          </div>
          </form>

    
</body>
</html>
