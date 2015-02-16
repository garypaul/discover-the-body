<?php 
/* 
* Template Name: Support
*/ 
get_header(); ?>
			
			<div id="content" role="main">
			
				<div class="row">
			
					<div id="main" class="twelve columns clearfix" >
	
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							
							<header>
								
								<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
							
							</header> <!-- end article header -->
						
							<section class="post_content clearfix" itemprop="articleBody">
								<?php the_content(); ?>
						
							</section> <!-- end article section -->
							
							<footer>
				
								<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>
								
							</footer> <!-- end article footer -->
						
						</article> <!-- end article -->
						
						<?php comments_template(); ?>
						
						<?php endwhile; ?>		
						
						<?php else : ?>
						
						<article id="post-not-found">
						    <header>
						    	<h1>Not Found</h1>
						    </header>
						    <section class="post_content">
						    	<p>Sorry, but the requested resource was not found on this site.</p>
						    </section>
						    <footer>
						    </footer>
						</article>
						
						<?php endif; ?>
				
					</div> <!-- end #main -->
	    
				</div>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
