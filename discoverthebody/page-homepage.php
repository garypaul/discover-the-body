<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
			
			<div id="content" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<div class="row">
			
					<div class="six columns page-intro" >

						<h1><?php the_title(); ?></h1>
	
						<?php the_content(); ?>
				
					</div> 
					
					<div class="six columns main-video">

							<?php //$vimeo_id = get_vimeo_id(get_field('main_video')); ?>
							
							<?php the_post_thumbnail('large'); ?>

					</div>

					<?php if(get_field('callouts')): ?>
						<?php while(has_sub_field('callouts')): ?>
							<div class="six columns callouts">
								<h2><?php the_sub_field('title'); ?></h2>
								
								<div class="row">

									<div class="callout-container">
								
										<!--div class="five columns callout-image">
										
											<?php $image = wp_get_attachment_image_src(get_sub_field('logo'), 'thumbnail'); ?>
											<img class="callout-img" src="<?php echo $image[0]; ?>" />
										
										</div -->
									
										<div class="seven columns callout-content">
										
											<p><?php the_sub_field('content'); ?></p>
											
										</div>

										<div class="five columns callout-button">

											<a href="<?php the_sub_field('link'); ?>" class="button"><?php the_sub_field('link_text'); ?></a>

										</div>

									</div>
																
								</div>
								
							</div>
					 
						<?php endwhile; ?>
										 
					<?php endif; ?>

					<div class="six columns featured-courses">

						
							
							<?php
							global $woothemes_sensei;

							if ( $woothemes_sensei->settings->settings[ 'course_archive_featured_enable' ] ) {

								//$woothemes_sensei->frontend->sensei_get_template( 'loop-featured-course.php' );
								$shortcode_override = 'featuredcourses';
							$woothemes_sensei->frontend->sensei_get_template( 'loop-course.php' );
						} 

							?>
					

						

					</div>
					
					<div class="six columns new-courses">
					
					<?php if(get_field('new_courses')): ?>
						

						<section class="course-container">
									 
						<header class="archive-header">
							<h1>New Courses</h1>					 
						</header>
						 
						<?php while(has_sub_field('new_courses')): 
							$course = get_sub_field('course');
							$post_id = absint( $course->ID );
							$post_title = $course->post_title;	?>
						
							<article class="<?php echo join( ' ', get_post_class( array( 'course', 'post' ), $post_id ) ); ?>">
								<?php
								// Image
								echo $woothemes_sensei->post_types->course->course_image( $post_id );
								?>
								<header>
									<h2><a href="<?php echo get_permalink( $post_id ); ?>" title="<?php echo esc_attr( $post_title ); ?>"><?php echo $post_title; ?></a></h2>
								</header>
								
								<section class="entry">
									<p class="sensei-course-meta">
										<?php if ( isset( $woothemes_sensei->settings->settings[ 'course_author' ] ) && ( $woothemes_sensei->settings->settings[ 'course_author' ] ) ) { ?>
											<span class="course-author"><?php _e( 'by ', 'woothemes-sensei' ); ?><a href="<?php echo $author_link; ?>" title="<?php echo esc_attr( $author_display_name ); ?>"><?php echo esc_html( $author_display_name   ); ?></a></span>
										<?php } // End If Statement ?>
										<!-- span class="course-lesson-count"><?php echo $woothemes_sensei->post_types->course->course_author_lesson_count( $author_id, $post_id ) . '&nbsp;' . __( 'Lectures', 'woothemes-sensei' ); ?></span -->	
										<? //php sensei_simple_course_price( $post_id ); ?>
									</p>
									<p><?php echo apply_filters( 'get_the_excerpt', $course->post_excerpt ); ?></p>
								</section>
							</article>
						<?php endwhile; ?>				 

				

					<?php endif; // get_field('new_courses') ?>

						<? /*php
							global $woothemes_sensei;
								$shortcode_override = 'newcourses';
							$woothemes_sensei->frontend->sensei_get_template( 'loop-course.php' ); */?>
						
						
					</div>



					

				</div> <!-- end of .row -->

				<?php endwhile; ?>

				<?php endif; ?>
				
				

			</div> <!-- end #content -->

<?php get_footer(); ?>
