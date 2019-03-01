<!DOCTYPE html>
  <head>

        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

   
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>CamelTours</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>media/img/CamelToursIcon.ico"/>
    <!-- CSS links -->
    <link rel="stylesheet" href="<?php echo base_url();?>media/css/homestyle.css">
    <link rel="stylesheet" href="<?php echo base_url();?>media/css/foundation.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>media/css/foundation.mod.css">
    <link rel="stylesheet" href="<?php echo base_url();?>media/css/glyphicons.css">
    <!--<link rel="stylesheet" href="<?php echo base_url();?>media/css/catalog_beta.css">-->
    <?php if ($title="catalog") echo '<link rel="stylesheet" href="'.base_url().'media/css/catalog_beta.css>'."\n    "; ?>
    <?php if ($title == 'Node') echo '<link rel="stylesheet" href="'.base_url().'media/css/dropzone.css">'."\n    "; ?><!-- End CSS links -->
    
    <script src="<?php echo base_url();?>media/js/vendor/modernizr.js"></script>
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-101867950-1', 'auto');
	  ga('send', 'pageview');
    </script>
  </head>
  <body>
