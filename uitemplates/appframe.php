<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{page_title}</title>

    <!-- Bootstrap core CSS -->
<?php include("{header_css_scripts}");?>
</head>

<body style="background-image: url('{background_image}');">
<?php include("{navbar_path}");?>
    <main role="main" class="container-fluid skin_plasma padding_row">

      <div class="row mt-5 pt-5 justify-content-center">
        <h4 class="col-md-12" style="text-align: center;">{page_title}<br><br></h2>
          <!-- <{ncgh}/> - new code will replace this tag. Pleace it where you want the terminal to write new code-->
          <!--<{ncgh}/>-->
      </div>

    </main><!-- /.container -->


 <!-- Bootstrap core JavaScript -->
 <!-- Placed at the end of the document so the pages load faster -->
    
<?php include("{footer_path}");?>
    
</body>
</html>
