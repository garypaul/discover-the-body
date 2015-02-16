<?php get_header(); ?>
			
			<div id="content" role="main">
			
				<div class="row">
			
					<div id="main" class="twelve columns clearfix" >
	
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					
							<article class="author-introduction">
						
								<div class="thumbnail two columns">							
									<?php the_post_thumbnail( 'wpbs-featured' ); ?>
								</div>
								<div class="details eight columns">
									
									<h2 class="single-title"><?php the_title(); ?></h2>
									<?php the_content(); ?>

								</div>

								<!-- <div class="two columns share-page">
									<a href="#" class="button">Share this page</a>
								</div> -->

								<!-- <span class='st_sharethis_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='Share'>Share this page</span> -->
								<a class="addthis_button_compact button sharethis-button">Share This Page</a> 

						</article> <!-- end article -->


						
						<?php $authorID = $post->ID; ?>

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

					<?php get_sidebar('author'); // sidebar 1 ?>

				</div>
    
				
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
