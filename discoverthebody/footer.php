</div > <!-- .page-wrap starts in header.php -->
			<footer role="contentinfo">
			
						<div class="row">

							<div class="twelve columns mobile-search">

								<form action="<?php echo home_url( '/' ); ?>" method="get">

									<input type="text" id="search" placeholder="Search" name="s" value="<?php the_search_query(); ?>" />

								</form>

							</div>

							<nav class="twelve columns clearfix">
								<?php 
								    wp_nav_menu( 
								    	array( 
								    		'menu' => 'footer_links', /* menu name */
								    		'menu_class' => 'menu',
								    		'theme_location' => 'footer_links', /* where in the theme it's assigned */
								    		'depth' => '0',
											'items_wrap' => '<ul id="footer-nav" class="nav menu ">%3$s</ul>',	
								    	)
								    );
							    ?>
							</nav>
							
							<div class="twelve columns footer-bottom">

								<p class="legal">&copy; <?php echo date('Y'); ?> Discover The Body</p>							
								<?php 
								    wp_nav_menu( 
								    	array( 
								    		'menu' => 'legal_links', /* menu name */
								    		'menu_class' => 'menu',
							    			'container'       => 'false',
								    		'theme_location' => 'legal_links', /* where in the theme it's assigned */
								    		'depth' => '0',
											'items_wrap' => '<ul id="legal-nav" class="nav menu ">%3$s</ul>',	
								    	)
								    );
							    ?>

							</div>


						</div>
					
			</footer> <!-- end footer -->
				
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>
