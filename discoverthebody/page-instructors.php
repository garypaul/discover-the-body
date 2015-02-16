<?php 
/* 
* Template Name: Instructors
*/ 
get_header(); ?>
			
			<div id="content" role="main">
			
				<div class="row">
			
					<div id="main" class="twelve columns clearfix" >
	
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
								
								<header>
									
									<h1 class="page-title"><?php the_title(); ?></h1>
								
								</header> <!-- end article header -->
							
								<section class="post_content clearfix" itemprop="articleBody">

									<?php the_content(); ?>
							
								</section> <!-- end article section -->
							
							</article> <!-- end article -->
						
						<?php endwhile; endif;?>

						<section class="instructor-list">
							
							<?php  
							$authors_args = array(
								'post_type' => 'course-authors', 
								'posts_per_page' => -1
							);							
			   	
							$authors = new WP_Query($authors_args); ?>

							<?php global $more; ?>

							<?php while ($authors->have_posts()): $authors->the_post(); ?>

								<?php $more = 0; ?>

								<?php $authorID = $post->ID; ?>

								<article class="author row">
									
									<div class="three columns">
										<?php the_post_thumbnail( 'thumb' ); ?>
									</div>
									
									<div class="four columns author-info">
										<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<?php //the_content("show more"); ?>
											<?php the_excerpt(); ?>
											<a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
									</div>

									<div class="five columns author-courses">
										<h2>Courses</h2>

										<?php $author_courses_arg = array(
											'post_type' => 'course',
											'posts_per_page' => -1,
											'meta_query' => array(
												array(
													'key' => 'author',
													'value' => $authorID,
												)
											)
										); 

										$author_courses = new wp_query($author_courses_arg);  ?>

										<ul>

										<?php while ($author_courses->have_posts()): $author_courses->the_post(); ?>

											<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

										<?php endwhile; ?>

										</ul>

									</div>

								</article>

							<?php endwhile; ?>

						</section>	
				
					</div> <!-- end #main -->
				
				</div>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>