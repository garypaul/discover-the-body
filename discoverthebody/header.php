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

  		<!--script type="text/javascript" src="//use.typekit.net/unp7zgu.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script -->
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	</head>
	
	<body <?php body_class(); ?>>

		<div class="top">
		
			<div class="row">
			
				<div class="six columns">

					<div class="row">

						<div class="twelve columns">

							<div class="row collapse">

								<form action="<?php echo home_url( '/' ); ?>" method="get">

									<div class="six mobile-three columns">
										
										<input type="text" id="search" placeholder="Search" name="s" value="<?php the_search_query(); ?>" />
									
									</div>

								</form>

							</div>

						</div>

					</div>

				</div>
				
				<div class="six columns">

					<?php 
					    wp_nav_menu( 
					    	array( 
					    		'menu' => 'top_menu', /* menu name */
					    		'menu_class' => 'menu',
					    		'theme_location' => 'top_menu', /* where in the theme it's assigned */
					    		'fallback_cb' => 'bones_main_nav_fallback', /* menu fallback */
					    		'depth' => '0',
								'items_wrap' => '<ul id="top-nav" class="nav menu">%3$s</ul>',
	
					    		//'walker' => new description_walker()
					    	)
					    );
				    ?>
				    					
				</div>
			
			</div>
		
		</div>
<div class="page-wrap"> <!-- ends in footer.php -->
		<header role="banner" id="top-header">

			<div class="row">
	
				<div class="twelve columns">

					<!-- <a class="brand" id="logo" href="<?php echo get_bloginfo('url'); ?>">Health<span>Key</span></a> -->
					
					<a class="brand" id="logo" href="<?php echo get_bloginfo('url'); ?>">

						<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/logo.png" alt="<?php bloginfo('name'); ?>"/>

					</a>

					<a class="brand" id="logo-mobile" href="<?php echo get_bloginfo('url'); ?>">

						<img src="<?php echo bloginfo('stylesheet_directory') ?>/images/logo-retina.png" alt="<?php bloginfo('name'); ?>"/>

					</a>

				</div>


				<div class="twelve columns mobile-search">

					<form action="<?php echo home_url( '/' ); ?>" method="get">

						<input type="text" id="search" placeholder="Search" name="s" value="<?php the_search_query(); ?>" />

					</form>

				</div>

	
				<nav class="main twelve columns">
					<?php 
					    wp_nav_menu( 
					    	array( 
					    		'menu' => 'main_nav', /* menu name */
					    		'menu_class' => 'menu',
					    		'theme_location' => 'main_nav', /* where in the theme it's assigned */
					    		'fallback_cb' => 'bones_main_nav_fallback', /* menu fallback */
					    		'depth' => '0',
								'items_wrap' => '<ul id="main-nav" class="nav menu">%3$s</ul>',
	
					    		//'walker' => new description_walker()
					    	)
					    );
				    ?>
			    </nav>

			    <?php if( is_front_page() ){ }else{?>

					<div class="breadcrumbs twelve columns">
						<?php if(function_exists('bcn_display'))
							{
								bcn_display();
							}
						?>
					</div>

				<?php } ?>
	
			</div>

			

		</header> <!-- end header -->
