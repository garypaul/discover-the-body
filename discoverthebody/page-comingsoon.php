<?php
/*
Template Name: Coming Soon
*/
?>
<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title><?php wp_title('', true, 'right'); ?></title>
				
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<!-- favicons -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
				
		<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  		<script type="text/javascript" src="//use.typekit.net/unp7zgu.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<!--<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />-->
				
	</head>
	
<body <?php body_class(); ?>>

	
		<header role="banner" id="top-header" style="width:100%">

			<div style="width:100%;">
	
				<div style="margin-left: auto; margin-right: auto; width:25%;">

					<!-- <a class="brand" id="logo" href="<?php echo get_bloginfo('url'); ?>">Health<span>Key</span></a> -->
					<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/logo.png" alt="<?php bloginfo('name'); ?>"/>
					


					<!--<a class="brand" id="logo-mobile" href="<?php echo get_bloginfo('url'); ?>">

						<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/logo-retina.png" alt="<?php bloginfo('name'); ?>"/>

					</a>-->

				

				<!--<div class="twelve columns mobile-search">

					<form action="<?php echo home_url( '/' ); ?>" method="get">

						<input type="text" id="search" placeholder="Search" name="s" value="<?php the_search_query(); ?>" />

					</form>

				</div>-->

	
				<nav class="main twelve columns">
					<br><br>
					<font face="helvetica" size="15px" >Coming Soon...</font>
					
			    </nav>
			    </div>
	
			</div>

			

		</header> <!-- end header -->

