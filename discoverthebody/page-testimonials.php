<?php 
/* 
* Template Name: Testimonials
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
							
							</article> <!-- end article -->
						
						<?php endwhile; endif;?>

						<section class="testimonial-list">
							
							<?php  

							$postPerPage = 10;

							if( $_GET['offset']){
								$paged = (int)$_GET['offset'];
								$offset =  ($paged * $postPerPage);
							}else{
								$paged = 0;
								$offset = 0;
							}

							$testimonial_args = array(
								'post_type' => 'testimonials', 
								'posts_per_page' => $postPerPage,
								'offset' => $offset

							);
							$testimonial = new WP_Query($testimonial_args); ?>

							<?php while ($testimonial->have_posts()): $testimonial->the_post(); ?>

								<article class="testimonial">																		

									<h4>
										<?php the_title(); ?>										
									</h4>
									<p><?php the_field('testimonial'); ?></p>
									<p>
										<?php the_field('author'); ?> - <?php the_field('date'); ?>
									</p>

								</article>

							<?php endwhile; ?>

						</section>

						<a href="#" class="back-top">back to top</a>

						<div class="pagination">
							<?php 
								$count = wp_count_posts('testimonials');
								$count = $count->publish;
								$mainCount = (int)($count / $postPerPage);
								$remainderCount = $count % $postPerPage;
								if($remainderCount > 0 ){$mainCount++;}
								$mainCount--; 
							?>

							<?php if($paged > 0 ) { ?>
								<a href="?offset=<?php echo $paged - 1; ?>">Previous Page</a>
							<?php }?>
							<?php if($mainCount > $paged){ ?>								
								<a href="?offset=<?php echo $paged + 1; ?>">Next Page</a>
							<?php } ?>
							

						</div>

						

					</div> <!-- end #main -->

				
				</div>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
