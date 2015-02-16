<?php
/**
 * The template for displaying product content in the single-course.php template
 *
 * Override this template by copying it to yourtheme/sensei/content-single-course.php
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.0.0
 */

global $woothemes_sensei, $post, $current_user;
	 	
// Get User Meta
get_currentuserinfo();
// Check if the user is taking the course
$is_user_taking_course = WooThemes_Sensei_Utils::sensei_check_for_activity( array( 'post_id' => $post->ID, 'user_id' => $current_user->ID, 'type' => 'sensei_course_start' ) );
// Content Access Permissions
$access_permission = false;
if ( isset( $woothemes_sensei->settings->settings['access_permission'] ) && !$woothemes_sensei->settings->settings['access_permission'] ) {
	$access_permission = true;
} // End If Statement
?>
	<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	if ( WooThemes_Sensei_Utils::sensei_is_woocommerce_activated() ) {
		do_action( 'woocommerce_before_single_product' );
	} // End If Statement
	?>
<?php 
// if user clicks complete lesson. Set the lesson as complete. 
if ( isset( $_POST['quiz_complete'] ) && wp_verify_nonce( $_POST[ 'woothemes_sensei_complete_lesson_noonce' ], 'woothemes_sensei_complete_lesson_noonce' ) && ( isset( $_POST['post_id']) ) ) {

					$completed_post = $_POST['post_id']; 

                    // Mark lesson as complete
                    $args = array(
                                        'post_id' => $completed_post,
                                        'username' => $current_user->user_login,
                                        'user_email' => $current_user->user_email,
                                        'user_url' => $current_user->user_url,
                                        'data' => 'Lesson completed by the user',
                                        'type' => 'sensei_lesson_end', /* FIELD SIZE 20 */
                                        'parent' => 0,
                                        'user_id' => $current_user->ID
                                    );
                    $activity_logged = WooThemes_Sensei_Utils::sensei_log_activity( $args );
}
?>
<article <?php post_class( array( 'course', 'post' ) ); ?>>
	<div class="row">		
		<header class="twelve columns">
     	<div class="right">
				<!--<?php course_single_meta(); ?>-->
				<!--span><input type="submit" name="register_button" class="quiz-submit complete" value="<?php _e( 'Register', 'woothemes-sensei' ); ?>"/></span-->
				
				<?php 
  				if(!is_user_logged_in()){ ?>
			        <!-- echo "<a href='".wp_register('', '', false)."' class='button create-account'>Create Account</a>";  -->
			        <a href="<?php bloginfo('url'); ?>/wp-login.php?action=register" class="button create account">Register</a>
 				<?php }	?>
            	<!--<a class="addthis_button_compact button sharethis-button">Share This Page</a>-->
     	</div> <!-- .right -->

     	<div>
        	<h1><?php the_title(); ?></h1>
      		<p class="instructors h4">
						<?php 
							$instructors = get_field('instructors') ; 
							if($instructors):
								$count = 1;
								foreach ($instructors as $instructor) : 
									if($count > 1 ) { echo(" and "); } ?>
									<a href="<?php echo get_permalink($instructor->ID) ?>"><?php echo $instructor->post_title; ?></a>
								<?php 
								$count++;
								endforeach;
							endif; 
						?>
					</p>
        	
        	<?php get_template_part( 'sensei/content', 'course_meta' ); ?>					

			</div>
			
		</header>
	</div>
					<!--<?php 
						$course_id = 0;
						if(isset($_GET['lesson-id']) && $_GET['lesson-id']) {
							$course_id = $_GET['lesson-id'] - 1; 
						}
						$course_lessons = $woothemes_sensei->frontend->course->course_lessons( $post->ID ); 
					?>-->
	               				
	<!-- div class="row">
 		<section class="twelve columns lesson-meta">
 			<div class="widget-purchase right">
	 			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="<?php the_field('course_key'); ?>">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
 		</section>
 	</div --> <!-- .row -->
 	<div class="row">
 		<section class="eight columns lesson-meta">

   	<?php 
			//thisismyurl_the_content($course_lessons[$course_id]->ID); 
			//$custom_fields = get_post_custom($course_lessons[$course_id]->ID);
			//$test_meta = get_post_meta($course_lessons[$course_id]->ID); 
		?>
		<h2>Course Instructors</h2>
		
			<?php 
				$instructors = get_field('instructors') ; 
				if($instructors):

					foreach ($instructors as $post) : 
						setup_postdata($post); ?>
						<p class="instructor-name"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
					<?php 
					endforeach; wp_reset_postdata();
				endif;
				//echo $author->post_title; 
			?>
			<?php
			$prereqs = get_field('prerequisites');		
			if($prereqs): ?>
			
				<h2>Prerequisites</h2>
				<p><?php echo $prereqs;  ?></p>
		<?php endif; ?>
			<?php $objectives = get_field('course_objectives');
			if ($objectives): ?>
				<h2>Course Objectives</h2>
				<?php echo $objectives ?>
			<?php	endif; ?>

			<?php
			$post_object = get_field('location');
			if($post_object):
					$map_url = 'http://maps.apple.com/maps?z=12&amp;t=m&amp;q=loc:'.get_field("map", $post_object->ID); ?>
					<h2>Location</h2>
					<p><?php echo the_field("address", $post_object->ID); ?></p>
					<a target='_BLANK' title='Open map in new window' href='<?php echo $map_url; ?>'>
							(view map)
					</a>
			<?php	endif; ?>

 		</section>
 		<section class="four columns">

 			<h2>Cost: <span class="singlecourse-cost">$<?php the_field('cost'); ?></span></h2>
			<p><a href="#" class="button">Register</a></p>
		</section>
	</div> <!-- END .row -->
	<?php course_single_lessons(); ?>

	                	
	<?php 
		
		/*the_field('duration'); 
		echo get_the_date('m/d/Y'); 

							$stamp = get_field('expiry_date')/1000; 
							echo date('m/d/Y', $stamp); 
			*/			?>
</article><!-- .post -->

