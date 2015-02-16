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

if ( ! defined( 'ABSPATH' ) ) exit;

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

        	<article <?php post_class( array( 'course', 'post' ) ); ?>>
				<div class="row">
					<div class="twelve columns">
						<?php do_action( 'sensei_course_image', $post->ID ); ?>

		                <?php do_action( 'sensei_course_single_title' ); ?>
						

		                	<section class="course-content">
		                		<?php the_content(); ?>
		                	</section>


		                	

	                			<?php get_template_part( 'sensei/content', 'course_meta' ); ?>

	                		
		                
		                
		                <?php if ( ( is_user_logged_in() && $is_user_taking_course ) || ( $access_permission ) ) { ?>
		                
		                	<section class="course-resources">
		                		<h2>Course Resources</h2>
								<?php
								$downloads = get_field('downloads');
									if($downloads){ ?>
										<a href="<?php echo $downloads['url'] ?>" class="button"><?php echo $downloads['title']?></a>
										<span class="link-caption"><?php echo $downloads['caption'] ?></span>
								<?php } // end if(downloads) ?>
		                	</section>
 		                <!-- this is where we'd show lessons if there were any -->
		                <?php  do_action( 'sensei_course_single_lessons' ); ?>
               		
                		<?php } // End Protected Content ?>
		                
	                </div> <!-- .twelve.columns- -->
                </div> <!-- .row -->


            </article><!-- .post -->

	        <?php //do_action('sensei_pagination'); ?>