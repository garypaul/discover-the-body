<?php 
/* 
* Template Name: Basic Frame Only
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
				
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		
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

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	</head>

	<body <?php body_class(); ?>>

<div class="page-wrap">

	<header role="banner" id="top-header">
		<div class="row">
			<div class="twelve columns">
				<a class="brand" id="logo" href="<?php echo get_bloginfo('url'); ?>">
					<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/logo.png" alt="<?php bloginfo('name'); ?>"/>
				</a>
				<a class="brand" id="logo-mobile" href="<?php echo get_bloginfo('url'); ?>">
					<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/logo-retina.png" alt="<?php bloginfo('name'); ?>"/>
				</a>
			</div>
		</div>
	</header>

	<div id="content" role="main">
		<div class="row">
			<div id="main" class=" push-three six columns clearfix" >
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						<section>
							<header class="desktop">
								<h1 class="page-title text-centered" itemprop="headline"><?php the_title(); ?></h1>
							</header> <!-- end article header -->
							<section class="post_content clearfix" itemprop="articleBody">
								<?php the_content(); ?>
							</section>
						</section>
						 <!-- end article section -->
					</article> <!-- end article -->
				<?php endwhile; endif;?>
			</div> <!-- end #main -->
		</div>
	</div> <!-- end #content -->
</div> <!-- .page-wrap -->
</body>
</html>