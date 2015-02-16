<?php 
/* 
* Template Name: Case Studies
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

						<section class="case-studies">
							
							<?php  

							$postPerPage = 2;

							if( $_GET['offset']){
								$paged = (int)$_GET['offset'];
								$offset =  ($paged * $postPerPage);
							}else{
								$paged = 0;
								$offset = 0;
							}

							$case_studies_args = array(
								'post_type' => 'case-studies', 
								'posts_per_page' => $postPerPage,
								'offset' => $offset
							);
							$case_studies = new WP_Query($case_studies_args); ?>

							<?php while ($case_studies->have_posts()): $case_studies->the_post(); ?>

								<article class="case-study">																		

									<h4>
										<?php the_title(); ?>										
									</h4>

									<div class="row">
										
										<div class="six columns details">
											
											<?php the_content(); ?>

											<p><?php the_field('author'); ?> - <?php the_field('date'); ?></p>
										</div>

										<div class="six columns video">
											<?php the_field('video'); ?>
										</div>	
									</div>

								</article>

							<?php endwhile; ?>

						</section>

						<a href="#" class="back-top">back to top</a>

						<div class="pagination">
							
							<?php 
								$count = wp_count_posts('case-studies');
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
