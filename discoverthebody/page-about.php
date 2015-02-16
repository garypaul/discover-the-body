<?php 
/* 
* Template Name: About
*/ 
get_header(); ?>
			
			<div id="content" role="main">
			
				<div class="row">
			
					<div id="main" class="twelve columns clearfix" >
	
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

								<section>

									<header class="desktop">
										
										<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
									
									</header> <!-- end article header -->
									<section class="post_content clearfix" itemprop="articleBody">
								
										<?php the_content(); ?>
						
									</section>
									<!--<div class="flex-video">

										<?php the_field('video'); ?>

									</div>-->
								</section>
								
								 <!-- end article section -->
							
							</article> <!-- end article -->
						
						<?php endwhile; endif;?>
				
					</div> <!-- end #main -->
				
				</div>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
