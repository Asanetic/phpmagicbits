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
{header_css_scripts}
</head>

<body>
    <form method="post" enctype="multipart/form-data">
{navbar_path}
    <main role="main" class="container-fluid skin_plasma padding_row" style="min-height:100vh;">

      <div class="row mt-5 pt-5 justify-content-center">
        <h4 class="col-md-12" style="text-align: center;">{page_title}<br><br></h4>
          <!-- <{ncgh}/> - new code will replace this tag. Place it where you want the terminal to write new code-->
          <!--<{ncgh}/>-->
      </div>

    </main><!-- /.container -->


 <!-- Bootstrap core JavaScript -->
 <!-- Placed at the end of the document so the pages load faster -->
    
{footer_path}
    </form>
</body>
</html>
